<?php
$this->breadcrumbs=array(
	'Droplets'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Droplet','url'=>array('index')),
	array('label'=>'Create Droplet','url'=>array('create')),
	array('label'=>'Update Droplet','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Droplet','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Droplet','url'=>array('admin')),
);
?>

<h1>View Droplet #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'droplet_id',
		'name',
		'memory',
		'vcpus',
		'disk',
		'status',
		'active',
		'created_at',
		'modified_at',
	),
)); ?>
