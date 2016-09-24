<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property string $Id
 * @property string $Nombre
 *
 * @property Pyme[] $pymes
 * @property Respuesta[] $respuestas
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Nombre'], 'required'],
            [['Id'], 'string', 'max' => 1],
            [['Nombre'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPymes()
    {
        return $this->hasMany(Pyme::className(), ['GeneroPropietarioID' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['GeneroID' => 'Id']);
    }
}
