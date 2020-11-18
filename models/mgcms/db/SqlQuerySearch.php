<?php
namespace app\models\mgcms\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\mgcms\db\SqlQuery;

/**
 * app\models\mgcms\db\SqlQuerySearch represents the model behind the search form about `app\models\mgcms\db\SqlQuery`.
 */
class SqlQuerySearch extends SqlQuery
{

  use SoftDeleteTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['id', 'created_by'], 'integer'],
        [['name', 'query', 'created_on', 'is_deleted', 'params'], 'safe'],
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
    $query = SqlQuery::find();

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
    ]);

    $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'query', $this->query])
        ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
        ->andFilterWhere(['like', 'params', $this->params]);
    
    if(!\app\components\mgcms\MgHelpers::isAdmin()){
      $query->joinWith(['users']);
      $query->andWhere(['user.id' => \app\components\mgcms\MgHelpers::getUserModel()->id]);
    }

    return $dataProvider;
  }
}
