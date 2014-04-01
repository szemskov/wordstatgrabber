<?php
/* @var $this ReportController */
/* @var $model Report */

$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->num=>array('view','id'=>$model->num),
	'Update',
);

$this->menu=array(
	array('label'=>'List Report', 'url'=>array('index')),
	array('label'=>'Create Report', 'url'=>array('create')),
	array('label'=>'View Report', 'url'=>array('view', 'id'=>$model->num)),
	array('label'=>'Manage Report', 'url'=>array('admin')),
);
?>

<h1>Update Report <?php echo $model->num; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>