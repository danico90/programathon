<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redsocial".
 *
 * @property integer $TipoRedSocialID
 * @property string $Comentario
 * @property string $InformacionContacto
 * @property integer $PymeID
 * @property string $Link
 *
 * @property Pyme $pyme
 * @property Tiporedsocial $tipoRedSocial
 */
class Redsocial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redsocial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TipoRedSocialID', 'PymeID', 'Link'], 'required'],
            [['TipoRedSocialID', 'PymeID'], 'integer'],
            [['Comentario', 'InformacionContacto', 'Link'], 'string', 'max' => 300],
            [['PymeID'], 'exist', 'skipOnError' => true, 'targetClass' => Pyme::className(), 'targetAttribute' => ['PymeID' => 'Id']],
            [['TipoRedSocialID'], 'exist', 'skipOnError' => true, 'targetClass' => Tiporedsocial::className(), 'targetAttribute' => ['TipoRedSocialID' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TipoRedSocialID' => 'Tipo Red Social ID',
            'Comentario' => 'Comentario',
            'InformacionContacto' => 'Informacion Contacto',
            'PymeID' => 'Pyme ID',
            'Link' => 'Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPyme()
    {
        return $this->hasOne(Pyme::className(), ['Id' => 'PymeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoRedSocial()
    {
        return $this->hasOne(Tiporedsocial::className(), ['Id' => 'TipoRedSocialID']);
    }
}
