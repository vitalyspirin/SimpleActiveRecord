<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t1".
 *
 * @property integer $col_id
 * @property boolean $col_bit1
 * @property boolean $col_bit2
 * @property boolean $col_bit3
 * @property boolean $col_bit4
 * @property integer $col_bit5
 * @property integer $col_bit6
 * @property integer $col_tinyint1
 * @property integer $col_tinyint2
 * @property integer $col_tinyint3
 * @property integer $col_tinyint4
 * @property integer $col_bool1
 * @property integer $col_bool2
 * @property integer $col_boolean1
 * @property integer $col_boolean2
 * @property integer $col_smallint1
 * @property integer $col_smallint2
 * @property integer $col_smallint3
 * @property integer $col_smallint4
 * @property integer $col_mediumint1
 * @property integer $col_mediumint2
 * @property integer $col_mediumint3
 * @property integer $col_mediumint4
 * @property integer $col_int1
 * @property integer $col_int2
 * @property integer $col_int3
 * @property integer $col_int4
 * @property integer $col_integer1
 * @property integer $col_integer2
 * @property integer $col_integer3
 * @property integer $col_integer4
 * @property integer $col_bigint1
 * @property integer $col_bigint2
 * @property string $col_bigint3
 * @property string $col_bigint4
 * @property integer $col_bigint5
 * @property string $col_decimal1
 * @property string $col_decimal2
 * @property string $col_decimal3
 * @property string $col_decimal4
 * @property string $col_dec1
 * @property string $col_dec2
 * @property string $col_dec3
 * @property string $col_dec4
 * @property double $col_float1
 * @property double $col_float2
 * @property double $col_float3
 * @property double $col_float4
 * @property double $col_double1
 * @property double $col_double2
 * @property double $col_double3
 * @property double $col_double4
 * @property double $col_doubleprecision1
 * @property double $col_doubleprecision2
 * @property double $col_doubleprecision3
 * @property double $col_doubleprecision4
 * @property string $col_char1
 * @property string $col_char2
 * @property string $col_char3
 * @property string $col_char4
 * @property string $col_varchar1
 * @property string $col_varchar2
 * @property string $col_binary1
 * @property string $col_binary2
 * @property string $col_binary3
 * @property string $col_binary4
 * @property string $col_varbinary1
 * @property string $col_varbinary2
 * @property string $col_tinyblob1
 * @property string $col_tinyblob2
 * @property string $col_tinytext1
 * @property string $col_tinytext2
 * @property resource $col_blob1
 * @property resource $col_blob2
 * @property string $col_text1
 * @property string $col_text2
 * @property string $col_mediumblob1
 * @property string $col_mediumblob2
 * @property string $col_mediumtext1
 * @property string $col_mediumtext2
 * @property resource $col_longblob1
 * @property resource $col_longblob2
 * @property string $col_longtext1
 * @property string $col_longtext2
 * @property string $col_enum1
 * @property string $col_enum2
 * @property string $col_set1
 * @property string $col_set2
 * @property string $col_date1
 * @property string $col_date2
 * @property string $col_datetime1
 * @property string $col_datetime2
 * @property string $col_timestamp1
 * @property string $col_timestamp2
 * @property string $col_time1
 * @property string $col_time2
 *
 * @property T2[] $t2s
 */
