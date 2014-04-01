<?php
/* @var $this KeywordsController */
/* @var $data Keywords */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('kid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kid), array('view', 'id'=>$data->kid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>