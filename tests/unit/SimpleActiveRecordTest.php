<?php

require_once(__DIR__ . '/../setup/yii_init.php');

ini_set('display_errors', 1);

require_once(__DIR__ . '/../../src/SimpleActiveRecord.php');
require_once(__DIR__ . '/../setup/T1.php');
require_once(__DIR__ . '/../setup/T2.php');
require_once(__DIR__ . '/../setup/T3.php');
require_once(__DIR__ . '/../setup/Person.php');
require_once(__DIR__ . '/../setup/T1YiiModel.php');
require_once(__DIR__ . '/../setup/T2YiiModel.php');
require_once(__DIR__ . '/../setup/Data.php');

use app\models\T1YiiModel;
use app\models\T2YiiModel;

/**
 * @covers SimpleActiveRecord
 * @covers YiiValidationRulesBuilder
 * @covers TableSchema
 * @covers MySQLTableSchemaParser
 */

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

class SimpleActiveRecordTest extends PHPUnit_Framework_TestCase
{
    protected static $testDBName = 'simpleactiverecord';


    public static function setDSN()
    {
        if (strpos(Yii::$app->db->dsn, 'dbname') === false) {
            Yii::$app->db->dsn .= ';dbname=' . self::$testDBName;
        }
    }


    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        $command = Yii::$app->db->createCommand("SET @@sql_mode = ''");
        try {
            $result = $command->execute();
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage() . "\n";
            echo "Possilbe cause: MySQL is not running!\n";
            exit;
        }

        $command = Yii::$app->db->nocache(function (\yii\db\Connection $db) {
            $SqlStr = file_get_contents(__DIR__ . '/../setup/mysql.sql');

            return $db->createCommand($SqlStr);
        });
        $result = $command->execute();


        // closing and opening connection below is needed otherwise Yii gives error:
        // "Cannot execute queries while other unbuffered queries are active."
        Yii::$app->db->close();
        self::setDSN();
        Yii::$app->db->open();

        $command = Yii::$app->db->createCommand("SET @@sql_mode = ''");
        $result = $command->execute();


