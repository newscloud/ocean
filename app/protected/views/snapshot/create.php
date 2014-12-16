<?php
$this->breadcrumbs=array(
	'Snapshots'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Snapshot','url'=>array('index')),
	array('label'=>'Manage Snapshot','url'=>array('admin')),
);
?>

<h1>Create Snapshot</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>