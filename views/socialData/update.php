<?php
/* @var $this SocialDataController */
/* @var $model SocialData */

$this->breadcrumbs=array(
	'Social Datas'=>array('admin'),	
    $model->socialTypes->name =>array('category', 'id' => $model->social_type_id),
    $model->id=>$model->id,
	'Update',
);

$this->menu=array(	
	array('label'=>'Manage SocialData', 'url'=>array('admin')),
    
);
?>

<h1>Update SocialData <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>