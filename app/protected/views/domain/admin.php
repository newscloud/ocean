<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Sync Domains','url'=>array('sync')),
	array('label'=>'Add a Domain','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('domain-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Domains</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'domain-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'ttl',
		/*
		'created_at',
		'modified_at',
		*/
    array(
      'htmlOptions'=>array('width'=>'100px'),  		
      'class'=>'bootstrap.widgets.TbButtonColumn',
      'header'=>'Options',
      'template'=>'{manage}',
        'buttons'=>array
        (
          'manage' => array
          (
            'options'=>array('title'=>'Manage this list'),
            'label'=>'<i class="icon-list icon-large" style="margin-right:10px;"></i>',
            'url'=>'Yii::app()->createUrl("domain/view", array("id"=>$data->id))',
          ),
		    ),
	    ),
),
)); ?>
