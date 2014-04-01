<?php
/* @var $this StatisticController */
/* @var $model Statistic */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kid'); ?>
		<?php echo $form->textField($model,'kid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'month'); ?>
		<?php echo $form->textField($model,'month'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shows'); ?>
		<?php echo $form->textField($model,'shows'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->