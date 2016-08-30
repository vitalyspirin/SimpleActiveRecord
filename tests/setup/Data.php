<?php

class Data
{
    public static $dataForNotNullColumnsArray = [
        'col_tinyint2' => 128, // valid max is only 127
        'col_tinyint4' => 256, // valid max is only 255
        'col_bool2' => 2,
        'col_boolean2' => 2,
        'col_smallint2' => 32768, // valid max is only 32767
        'col_smallint4' => 65536, // valid max is only 65535
        'col_mediumint2' => 8388608, // valid max is only 8388607
        'col_mediumint4' => 16777216, // valid max is only 16777215
        'col_int2' => 2147483648, // valid max is only 2147483647
        'col_int4' => 4294967296, // valid max is only 4294967295
        'col_integer2' => 2147483648, // valid max is only 2147483647
        'col_integer4' => 4294967296, // valid max is only 4294967295
        'col_bigint2' => 9223372036854775808, // valid max is only 9223372036854775807
        'col_bigint4' => 9223372036854775807, // MySQL valid max is only 18446744073709551615
                                              // but PHP doesn't support unsigned integer
        'col_decimal2' => 1,
        'col_decimal4' => 2,
        'col_dec2' => 3,
        'col_dec4' => 4,
        'col_float2' => 3.402823466E+39, // valid max is only 3.402823466E+38
        'col_float4' => -3.402823466E+39,// valid min is only -3.402823466E+38
        'col_double2' => 1.7976931348623157E+309, // valid max is only 1.7976931348623157E+308
        'col_double4' => 1.7976931348623157E+309, // valid max is only 1.7976931348623157E+308
        'col_doubleprecision2' => 1.7976931348623157E+309,
        'col_doubleprecision4' => 1.7976931348623157E+309,

        'col_char2' => '123',
        'col_char4' => '123',
        'col_varchar2' => '1234',
        'col_binary2' => '12',
        'col_binary4' => '123',
        'col_varbinary2' => '1234',
        'col_tinyblob2' => 101,
        'col_tinytext2' => 102,
        'col_blob2' => 103,
        'col_text2' => 104,
        'col_mediumblob2' => 105,
        'col_mediumtext2' => 106,
        'col_longblob2' => 107,
        'col_longtext2' => 108,

        'col_enum2' => 'val1',
        'col_set2' => 'val2',
        'col_date2' => '999-01-01',
        'col_datetime2' => '999-01-01 00:00:00.000000',
        'col_time2' => '839:59:59.000000' // valid max is only '838:59:59.000000'
    ];


    public static $dataDefaultSQLValidForNotNullColumnsArray = [
        'col_bigint2' => 9223372036854775807,
        'col_double2' => 1.7976931348623157E+308,
        'col_double4' => 1.7976931348623157E+308,
        'col_doubleprecision2' => 1.7976931348623157E+308,
        'col_doubleprecision4' => 1.7976931348623157E+308,
        'col_char2' => '1',
        'col_binary2' => '1',
        'col_char4' => '12',
        'col_binary4' => '12',
        'col_varchar2' => '123',
        'col_varbinary2' => '123',
        'col_tinyblob2' => '101', // maximum length of 255 bytes.
        'col_tinytext2' => '102', // maximum length of 255 characters
        'col_blob2' => '103', // maximum length of 65,535 bytes
        'col_text2' => '104', //  maximum length of 65,535 characters
        'col_mediumblob2' => '105', // maximum length of 16,777,215 bytes
        'col_mediumtext2' => '106', // maximum length of 16,777,215 characters
        'col_longblob2' => '107', // maximum length of 4,294,967,295 or 4GB bytes
        'col_longtext2' => '108' // maximum length of 4,294,967,295 or 4GB characters
    ];

    public static $dataStrictSQLValidForNotNullColumnsArray = [
        'col_bit2' => true,
        'col_bit4' => false,
        'col_bit6' => 3,
        'col_tinyint2' => 127, // valid max is only 127
        'col_tinyint4' => 255, // valid max is only 255
        'col_smallint2' => 32767, // valid max is only 32767
        'col_smallint4' => 65535, // valid max is only 65535
        'col_mediumint2' => 8388607, // valid max is only 8388607
        'col_mediumint4' => 16777215, // valid max is only 16777215
        'col_int2' => 2147483647, // valid max is only 2147483647
        'col_int4' => 4294967295, // valid max is only 4294967295
        'col_integer2' => 2147483647, // valid max is only 2147483647
        'col_integer4' => 4294967295, // valid max is only 4294967295
    //    'col_bigint2' => 9223372036854775807, // valid max is only 9223372036854775807
    //    'col_bigint4' => 9223372036854775807, // valid max is only 9223372036854775807

        'col_float2' => 3.402823466E+38, // valid max is only 3.402823466E+38
        'col_float4' => 3.402823466E+38,// valid max is only 3.402823466E+38
    //    'col_double2' => 1.7976931348623157E+308, // valid max is only 1.7976931348623157E+308
    //    'col_double4' => 1.7976931348623157E+309, // valid max is only 1.7976931348623157E+308

        'col_enum2' => 'value1',
        'col_set2' => 'value2',
        'col_date2' => '1000-01-01',
        'col_datetime2' => '1000-01-01 00:00:00',
        'col_time2' => '838:59:59' // valid max is only '838:59:59.000000'
    ];

    public static $dataForColumnsWithDefaultValuesArray = [
        'col_tinyint5' => 11,
        'col_tinyint6' => 11,
        'col_tinyint7' => 111,
        'col_tinyint8' => 112,
        'col_bool3' => true,
        'col_boolean3' => false,
        'col_smallint5' => 11,
        'col_mediumint5' => 12,
        'col_int5' => 13,
        'col_integer5' => 13,
        'col_bigint6' => 14,
        'col_decimal5' => 15,
        'col_dec5' => 16,
        'col_float5' => 17,
        'col_double5' => 18,
        'col_doubleprecision5' => 19,

        'col_char5' => 'a',
        'col_char6' => 'b',
        'col_varchar3' => 'cd',
        'col_varchar4' => 'efg',
        'col_binary5' => 'hi',
        'col_binary6' => 'jk',
        'col_varbinary3' => 'lm',
        'col_varbinary4' => 'no',

        'col_enum3' => 'value2',
        'col_set3' => 'value2',

        'col_datetime3' => '2014-01-02 00:01:02',
        'col_datetime4' => '2015-03-04 09:10:20'
    ];


    public static $dataPrimaryKeyArray = [
        'col_id' => 1
    ];
}
