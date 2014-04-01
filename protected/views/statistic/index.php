<?php
/* @var $this StatisticController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Statistics',
);

$this->menu=array(
	array('label'=>'Create Statistic', 'url'=>array('create')),
	array('label'=>'Manage Statistic', 'url'=>array('admin')),
);
?>

<h1>База ключевых слов</h1>

<p>
Можно использовать следующие операторы для числовых полей (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) а также комбинировать условия через ",".
</p>

<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'statistic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallCJuiAutoComplete',
	'columns'=>array(
			array(
					'class'=>'CLinkColumn',
					'header'=>'ID',
					'urlExpression'=>'"/keywords/view/id/".$data->kid',
					'labelExpression'=>'$data->kid',
			),
			array(	
					'header'=>'key',
					'name'=>'keywords.name',
					'filter'=>$this->widget('zii.widgets.jui.CJuiAutoComplete',
							array(	'name' => 'Keywords[name]',
									'model'=>Keywords::model(),
									'attribute'=>'name',
									'source' =>Yii::app()->createUrl('keywords/autocomplete'),
									'options'=>array(
										// минимальное кол-во символов, после которого начнется поиск
										'minLength'=>'2',
										'showAnim'=>'fold',
										'delay'=>300,
									)
		                    ),true),

			),
			'year',
			'month',
			'shows',
			array(            // display a column with "view", "update" and "delete" buttons
					'class'=>'CButtonColumn',
			),
	),
));

Yii::app()->clientScript->registerScript('re-install-auto-complete', "
function reinstallCJuiAutoComplete(id, data) {
    jQuery('#Keywords_name').autocomplete({'minLength':'2','showAnim':'fold','delay':300,'source':'/keywords/autocomplete'});
}
");
?>
