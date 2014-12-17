<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Domain','url'=>array('index')),
	array('label'=>'Create Domain','url'=>array('create')),
	array('label'=>'Update Domain','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Domain','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Domain','url'=>array('admin')),
);
?>

<h1>View Domain #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'ttl',
		'zone',
		'ip_address',
		'active',
		'created_at',
		'modified_at',
	),
)); ?>
