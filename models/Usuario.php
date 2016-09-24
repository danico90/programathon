<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $ID
 * @property string $Usuario
 * @property string $NombreCompleto
 * @property string $Clave
 * @property string $RepetirClave
 * @property string $EmailContacto
 * @property string $RepetirEmailContacto
 *
 * @property Pyme[] $pymes
 */
class Usuario extends \yii\db\ActiveRecord
{
    public $RepetirClave;
    public $RepetirEmailContacto;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Usuario', 'NombreCompleto', 'Clave', 'EmailContacto', 'RepetirClave', 'RepetirEmailContacto'], 'required'],
            [['Usuario', 'Clave', 'EmailContacto', 'RepetirClave', 'RepetirEmailContacto'], 'string', 'max' => 50],
            [['NombreCompleto'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Usuario' => 'Usuario',
            'NombreCompleto' => 'Nombre Completo',
            'Clave' => 'Contraseña',
            'RepetirClave' => 'Repetir Contraseña',
            'EmailContacto' => 'Email Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPymes()
    {
        return $this->hasMany(Pyme::className(), ['UsuarioID' => 'ID']);
    }

    public function validatePassword($password)
    {
        return $this->Clave === $password;
    }
}
