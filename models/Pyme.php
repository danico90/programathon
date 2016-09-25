<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pyme".
 *
 * @property integer $Id
 * @property string $NombreComercio
 * @property integer $EstadoID
 * @property integer $SectorID
 * @property integer $AnnoInicioOperaciones
 * @property string $NumeroTelefono
 * @property string $Direccion
 * @property boolean $EsActiva
 * @property boolean $EsNegocioFamiliar
 * @property resource $Logo
 * @property string $ExtensionLogo
 * @property string $FechaCreacion
 * @property string $FechaUltimaActualizacion
 * @property boolean $EsFacebookAppInstalado
 * @property integer $UsuarioID
 * @property string $GeneroPropietarioID
 * @property string $CedJuridica
 *
 * @property Genero $generoPropietario
 * @property Sector $sector
 * @property Estado $estado
 * @property Usuario $usuario
 * @property Redsocial[] $redsocials
 * @property Tiporedsocial[] $tipoRedSocials
 * @property Respuesta[] $respuestas
 */
class Pyme extends \yii\db\ActiveRecord
{
    public $LogoUpdate;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pyme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NombreComercio', 'EstadoID', 'SectorID', 'AnnoInicioOperaciones', 'NumeroTelefono', 'Direccion', 'Logo', 'ExtensionLogo', 'FechaCreacion', 'FechaUltimaActualizacion', 'UsuarioID', 'GeneroPropietarioID', 'CedJuridica'], 'required'],
            [['EstadoID', 'SectorID', 'AnnoInicioOperaciones', 'UsuarioID'], 'integer'],
            [['EsActiva', 'EsNegocioFamiliar', 'EsFacebookAppInstalado'], 'boolean'],
            [['Logo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, gif', 'maxSize' => 50 * 1024, 'tooBig' => 'El tamaño máximo de la imagen es de 50kb.'],
            [['LogoUpdate'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, gif', 'maxSize' => 50 * 1024, 'tooBig' => 'El tamaño máximo de la imagen es de 50kb.'],
            [['FechaCreacion', 'FechaUltimaActualizacion'], 'safe'],
            [['NombreComercio'], 'string', 'max' => 100],
            [['NumeroTelefono', 'CedJuridica'], 'string', 'max' => 50],
            [['Direccion'], 'string', 'max' => 200],
            [['ExtensionLogo'], 'string', 'max' => 3],
            [['GeneroPropietarioID'], 'string', 'max' => 1],
            [['GeneroPropietarioID'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['GeneroPropietarioID' => 'Id']],
            [['SectorID'], 'exist', 'skipOnError' => true, 'targetClass' => Sector::className(), 'targetAttribute' => ['SectorID' => 'Id']],
            [['EstadoID'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['EstadoID' => 'Id']],
            [['UsuarioID'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['UsuarioID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'Pyme',
            'NombreComercio' => 'Nombre Comercio',
            'EstadoID' => 'Provincia / Estado / Departamento',
            'SectorID' => 'Sector',
            'AnnoInicioOperaciones' => 'Año Inicio Operaciones',
            'NumeroTelefono' => 'Numero de Teléfono',
            'Direccion' => 'Direccion',
            'EsActiva' => 'Es Activa',
            'EsNegocioFamiliar' => 'Es Negocio Familiar',
            'Logo' => 'Logo',
            'LogoUpdate' => 'Logo',
            'ExtensionLogo' => 'Extension Logo',
            'FechaCreacion' => 'Fecha Creacion',
            'FechaUltimaActualizacion' => 'Fecha Ultima Actualizacion',
            'EsFacebookAppInstalado' => 'Es Facebook App Instalado',
            'UsuarioID' => 'Usuario',
            'GeneroPropietarioID' => 'Genero Propietario',
            'CedJuridica' => 'ID / Cedula Jurídica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneroPropietario()
    {
        return $this->hasOne(Genero::className(), ['Id' => 'GeneroPropietarioID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(Sector::className(), ['Id' => 'SectorID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['Id' => 'EstadoID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['ID' => 'UsuarioID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedsocials()
    {
        return $this->hasMany(Redsocial::className(), ['PymeID' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoRedSocials()
    {
        return $this->hasMany(Tiporedsocial::className(), ['Id' => 'TipoRedSocialID'])->viaTable('redsocial', ['PymeID' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['PymeID' => 'Id']);
    }
}
