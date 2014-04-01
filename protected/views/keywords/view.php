<?php
/* @var $this KeywordsController */
/* @var $model Keywords */

$this->breadcrumbs=array(
	'Keywords'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Keywords', 'url'=>array('index')),
	array('label'=>'Create Keywords', 'url'=>array('create')),
	array('label'=>'Update Keywords', 'url'=>array('update', 'id'=>$model->kid)),
	array('label'=>'Delete Keywords', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->kid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Keywords', 'url'=>array('admin')),
);
?>

<h1>View Keywords #<?php echo $model->kid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'kid',
	),
)); ?>
