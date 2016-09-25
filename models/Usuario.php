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
            [['RepetirClave'], 'validatePassword'],
            [['RepetirEmailContacto'], 'validateEmail']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'Usuario',
            'Usuario' => 'Usuario',
            'NombreCompleto' => 'Nombre Completo',
            'Clave' => 'Contraseña',
            'RepetirClave' => 'Repetir Contraseña',
            'EmailContacto' => 'Email Contacto',
            'RepetirEmailContacto' => 'Repetir el Email de Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPymes()
    {
        return $this->hasMany(Pyme::className(), ['UsuarioID' => 'ID']);
    }

    /**
     * Validates the password. It shoud match when repeating the password.
     */
    public function validatePassword($password)
    {
        if($this->Clave != $password) {
            $this->addError($password, 'Las claves no son iguales');
        }
    }

    /**
     * Validates the email. It shoud match when repeating the email.
     */
    public function validateEmail($email)
    {
        if($this->EmailContacto != $email) {
            $this->addError($email, 'Las email no son iguales');
        }
    }
}
