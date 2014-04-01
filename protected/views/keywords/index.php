<?php
/* @var $this KeywordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Keywords',
);

$this->menu=array(
	array('label'=>'Create Keywords', 'url'=>array('create')),
	array('label'=>'Manage Keywords', 'url'=>array('admin')),
);
?>

<h1>Keywords</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
