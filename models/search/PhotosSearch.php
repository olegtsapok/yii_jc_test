<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Photos;

/**
 * PhotosSearch represents the model behind the search form about `app\models\Photos`.
 */
class PhotosSearch extends Photos
{
    public $product;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['name', 'extension', 'product'], 'safe'],
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
        $query = Photos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('product');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->setSort([
            'defaultOrder'=> ['id' => 'desc'],
            'attributes' => [
                'id',
                'product_id',
                'name',
                'extension',
                'product' => [
                    'asc' => ['products.name' => SORT_ASC],
                    'desc' => ['products.name' => SORT_DESC],
                    'default' => SORT_DESC
                ],
            ]
        ]);

        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'extension', $this->extension]);

        $query->andFilterWhere(['like', 'products.name', $this->product]);

        return $dataProvider;
    }
}
