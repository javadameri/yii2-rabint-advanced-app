<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    //    'class' => '\kartik\grid\DataColumn',
    //    'attribute' => 'creator_id',
    //    'value' => function ($model) {
    //        return $model->creator ? $model->creator->displayName : $model->creator_id;
    //    },
    //],
    //[
    //    'class' => \rabint\components\grid\AttachmentColumn::class,
    //    'attribute' => 'avatar',
    //    'size' => [60, 80],
    // // 'filterOptions' => ['style' => 'max-width:60px;'],
    //],
    //[
    //    'class' => \rabint\components\grid\AdvanceEnumColumn::class,
    //    'attribute' => 'status',
    //    'enum' => \app\modules\open\models\Company::statuses(),
    //],
    //[
    //    'class' => \rabint\components\grid\JDateColumn::class,
    //    'attribute' => 'establish_date',
    //    'dateFormat' => 'j F Y H:i:s',
    //],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'full_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cell',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'description',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'user_id',
//    ],
     [
         'class' => \rabint\components\grid\AdvanceEnumColumn::class,
         'attribute' => 'from',
         'enum' => \yii\helpers\ArrayHelper::map(\common\models\TrainStation::find()->all(),"id",function ($model){return ["title"=>$model->name];}),
     ],
    [
        'class' => \rabint\components\grid\AdvanceEnumColumn::class,
        'attribute' => 'to',
        'enum' => \yii\helpers\ArrayHelper::map(\common\models\TrainStation::find()->all(),"id",function ($model){return ["title"=>$model->name];}),
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'date',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'type',
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'price',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'transaction_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ticket_file',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'request_type',
     ],
    [
        'class' => \rabint\components\grid\JDateColumn::class,
        'attribute' => 'created_at',
        'dateFormat' => 'j F Y H:i:s',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',

        'urlCreator' => function($action, $model, $key, $index) { 
               
                return Url::to([$action,'id'=>$key]);
        },

        'urlCreator' => function($action, $model, $key, $index) { 
                /*if($action=='view'){
                    return \Yii::$app->urlManagerFrontend->createAbsoluteUrl([$action,'id'=>$model->id]);    
                }*/
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('rabint', 'View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('rabint', 'Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('rabint', 'Delete'),
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('rabint', 'Are you sure?'),
                          'data-confirm-message'=>Yii::t('rabint', 'Are you sure want to delete this item?')         ],
//        'template' => '{view} {update} {delete} <br/>{shortlink}',
//        'buttons' => [
//            'shortlink' => function ($url, $model) {
//                $url = \Yii::$app->urlManager->createUrl(['/open/admin/index', 'EmployeeExecutiveSearch' => ['employee_id'=>$model->_id]]);
//                return \yii\bootstrap4\Html::a('<span class="fas fa-th-list"></span>', $url, [
//                    'title' => Yii::t('rabint', 'short link'),
//                    'target' => '_BLANK'
//                    //'role' => 'modal-remote',
//                    //'data-toggle' => 'tooltip'
//                ]);
//            },
//        ],
    ],

];   
