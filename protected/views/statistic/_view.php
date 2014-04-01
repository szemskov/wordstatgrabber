<?php
/* @var $this StatisticController */
/* @var $data Statistic */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sid), array('view', 'id'=>$data->sid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kid')); ?>:</b>
	<?php echo CHtml::encode($data->kid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('month')); ?>:</b>
	<?php echo CHtml::encode($data->month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shows')); ?>:</b>
	<?php echo CHtml::encode($data->shows); ?>
	<br />


</div>