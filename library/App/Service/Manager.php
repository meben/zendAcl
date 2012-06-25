<?php

/**
 * Description of Abstract
 *
 * @author Nandini
 */
abstract class App_Service_Manager {    
    
    public static function getService($service) {
        if (is_string($service)) {
           $service = 'Application_Service_'.ucwords($service);
           $service = new $service();
        }
        if (!$service instanceof App_Service_Abstract) {
            throw new Exception('Invalid Service Provided');
        }
        
        return $service;
    }
}
?>
