<?php

namespace backend\models;

use common\models\Article;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * common\models\Article 模型的表单搜索查询类.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'title_image', 'images', 'content'], 'safe'],
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
     * 根据查询参数创建数据提供者
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                //设置默认排序
                'defaultOrder' => ['sort' => SORT_DESC, 'updated_at' => SORT_DESC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // 如果想要验证不通过时不显示数据, 请打开下一行注释.
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_image', $this->title_image])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