class T1YiiModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['col_bit1', 'col_bit2', 'col_bit3', 'col_bit4'], 'boolean'],
            [['col_bit5', 'col_bit6', 'col_tinyint1', 'col_tinyint2', 'col_tinyint3', 'col_tinyint4', 'col_bool1', 'col_bool2', 'col_boolean1', 'col_boolean2', 'col_smallint1', 'col_smallint2', 'col_smallint3', 'col_smallint4', 'col_mediumint1', 'col_mediumint2', 'col_mediumint3', 'col_mediumint4', 'col_int1', 'col_int2', 'col_int3', 'col_int4', 'col_integer1', 'col_integer2', 'col_integer3', 'col_integer4', 'col_bigint1', 'col_bigint2', 'col_bigint3', 'col_bigint4', 'col_bigint5'], 'integer'],
            [['col_tinyint2', 'col_tinyint4', 'col_bool2', 'col_boolean2', 'col_smallint2', 'col_smallint4', 'col_mediumint2', 'col_mediumint4', 'col_int2', 'col_int4', 'col_integer2', 'col_integer4', 'col_bigint2', 'col_bigint4', 'col_decimal2', 'col_decimal4', 'col_dec2', 'col_dec4', 'col_float2', 'col_float4', 'col_double2', 'col_double4', 'col_doubleprecision2', 'col_doubleprecision4', 'col_char2', 'col_char4', 'col_varchar2', 'col_binary2', 'col_binary4', 'col_varbinary2', 'col_tinyblob2', 'col_tinytext2', 'col_blob2', 'col_text2', 'col_mediumblob2', 'col_mediumtext2', 'col_longblob2', 'col_longtext2', 'col_enum2', 'col_set2', 'col_date2', 'col_datetime2', 'col_time2'], 'required'],
            [['col_decimal1', 'col_decimal2', 'col_decimal3', 'col_decimal4', 'col_dec1', 'col_dec2', 'col_dec3', 'col_dec4', 'col_float1', 'col_float2', 'col_float3', 'col_float4', 'col_double1', 'col_double2', 'col_double3', 'col_double4', 'col_doubleprecision1', 'col_doubleprecision2', 'col_doubleprecision3', 'col_doubleprecision4'], 'number'],
            [['col_tinyblob1', 'col_tinyblob2', 'col_tinytext1', 'col_tinytext2', 'col_blob1', 'col_blob2', 'col_text1', 'col_text2', 'col_mediumblob1', 'col_mediumblob2', 'col_mediumtext1', 'col_mediumtext2', 'col_longblob1', 'col_longblob2', 'col_longtext1', 'col_longtext2', 'col_enum1', 'col_enum2', 'col_set1', 'col_set2'], 'string'],
            [['col_date1', 'col_date2', 'col_datetime1', 'col_datetime2', 'col_timestamp1', 'col_timestamp2', 'col_time1', 'col_time2'], 'safe'],
            [['col_char1', 'col_char2', 'col_binary1', 'col_binary2'], 'string', 'max' => 1],
            [['col_char3', 'col_char4', 'col_varchar1', 'col_binary3', 'col_binary4', 'col_varbinary1'], 'string', 'max' => 2],
            [['col_varchar2', 'col_varbinary2'], 'string', 'max' => 3],
            [['col_int1'], 'unique'],
            [['col_integer1', 'col_integer3'], 'unique', 'targetAttribute' => ['col_integer1', 'col_integer3'], 'message' => 'The combination of Col Integer1 and Col Integer3 has already been taken.'],
            [['col_bigint1', 'col_bigint3', 'col_bigint5'], 'unique', 'targetAttribute' => ['col_bigint1', 'col_bigint3', 'col_bigint5'], 'message' => 'The combination of Col Bigint1, Col Bigint3 and Col Bigint5 has already been taken.'],
            [['col_timestamp1'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'col_id' => 'Col ID',
            'col_bit1' => 'Col Bit1',
            'col_bit2' => 'Col Bit2',
            'col_bit3' => 'Col Bit3',
            'col_bit4' => 'Col Bit4',
            'col_bit5' => 'Col Bit5',
            'col_bit6' => 'Col Bit6',
            'col_tinyint1' => 'Col Tinyint1',
            'col_tinyint2' => 'Col Tinyint2',
            'col_tinyint3' => 'Col Tinyint3',
            'col_tinyint4' => 'Col Tinyint4',
            'col_bool1' => 'Col Bool1',
            'col_bool2' => 'Col Bool2',
            'col_boolean1' => 'Col Boolean1',
            'col_boolean2' => 'Col Boolean2',
            'col_smallint1' => 'Col Smallint1',
            'col_smallint2' => 'Col Smallint2',
            'col_smallint3' => 'Col Smallint3',
            'col_smallint4' => 'Col Smallint4',
            'col_mediumint1' => 'Col Mediumint1',
            'col_mediumint2' => 'Col Mediumint2',
            'col_mediumint3' => 'Col Mediumint3',
            'col_mediumint4' => 'Col Mediumint4',
            'col_int1' => 'Col Int1',
            'col_int2' => 'Col Int2',
            'col_int3' => 'Col Int3',
            'col_int4' => 'Col Int4',
            'col_integer1' => 'Col Integer1',
            'col_integer2' => 'Col Integer2',
            'col_integer3' => 'Col Integer3',
            'col_integer4' => 'Col Integer4',
            'col_bigint1' => 'Col Bigint1',
            'col_bigint2' => 'Col Bigint2',
            'col_bigint3' => 'Col Bigint3',
            'col_bigint4' => 'Col Bigint4',
            'col_bigint5' => 'Col Bigint5',
            'col_decimal1' => 'Col Decimal1',
            'col_decimal2' => 'Col Decimal2',
            'col_decimal3' => 'Col Decimal3',
            'col_decimal4' => 'Col Decimal4',
            'col_dec1' => 'Col Dec1',
            'col_dec2' => 'Col Dec2',
            'col_dec3' => 'Col Dec3',
            'col_dec4' => 'Col Dec4',
            'col_float1' => 'Col Float1',
            'col_float2' => 'Col Float2',
            'col_float3' => 'Col Float3',
            'col_float4' => 'Col Float4',
            'col_double1' => 'Col Double1',
            'col_double2' => 'Col Double2',
            'col_double3' => 'Col Double3',
            'col_double4' => 'Col Double4',
            'col_doubleprecision1' => 'Col Doubleprecision1',
            'col_doubleprecision2' => 'Col Doubleprecision2',
            'col_doubleprecision3' => 'Col Doubleprecision3',
            'col_doubleprecision4' => 'Col Doubleprecision4',
            'col_char1' => 'Col Char1',
            'col_char2' => 'Col Char2',
            'col_char3' => 'Col Char3',
            'col_char4' => 'Col Char4',
            'col_varchar1' => 'Col Varchar1',
            'col_varchar2' => 'Col Varchar2',
            'col_binary1' => 'Col Binary1',
            'col_binary2' => 'Col Binary2',
            'col_binary3' => 'Col Binary3',
            'col_binary4' => 'Col Binary4',
            'col_varbinary1' => 'Col Varbinary1',
            'col_varbinary2' => 'Col Varbinary2',
            'col_tinyblob1' => 'Col Tinyblob1',
            'col_tinyblob2' => 'Col Tinyblob2',
            'col_tinytext1' => 'Col Tinytext1',
            'col_tinytext2' => 'Col Tinytext2',
            'col_blob1' => 'Col Blob1',
            'col_blob2' => 'Col Blob2',
            'col_text1' => 'Col Text1',
            'col_text2' => 'Col Text2',
            'col_mediumblob1' => 'Col Mediumblob1',
            'col_mediumblob2' => 'Col Mediumblob2',
            'col_mediumtext1' => 'Col Mediumtext1',
            'col_mediumtext2' => 'Col Mediumtext2',
            'col_longblob1' => 'Col Longblob1',
            'col_longblob2' => 'Col Longblob2',
            'col_longtext1' => 'Col Longtext1',
            'col_longtext2' => 'Col Longtext2',
            'col_enum1' => 'Col Enum1',
            'col_enum2' => 'Col Enum2',
            'col_set1' => 'Col Set1',
            'col_set2' => 'Col Set2',
            'col_date1' => 'Col Date1',
            'col_date2' => 'Col Date2',
            'col_datetime1' => 'Col Datetime1',
            'col_datetime2' => 'Col Datetime2',
            'col_timestamp1' => 'Col Timestamp1',
            'col_timestamp2' => 'Col Timestamp2',
            'col_time1' => 'Col Time1',
            'col_time2' => 'Col Time2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT2s()
    {
        return $this->hasMany(T2::className(), ['col_id' => 'col_id']);
    }
}
