<?php

class SocialcollectModule extends CWebModule
{

	public $providers=array();

	public function init()
	{
		

		// import the module-level models and components
		$this->setImport(array(
			'socialcollect.models.*',
			'socialcollect.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{			
			return true;
		}
		else
			return false;
	}
}
