<?php
$this->breadcrumbs=array(
	'Snapshots'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Sync Images','url'=>array('sync')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('snapshot-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
if(Yii::app()->user->hasFlash('info')) {
  $this->widget('bootstrap.widgets.TbAlert', array(
      'block'=>true, // display a larger alert block?
      'fade'=>true, // use transitions?
      'closeText'=>'×', // close link text - if set to false, no close link is displayed
      'alerts'=>array( // configurations per alert type
  	    'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger  	    
      ),
  ));
}

?>
<h1>Manage Images</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'snapshot-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'id',
//		'user_id',
		'image_id',
		'name',
		'region',
//		'created_at',
//		'modified_at',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
