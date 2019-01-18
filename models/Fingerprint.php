<?php
namespace app\models;

use yii\db\ActiveRecord;

class Fingerprint extends ActiveRecord
{
    const TABLE_NAME = '{{fingerprints}}';

    public static function tableName()
    {
        return self::TABLE_NAME;
    }
}