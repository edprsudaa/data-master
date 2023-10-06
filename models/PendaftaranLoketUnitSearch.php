<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PendaftaranLoketUnit;

/**
 * PendaftaranLoketUnitSearch represents the model behind the search form of `app\models\PendaftaranLoketUnit`.
 */
class PendaftaranLoketUnitSearch extends PendaftaranLoketUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit_id', 'aktif', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['loket_kode', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = PendaftaranLoketUnit::find();

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
            'id' => $this->id,
            'unit_id' => $this->unit_id,
            'aktif' => $this->aktif,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'loket_kode', $this->loket_kode]);

        return $dataProvider;
    }
}
