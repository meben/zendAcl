<?php
/**
 * Description of Manager
 *
 * @author Nandini
 */
class App_Model_Mapper_Manager {
    
    public static function getDbMapper($mapper) {
        if (is_string($mapper)) {
           $mapper = 'Application_Model_Mapper_Db_'.ucwords($mapper);
           $mapper = new $mapper();
        }
        if (!$mapper instanceof App_Model_Mapper_Abstract) {
            throw new Exception('Invalid Mapper Provided');
        }
        
        return $mapper;
    }
}

?>
