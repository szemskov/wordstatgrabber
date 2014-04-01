<?php
/* @var $this ReportController */
/* @var $model Report */

$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->num,
);

$this->menu=array(
	array('label'=>'List Report', 'url'=>array('index')),
	array('label'=>'Create Report', 'url'=>array('create')),
	array('label'=>'Update Report', 'url'=>array('update', 'id'=>$model->num)),
	array('label'=>'Delete Report', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->num),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Report', 'url'=>array('admin')),
);
?>

<h1>View Report #<?php echo $model->num; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'num',
		'aid',
	),
)); ?>
