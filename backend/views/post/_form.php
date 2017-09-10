<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php $all_status = Poststatus::find()->select('name, id')->indexBy('id')->column(); ?>

    <?= $form->field($model, 'status')->dropDownList($all_status, ['prompt' => '文章状态']); ?>

    <?php $admin_users = \common\models\Adminuser::find()->select('nickname, id')->indexBy('id')->column(); ?>

    <?= $form->field($model, 'author_id')->dropDownList($admin_users, ['prompt' => '请选择作者']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
