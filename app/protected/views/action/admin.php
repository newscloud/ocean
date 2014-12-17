<?php
$this->breadcrumbs=array(
	'Actions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Process','url'=>array('/daemon/process')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('action-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Actions</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'action-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'droplet_id',
		'snapshot_id',
    array(
      'name'=>'action',
          'header' => 'Action',
           'value' => array($model,'renderAction'), 
      ),
    array(
      'name'=>'status',
          'header' => 'Status',
           'value' => array($model,'renderStatus'), 
      ),
		'stage',
    array(
      'name'=>'last_checked',
          'header' => 'Last Checked',
           'value' => array($model,'renderLastChecked'), 
      ),
		/*
		'end_stage',
		'last_checked',
		'created_at',
		'modified_at',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
