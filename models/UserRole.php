<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UserRole".
 *
 * @property integer $UserID
 * @property integer $RoleID
 *
 * @property Appuser $user
 * @property Role $role
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UserRole';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserID', 'RoleID'], 'required'],
            [['UserID', 'RoleID'], 'integer'],
            [['UserID'], 'exist', 'skipOnError' => true, 'targetClass' => Appuser::className(), 'targetAttribute' => ['UserID' => 'UserID']],
            [['RoleID'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['RoleID' => 'RoleID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'RoleID' => 'Role ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Appuser::className(), ['UserID' => 'UserID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['RoleID' => 'RoleID']);
    }
}
