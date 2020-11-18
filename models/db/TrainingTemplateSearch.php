<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\TrainingTemplate;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\TrainingTemplateSearch represents the model behind the search form about `app\models\db\TrainingTemplate`.
 */
 class TrainingTemplateSearch extends TrainingTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'subcategory_id', 'meeting_default_number', 'modules_default_number', 'created_by', 'program_file_id', 'image_id', 'image_2_id', 'default_minimal_participants_number', 'default_maximal_participants_number', 'poll_id', 'article_id', 'subject_id'], 'integer'],
            [['name', 'subtitle', 'is_deleted', 'type', 'code_start', 'educational_level', 'training_gruop', 'training_path', 'created_on', 'lead', 'date_program_submission', 'date_last_program_modification', 'preliminary_recommendations', 'default_technical_requirements', 'default_social_requirements', 'keywords', 'default_price_category', 'visibility', 'default_certificate_lines', 'is_login_required', 'is_card_required', 'is_certificate_issued', 'additional_information', 'comments'], 'safe'],
            [['hours_local', 'hours_online'], 'number'],
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
        $query = TrainingTemplate::find();

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
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'hours_local' => $this->hours_local,
            'hours_online' => $this->hours_online,
            'meeting_default_number' => $this->meeting_default_number,
            'modules_default_number' => $this->modules_default_number,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'program_file_id' => $this->program_file_id,
            'date_program_submission' => $this->date_program_submission,
            'date_last_program_modification' => $this->date_last_program_modification,
            'image_id' => $this->image_id,
            'image_2_id' => $this->image_2_id,
            'default_minimal_participants_number' => $this->default_minimal_participants_number,
            'default_maximal_participants_number' => $this->default_maximal_participants_number,
            'poll_id' => $this->poll_id,
            'article_id' => $this->article_id,
            'subject_id' => $this->subject_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'code_start', $this->code_start])
            ->andFilterWhere(['like', 'educational_level', $this->educational_level])
            ->andFilterWhere(['like', 'training_gruop', $this->training_gruop])
            ->andFilterWhere(['like', 'training_path', $this->training_path])
            ->andFilterWhere(['like', 'lead', $this->lead])
            ->andFilterWhere(['like', 'preliminary_recommendations', $this->preliminary_recommendations])
            ->andFilterWhere(['like', 'default_technical_requirements', $this->default_technical_requirements])
            ->andFilterWhere(['like', 'default_social_requirements', $this->default_social_requirements])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'default_price_category', $this->default_price_category])
            ->andFilterWhere(['like', 'visibility', $this->visibility])
            ->andFilterWhere(['like', 'default_certificate_lines', $this->default_certificate_lines])
            ->andFilterWhere(['like', 'is_login_required', $this->is_login_required])
            ->andFilterWhere(['like', 'is_card_required', $this->is_card_required])
            ->andFilterWhere(['like', 'is_certificate_issued', $this->is_certificate_issued])
            ->andFilterWhere(['like', 'additional_information', $this->additional_information])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
