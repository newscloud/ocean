<?php
$this->breadcrumbs=array(
	'Domain Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DomainRecord','url'=>array('index')),
	array('label'=>'Create DomainRecord','url'=>array('create')),
	array('label'=>'View DomainRecord','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DomainRecord','url'=>array('admin')),
);
?>

<h1>Update DomainRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>