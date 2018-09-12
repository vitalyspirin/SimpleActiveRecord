<?php

namespace vitalyspirin\yii2\simpleactiverecord;

use yii\helpers\Inflector;

class SimpleActiveRecord extends \yii\db\ActiveRecord
{
    protected static $ruleList = [];
    protected static $yiiValidationRulesBuilder;
    protected $maximumValidation;


    public function __construct($maximumValidation = true, $config = [])
    {
        if (is_bool($maximumValidation)) {
            $this->maximumValidation = $maximumValidation;
        } else {
            $this->maximumValidation = true;
            $config = $maximumValidation; // probably $config passed as first
                                            // and only parameter
        }

        if (!isset(static::$yiiValidationRulesBuilder[static::tableName()][$this->maximumValidation])) {
            static::$yiiValidationRulesBuilder[static::tableName()][$this->maximumValidation] =
                new YiiValidationRulesBuilder($this->maximumValidation, static::tableName());
        }


        if (!isset(static::$ruleList[static::tableName()][$this->maximumValidation])) {
            if ($this->maximumValidation) {
                $this->buildStrictRules();
            } else {
                $this->buildDefaultRules();
            }
        } else {
            ; // for code coverage analysis
        }

        parent::__construct($config);
    }


    public function rules()
    {
        return static::$ruleList[static::tableName()][$this->maximumValidation];
    }


    public function generateAttributeLabel($name)
    {
        $label = Inflector::camel2words($name);
        // the following part is taken from Gii model generator
        if (!empty($label) && substr_compare($label, ' id', -3, 3, true) === 0) {
            $label = substr($label, 0, -3) . ' ID';
        }

        return $label;
    }


    public function attributeLabels()
    {
        $attributeLabelList = $this->getYiiValidationRulesBuilder()->commentColumnList;

        foreach ($this->attributes() as $attribute) {
            if (empty($attributeLabelList[$attribute])) {
                $attributeLabelList[$attribute] =
                    $this->generateAttributeLabel($attribute);
            }
        }

        return $attributeLabelList;
    }


    public function getEnumValues()
    {
        return $this->getYiiValidationRulesBuilder()->enumValuesColumnList;
    }


    protected function getYiiValidationRulesBuilder()
    {
        return static::$yiiValidationRulesBuilder[static::tableName()][$this->maximumValidation];
    }

    protected function buildDefaultRules()
    {
        $ruleList = [];

        $yiiValidationRulesBuilder = $this->getYiiValidationRulesBuilder();

        $yiiValidationRulesBuilder->buildBooleanRules($ruleList);

        $yiiValidationRulesBuilder->buildIntegerRules($ruleList);

        $yiiValidationRulesBuilder->buildRequiredRules($ruleList);

        $yiiValidationRulesBuilder->buildNumericRules($ruleList);

        $yiiValidationRulesBuilder->buildOtherRules($ruleList);

        $yiiValidationRulesBuilder->buildStringRules($ruleList);

        $yiiValidationRulesBuilder->buildUniqueRules($ruleList);

        static::$ruleList[static::tableName()][$this->maximumValidation] = $ruleList;
    }


    protected function buildStrictRules()
    {
        $ruleList = [];

        $yiiValidationRulesBuilder = $this->getYiiValidationRulesBuilder();

        $yiiValidationRulesBuilder->buildDefaultRules($ruleList); // has to be first to fill value before applying other rules

        $yiiValidationRulesBuilder->buildRequiredRules($ruleList);

        $yiiValidationRulesBuilder->buildRangeRules($ruleList);

        $yiiValidationRulesBuilder->buildDateRules($ruleList);

        $yiiValidationRulesBuilder->buildTimeRules($ruleList);

        $yiiValidationRulesBuilder->buildIntegerWithRangeRules($ruleList);

        $yiiValidationRulesBuilder->buildNumberWithRangeRules($ruleList);

        $yiiValidationRulesBuilder->buildStringRules($ruleList);

        $yiiValidationRulesBuilder->buildUniqueRules($ruleList);

        static::$ruleList[static::tableName()][$this->maximumValidation] = $ruleList;
    }
}
