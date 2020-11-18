<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Institution;

/**
 * app\models\db\InstitutionSearch represents the model behind the search form about `app\models\db\Institution`.
 */
 class InstitutionSearch extends Institution
{
   use \app\models\mgcms\db\SoftDeleteTrait;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['name', 'short_name', 'code', 'created_on', 'is_deleted', 'patron', 'city', 'community', 'county', 'province', 'street', 'house_no', 'postcode', 'post', 'phone', 'www', 'type', 'is_verified', 'territory', 'school_group_name', 'delegacy', 'NIP', 'email', 'school_governing_body'], 'safe'],
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
        $query = Institution::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'patron', $this->patron])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'community', $this->community])
            ->andFilterWhere(['like', 'county', $this->county])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'house_no', $this->house_no])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'post', $this->post])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'www', $this->www])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'is_verified', $this->is_verified])
            ->andFilterWhere(['like', 'territory', $this->territory])
            ->andFilterWhere(['like', 'school_group_name', $this->school_group_name])
            ->andFilterWhere(['like', 'delegacy', $this->delegacy])
            ->andFilterWhere(['like', 'NIP', $this->NIP])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'school_governing_body', $this->school_governing_body]);

        return $dataProvider;
    }
}
