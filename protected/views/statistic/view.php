<?php
/* @var $this StatisticController */
/* @var $model Statistic */

$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	$model->sid,
);

$this->menu=array(
	array('label'=>'List Statistic', 'url'=>array('index')),
	array('label'=>'Create Statistic', 'url'=>array('create')),
	array('label'=>'Update Statistic', 'url'=>array('update', 'id'=>$model->sid)),
	array('label'=>'Delete Statistic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Statistic', 'url'=>array('admin')),
);
?>

<h1>View Statistic #<?php echo $model->sid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sid',
		'kid',
		'year',
		'month',
		'shows',
	),
)); ?>
