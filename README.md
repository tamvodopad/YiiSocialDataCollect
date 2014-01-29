YiiSocialDataCollect
====================

This Yii Frameworks module for collects social data from most popular socials networks in database and manipulate with this data.

Git clone
---------
    
    Clone this repository in your protected/modules/socialcollect folder

    git clone https://github.com/tamvodopad/YiiSocialDataCollect.git

Configure
---------

Change your config console:

'modules'=>array(
    'socialcollect' => array(
        'providers' => array(
            'facebook' => array(
                'appId' => 'YOUR_APPID',
                'secret' => 'YOUR_APP_SECRET',
                'fbaccesstoken' => 'YOUR FACEBOOK APP TOKEN',
                'fbLimit' => 'LIMIT OF FACEBOOK POSTS FOR ONE REQUEST',
            ),
            'twitter' => array(
                'oauth_access_token' => 'YOUR_TWITTER_APPID',
                'consumer_key' => 'YOUR_TWITTER_APPID_CONSUMER_KEY',
                'consumer_secret' => 'YOUR_TWITTER_APPID_CONSUMER_SECRET',
                'oauth_access_token_secret' => 'YOUR_TWITTER_APPID_ACCESS_TOKEN',                
            ),          
            'instagram' => array(
                'apiKey'      => 'YOUR_INSTAGRAM_API_APIKEY',
                'apiSecret'   => 'YOUR_INSTAGRAM_API_APISECRET',
                'apiCallback' => 'YOUR_INSTAGRAM_API_APICALLBACK',
                'userId' => 'YOUR_INSTAGRAM_USER_FOR_COLLECT_THIS_USER_FEED',
                'accessToken' => 'YOUR_INSTAGRAM_ACCESSTOKEN'
            ),
            'vimeo' => array(
                'userId'      => 'YOUR_VIMEO_USER_FOR_COLLECT_THIS_USER_VIDEOS_FEED',                        
            )
        )
    ),
'commandMap' => array(
    'socialcollect' => array(
        'class' => 'application.modules.socialcollect.commands.SocialcollectCommand',
    ),

),            

Install
-------

1. Run command:
    yiic migrate --migrationPath=socialcollect.migrations

2. Download next API php implementations classes:

* https://github.com/facebook/facebook-php-sdk  extract files from /src/ folder to protected/modules/socialcollect/extensions/facebook folder
* https://github.com/cosenary/Instagram-PHP-API and rename instagram.class.php to instagram.php


Using the application
-------

You can grub data from social networks to yii database by commands: 

* yiic socialcollect Facebook - add data from facebook page
* yiic socialcollect Twitter - add data from twitter accaunt
* yiic socialcollect Instagram - add data from instagram accaunt
* yiic socialcollect Vimeo - add data from vimeo accaunt

To automate, you can add these commands to your cron task.
