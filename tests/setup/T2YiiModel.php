<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t2".
 *
 * @property integer $col_id
 *
 * @property T1 $col
 */
class T2YiiModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['col_id'], 'required'],
            [['col_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'col_id' => 'Col ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCol()
    {
        return $this->hasOne(T1::className(), ['col_id' => 'col_id']);
    }
}
