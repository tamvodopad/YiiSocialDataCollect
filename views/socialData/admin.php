<?php
/* @var $this SocialDataController */
/* @var $model SocialData */

$this->breadcrumbs=array(
	'Social Datas'=>array('index'),
	'Manage',
);

$this->menu=array(
	
);


?>

<h1>Manage Social Categorys</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'social-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name, array("category", "id" => $data->id))',
        ),      
	),
)); ?>
