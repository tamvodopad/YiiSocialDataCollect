<?php
/*
    #Vimeo social provider
    @author Konstantin Popov <popovconstantine@gmail.com>
 */
class ProviderSocialVimeo extends ProviderSocial {    
    var $userId;    
     
    public function __construct(){
        $this->userId = Yii::app()->modules['socialcollect']['providers']['vimeo']['userId'];            
    }
    
    function getSocialData() {        
        $posts = $this->getVimeoRawData();        
        $result = array();
        foreach ($posts as $key => $post) {
            $result[] = array('data_id' => $post->id, 'data' => json_encode($post));    
        }
        return $result;
    }

    private function getVimeoRawData() {
      $curl = curl_init('http://vimeo.com/api/v2/' . $this->userId . '/videos.json');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_TIMEOUT, 30);
      $data = json_decode(curl_exec($curl));
      curl_close($curl);
      return $data;
    }
}