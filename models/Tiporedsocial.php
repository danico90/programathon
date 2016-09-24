<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiporedsocial".
 *
 * @property integer $Id
 * @property string $Nombre
 *
 * @property Redsocial[] $redsocials
 * @property Pyme[] $pymes
 */
class Tiporedsocial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiporedsocial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre'], 'required'],
            [['Nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'Tipo de red social',
            'Nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedsocials()
    {
        return $this->hasMany(Redsocial::className(), ['TipoRedSocialID' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPymes()
    {
        return $this->hasMany(Pyme::className(), ['Id' => 'PymeID'])->viaTable('redsocial', ['TipoRedSocialID' => 'Id']);
    }
}
