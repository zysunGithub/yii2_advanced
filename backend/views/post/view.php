<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
date_default_timezone_set('Asia/Shanghai');

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'content:ntext',
            'tags:ntext',
            [
                'label' => '文章状态',
                'value' => $model->status0->name,
            ],
            [
                'label' => '创建时间',
                'value' => date('Y-m-d H:i:s', $model->create_time),
            ],
            [
                'label' => '创建时间',
                'value' => date('Y-m-d H:i:s', $model->update_time),
            ],
            [
                'label' => '作者姓名',
                'value' => $model->name0->nickname,
            ],
        ],
        'template' => '<tr><th style="width: 120px">{label}</th><td>{value}</td></tr>'
    ]) ?>

</div>
