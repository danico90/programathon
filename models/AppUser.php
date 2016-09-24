<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appuser".
 *
 * @property integer $UserID
 * @property string $Name
 * @property string $LastName
 * @property integer $Active
 * @property string $Password
 */
class AppUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AppUser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'LastName', 'Active', 'Password'], 'required'],
            [['Active'], 'integer'],
            [['Name', 'LastName'], 'string', 'max' => 100],
            [['Password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'Name' => 'Name',
            'LastName' => 'Last Name',
            'Active' => 'Active',
            'Password' => 'Password',
        ];
    }
}
