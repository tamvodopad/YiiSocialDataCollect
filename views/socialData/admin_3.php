<?php
/* @var $this SocialDataController */
/* @var $model SocialData */

$this->breadcrumbs=array(
    'Social Datas'=>array('admin'),
    $model->social_type_id => array('category', 'id' => $model->social_type_id),
    'Manage',
);

$this->menu=array(
    
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#social-data-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Manage Social Datas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'social-data-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'header' => 'Title',
            'name' => 'data',
            'type'=>'raw',
            /*'value'=>'CHtml::encode($data->data)',*/
            'value' => function($data, $row){ return '<img src="' . (json_decode($data->data)->images->low_resolution->url) . '"/>';}
        ),
        array(
            'name' => 'social_type_id',
            'value' => '$data->socialTypes->name'
        ),      
        array(          
            'header' => 'Published',
            'name' => 'status',
            'type'=>'raw',
            'value' => '($data->status == 1) ? "Yes" : "No"',
        ),      
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
        ),
    ),
)); ?>
