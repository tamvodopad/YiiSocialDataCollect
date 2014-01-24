<?php
    class SocialcollectCommand extends CConsoleCommand
    {
        public function run($attributes) {
            $social_type=SocialTypes::model()->findByAttributes(array('name' => $attributes[0]));

            if(isset($social_type->id)) {
                $social = SocialProviderFactory::create($attributes[0]);              
                
                $posts = $social->getSocialData();

                foreach ($posts as $key => $value) {
                    $is_data = SocialData::model()->findByAttributes(array('data_id' => $value['data_id']));
                    if(empty($is_data)) {
                        $Post = new SocialData;
                        $Post->social_type_id = $social_type->id;
                        $Post->data_id = $value['data_id'];
                        $Post->data = $value['data'];
                        if($Post->validate())
                            $Post->save();
                    }                    
                }    
            }
        }        
    }
?>