<?php

/**
 * Description of Abstract
 *
 * @author Nandini
 */
abstract class App_Service_Abstract {
    protected $_mapper;
    
    abstract public function getMapper();
    
    public function setMapper($mapper) {
        if (is_string($mapper)) {
            $mapper = new $mapper();
        }
        if (!$mapper instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid Mapper Provided');
        }
        $this->_mapper = $dbTable;
        
        return $this;
    }
}
?>
