<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $comercialName;
    public $country;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'comercialName', 'country'], 'required'],
            [['comercialName'], 'string', 'max' => 100],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'min' => 8],
            [['password'], 'string', 'max' => 10],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['comercialName', 'validateCommerceName'],
            ['country', 'validateCountry']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function validateCommerceName($attribute, $params) 
    {
        if (!$this->hasErrors()) {

            $user = $this->getUser();
            $dbUser = Usuario::findOne(['ID' => $user->id]);
            $userPymes = Pyme::find()->where(['UsuarioID' => $user->id]);
            
            if (!$userPymes || $userPymes->count() == 0) {
                $this->addError($attribute, 'Incorrect commercial name'); 
            }
            else {
                $found = 0;
                foreach($userPymes->all() as $pyme) {
                    if ($pyme->NombreComercio === $this->comercialName)
                    {
                        $found = 1;
                    }
                }
                if ($found == 0) {
                    
                    $this->addError($attribute, 'Incorrect commercial name'); 
                }
            }


        }

    }

     public function validateCountry($attribute, $params) 
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            $dbUser = Usuario::findOne(['ID' => $user->id]);
            $userPymes = Pyme::find()->where(['UsuarioID' => $user->id]);
            
            if (!$userPymes || $userPymes->count() == 0) {
                $this->addError($attribute, 'Incorrect country'); 
            }
            else {
                $found = 0;
                foreach($userPymes->all() as $pyme) {
                    $estado = Estado::findOne(['Id' => $pyme->EstadoID]);
                    
                    if ($estado->PaisID == $this->country)
                    {
                        $found = 1;
                    }
                }
                if ($found == 0) {
                    
                    $this->addError($attribute, 'Incorrect country'); 
                }
            }
        }

    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            //$dbUser = Usuario::findOne(['ID' => $this->id]);
            Yii::$app->session->set('user', $this->getUser());
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de usuario',
            'password' => 'Contraseña',
            'country' => 'País',
            'comercialName' => 'Nombre comercial'
        ];
    }
}
