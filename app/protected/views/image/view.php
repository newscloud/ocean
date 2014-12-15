<?php
$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Droplet','url'=>array('image/new/'.$model->id)),
	array('label'=>'Manage Images','url'=>array('admin')),
);
?>

<h1>View Image #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image_id',
		'name',
		'distribution',
		'slug',
		'public',
		'created_at',
		'modified_at',
	),
)); ?>
