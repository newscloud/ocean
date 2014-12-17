<?php
$this->breadcrumbs=array(
	'Domain Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DomainRecord','url'=>array('index')),
	array('label'=>'Create DomainRecord','url'=>array('create')),
	array('label'=>'Update DomainRecord','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete DomainRecord','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DomainRecord','url'=>array('admin')),
);
?>

<h1>View DomainRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'record_id',
		'record_type',
		'record_name',
		'record_data',
		'priority',
		'port',
		'weight',
		'active',
		'created_at',
		'modified_at',
	),
)); ?>
