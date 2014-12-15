<?php
$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Image','url'=>array('index')),
	array('label'=>'Create Image','url'=>array('create')),
	array('label'=>'View Image','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Image','url'=>array('admin')),
);
?>

<h1>Update Image <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>