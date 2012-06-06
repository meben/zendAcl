<?php

class Application_Model_ResourceA implements Zend_Acl_Resource_Interface
{
    public $id;    
    public $name;
    public $type = "A";
    public $created_by;
    
    public function getResourceId() {
        return $this->type;
    }
    
    
}

