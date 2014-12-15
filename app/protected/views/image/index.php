<?php
$this->breadcrumbs=array(
	'Images',
);

$this->menu=array(
	array('label'=>'Create Image','url'=>array('create')),
	array('label'=>'Manage Image','url'=>array('admin')),
);
?>

<h1>Images</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
