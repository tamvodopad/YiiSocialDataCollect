<?php
/*
    #Twitter social provider
    @author Konstantin Popov <popovconstantine@gmail.com>
 */
class ProviderSocialTwitter extends ProviderSocial {
    
    var $oauth_access_token;    
    var $oauth_access_token_secret;    
    var $consumer_key;    
    var $consumer_secret;    
    

    public function __construct(){
        $this->oauth_access_token = Yii::app()->modules['socialcollect']['providers']['twitter']['oauth_access_token'];    
        $this->oauth_access_token_secret = Yii::app()->modules['socialcollect']['providers']['twitter']['oauth_access_token_secret'];    
        $this->consumer_key = Yii::app()->modules['socialcollect']['providers']['twitter']['consumer_key'];    
        $this->consumer_secret = Yii::app()->modules['socialcollect']['providers']['twitter']['consumer_secret'];   

    }

    function getSocialData() {
        $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
      
        $oauth = array('oauth_consumer_key' => $this->consumer_key,
                'oauth_nonce' => time(),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_token' => $this->oauth_access_token,
                'oauth_timestamp' => time(),
                'oauth_version' => '1.0');
            $base_info = $this->buildBaseString($url, 'GET', $oauth);
            $composite_key = rawurlencode($this->consumer_secret) . '&' . rawurlencode($this->oauth_access_token_secret);
            $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
            $oauth['oauth_signature'] = $oauth_signature;

            // Make Requests
            $header = array($this->buildAuthorizationHeader($oauth), 'Expect:');
            $options = array(CURLOPT_HTTPHEADER => $header,
                CURLOPT_HEADER => false,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false);

            $feed = curl_init();
            curl_setopt_array($feed, $options);
            $json = curl_exec($feed);
            curl_close($feed);
            
            $twitter_data = json_decode($json);

           // print_r($twitter_data);
            
            $result = array();

            foreach ($twitter_data as $key => $post) {
                $result[] = array('data_id' => $post->id, 'data' => json_encode($post));    
            }
            return $result;
    }

    function buildBaseString($baseURI, $method, $params) {
        $r = array();
        ksort($params);
        foreach ($params as $key => $value) {
            $r[] = "$key=" . rawurlencode($value);
        }
        return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
    }

    function buildAuthorizationHeader($oauth) {
            $r = 'Authorization: OAuth ';
            $values = array();
            foreach ($oauth as $key => $value)
                $values[] = "$key=\"" . rawurlencode($value) . "\"";
            $r .= implode(', ', $values);
            return $r;
        }
}