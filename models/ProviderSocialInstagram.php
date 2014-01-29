<?php
/*
    #Instagram social provider
    @author Konstantin Popov <popovconstantine@gmail.com>
 */
class ProviderSocialInstagram extends ProviderSocial {    
    var $apiKey;    
    var $apiSecret;    
    var $apiCallback;    
    var $userId; 
    var $accessToken;    
    

    public function __construct(){
        Yii::import('application.modules.socialcollect.extensions.*');

        $this->apiKey = Yii::app()->modules['socialcollect']['providers']['instagram']['apiKey'];    
        $this->apiSecret = Yii::app()->modules['socialcollect']['providers']['instagram']['apiSecret'];    
        $this->apiCallback = Yii::app()->modules['socialcollect']['providers']['instagram']['apiCallback'];      
        $this->userId = Yii::app()->modules['socialcollect']['providers']['instagram']['userId'];      
        $this->accessToken = Yii::app()->modules['socialcollect']['providers']['instagram']['accessToken'];      
    }
    
    function getSocialData() {
        $instagram = new Instagram(array(
          'apiKey'      => $this->apiKey,
          'apiSecret'   => $this->apiSecret,
          'apiCallback' => $this->apiCallback
        ));

        $data = $instagram->setAccessToken($this->accessToken);
        $posts = $instagram->getUserMedia($this->userId);

        $result = array();

        foreach ($posts->data as $key => $post) {
            $result[] = array('data_id' => $post->id, 'data' => json_encode($post));    
        }
        return $result;
    }
}