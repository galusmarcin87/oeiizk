<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Poll;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\PollSearch represents the model behind the search form about `app\models\db\Poll`.
 */
 class PollSearch extends Poll
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'poll_template_id'], 'integer'],
            [['name', 'created_on', 'is_deleted'], 'safe'],
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
        $query = Poll::find();

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
            'poll_template_id' => $this->poll_template_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
