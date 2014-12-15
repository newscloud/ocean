<?php
$this->breadcrumbs=array(
	'Droplets',
);

$this->menu=array(
	array('label'=>'Create Droplet','url'=>array('create')),
	array('label'=>'Manage Droplet','url'=>array('admin')),
);
?>

<h1>Droplets</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
