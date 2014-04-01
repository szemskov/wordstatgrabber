<?php
/* @var $this ReportController */
/* @var $data Report */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('num')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->num), array('view', 'id'=>$data->num)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aid')); ?>:</b>
	<?php echo CHtml::encode($data->aid); ?>
	<br />


</div>