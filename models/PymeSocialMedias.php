<?php

namespace app\models;

use yii\base\Model;
use Yii;

class PymeSocialMedias extends Model
{
    public $linkFacebookID;
    public $linkFacebook;
    
    public $linkTwitterID;
    public $linkTwitter;
    
    public $linkLinkedInID;
    public $linkLinkedIn;
    
    public $linkYoutubeID;
    public $linkYoutube;
    
    public $linkWebsiteID;
    public $linkWebsite;
    
    public $correoContactoID;
    public $correoContacto;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['linkFacebook'], 'required'],
            [['linkFacebook', 'linkTwitter', 'linkLinkedIn', 'linkYoutube', 'linkWebsite'], 'string','max'=> 300],
            [['correoContacto'], 'string','max'=> 50],
            ['correoContacto', 'email'],
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
            'linkWebsite' => 'Website',
        ];
    }

}
