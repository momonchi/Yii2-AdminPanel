<?php

namespace backend\models\systemsetting;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\systemsetting\Systemsetting;

/**
 * SystemsettingSearch represents the model behind the search form about `backend\models\systemsetting\Systemsetting`.
 */
class SystemsettingSearch extends Systemsetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['system_setting'], 'required'],
            [['default_time_allowance'], 'integer'],
            [['default_time_zone'], 'string', 'max' => 250]
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
        $query = Systemsetting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'system_setting' => $this->system_setting,
            'default_time_allowance' => $this->default_time_allowance,
            'default_time_zone' => $this->default_time_zone
        ]);
        
        return $dataProvider;
    }
}
