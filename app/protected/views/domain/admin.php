<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Domain','url'=>array('index')),
	array('label'=>'Create Domain','url'=>array('create')),
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

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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
