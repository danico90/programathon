<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Role".
 *
 * @property integer $RoleID
 * @property string $Description
 *
 * @property UserRole[] $userRoles
 * @property Appuser[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Description'], 'required'],
            [['Description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RoleID' => 'Role ID',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasMany(UserRole::className(), ['RoleID' => 'RoleID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Appuser::className(), ['UserID' => 'UserID'])->viaTable('UserRole', ['RoleID' => 'RoleID']);
    }
}
