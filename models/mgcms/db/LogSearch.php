<?php

namespace app\models\mgcms\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\mgcms\db\Log;

/**
 * app\models\mgcms\db\LogSearch represents the model behind the search form about `app\models\mgcms\db\Log`.
 */
 class LogSearch extends Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['created_on', 'type', 'text'], 'safe'],
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
        $query = Log::find();

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
            'created_by' => $this->created_by
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'text', $this->text]);
        
        if($this->created_on && preg_match('/(\d{4}-\d{2}-\d{2}):(\d{4}-\d{2}-\d{2})/', $this->created_on, $matches)){
          $query->andWhere(['between', 'created_on', $matches[1], $matches[2]]);
        }else{
          $query->andFilterWhere(['like', 'created_on', $this->created_on]);
        }

        return $dataProvider;
    }
}
