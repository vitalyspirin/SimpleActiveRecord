<?php

namespace vitalyspirin\yii2\simpleactiverecord;

require_once('TableSchema.php');
require_once('MySqlTableSchemaParser.php');


class YiiValidationRulesBuilder extends TableSchema
{
    const DATABASE_IS_NOT_SUPPORTED = 'Database is not supported';
    public static  $supportedDatabaseList = [
        'mysql' => 'vitalyspirin\yii2\simpleactiverecord\MySqlTableSchemaParser'
    ];
    protected $tableSchemaParserClass;
    
    
    public function __construct($maximumValidation, $tableName)
    {
        
        if (! $this->isDatabaseSupported(\Yii::$app->db->dsn))
        {
            throw new Exception(DATABASE_IS_NOT_SUPPORTED);
        }


        if ( isset(MySqlTableSchemaParser::$describeTable[$tableName]) )
        {
            $tableSchemaRowList = MySqlTableSchemaParser::$describeTable[$tableName];
        } else
        {

            $command = \Yii::$app->db->createCommand('DESCRIBE ' . $tableName);
            $tableSchemaRowList = $command->queryAll();
            MySqlTableSchemaParser::$describeTable[$tableName] = $tableSchemaRowList;
            
            $command = \Yii::$app->db->createCommand('SHOW CREATE TABLE ' . $tableName);
            $tableSchemaStr = $command->queryAll();
            MySqlTableSchemaParser::$showCreateTable[$tableName] = 
                $tableSchemaStr[0]['Create Table'];
        }

        $tableSchemaParser = new $this->tableSchemaParserClass($this, $tableName, 
            $tableSchemaRowList, $maximumValidation);


        parent::__construct();
    }
    
    
    protected function isDatabaseSupported($dns)
    {
        $result = false;
        
        foreach(self::$supportedDatabaseList as $supportedDatabase => $tableSchemaClass)
        {
            if (substr($dns, 0, strlen($supportedDatabase)) == $supportedDatabase)
            {
                $this->tableSchemaParserClass = $tableSchemaClass;
                
                $result = true;
                break;
            }
        }
        
        return $result;
    }
    
    
    public function buildRequiredRules(&$ruleList)
    {
        if ( count($this->requiredColumnList) > 0)
        {
            $ruleList[] = [$this->requiredColumnList, 'required'];
        }
    }
    
    
    public function buildBooleanRules(&$ruleList)
    {
        if ( count($this->booleanColumnList) > 0)
        {
            $ruleList[] = [$this->booleanColumnList, 'boolean'];
        }

    }
    
    
    public function buildIntegerRules(&$ruleList)
    {
        if ( count($this->integerColumnList) > 0)
        {
            $ruleList[] = [$this->integerColumnList, 'integer'];
        }
    }
    
    
    public function buildNumericRules(&$ruleList)
    {
        if ( count($this->numericColumnList) > 0)
        {
            $ruleList[] = [$this->numericColumnList, 'number'];
        }
    }
    
    
    public function buildOtherRules(&$ruleList)
    {
        if ( count($this->otherColumnList) > 0)
        {
            $ruleList[] = [$this->otherColumnList, 'safe'];
        }
    }
    
    
    public function buildStringRules(&$ruleList)
    {
        foreach($this->stringColumnList as $stringLength=>$columnNameList)
        {
            if ($stringLength == TableSchema::DEFAULT_LEGNTH_STRINGS)
            {
                $ruleList[] = [$columnNameList, 'string'];
            } else
            {
                $ruleList[] = [$columnNameList, 'string', 'max'=>$stringLength];
            }
        }
    }
    
    
    public function buildUniqueRules(&$ruleList)
    {
        foreach($this->uniqueColumnList as $columnInOneConstraintList)
        {
            if ( count($columnInOneConstraintList) > 1 )
            {
                $columnListAsStr = [];
                foreach($columnInOneConstraintList as $columnName)
                {
                    $columnListAsStr[] = \yii\helpers\Inflector::camel2words($columnName);
                }

                $ruleList[] = [$columnInOneConstraintList, 'unique', 
                    'targetAttribute'=>$columnInOneConstraintList,
                    'message'=>'The combination of ' . 
                        implode(' and ', $columnListAsStr) . 
                        ' has already been taken.'
                ];
            } else
            {
                $ruleList[] = [$columnInOneConstraintList, 'unique'];
            }
        }
    }
    
    
    public function buildRangeRules(&$ruleList)
    {
        foreach($this->rangeColumnList as $valueListStr=>$columnNameList)
        {
            preg_match_all("/'(.*?)'/", $valueListStr, $matches);
            
            $ruleList[] = [ $columnNameList, 'in', 'range'=>$matches[1] ];
        }
    }
    
    
    public function buildDateRules(&$ruleList)
    {
        foreach($this->dateColumnList as $dateType=>$valueList)
        {
            if ( isset($valueList[0]) )
            {
                $ruleList[] = [$valueList[0], 'date', 'format'=>$valueList['format'], 
                    'min' => $valueList['min'], 'max' => $valueList['max']
                ];
            }
        }
    }
    
    
    public function buildTimeRules(&$ruleList)
    {
        if ( count($this->timeColumnList) > 0)
        {
            $ruleList[] = [$this->timeColumnList, 'match', 
                'pattern' => TableSchema::TIME_PATTERN];
        }
    }
    
    
    public function buildIntegerWithRangeRules(&$ruleList)
    {
        foreach($this->integerWithRangeColumnList as $integerType=>$valueList)
        {
            if ( isset($valueList[0]) )
            {
                $ruleList[] = [$valueList[0], 'integer', 
                    'min'=>$valueList['min'], 'max'=>$valueList['max']
                ];
            }
        }
    }
    
    
    public function buildNumberWithRangeRules(&$ruleList)
    {
        foreach($this->numberWithRangeColumnList as $numberType=>$valueList)
        {
            if ( isset($valueList[0]) )
            {
                if ( isset($valueList['max']) )
                {
                    $ruleList[] = [$valueList[0], 'number', 
                        'min'=>$valueList['min'], 'max'=>$valueList['max']
                    ];
                } elseif ( isset($valueList['min']) )
                {
                    $ruleList[] = [$valueList[0], 'number', 
                        'min'=>$valueList['min']
                    ];
                } else
                {
                    $ruleList[] = [$valueList[0], 'number'];
                }
            }
        }
    }
    
    public function buildDefaultRules(&$ruleList)
    {
        foreach($this->defaultColumnList as $value=>$attributeList)
        {
            if ($value === 'CURRENT_TIMESTAMP')
            {
                $ruleList[] = [$attributeList, 'default', 'value' => 
                    function ($model, $attribute) { return date('Y-m-d H:i:s'); }
                ];
             
            } else
            {
                $ruleList[] = [$attributeList, 'default', 'value' => $value];
            }
        }
    }
    
}
