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
    public $EstadoID;
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
            [['RepetirEmailContacto'], 'validateEmail'],
            [['Usuario'], 'validateUniqeUserName']
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
            'EstadoID' => ''
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
    public function validatePassword($passwordAttr)
    {
        if($this->Clave != $this->RepetirClave) {
            $this->addError($passwordAttr, 'Las claves no son iguales');
        }
    }

    /**
     * Validates the email. It shoud match when repeating the email.
     */
    public function validateEmail($emailAttr)
    {
        if($this->EmailContacto != $this->RepetirEmailContacto) {
            $this->addError($emailAttr, 'Las email no son iguales');
        }
    }

    /**
     * Validates the unique UserName on a Pyme
     */
    public function validateUniqeUserName($userNameAttr)
    {
        
        $isUnique = true;
        $dbUser = Usuario::findOne(['Usuario' => $this->Usuario, 'Clave' => $this->Clave]);
echo "-----------------";
        
        if($dbUser) {
            print_r($dbUser);
            $dbPyme = Pyme::findOne(['UsuarioID' => $dbUser->ID, 'EstadoID' => $this->EstadoID]);
            if($dbPyme) {
                $this->addError($userNameAttr, 'El nombre de usuario indicado para esa PYME para el país seleccionado ya existe.');
            }
        }
    }
}
