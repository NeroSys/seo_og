<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Opengraf;

/**
 * OpengrafSearch represents the model behind the search form of `common\models\Opengraf`.
 */
class OpengrafSearch extends Opengraf
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'itemId', 'app_id', 'created_at'], 'integer'],
            [['modelName', 'type', 'img', 'url', 'video', 'audio', 'localeAlternative', 'GAuthor', 'GPublisher'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Opengraf::find();

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
            'itemId' => $this->itemId,
            'app_id' => $this->app_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'modelName', $this->modelName])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'audio', $this->audio])
            ->andFilterWhere(['like', 'localeAlternative', $this->localeAlternative])
            ->andFilterWhere(['like', 'GAuthor', $this->GAuthor])
            ->andFilterWhere(['like', 'GPublisher', $this->GPublisher]);

        return $dataProvider;
    }
}
