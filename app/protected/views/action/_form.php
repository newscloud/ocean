<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'action-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'droplet_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'snapshot_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'action',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'stage',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'end_stage',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'last_checked',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'created_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'modified_at',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
