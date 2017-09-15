<?php

use vitalyspirin\yii2\simpleactiverecord\SimpleActiveRecord;

class PersonView extends SimpleActiveRecord
{
    public static function tableName()
    {
        return 'person_view';
    }
}
