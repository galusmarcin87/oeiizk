<?php

namespace app\models\db;

use app\models\db\Training;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\components\mgcms\MgHelpers;
use app\components\mgcms\OeiizkHelpers;

/**
 * app\models\db\TrainingSearch represents the model behind the search form about `app\models\db\Training`.
 */
class TrainingSearch extends Training
{

    const FORM_LOCAL = 'local';
    const FORM_ONLINE = 'online';
    const FORM_MIXED = 'mixed';

    public $queryString;
    public $subjects;
    public $groups;
    public $educationalLevels;
    public $types;
    public $dateType;
    public $schoolYear;
    public $category_ids;
    public $trainingForms;
    public $delegacies;
    public $notTypes;
    public $trainingTemplatePath;
    public $startDayOfWeek;
    public $isArchive = false;
    public $isDuringTime = false;
    public $trainingTemplateIds;
    public $isCooperationNet = false;
    public $orderName = false;
    public $notIdsIn;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'training_template_id', 'meeting_number', 'module_number', 'minimal_participants_number', 'maximal_participants_number', 'final_maximal_participants_number', 'file_id', 'poll_id', 'article_id', 'subject_id', 'lab_id'], 'integer'],
            [['name', 'subtitle', 'created_on', 'is_deleted', 'code', 'date_start', 'date_end', 'technical_requirements', 'social_requirements', 'visibility', 'certificate_lines', 'is_login_required', 'status', 'is_card_required', 'is_certificate_issued', 'additional_information', 'comments', 'sign_status', 'is_promoted_oeiizk', 'is_promoted_pos', 'link_to_materials', 'project', 'is_display_on_screen', 'queryString'], 'safe'],
            [['subjects', 'groups', 'educationalLevels', 'types', 'dateType', 'schoolYear'], 'safe'],
            [['category_ids', 'trainingForms', 'delegacy', 'city', 'delegacies', 'trainingTemplatePath', 'startDayOfWeek', 'trainingTemplateIds', 'orderName'], 'safe'],
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
        $query = Training::find();

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
            'training_template_id' => $this->training_template_id,
            'meeting_number' => $this->meeting_number,
            'module_number' => $this->module_number,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'minimal_participants_number' => $this->minimal_participants_number,
            'maximal_participants_number' => $this->maximal_participants_number,
            'final_maximal_participants_number' => $this->final_maximal_participants_number,
            'file_id' => $this->file_id,
            'poll_id' => $this->poll_id,
            'article_id' => $this->article_id,
            'subject_id' => $this->subject_id,
            'lab_id' => $this->lab_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'technical_requirements', $this->technical_requirements])
            ->andFilterWhere(['like', 'social_requirements', $this->social_requirements])
            ->andFilterWhere(['like', 'visibility', $this->visibility])
            ->andFilterWhere(['like', 'certificate_lines', $this->certificate_lines])
            ->andFilterWhere(['like', 'is_login_required', $this->is_login_required])
            ->andFilterWhere(['like', 'training.status', $this->status])
            ->andFilterWhere(['like', 'is_card_required', $this->is_card_required])
            ->andFilterWhere(['like', 'is_certificate_issued', $this->is_certificate_issued])
            ->andFilterWhere(['like', 'additional_information', $this->additional_information])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'sign_status', $this->sign_status])
            ->andFilterWhere(['like', 'is_promoted_oeiizk', $this->is_promoted_oeiizk])
            ->andFilterWhere(['like', 'is_promoted_pos', $this->is_promoted_pos])
            ->andFilterWhere(['like', 'link_to_materials', $this->link_to_materials])
            ->andFilterWhere(['like', 'project', $this->project])
            ->andFilterWhere(['like', 'delegacy', $this->delegacy])
            ->andFilterWhere(['like', 'is_display_on_screen', $this->is_display_on_screen]);
        $user = MgHelpers::getUserModel();


        if ($user) {
            if (\app\components\mgcms\OeiizkHelpers::isInRoles([\app\models\mgcms\db\User::ROLE_LECTOR, \app\models\mgcms\db\User::ROLE_COACH])) {
                $query->joinWith('lectors');
                $query->andFilterCompare('training_lector.user_id', $user->id);
            }
        }

        if ($this->dateType) {
            switch ($this->dateType) {
                case 1:
                    $query->andWhere(['<', 'date_end', new \yii\db\Expression('now()')]);
                    break;
                case 2:
                    $query->andWhere(['>=', 'date_end', date('Y-m-d', strtotime('now'))]);
                    $query->andWhere(['<=', 'date_start', date('Y-m-d', strtotime('now'))]);
                    break;
                case 3:
                    $query->andWhere(['>', 'date_start', new \yii\db\Expression('now()')]);
                    break;
            }
        }

        if ($this->schoolYear) {
            $schoolYearStart = substr($this->schoolYear, 0, 4) . '-09-01';
            $schoolYearEnd = (substr($this->schoolYear, 0, 4) + 1) . '-09-01';

            $query->andWhere(['>', 'date_end', $schoolYearStart]);
            $query->andWhere(['<', 'date_end', $schoolYearEnd]);
        }


        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchFront($params)
    {
        $query = Training::find();
        $wholeQuery = Training::find(false);
        $this->load($params);


        $query->andFilterWhere([
            'id' => $this->id,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'training_template_id' => $this->training_template_id,
            'meeting_number' => $this->meeting_number,
            'module_number' => $this->module_number,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'minimal_participants_number' => $this->minimal_participants_number,
            'maximal_participants_number' => $this->maximal_participants_number,
            'final_maximal_participants_number' => $this->final_maximal_participants_number,
            'file_id' => $this->file_id,
            'poll_id' => $this->poll_id,
            'article_id' => $this->article_id,
            'subject_id' => $this->subject_id,
            'lab_id' => $this->lab_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'technical_requirements', $this->technical_requirements])
            ->andFilterWhere(['like', 'social_requirements', $this->social_requirements])
            ->andFilterWhere(['like', 'visibility', $this->visibility])
            ->andFilterWhere(['like', 'certificate_lines', $this->certificate_lines])
            ->andFilterWhere(['like', 'is_login_required', $this->is_login_required])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'is_card_required', $this->is_card_required])
            ->andFilterWhere(['like', 'is_certificate_issued', $this->is_certificate_issued])
            ->andFilterWhere(['like', 'additional_information', $this->additional_information])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'sign_status', $this->sign_status])
            ->andFilterWhere(['like', 'is_promoted_oeiizk', $this->is_promoted_oeiizk])
            ->andFilterWhere(['like', 'is_promoted_pos', $this->is_promoted_pos])
            ->andFilterWhere(['like', 'link_to_materials', $this->link_to_materials])
            ->andFilterWhere(['like', 'project', $this->project])
            ->andFilterWhere(['like', 'delegacy', $this->delegacy])
            ->andFilterWhere(['like', 'is_display_on_screen', $this->is_display_on_screen]);

        $user = MgHelpers::getUserModel();

        if ($this->queryString) {
            $keyword = new SearchKeyword;
            $keyword->keyword = $this->queryString;
            $keyword->save();
            $query->joinWith('trainingTemplate');
            $query->joinWith('lectors');
            $query->andFilterWhere(['or',
                ['like', 'training.name', $this->queryString],
                ['like', 'training_template.keywords', $this->queryString],
                ['like', 'training_template.lead', $this->queryString],
                ['like', 'training.code', $this->queryString],
                ['like', 'training.subtitle', $this->queryString],
                ['like', 'training.comments', $this->queryString],
                ['like', 'user.first_name', $this->queryString],
                ['like', 'user.last_name', $this->queryString],
            ]);
        }

        if ($this->subjects) {
            $query->joinWith('subject');
            $query->andWhere(['IN', 'subject.id', $this->subjects]);
        }

        if ($this->educationalLevels) {
            $query->joinWith('trainingTemplate.educationalLevels');
            $query->andWhere(['IN', '`training_template_educational_level`.`educational_level_id`', $this->educationalLevels]);
        }

        if ($this->groups) {
            $query->andWhere(['IN', 'training.group_id', $this->groups]);
        }

        if ($this->types) {
            $query->joinWith('trainingTemplate');
            $query->andWhere(['IN', 'training_template.type', $this->types]);
        }

        if ($this->notTypes) {
            $query->joinWith('trainingTemplate');
            $query->andWhere(['NOT IN', 'training_template.type', $this->notTypes]);
        }

        if ($this->notIdsIn) {
            $query->andWhere(['NOT IN', 'training.id', $this->notIdsIn]);
        }

        if ($this->category_ids) {
            $query->joinWith('trainingTemplate');
            $query->andWhere(['IN', 'training_template.category_id', $this->category_ids]);
        }
        if ($this->delegacies) {
            $query->andWhere(['IN', 'delegacy', $this->delegacies]);
        }

        if ($this->trainingForms) {
            $query->joinWith('trainingTemplate');
            $subqueriesTrainingForms = [];
            foreach ($this->trainingForms as $trainingForm) {
                if ($trainingForm == self::FORM_LOCAL) {
                    $subqueriesTrainingForms[] = ['and', ['>', 'training_template.hours_local', 0], ['=', 'training_template.hours_online', 0]];
                }
                if ($trainingForm == self::FORM_ONLINE) {
                    $subqueriesTrainingForms[] = ['and', ['=', 'training_template.hours_local', 0], ['>', 'training_template.hours_online', 0]];
                }
                if ($trainingForm == self::FORM_MIXED) {
                    $subqueriesTrainingForms[] = ['and', ['>', 'training_template.hours_local', 0], ['>', 'training_template.hours_online', 0]];
                }
            }
            $orTrainingFormsQuery = ['or'];
            foreach ($subqueriesTrainingForms as $subqueryTrainingForm) {
                $orTrainingFormsQuery[] = $subqueryTrainingForm;
            }

            $query->andWhere($orTrainingFormsQuery);
        }

        if ($this->isArchive) {
            //$query->andWhere(['is_promoted_pos' => 1]);
            $query->andWhere(['<', 'training.date_end', new \yii\db\Expression('now()')]);

            if ($this->orderName) {
                $query->orderBy(['is_promoted_pos' => SORT_DESC,'name' => SORT_ASC]);
            } else {
                $query->orderBy(['is_promoted_pos' => SORT_DESC,'date_start' => SORT_DESC]);
            }
        } else {
            if (!$this->isCooperationNet) {
                if ($this->isDuringTime) {
                    $query->andWhere(['>', 'training.date_end', new \yii\db\Expression('now()')]);
                } else {
                    $query->andWhere(['>', 'training.date_start', new \yii\db\Expression('now()')]);
                }
            }
            if ($this->orderName) {
                $query->orderBy(['is_promoted_pos' => SORT_DESC,'name' => SORT_ASC]);
            } else {
                $query->orderBy(['is_promoted_pos' => SORT_DESC,'date_start' => SORT_ASC]);
            }


            if (!$this->isCooperationNet) {
                $query->andWhere(['OR', ['training.status' => Training::STATUS_SIGN_TIME], ['training.sign_status' => Training::SIGN_STATUS_YES]]);
            }
        }

        $groupCondition = [];
        if ($user && $user->groups) {
            $groupsIds = [];
            foreach ($user->groups as $group) {
                $groupsIds[] = $group->id;
            }
            $groupCondition = ['in', 'training.group_id', $groupsIds];
        }

        $query->andWhere(['or', ['training.visibility' => Training::VISIBILITY_YES], $groupCondition]);

        if ($this->startDayOfWeek) {
            $query->andWhere(['weekday(training.date_start)' => $this->startDayOfWeek - 1]);
        }

        if ($this->trainingTemplatePath) {
            $query->joinWith('trainingTemplate');
            $query->andWhere(['training_template.training_path' => $this->trainingTemplatePath]);
        }

        if ($this->schoolYear) {
            $schoolYearStart = substr($this->schoolYear, 0, 4) . '-09-01';
            $schoolYearEnd = (substr($this->schoolYear, 0, 4) + 1) . '-09-01';

            $query->andWhere(['>', 'date_end', $schoolYearStart]);
            $query->andWhere(['<', 'date_end', $schoolYearEnd]);
        }

        if ($this->trainingTemplateIds) {
            $query->andWhere(['IN', 'training.training_template_id', $this->trainingTemplateIds]);
        }

        $promotedCondition = ['and',['training.is_promoted_pos' => 1], ['training.sign_status' => 0], ['training.is_deleted' => 0]];
        if ($this->notTypes) {
            $query->joinWith('trainingTemplate');
            $promotedCondition[] = ['NOT IN', 'training_template.type', $this->notTypes];
        }
        if ($this->types) {
            $query->joinWith('trainingTemplate');
            $promotedCondition[] = ['IN', 'training_template.type', $this->types];
        }
        $query->orFilterWhere($promotedCondition);
        $query->limit = 20000000;




        $wholeQuery->select('*')->from(['a' => $query])->groupBy('training_template_id')->orderBy($query->orderBy);


        $dataProvider = new ActiveDataProvider([
            'query' => $wholeQuery,
        ]);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        return $dataProvider;
    }

    public function searchMyAccount($type)
    {
        $query = Training::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load([]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        switch ($type) {
            case 0:
                $query->andWhere(['<=', 'date_start', date('Y-m-d', strtotime('now'))]);
                $query->andWhere(['>=', 'date_end', date('Y-m-d', strtotime('now'))]);
                break;
            case -1:
                $query->andWhere(['<=', 'date_end', new \yii\db\Expression('now()')]);
                break;
            case 1:
                $query->andWhere(['>', 'date_start', new \yii\db\Expression('now()')]);
                break;
        }

        $query->joinWith('trainingParticipants');
        $query->andWhere(['training_participant.user_id' => MgHelpers::getUserModel()->id]);

        $query->orderBy(['date_start' => SORT_ASC]);


        return $dataProvider;
    }

    public function searchWaitingRoom($params, $onlyMy = false)
    {
        $query = Training::find();

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
            'training_template_id' => $this->training_template_id,
            'meeting_number' => $this->meeting_number,
            'module_number' => $this->module_number,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'minimal_participants_number' => $this->minimal_participants_number,
            'maximal_participants_number' => $this->maximal_participants_number,
            'final_maximal_participants_number' => $this->final_maximal_participants_number,
            'file_id' => $this->file_id,
            'poll_id' => $this->poll_id,
            'article_id' => $this->article_id,
            'subject_id' => $this->subject_id,
            'lab_id' => $this->lab_id,
            'training.status' => self::STATUS_WAITINGROOM,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'technical_requirements', $this->technical_requirements])
            ->andFilterWhere(['like', 'social_requirements', $this->social_requirements])
            ->andFilterWhere(['like', 'visibility', $this->visibility])
            ->andFilterWhere(['like', 'certificate_lines', $this->certificate_lines])
            ->andFilterWhere(['like', 'is_login_required', $this->is_login_required])
            ->andFilterWhere(['like', 'is_card_required', $this->is_card_required])
            ->andFilterWhere(['like', 'is_certificate_issued', $this->is_certificate_issued])
            ->andFilterWhere(['like', 'additional_information', $this->additional_information])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'sign_status', $this->sign_status])
            ->andFilterWhere(['like', 'is_promoted_oeiizk', $this->is_promoted_oeiizk])
            ->andFilterWhere(['like', 'is_promoted_pos', $this->is_promoted_pos])
            ->andFilterWhere(['like', 'link_to_materials', $this->link_to_materials])
            ->andFilterWhere(['like', 'project', $this->project])
            ->andFilterWhere(['like', 'is_display_on_screen', $this->is_display_on_screen]);

        $user = MgHelpers::getUserModel();

        if ($this->queryString) {
            $query->joinWith('trainingTemplate');
            $query->andFilterWhere(['or', ['like', 'training.name', $this->queryString], ['like', 'training_template.lead', $this->queryString]]);
        }

        if ($this->subjects) {
            $query->joinWith('subject');
            $query->andWhere(['IN', 'subject.id', $this->subjects]);
        }

        if ($this->educationalLevels) {
            $query->joinWith('trainingTemplate.educationalLevels');
            $query->andWhere(['IN', '`training_template_educational_level`.`educational_level_id`', $this->educationalLevels]);
        }

        if ($this->groups) {
            $query->andWhere(['IN', 'training.group_id', $this->groups]);
        }


        if ($this->types) {
            $query->joinWith('trainingTemplate');
            $query->andWhere(['IN', 'training_template.type', $this->types]);
        }


        $groupCondition = [];
        if ($user && $user->groups) {
            $groupsIds = [];
            foreach ($user->groups as $group) {
                $groupsIds[] = $group->id;
            }
            $groupCondition = ['in', 'training.group_id', $groupsIds];
        }

        $query->andWhere(['or', ['training.visibility' => Training::VISIBILITY_YES], $groupCondition]);

        if ($onlyMy) {
            $user = MgHelpers::getUserModel();
            if ($user) {
                $query->joinWith('trainingParticipants');
                $query->andWhere(['training_participant.user_id' => $user->id]);
            }
        }

        return $dataProvider;
    }
}
