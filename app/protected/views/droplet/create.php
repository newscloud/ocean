<?php
$this->breadcrumbs=array(
	'Droplets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Droplet','url'=>array('index')),
	array('label'=>'Manage Droplet','url'=>array('admin')),
);
?>

<h1>Create Droplet</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>