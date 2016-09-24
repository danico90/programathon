<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Redsocial;

/**
 * RedsocialSearch represents the model behind the search form about `app\models\Redsocial`.
 */
class RedsocialSearch extends Redsocial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TipoRedSocialID', 'PymeID'], 'integer'],
            [['Comentario', 'InformacionContacto', 'Link'], 'safe'],
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
        $query = Redsocial::find();

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
            'TipoRedSocialID' => $this->TipoRedSocialID,
            'PymeID' => $this->PymeID,
        ]);

        $query->andFilterWhere(['like', 'Comentario', $this->Comentario])
            ->andFilterWhere(['like', 'InformacionContacto', $this->InformacionContacto])
            ->andFilterWhere(['like', 'Link', $this->Link]);

        return $dataProvider;
    }
}
