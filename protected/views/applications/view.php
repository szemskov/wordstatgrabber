<?php
/* @var $this ApplicationsController */
/* @var $model Applications */

$this->breadcrumbs=array(
	'Applications'=>array('index'),
	$model->aid,
);

$this->menu=array(
	array('label'=>'List Applications', 'url'=>array('index')),
	array('label'=>'Create Applications', 'url'=>array('create')),
	array('label'=>'Update Applications', 'url'=>array('update', 'id'=>$model->aid)),
	array('label'=>'Delete Applications', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->aid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Applications', 'url'=>array('admin')),
);
?>

<h1>Параметры приложения Yandex.ru <?php echo $model->application_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'aid',
		'login',
		'application_id',
		'token',
		'limit',
		'count',
		'timestamp',
	),
)); ?>
