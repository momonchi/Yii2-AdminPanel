<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\admin\admin;

/**
 * AdminSearch represents the model behind the search form about `backend\models\admin\admin`.
 */
class AdminSearch extends admin
{
    /**
     * @inheritdoc
     */

    public $fname;
    public $lname;
    public $email;

    public function rules()
    {
        return [
            [['admin_id', 'userid', 'role_id'], 'integer'],
            [['position', 'department'], 'safe'],
            [['fname', 'lname','email'], 'safe'],
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
        $query = admin::find();

        $query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'admin_id' => $this->admin_id,
            'userid' => $this->userid,
            'role_id' => $this->role_id,
        ]);

        $query->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'user.fname', $this->fname])
            ->andFilterWhere(['like', 'user.email', $this->email]);

        //pagination
        $dataProvider->pagination->pageSize= 100 ;
        return $dataProvider;
    }
}
