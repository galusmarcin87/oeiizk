<?php
namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\WorkshopUser;
use app\components\mgcms\MgHelpers;

/**
 * app\models\db\WorkshopUserSearch represents the model behind the search form about `app\models\db\WorkshopUser`.
 */
class WorkshopUserSearch extends WorkshopUser
{

  public $userLastName;
  public $userFirstName;
  public $userEmail;
  public $trainingId;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['user_id', 'workshop_id'], 'integer'],
        [['status', 'userLastName', 'userFirstName', 'userEmail','trainingId'], 'safe'],
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
    $query = WorkshopUser::find();

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
        'user_id' => $this->user_id,
        'workshop_id' => $this->workshop_id,
    ]);

    $query->andFilterWhere(['like', 'status', $this->status]);

    $query->joinWith('user');
    $query->joinWith('workshop.training');

    $query->andFilterWhere(['like', 'user.first_name', $this->userFirstName])
        ->andFilterWhere(['like', 'user.last_name', $this->userLastName])
        ->andFilterWhere(['like', 'user.email', $this->userEmail]);

    $query->andFilterWhere(['like', 'training_id', $this->trainingId]);
    
    
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
    
    
    $dataProvider->sort->attributes['trainingId'] = [
        'asc' => ['training.code' => SORT_ASC],
        'desc' => ['training.code' => SORT_DESC],
    ];

    return $dataProvider;
  }
}
