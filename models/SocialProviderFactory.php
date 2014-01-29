<?php
/*
    #Social providers factory
    @author Konstantin Popov <popovconstantine@gmail.com>
 */
class SocialProviderFactory {
    
    public function __construct(){

    }

    public static function create($social_name){
        $class_name = 'ProviderSocial'.$social_name;
        if (is_file(Yii::getPathOfAlias('application.modules.socialcollect.models.'. $class_name).'.php')) {
            $provider = new $class_name;
            return $provider;
        } else {
            throw new CException(404,'Provider not found');
        }                   
    }
}