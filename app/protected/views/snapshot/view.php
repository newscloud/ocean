<?php
$this->breadcrumbs=array(
	'Snapshots'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Snapshot','url'=>array('index')),
	array('label'=>'Create Snapshot','url'=>array('create')),
	array('label'=>'Update Snapshot','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Snapshot','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Snapshot','url'=>array('admin')),
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
