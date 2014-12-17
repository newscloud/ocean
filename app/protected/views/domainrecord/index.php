<?php
$this->breadcrumbs=array(
	'Domain Records',
);

$this->menu=array(
	array('label'=>'Create DomainRecord','url'=>array('create')),
	array('label'=>'Manage DomainRecord','url'=>array('admin')),
);
?>

<h1>Domain Records</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
