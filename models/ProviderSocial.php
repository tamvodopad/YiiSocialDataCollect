<?php 
    /*
        #Abstract class for social providers
        @author Konstantin Popov <popovconstantine@gmail.com>
    */
    abstract class ProviderSocial { 
        function __construct() {             
        }         

        abstract function getSocialData(); 
    } 

?>