<?php
/* @var $this StatisticController */
/* @var $model Statistic */

$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Statistic', 'url'=>array('index')),
	array('label'=>'Manage Statistic', 'url'=>array('admin')),
);
?>

<h1>Create Statistic</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>