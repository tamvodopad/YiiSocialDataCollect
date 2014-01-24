<?php
/*
    Factory social providers
 */
class SocialProviderFactory {
    public function __construct(){

    }
    public static function create($social_name){
        $class_name = 'ProviderSocial'.$social_name;
        if (is_file(Yii::getPathOfAlias('application.modules.socialcollect.models.'. $class_name).'.php')) {
            $provider = new $class_name;
        }
        else {
            throw new CHttpException(404,'Страница не найдена');
        }           
        return $provider;
    }
}