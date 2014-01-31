<?php

class SocialDataController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request			
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'category', 'update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SocialTypes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SocialTypes']))
			$model->attributes=$_GET['SocialTypes'];

		$this->render('admin',array(
			'model'=>$model,
		));		
	}

	/**
	 * Manages all models.
	 */
	public function actionCategory($id)
	{
		print_r($id);
		$model=new SocialData('search');
		$model->unsetAttributes();  // clear any default values
		$model->social_type_id = $id;
		if(isset($_GET['SocialData']))
			$model->attributes=$_GET['SocialData'];

		$this->render('admin_' . $id, array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SocialData']))
		{
			$model->attributes=$_POST['SocialData'];
			if($model->save())
				$this->redirect(array('category', 'id' => $model->social_type_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SocialData the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{ 
		$model=SocialData::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SocialData $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='social-data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
