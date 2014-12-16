<?php
$this->breadcrumbs=array(
	'Snapshots'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Snapshot','url'=>array('index')),
	array('label'=>'Create Snapshot','url'=>array('create')),
	array('label'=>'View Snapshot','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Snapshot','url'=>array('admin')),
);
?>

<h1>Update Snapshot <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>