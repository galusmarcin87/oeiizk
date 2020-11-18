<?php
namespace app\models\mgcms\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\mgcms\db\ModificationHistory;

/**
 * app\models\mgcms\db\ModificationHistorySearch represents the model behind the search form about `app\models\mgcms\db\ModificationHistory`.
 */
class ModificationHistorySearch extends ModificationHistory
{

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['id', 'created_by', 'model_id'], 'integer'],
        [['created_on', 'model_class', 'previous_model', 'model'], 'safe'],
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
    $query = ModificationHistory::find();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $this->load($params);
    if (isset($params['id'])) {
      $this->model_id = $params['id'];
    }
    if (isset($params['modelClass'])) {
      $this->model_class = $params['modelClass'];
    }

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    $query->andFilterWhere([
        'id' => $this->id,
        'created_on' => $this->created_on,
        'created_by' => $this->created_by,
        'model_id' => $this->model_id,
        'model_class' => $this->model_class
    ]);
    $query->orderBy(['created_on' => SORT_DESC]);

    $query->andFilterWhere(['like', 'previous_model', $this->previous_model])
        ->andFilterWhere(['like', 'model', $this->model]);

    return $dataProvider;
  }
}
