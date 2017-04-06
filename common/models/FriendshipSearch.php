<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FriendshipSearch represents the model behind the search form about `common\models\Friendship`.
 */
class FriendshipSearch extends Friendship
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'friend_one', 'friend_two', 'status', 'created_at'], 'integer'],
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
        $query = Friendship::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'friend_one' => $this->friend_one,
            'friend_two' => $this->friend_two,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
