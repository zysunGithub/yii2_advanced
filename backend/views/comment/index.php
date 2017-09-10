<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建评论', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
//            'content:ntext',
            [
                'attribute' => 'content',
                'value' => 'simpleComment'//使用get魔术方法处理数据
            ],
            [
                'attribute' => 'status',
                'value' => 'status0.name',
                'filter'=> \common\models\Commentstatus::find()
                            ->select(['name','id'])
                            ->orderBy('position')
                            ->indexBy('id')
                            ->column()
            ],
            [
                'attribute' => 'userInfo',
                'label' => '评论者',
                'value' => 'userInfo.username'
            ],
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // 'email:email',
            // 'url:url',
            // 'post_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>