<?php
namespace app\models\mgcms\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\mgcms\db\User;

/**
 * app\models\mgcms\db\UserSearch represents the model behind the search form about `app\models\mgcms\db\User`.
 */
class UserSearch extends User
{

  public $searchGroupId;
  public $searchInstitutionId;
  public $searchInstitutionCode;
  public $roleId;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['id', 'created_by', 'employment_card_id', 'credibility','roleId'], 'integer'],
        [['username', 'password', 'first_name', 'last_name', 'role', 'status', 'email', 'created_on', 'last_login', 'address', 'postcode', 'birthdate', 'city', 'auth_key', 'is_password_change_accepted', 'other_names', 'gender', 'date_email_confirmation', 'birth_place', 'position', 'educational_level', 'date_card_verification', 'date_card_submission', 'academic_title', 'phone', 'is_special_account', 'is_newsletter', 'comments', 'is_deleted', 'is_not_logged_account', 'training_preferences', 'training_preferences_keywords', 'date_last_password_change', 'searchGroupId', 'searchInstitutionId','searchInstitutionCode'], 'safe'],
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
    $query = User::find();

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
        'last_login' => $this->last_login,
        'created_by' => $this->created_by,
        'birthdate' => $this->birthdate,
        'date_email_confirmation' => $this->date_email_confirmation,
        'employment_card_id' => $this->employment_card_id,
        'date_card_verification' => $this->date_card_verification,
        'date_card_submission' => $this->date_card_submission,
        'credibility' => $this->credibility,
        'date_last_password_change' => $this->date_last_password_change,
    ]);

    $query->andFilterWhere(['like', 'username', $this->username])
        ->andFilterWhere(['like', 'password', $this->password])
        ->andFilterWhere(['like', 'first_name', $this->first_name])
        ->andFilterWhere(['like', 'last_name', $this->last_name])
        ->andFilterWhere(['like', 'role', $this->role])
        ->andFilterWhere(['like', 'status', $this->status])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'address', $this->address])
        ->andFilterWhere(['like', 'postcode', $this->postcode])
        ->andFilterWhere(['like', 'city', $this->city])
        ->andFilterWhere(['like', 'is_password_change_accepted', $this->is_password_change_accepted])
        ->andFilterWhere(['like', 'other_names', $this->other_names])
        ->andFilterWhere(['like', 'gender', $this->gender])
        ->andFilterWhere(['like', 'birth_place', $this->birth_place])
        ->andFilterWhere(['like', 'position', $this->position])
        ->andFilterWhere(['like', 'educational_level', $this->educational_level])
        ->andFilterWhere(['like', 'academic_title', $this->academic_title])
        ->andFilterWhere(['like', 'phone', $this->phone])
        ->andFilterWhere(['like', 'is_special_account', $this->is_special_account])
        ->andFilterWhere(['like', 'is_newsletter', $this->is_newsletter])
        ->andFilterWhere(['like', 'comments', $this->comments])
        ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
        ->andFilterWhere(['like', 'is_not_logged_account', $this->is_not_logged_account])
        ->andFilterWhere(['like', 'training_preferences', $this->training_preferences])
        ->andFilterWhere(['like', 'training_preferences_keywords', $this->training_preferences_keywords]);

    if ($this->searchGroupId) {
      $query->joinWith('groups');
      $query->andWhere(['group.id' => $this->searchGroupId]);
    }

    if ($this->searchInstitutionId) {
      $query->joinWith('workplaces');
      $query->andWhere(['workplace.institution_id' => $this->searchInstitutionId]);
    }
    
    if ($this->searchInstitutionCode) {
      $query->joinWith('workplaces.institution');
      $query->andWhere(['LIKE','institution.code' , $this->searchInstitutionCode]);
    }
    
    if ($this->roleId) {
      $query->joinWith('roles');
      $query->andWhere(['role.id' => $this->roleId]);
    }

    if (\app\components\mgcms\MgHelpers::getUserModel()->role != User::ROLE_ADMIN) {
      $query->andWhere(['!=','role',User::ROLE_ADMIN]);
    }


    return $dataProvider;
  }
}
