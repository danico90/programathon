<?php

namespace app\models;

use yii\base\Model;
use Yii;

class PymeSocialMedias extends Model
{
    public $linkFacebook;
    public $linkTwitter;
    public $linkLinkedIn;
    public $linkYoutube;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['linkFacebook'], 'required'],
            [['linkFacebook', 'linkTwitter', 'linkLinkedIn', 'linkYoutube'], 'string','max'=> 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'linkFacebook' => 'Dirección de Facebook',
            'linkTwitter' => 'Dirección de Twitter',
            'linkLinkedIn' => 'Dirección de LinkedIn',
            'linkYoutube' => 'Canal de Youtube',
            'contactEmailAddress' => 'Correc electrónico del Contacto',
        ];
    }

}
