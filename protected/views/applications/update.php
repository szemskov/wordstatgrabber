<?php
/* @var $this ApplicationsController */
/* @var $model Applications */

$this->breadcrumbs=array(
	'Applications'=>array('index'),
	$model->aid=>array('view','id'=>$model->aid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Applications', 'url'=>array('index')),
	array('label'=>'Create Applications', 'url'=>array('create')),
	array('label'=>'View Applications', 'url'=>array('view', 'id'=>$model->aid)),
	array('label'=>'Manage Applications', 'url'=>array('admin')),
);
?>

<h1>Update Applications <?php echo $model->aid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>