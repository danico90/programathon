<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Respuesta;

/**
 * RespuestaSearch represents the model behind the search form about `app\models\Respuesta`.
 */
class RespuestaSearch extends Respuesta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'Respuesta01', 'Respuesta02', 'Respuesta03', 'Respuesta04', 'Respuesta05', 'RangoEdad', 'PymeID'], 'integer'],
            [['FechaRespuesta', 'GeneroID', 'Campo01', 'Campo02'], 'safe'],
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
        $query = Respuesta::find();

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
            'ID' => $this->ID,
            'Respuesta01' => $this->Respuesta01,
            'Respuesta02' => $this->Respuesta02,
            'Respuesta03' => $this->Respuesta03,
            'Respuesta04' => $this->Respuesta04,
            'Respuesta05' => $this->Respuesta05,
            'FechaRespuesta' => $this->FechaRespuesta,
            'RangoEdad' => $this->RangoEdad,
            'PymeID' => $this->PymeID,
        ]);

        $query->andFilterWhere(['like', 'GeneroID', $this->GeneroID])
            ->andFilterWhere(['like', 'Campo01', $this->Campo01])
            ->andFilterWhere(['like', 'Campo02', $this->Campo02]);

        return $dataProvider;
    }
}
