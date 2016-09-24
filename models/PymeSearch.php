<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pyme;

/**
 * PymeSearch represents the model behind the search form about `app\models\Pyme`.
 */
class PymeSearch extends Pyme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'EstadoID', 'SectorID', 'AnnoInicioOperaciones', 'UsuarioID'], 'integer'],
            [['NombreComercio', 'NumeroTelefono', 'Direccion', 'Logo', 'ExtensionLogo', 'FechaCreacion', 'FechaUltimaActualizacion', 'GeneroPropietarioID', 'CedJuridica'], 'safe'],
            [['EsActiva', 'EsNegocioFamiliar', 'EsFacebookAppInstalado'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pyme::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'EstadoID' => $this->EstadoID,
            'SectorID' => $this->SectorID,
            'AnnoInicioOperaciones' => $this->AnnoInicioOperaciones,
            'EsActiva' => $this->EsActiva,
            'EsNegocioFamiliar' => $this->EsNegocioFamiliar,
            'FechaCreacion' => $this->FechaCreacion,
            'FechaUltimaActualizacion' => $this->FechaUltimaActualizacion,
            'EsFacebookAppInstalado' => $this->EsFacebookAppInstalado,
            'UsuarioID' => $this->UsuarioID,
        ]);

        $query->andFilterWhere(['like', 'NombreComercio', $this->NombreComercio])
            ->andFilterWhere(['like', 'NumeroTelefono', $this->NumeroTelefono])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Logo', $this->Logo])
            ->andFilterWhere(['like', 'ExtensionLogo', $this->ExtensionLogo])
            ->andFilterWhere(['like', 'GeneroPropietarioID', $this->GeneroPropietarioID])
            ->andFilterWhere(['like', 'CedJuridica', $this->CedJuridica]);

        return $dataProvider;
    }
}
