<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Newsletter;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\NewsletterSearch represents the model behind the search form about `app\models\db\Newsletter`.
 */
 class NewsletterSearch extends Newsletter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'group_id'], 'integer'],
            [['name', 'created_on', 'header', 'footer', 'text', 'add_incoming_training_info', 'status', 'is_deleted', 'keywords', 'date_sent', 'is_required_answer'], 'safe'],
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
        $query = Newsletter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
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
            'group_id' => $this->group_id,
            'date_sent' => $this->date_sent,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'footer', $this->footer])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'add_incoming_training_info', $this->add_incoming_training_info])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'is_required_answer', $this->is_required_answer]);

        return $dataProvider;
    }
}
