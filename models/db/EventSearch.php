<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Event;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\EventSearch represents the model behind the search form about `app\models\db\Event`.
 */
 class EventSearch extends Event
{
   use \app\models\mgcms\db\SoftDeleteTrait;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'file_id', 'lab_id'], 'integer'],
            [['name', 'subtitle', 'created_on', 'type', 'code', 'info', 'link', 'link_to_registration', 'date_from', 'date_to', 'promoted_oeiizk', 'promoted_pos', 'coments', 'is_deleted', 'is_display_on_screen'], 'safe'],
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
        $query = Event::find();

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
            'file_id' => $this->file_id,
            'type' => $this->type,
            'lab_id' => $this->lab_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'date_from', $this->date_from])
            ->andFilterWhere(['like', 'date_to', $this->date_to])
            ->andFilterWhere(['like', 'link_to_registration', $this->link_to_registration])
            ->andFilterWhere(['like', 'promoted_oeiizk', $this->promoted_oeiizk])
            ->andFilterWhere(['like', 'promoted_pos', $this->promoted_pos])
            ->andFilterWhere(['like', 'coments', $this->coments])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'is_display_on_screen', $this->is_display_on_screen]);

        return $dataProvider;
    }
}
