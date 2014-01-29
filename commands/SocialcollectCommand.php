<?php
    /*
        #SocialcollectCommand
        @author Konstantin Popov <popovconstantine@gmail.com>
     */
    
    class SocialcollectCommand extends CConsoleCommand
    {
        public function run($attributes) {
            
            $social_type=SocialTypes::model()->findByAttributes(array('name' => $attributes[0]));

            if(isset($social_type->id)) {
                $social = SocialProviderFactory::create($attributes[0]);                              
                $posts = $social->getSocialData();

                foreach ($posts as $key => $value) {
                    $is_data = SocialData::model()->findByAttributes(array('data_id' => $value['data_id']));
                   
                    //If this data are not in db
                    if(!isset($is_data->id)) {
                        
                        $Post = new SocialData;
                        $Post->social_type_id = $social_type->id;
                        $Post->data_id = $value['data_id'];
                        $Post->data = $value['data'];

                        if($Post->validate())
                            $Post->save();
                    }                    
                }    
            } else {
                throw new CException('Provider not found');
            }
        }        
    }
?>