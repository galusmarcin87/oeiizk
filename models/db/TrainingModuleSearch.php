<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\TrainingModule;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\TrainingModuleSearch represents the model behind the search form about `app\models\db\TrainingModule`.
 */
 class TrainingModuleSearch extends TrainingModule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hours', 'training_id', 'created_by'], 'integer'],
            [['subject', 'date_start', 'date_end', 'description', 'is_deleted'], 'safe'],
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
        $query = TrainingModule::find();

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
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'hours' => $this->hours,
            'training_id' => $this->training_id,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
