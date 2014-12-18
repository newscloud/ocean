<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Sync Domain Records','url'=>array('/domain/syncrecords/'.$model->id)),
	array('label'=>'Add Record','url'=>array('/domainrecord/create/'.$model->id)),
	array('label'=>'Manage Domain','url'=>array('admin')),
);
?>

<h1>Domain <?php echo $model->name; ?></h1>

<?php 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'domainrecord-grid',
	'dataProvider'=>$records,
	'type'=>'striped',
	'columns'=>array(
    array('class'=>'CDataColumn','value'=>'$data->record_id', 'header'=>'Ext ID'),
    array('class'=>'CDataColumn','value'=>'$data->record_name', 'header'=>'Name'),
    array('class'=>'CDataColumn','value'=>'$data->record_type', 'header'=>'Type'),
    array('class'=>'CDataColumn','value'=>'$data->record_data', 'header'=>'Data'),

/*
    array(            
        'name'=>'user_id',
        'value'=>array($this,'showUser'), 
        ),

   array('class'=>'CLinkColumn','labelExpression'=>'showSubscriptionStatus($data->status)', 'header'=>'Status','urlExpression'=>'showSubscriptionLink($data->user_id,$data->list_id,$data->status)'),
*/
	),
)); 

?>