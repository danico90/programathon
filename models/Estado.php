<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property integer $Id
 * @property string $Nombre
 * @property integer $PaisID
 *
 * @property Pais $pais
 * @property Pyme[] $pymes
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'PaisID'], 'required'],
            [['PaisID'], 'integer'],
            [['Nombre'], 'string', 'max' => 50],
            [['PaisID'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['PaisID' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'Estado',
            'Nombre' => 'Nombre',
            'PaisID' => 'Pais ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Pais::className(), ['Id' => 'PaisID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPymes()
    {
        return $this->hasMany(Pyme::className(), ['EstadoID' => 'Id']);
    }
}
