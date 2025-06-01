<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ContactSearch extends Contact
{
    public $updated_at;  // Добавил объявление свойства, так как оно используется

    public function rules()
    {
        return [
            [['id', 'is_completed', 'status'], 'integer'],
            [['name', 'phone', 'email', 'message', 'ip_address'], 'safe'],
            [['created_at', 'updated_at'], 'safe'], // Добавил updated_at сюда
        ];
    }

    public function search($params)
    {
        $query = Contact::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'is_completed' => $this->is_completed,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        // Фильтрация по created_at (один день)
        if ($this->created_at) {
            $start = strtotime($this->created_at);
            if ($start !== false) {
                $query->andFilterWhere(['>=', 'created_at', $start]);
                $query->andFilterWhere(['<', 'created_at', $start + 86400]);
            }
        }

        // Фильтрация по updated_at (один день)
        if ($this->updated_at) {
            $start = strtotime($this->updated_at);
            if ($start !== false) {
                $query->andFilterWhere(['>=', 'updated_at', $start]);
                $query->andFilterWhere(['<', 'updated_at', $start + 86400]);
            }
        }

        return $dataProvider;
    }
}

