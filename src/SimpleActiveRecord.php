<?php

require_once 'YiiValidationRulesBuilder.php';

use yii\helpers\Inflector;


class SimpleActiveRecord extends yii\db\ActiveRecord
{
   
    protected static $ruleList = [];
    protected $yiiValidationRulesBuilder;
    protected $maximumValidation;
    
    
    public function __construct($maximumValidation = true, $config = [])
    {
        if ( is_bool($maximumValidation))
        {
            $this->maximumValidation = $maximumValidation;
        } else
        {
            $this->maximumValidation = true;
            $config = $maximumValidation; // probably $config passed as first 
                                            // and only parameter
        }
        
        $this->yiiValidationRulesBuilder = 
            new YiiValidationRulesBuilder($this->maximumValidation, self::tableName());


        if ( !isset(self::$ruleList[self::tableName()][$this->maximumValidation]) )
        {
            if ($this->maximumValidation)
            {
                $this->buildStrictRules();
            } else
            {
                $this->buildDefaultRules();
            }
        } else
        {
            ; // for code coverage analysis
        }
        
        parent::__construct($config);
    }


    public function rules()
    {
        return self::$ruleList[self::tableName()][$this->maximumValidation];
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
        $attributeLabelList = [];

        foreach($this->attributes() as $attribute)
        {
            $attributeLabelList[$attribute] = 
                $this->generateAttributeLabel($attribute);
        }
        
        return $attributeLabelList;
    }
    
    
    public function getEnumValues()
    {
        return $this->yiiValidationRulesBuilder->enumValuesColumnList;
    }
    
    
    protected function buildDefaultRules()
    {
        $ruleList = [];
        
        $this->yiiValidationRulesBuilder->buildBooleanRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildIntegerRules($ruleList);

        $this->yiiValidationRulesBuilder->buildRequiredRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildNumericRules($ruleList);

        $this->yiiValidationRulesBuilder->buildOtherRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildStringRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildUniqueRules($ruleList);
        
        self::$ruleList[self::tableName()][$this->maximumValidation] = $ruleList;
    }
    

    protected function buildStrictRules()
    {
        $ruleList = [];
        
        $this->yiiValidationRulesBuilder->buildRequiredRules($ruleList);

        $this->yiiValidationRulesBuilder->buildRangeRules($ruleList);

        $this->yiiValidationRulesBuilder->buildDateRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildTimeRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildIntegerWithRangeRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildNumberWithRangeRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildStringRules($ruleList);
        
        $this->yiiValidationRulesBuilder->buildUniqueRules($ruleList);
        
        self::$ruleList[self::tableName()][$this->maximumValidation] = $ruleList;
    }
    
    
    
}
