<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HeadOrderTrainOffline;

/**
 * HeadOrderTrainOfflineSearch represents the model behind the search form about `common\models\HeadOrderTrainOffline`.
 */
class HeadOrderTrainOfflineSearch extends HeadOrderTrainOffline
{

    //var $keyword;
    //var $created_from;
    //var $created_to;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'from', 'to', 'status', 'price', 'transaction_id', 'ticket_file', 'request_type', 'created_at', 'updated_at', 'created_by', 'updated_by','reserve_time'], 'integer'],
            [['full_name', 'cell', 'code', 'description', 'date', 'type'], 'safe'],
            //[['created_from', 'created_to', 'keyword'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return parent::attributeLabels() + [
             //'created_from' =>  Yii::t('rabint', 'Created from'),
             //'created_to' =>  Yii::t('rabint', 'Created to'),
             //'keyword' =>  Yii::t('rabint', 'Keyword'),
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
     * @param boolean $returnActiveQuery
     *
     * @return ActiveDataProvider | ActiveQuery
     */
    public function search($params,$returnActiveQuery = FALSE)
    {
        $query = HeadOrderTrainOffline::find();//->alias('headordertrainoffline');

        // add conditions that should always apply here

        $sort = ['id' => SORT_DESC];
        //$query->orderBy($sort);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => $sort]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $returnActiveQuery ? $query : $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'from' => $this->from,
            'to' => $this->to,
            'status' => $this->status,
            'price' => $this->price,
            'transaction_id' => $this->transaction_id,
            'ticket_file' => $this->ticket_file,
            'request_type' => $this->request_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'type', $this->type]);


        // if (!empty($this->creator_id) && is_string($this->creator_id)) {
        //     $exp1 = new \yii\db\Expression(
        //         "creator_id in (SELECT user_id from user_profile  WHERE " .
        //             "firstname like :keyword or  " .
        //             "lastname like :keyword or  " .
        //             "nickname like :keyword )",
        //         ['keyword' => '%' . $this->creator_id . '%']
        //     );
        //     $query->andWhere($exp1);
        // } else {
        //     $query->andFilterWhere([
        //         'contact_id' => $this->creator_id,
        //     ]);
        // }
        
        //if (!empty($this->keyword)) {
        //    $query->andFilterWhere([
        //        'OR',
        //        ['title'=>$this->keyword],
        //        //['decription'=>$this->keyword],
        //    ]);
        //
        //    //$exp1 = new \yii\db\Expression(
        //    //        "id in (SELECT user_id from user_profile  WHERE " .
        //    //        //  "firstname like '%:keyword%' or  ".
        //    //        //  "lastname like '%:keyword%' or  ".
        //    //        "nickname like ':keyword')", 
        //    //     ['keyword' => '%'.$this->keyword.'%']);
        //    //$query->andWhere($exp1);
        //}

        /**
         * date filters:
         */
        //if (!empty($this->created_at)) {
        //    $from = locality::anyToGregorian($this->created_at);
        //    $to = locality::anyToGregorian($this->created_at+86400);
        //    $query->andFilterWhere(['>=', 'created_at', $from]);
        //    $query->andFilterWhere(['<=', 'created_at', $to]);
        //}
        //
        //if (!empty($this->created_from)) {
        //    $this->created_from = locality::anyToGregorian($this->created_from);
        //    $query->andFilterWhere(['>=', 'created_at', $this->created_from]);
        //}
        //if (!empty($this->created_to)) {
        //    $this->calldate_ = locality::anyToGregorian($this->created_to);
        //    $query->andFilterWhere(['<=', 'created_at', $this->created_to]);
        //}
        


        if ($returnActiveQuery) {
            return $query;
        }
        return $returnActiveQuery ? $query : $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param boolean $returnActiveQuery
     *
     * @return ActiveDataProvider | ActiveQuery
     */
    public static function searchFactory($params, $returnActiveQuery = FALSE, $shortParams = true)
    {
        $new = new self();
        if ($shortParams) {
            $modelName = basename(str_replace('\\', '/', self::class));
            $newParams = [$modelName => $params];
        }
        return $new->search($newParams, $returnActiveQuery);
    }
}
