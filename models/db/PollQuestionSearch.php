<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\PollQuestion;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\PollQuestionSearch represents the model behind the search form about `app\models\db\PollQuestion`.
 */
 class PollQuestionSearch extends PollQuestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'type', 'order'], 'integer'],
            [['name', 'created_on', 'is_deleted', 'question', 'options_json', 'is_individual', 'is_required'], 'safe'],
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
        $query = PollQuestion::find();

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
            'type' => $this->type,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'options_json', $this->options_json])
            ->andFilterWhere(['like', 'is_individual', $this->is_individual])
            ->andFilterWhere(['like', 'is_required', $this->is_required]);

        return $dataProvider;
    }
}
