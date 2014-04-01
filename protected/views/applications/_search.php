<?php
/* @var $this ApplicationsController */
/* @var $model Applications */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'aid'); ?>
		<?php echo $form->textField($model,'aid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'application_id'); ?>
		<?php echo $form->textField($model,'application_id',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit'); ?>
		<?php echo $form->textField($model,'limit'); ?>
	</div>
        <div class="row">
                <?php echo $form->label($model,'count'); ?>
                <?php echo $form->textField($model,'count'); ?>
        </div>
	<div class="row">
		<?php echo $form->label($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
