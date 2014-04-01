<?php
/* @var $this ApplicationsController */
/* @var $model Applications */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applications-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'application_id'); ?>
		<?php echo $form->textField($model,'application_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'application_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'token'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit'); ?>
		<?php echo $form->textField($model,'limit'); ?>
		<?php echo $form->error($model,'limit'); ?>
	</div>
        <div class="row">
                <?php echo $form->labelEx($model,'count'); ?>
                <?php echo $form->textField($model,'count'); ?>
                <?php echo $form->error($model,'count'); ?>
        </div>
	<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
