<?php

class Application_Model_User implements Zend_Acl_Role_Interface {

    public $id;
    public $email;
    public $name;
    public $roleid;
    
    public function __construct($user) {
        $this->id       = $user->id;
        $this->email    = $user->email;
        $this->name     = $user->name;
        $this->roleid   = $user->role_id;
    }
    
    public function getRoleId() {
        return $this->roleid;
    }

}

