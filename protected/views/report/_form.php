<?php
/* @var $this ReportController */
/* @var $model Report */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'report-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'num'); ?>
		<?php echo $form->textField($model,'num',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aid'); ?>
		<?php echo $form->textField($model,'aid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'aid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->