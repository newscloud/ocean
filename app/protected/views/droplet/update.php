<?php
$this->breadcrumbs=array(
	'Droplets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Droplet','url'=>array('index')),
	array('label'=>'Create Droplet','url'=>array('create')),
	array('label'=>'View Droplet','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Droplet','url'=>array('admin')),
);
?>

<h1>Update Droplet <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>