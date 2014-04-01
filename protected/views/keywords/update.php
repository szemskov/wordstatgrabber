<?php
/* @var $this KeywordsController */
/* @var $model Keywords */

$this->breadcrumbs=array(
	'Keywords'=>array('index'),
	$model->name=>array('view','id'=>$model->kid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Keywords', 'url'=>array('index')),
	array('label'=>'Create Keywords', 'url'=>array('create')),
	array('label'=>'View Keywords', 'url'=>array('view', 'id'=>$model->kid)),
	array('label'=>'Manage Keywords', 'url'=>array('admin')),
);
?>

<h1>Update Keywords <?php echo $model->kid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>