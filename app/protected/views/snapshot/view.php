<?php
$this->breadcrumbs=array(
	'Snapshots'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Replicate','url'=>array('/snapshot/replicate/'.$model->id)),
	array('label'=>'Manage Snapshots','url'=>array('admin')),
);
?>

<h1>View Snapshot #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'image_id',
		'name',
		'created_at',
		'modified_at',
	),
)); ?>
