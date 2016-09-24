<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property integer $Id
 * @property string $Nombre
 * @property string $Iso
 * @property string $Iso3
 * @property integer $CodigoNumerico
 * @property integer $CodigoTelefono
 *
 * @property Estado[] $estados
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Nombre', 'Iso', 'CodigoTelefono'], 'required'],
            [['Id', 'CodigoNumerico', 'CodigoTelefono'], 'integer'],
            [['Nombre'], 'string', 'max' => 50],
            [['Iso'], 'string', 'max' => 2],
            [['Iso3'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Nombre' => 'Nombre',
            'Iso' => 'Iso',
            'Iso3' => 'Iso3',
            'CodigoNumerico' => 'Codigo Numerico',
            'CodigoTelefono' => 'Codigo Telefono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstados()
    {
        return $this->hasMany(Estado::className(), ['PaisID' => 'Id']);
    }
}
