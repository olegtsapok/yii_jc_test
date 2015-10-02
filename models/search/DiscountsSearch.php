<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Discounts;

/**
 * DiscountsSearch represents the model behind the search form about `app\models\Discounts`.
 */
class DiscountsSearch extends Discounts
{
    public $product;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'amount', 'quantity_products'], 'integer'],
            [['product', ], 'safe'],
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
        $query = Discounts::find();

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
                'amount',
                'quantity_products',
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
            'amount' => $this->amount,
            'quantity_products' => $this->quantity_products,
        ]);

        $query->andFilterWhere(['like', 'products.name', $this->product]);

        return $dataProvider;
    }
}
