<?php
$this->breadcrumbs=array(
	'Snapshots'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Sync Images','url'=>array('sync')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('snapshot-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Images</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'snapshot-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'id',
//		'user_id',
		'image_id',
		'name',
		'region',
//		'created_at',
//		'modified_at',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
