<?php

class Application_Model_User extends App_Model_Abstract implements Zend_Acl_Role_Interface {

    protected $_email;
    protected $_roleId;
    protected $_modelType = "User";
    
    public function __construct($user) {
        $this->_id       = $user->id;
        $this->_email    = $user->email;
        $this->_name     = $user->name;
        $this->_roleId   = $user->role_id;
    }
    
    public function getRoleId() {
        return $this->_roleId;
    }

    protected function _getModelType() {
        return $this->_modelType;
    }

}

