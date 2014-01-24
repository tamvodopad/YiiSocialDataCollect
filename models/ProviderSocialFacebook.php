<?php
/*
    Facebook social provider
 */
class ProviderSocialFacebook extends ProviderSocial {    
    var $appId;    
    var $secret;    
    var $fbaccesstoken;    
    var $fbLimit;    
    

    public function __construct(){
        Yii::import('application.modules.socialcollect.extensions.facebook.*');

        $this->appId = Yii::app()->modules['socialcollect']['providers']['facebook']['appId'];    
        $this->secret = Yii::app()->modules['socialcollect']['providers']['facebook']['secret'];    
        $this->fbaccesstoken = Yii::app()->modules['socialcollect']['providers']['facebook']['fbaccesstoken'];    
        $this->fbLimit = Yii::app()->modules['socialcollect']['providers']['facebook']['fbLimit'];   
    }
    
    function getSocialData() {
        $facebook = new Facebook(array(
          'appId'  => $this->appid,
          'secret' => $this->secret,
        ));

        $facebook->setAccessToken($this->fbaccesstoken);
        $posts = $facebook->api('/119723781374584/feed/?limit=' . $this->fbLimit);       
        $result = array();

        foreach ($posts['data'] as $key => $post) {
            $result[] = array('data_id' => $post['id'], 'data' => json_encode($post));    
        }
        return $result;
    }
}