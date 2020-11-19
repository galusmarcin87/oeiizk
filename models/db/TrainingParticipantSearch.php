<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\TrainingParticipant;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\TrainingParticipantSearch represents the model behind the search form about `app\models\db\TrainingParticipant`.
 */
class TrainingParticipantSearch extends TrainingParticipant
{

    public $userLastName;
    public $userFirstName;
    public $userEmail;
    public $userWorkplaceCode;
    public $trainingCode;
    public $trainingCreatedById;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'training_id', 'user_id', 'order', 'created_by'], 'integer'],
            [['surname', 'workplace', 'status', 'created_on', 'is_reserve', 'is_paid', 'is_passed', 'is_print_certificate', 'userLastName', 'userFirstName', 'userEmail', 'userWorkplaceCode', 'trainingCreatedById','trainingCode'], 'safe'],
            [['paid_missing'], 'number'],
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
        $query = TrainingParticipant::find();

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
            'training_id' => $this->training_id,
            'user_id' => $this->user_id,
            'order' => $this->order,
            'created_on' => $this->created_on,
            'paid_missing' => $this->paid_missing,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'workplace', $this->workplace])
            ->andFilterWhere(['like', 'training_participant.status', $this->status])
            ->andFilterWhere(['like', 'is_reserve', $this->is_reserve])
            ->andFilterWhere(['like', 'is_paid', $this->is_paid])
            ->andFilterWhere(['like', 'is_passed', $this->is_passed])
            ->andFilterWhere(['like', 'is_print_certificate', $this->is_print_certificate]);

        if ($this->userWorkplaceCode) {
            $query->joinWith('user.workplaces.institution');
            $query->andFilterWhere(['like', 'institution.code', $this->userWorkplaceCode]);
        }


        $query->andFilterWhere(['like', 'user.first_name', $this->userFirstName])
            ->andFilterWhere(['like', 'user.last_name', $this->userLastName])
            ->andFilterWhere(['like', 'user.email', $this->userEmail]);



        $query->joinWith('user');

        if($this->trainingCode){
            $query->joinWith('training');
            $query->andFilterWhere(['like', 'training.code', $this->trainingCode]);
        }


        if ($this->trainingCreatedById) {
            $query->joinWith('training');
            $query->andFilterWhere(['training.created_by' => $this->trainingCreatedById]);
        }
        $dataProvider->sort->attributes['userFirstName'] = [
            'asc' => ['user.first_name' => SORT_ASC],
            'desc' => ['user.first_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['userLastName'] = [
            'asc' => ['user.last_name' => SORT_ASC],
            'desc' => ['user.last_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['userEmail'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];


        $dataProvider->sort->attributes['user.date_card_verification'] = [
            'asc' => ['user.date_card_verification' => SORT_ASC],
            'desc' => ['user.date_card_verification' => SORT_DESC],
        ];


        return $dataProvider;
    }
}
