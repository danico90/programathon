<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta".
 *
 * @property integer $ID
 * @property integer $Respuesta01
 * @property integer $Respuesta02
 * @property integer $Respuesta03
 * @property integer $Respuesta04
 * @property integer $Respuesta05
 * @property string $FechaRespuesta
 * @property string $GeneroID
 * @property string $Campo01
 * @property string $Campo02
 * @property integer $RangoEdad
 * @property integer $PymeID
 *
 * @property Genero $genero
 * @property Pyme $pyme
 */
class Respuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Respuesta01', 'Respuesta02', 'Respuesta03', 'Respuesta04', 'Respuesta05', 'FechaRespuesta', 'GeneroID', 'RangoEdad', 'PymeID'], 'required'],
            [['Respuesta01', 'Respuesta02', 'Respuesta03', 'Respuesta04', 'Respuesta05', 'RangoEdad', 'PymeID'], 'integer'],
            [['FechaRespuesta'], 'safe'],
            [['GeneroID'], 'string', 'max' => 1],
            [['Campo01', 'Campo02'], 'string', 'max' => 100],
            [['GeneroID'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['GeneroID' => 'Id']],
            [['PymeID'], 'exist', 'skipOnError' => true, 'targetClass' => Pyme::className(), 'targetAttribute' => ['PymeID' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'Respuestas',
            'Respuesta01' => 'Respuesta01',
            'Respuesta02' => 'Respuesta02',
            'Respuesta03' => 'Respuesta03',
            'Respuesta04' => 'Respuesta04',
            'Respuesta05' => 'Respuesta05',
            'FechaRespuesta' => 'Fecha Respuesta',
            'GeneroID' => 'Genero ID',
            'Campo01' => 'Campo01',
            'Campo02' => 'Campo02',
            'RangoEdad' => 'Rango Edad',
            'PymeID' => 'Pyme ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::className(), ['Id' => 'GeneroID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPyme()
    {
        return $this->hasOne(Pyme::className(), ['Id' => 'PymeID']);
    }
}
