<?php

abstract class App_Model_Mapper_Abstract {

    protected $_table;
    protected $_mapper = array();

    abstract protected function _getTable();
    
    public function setTable(Zend_Db_Table_Abstract $table) {
        $this->_table = $table;
    }
    
    public function dbToModel($dbModel, $modelObj) {
        if (!is_null($dbModel)) {
            foreach ($dbModel as $prop_name => $prop_value) {
                if (array_key_exists($prop_name, $this->_mapper)) {
                    $modelObj->__set($this->_mapper["$prop_name"], $prop_value);
                }
            }
        }
        return $modelObj;
    }

    protected function _modeltoDB($modelObj, $dbModel) {
        
    }
}