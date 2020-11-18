<?php

namespace app\models\mgcms\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\mgcms\db\Message;

/**
 * app\models\mgcms\db\MessageSearch represents the model behind the search form about `app\models\mgcms\db\Message`.
 */
 class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sender_id', 'recipient_id', 'message_id'], 'integer'],
            [['subject', 'message', 'email', 'created_on', 'is_read'], 'safe'],
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
        $query = Message::find();

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
            'sender_id' => $this->sender_id,
            'recipient_id' => $this->recipient_id,
            'message_id' => $this->message_id,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'is_read', $this->is_read]);
        
        $query->andWhere(['or',
           ['recipient_id' => \app\components\mgcms\MgHelpers::getUserModel()->id,],
           ['sender_id' => \app\components\mgcms\MgHelpers::getUserModel()->id,]
       ]);

        return $dataProvider;
    }
}