        parent::__construct($name, $data, $dataName);
    }


    public function testSaveEmptyRecord()
    {
        $t1 = new T1(false /*Yii style validation only*/);
        $result = $t1->save();

        $t1YiiModel = new T1YiiModel();
        $resultYii = $t1YiiModel->save();

        $this->compareMultidimensionalArrays($t1->getErrors(), $t1YiiModel->getErrors(),
            'SimpleActiveRecord', 'Yii Active Record');

        $this->compareMultidimensionalArrays($t1YiiModel->getErrors(), $t1->getErrors(),
            'Yii Active Record', 'SimpleActiveRecord');


        $t1 = new T1(true /*maixum validation*/);
        $result = $t1->save();
        foreach (Data::$dataForNotNullColumnsArray as $columnName => $value) {
            $this->assertArrayHasKey($columnName, $t1->getErrors(),
                "No validation error for $columnName when saving " .
                'with maximum validation.');
        }
    }


    public function testSaveLongStrings()
    {
        $t1 = new T1(false /*Yii style validation only*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $result = $t1->save();

        $t1YiiModel = new T1YiiModel();
        $t1YiiModel->attributes = Data::$dataForNotNullColumnsArray;
        $resultYii = $t1YiiModel->save();

        $this->compareMultidimensionalArrays($t1->getErrors(), $t1YiiModel->getErrors(),
            'SimpleActiveRecord', 'Yii Active Record');
        $this->compareMultidimensionalArrays($t1YiiModel->getErrors(), $t1->getErrors(),
            'Yii Active Record', 'SimpleActiveRecord');


        $t1 = new T1(true /*maixum validation*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $result = $t1->save();
        foreach (Data::$dataDefaultSQLValidForNotNullColumnsArray as $columnName => $value) {
            $this->assertArrayHasKey($columnName, $t1->getErrors(),
                "No validation error for $columnName when saving " .
                'with maximum validation.');
        }
    }


    public function testDecimal()
    {
        $t1 = new T1(false /*Yii style validation only*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->col_decimal1 = 'a';

        $result = $t1->save();
        $this->assertCount(1, $t1->getErrors());

        $t1 = new T1(/*maximum validation by default*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->attributes = Data::$dataStrictSQLValidForNotNullColumnsArray;
        $t1->col_decimal1 = 'a';

        $t1->validate();
        $this->assertCount(1, $t1->getErrors());

        $t1->col_decimal1 = 1.1;
        $t1->validate();
        $this->assertCount(0, $t1->getErrors());

        $t1->col_decimal3 = 'a';
        $t1->validate();
        $this->assertCount(1, $t1->getErrors());

        $t1->col_decimal3 = -1;
        $t1->validate();
        $this->assertCount(1, $t1->getErrors());
    }


    public function testSuccessfulSaveInDefaultSQLMode()
    {
        $t1 = new T1(false /*Yii style validation only*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;

        // for further test of unique validator
        $t1->col_int1 = 1;
        $t1->col_integer1 = 2;
        $t1->col_integer3 = 3;
        $result = $t1->save();

        $this->assertCount(0, $t1->getErrors());
    }


    /**
     * need prior saving of row to test unique values.
     *
     * @depends testSuccessfulSaveInDefaultSQLMode
     */
    public function testForUniqueWithDefaultValidation()
    {
        $t1 = new T1(false /*Yii style validation only*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->col_int1 = 1;
        $t1->col_integer1 = 2;
        $t1->col_integer3 = 3;
        $result = $t1->save();

        $t1YiiModel = new T1YiiModel();
        $t1YiiModel->attributes = $t1->attributes;
        $resultYii = $t1YiiModel->save();

        $this->compareMultidimensionalArrays($t1->getErrors(), $t1YiiModel->getErrors(),
            'SimpleActiveRecord', 'Yii Active Record');
        $this->compareMultidimensionalArrays($t1YiiModel->getErrors(), $t1->getErrors(),
            'Yii Active Record', 'SimpleActiveRecord');

        $this->assertTrue(array_key_exists('col_int1', $t1->getErrors()));
    }


    public function testFailedSaveInStrictSQLMode()
    {
        $command = Yii::$app->db->createCommand("SET @@sql_mode = 'TRADITIONAL'");
        $result = $command->execute();

        $t2 = new T1(true /*maximum validation*/);
        $t1 = new T1(/*maximum validation by default*/);

        $this->assertJsonStringEqualsJsonString(
            json_encode($t1->rules()),
            json_encode($t2->rules())
        );

        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $result = $t1->save();

        foreach (Data::$dataStrictSQLValidForNotNullColumnsArray as $columnName => $value) {
            $this->assertArrayHasKey($columnName, $t1->getErrors(),
                "No validation error for $columnName when saving in SQL " .
                'strict mode with maximum validation.');
        }
    }


    /**
     * need prior switch to strict SQL mode.
     *
     * @depends testFailedSaveInStrictSQLMode
     */
    public function testSuccessfulSaveInStrictSQLMode()
    {
        $t1 = new T1(/*maximum validation by default*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->attributes = Data::$dataStrictSQLValidForNotNullColumnsArray;
        $result = $t1->save();

        $this->assertCount(0, $t1->getErrors());
    }


    public function testForUniqueWithMaximumValidation()
    {
        $t1 = new T1(/*maximum validation by default*/);
        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->col_int1 = 1;
        $result = $t1->save();

        $this->assertTrue(array_key_exists('col_int1', $t1->getErrors()));

        $t1->col_integer1 = 2;
        $t1->col_integer3 = 3;
        $result = $t1->save();

        $this->assertTrue(array_key_exists('col_integer1', $t1->getErrors()));
        $this->assertTrue(array_key_exists('col_integer3', $t1->getErrors()));
    }


    public function testForTableWithOneColumn()
    {
        $t2 = new T2(false);
        $t2YiiModel = new T2YiiModel();

        $this->assertEquals(count($t2->rules()), count($t2YiiModel->rules()));
    }


    public function testForAutoIncrement()
    {
        $t1 = new T1(true);

        $primaryKey = key($t1->getPrimaryKey(true));
        $this->assertNotContains($primaryKey, json_encode($t1->rules()));

        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->attributes = Data::$dataStrictSQLValidForNotNullColumnsArray;
        $t1->attributes = Data::$dataPrimaryKeyArray;
        $result = $t1->save();

        $this->assertCount(0, $t1->getErrors());

        $t2 = new T2(false);
        $primaryKey = key($t2->getPrimaryKey(true));
        $this->assertContains($primaryKey, json_encode($t2->rules()));

        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->attributes = Data::$dataStrictSQLValidForNotNullColumnsArray;
        $t1->attributes = Data::$dataPrimaryKeyArray;
        $result = $t1->save();
    }


    public function testForSafe()
    {
        $t1 = new T1(false);
        $t1YiiModel = new T1YiiModel();

        $t1SafeList = [];
        foreach ($t1->rules() as $array) {
            if ($array[1] == 'safe') {
                $t1SafeList = $array[0];
                break;
            }
        }

        $t1YiiModelSafeList = [];
        foreach ($t1YiiModel->rules() as $array) {
            if ($array[1] == 'safe') {
                $t1YiiModelSafeList = $array[0];
                break;
            }
        }

        $this->assertEquals($t1SafeList, $t1YiiModelSafeList);
    }


    public function testForInputParameters()
    {
        $t1 = new T1(['col_tinyint1' => 13]);
        $this->assertEquals($t1->col_tinyint1, 13);

        $t1 = new T1(true, ['col_tinyint1' => 14]);
        $this->assertEquals($t1->col_tinyint1, 14);

        $t1 = new T1(false, ['col_tinyint1' => 15]);
        $this->assertEquals($t1->col_tinyint1, 15);
    }


    public function testForAttributeLabels()
    {
        $t1 = new T1();
        $t1YiiModel = new T1YiiModel();

        $this->assertEquals(count($t1->attributeLabels()),
            count($t1YiiModel->attributeLabels()));

        foreach ($t1YiiModel->attributeLabels() as $attribute => $label) {
            $this->assertTrue(isset($t1->attributeLabels()[$attribute]));
            $this->assertEquals($t1->attributeLabels()[$attribute], $label);
        }
    }


    public function testForEnumValues()
    {
        $t1 = new T1();

        $this->assertEquals($t1->getEnumValues()['col_enum1'], ['value1', 'value2']);

        $this->assertEquals($t1->getEnumValues()['col_enum2'],
            ['value1', 'value2', 'value3']);

        $this->assertEquals($t1->getEnumValues()['col_set1'],
            ['value1', 'value2']);
    }


    public function testDefaultValues()
    {
        $t1 = new T1();

        $t1->attributes = Data::$dataForNotNullColumnsArray;
        $t1->attributes = Data::$dataDefaultSQLValidForNotNullColumnsArray;
        $t1->attributes = Data::$dataStrictSQLValidForNotNullColumnsArray;

        $result = $t1->save();

        $this->assertTrue($result);

        foreach (Data::$dataForColumnsWithDefaultValuesArray as $columnName => $defaulValue) {
            $this->assertEquals($t1->$columnName, $defaulValue);
        }
    }


    public function testTableNameMethod()
    {
        try {
            $t3 = new T3();
            $this->assertTrue(true);
        } catch (Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }


    public function testLabels()
    {
        $person = new Person();
        $attributeLabels = $person->attributeLabels();
        $this->assertEquals($attributeLabels['person_id'], 'Person ID');
        $this->assertEquals($attributeLabels['person_firstname'], 'First name');
        $this->assertEquals($attributeLabels['person_lastname'], 'Last name');
        $this->assertEquals($attributeLabels['person_gender'], 'Person Gender');
    }


    protected function compareMultidimensionalArrays($array1, $array2,
        $array1Name = 'First array', $array2Name = 'Second Array')
    {
        foreach ($array1 as $columName => $errorList) {
            $this->assertArrayHasKey($columName, $array2,
                "$array2Name doesn't have elements for $columName. " .
                "$array1Name has the following elements: " .
                json_encode($array1[$columName]));

            $array1ColumnCountRecursive = count($array1[$columName], COUNT_RECURSIVE);
            $array2ColumnCountRecursive = count($array2[$columName], COUNT_RECURSIVE);

            if (count($array1[$columName]) == $array1ColumnCountRecursive &&
                count($array2[$columName]) == $array2ColumnCountRecursive) { // one dimensional arrays
                $diffArray = array_diff($array1[$columName], $array2[$columName]);

                $this->assertCount(0, $diffArray,
                    "$array1Name has extra: " . json_encode($diffArray));
            } else {
                $this->assertEquals(json_encode($array1[$columName]),
                    json_encode($array2[$columName]),
                    "count recursive ($array1Name [$columName]) = $array1ColumnCountRecursive"
                    . ". count recursive ($array2Name [$columName]) = $array2ColumnCountRecursive");
            }
        }
    }
}
