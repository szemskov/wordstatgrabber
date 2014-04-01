<?php
/* @var $this ReportController */
/* @var $model Report */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'num'); ?>
		<?php echo $form->textField($model,'num',array('size'=>60,'maxlength'=>127)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aid'); ?>
		<?php echo $form->textField($model,'aid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->