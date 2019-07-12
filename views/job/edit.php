<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form ActiveForm */
?>
<div class="job-edit">
<h2 class="page-leader">Edit Job</h2>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($job); ?>

        <?= $form->field($job, 'category_id')
            ->dropDownList(Category::find()
            ->select(['name','id'])
            ->indexBy('id')
            ->column(), ['prompt' => 'Select Category']);
        ?>
        <?= $form->field($job, 'title') ?>
        <?= $form->field($job, 'description')->textArea(['rows'=>'6']) ?>
        <?= $form->field($job, 'type')->dropDownList(['full_time' =>'Full Time', 'part_time' => 'Part Time', 'as_needed' => 'As Needed'], ['prompt' => 'Select Type']) ?>
        <?= $form->field($job, 'requirements') ?>
        <?= $form->field($job, 'salary_range')->dropDownList(['Under $20K' =>'Under $20K', '$20K - $40K' => '$20K - $40K', '$40K - $60K' => '$40K - $60K', '$60K - $80K' => '$60K - $80K', '$80K - $100K' => '$80K - $100K', '$100K - $150K' => '$100K - $150K', '$150K - $200K' => '$150K - $200K', 'Over $200K' => 'Over $200K',], ['prompt' => 'Select Salary Range']) ?>
        <?= $form->field($job, 'city') ?>
        <?= $form->field($job, 'state') ?>
        <?= $form->field($job, 'zipcode') ?>
        <?= $form->field($job, 'contact_email') ?>
        <?= $form->field($job, 'contact_phone') ?>
        <?= $form->field($job, 'is_published')->radioList(array('1'=>'Yes', '0'=>'No')) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- job-create -->
