<?php

require_once 'YiiValidationRulesBuilder.php';


class SimpleActiveRecord extends yii\db\ActiveRecord
{
   
    protected static $ruleList = [];
    protected $yiiValidationRulesBuilder;
    protected $maximumValidation;
    
    
    public function __construct($maximumValidation = true, $config = [])
    {
        $this->maximumValidation = $maximumValidation;
        
        $this->yiiValidationRulesBuilder = 
            new YiiValidationRulesBuilder($maximumValidation, self::tableName());


        if ( !isset(self::$ruleList[self::tableName()][$this->maximumValidation]) )
        {
            if ($maximumValidation)
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
