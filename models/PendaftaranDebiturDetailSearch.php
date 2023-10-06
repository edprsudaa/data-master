<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PendaftaranDebiturDetail;

/**
 * PendaftaranDebiturDetailSearch represents the model behind the search form of `app\models\PendaftaranDebiturDetail`.
 */
class PendaftaranDebiturDetailSearch extends PendaftaranDebiturDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'debitur_kode', 'nama', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'aktif', 'deleted_by', 'kode_lama'], 'integer'],
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
        $query = PendaftaranDebiturDetail::find();

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
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'aktif' => $this->aktif,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'kode_lama' => $this->kode_lama,
        ]);

        $query->andFilterWhere(['ilike', 'kode', $this->kode])
            ->andFilterWhere(['ilike', 'debitur_kode', $this->debitur_kode])
            ->andFilterWhere(['ilike', 'nama', $this->nama]);

        return $dataProvider;
    }
}
