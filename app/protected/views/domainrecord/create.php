<?php
$this->breadcrumbs=array(
	'Domain Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DomainRecord','url'=>array('index')),
	array('label'=>'Manage DomainRecord','url'=>array('admin')),
);
?>

<h1>Create DomainRecord</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>