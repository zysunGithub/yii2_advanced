<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            'title',
            'tags:ntext',
            [
                'attribute'=>'status',
                'value'=>'status0.name',
                'filter'=>\common\models\Poststatus::find()
                    ->select(['name','id'])
                    ->orderBy('position')
                    ->indexBy('id')
                    ->column(),
            ],
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'update_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'name0',
                'label' => '作者姓名',
                'value' => 'name0.nickname',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
