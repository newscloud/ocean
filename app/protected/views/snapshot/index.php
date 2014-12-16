<?php
$this->breadcrumbs=array(
	'Snapshots',
);

$this->menu=array(
	array('label'=>'Create Snapshot','url'=>array('create')),
	array('label'=>'Manage Snapshot','url'=>array('admin')),
);
?>

<h1>Snapshots</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
