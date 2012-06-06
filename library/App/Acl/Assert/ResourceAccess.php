<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResourceAccess
 *
 * @author Nandini
 */
class App_Acl_Assert_ResourceAccess implements Zend_Acl_Assert_Interface {
    //put your code here
    public function assert(Zend_Acl $acl, Zend_Acl_Role_Interface $role = null, Zend_Acl_Resource_Interface $resource = null, $privilege = null) {
        
        if($acl->isAllowed($role,$resource,$privilege.':all') || $acl->isAllowed($role,$resource,$privilege)) {
            return true;
        }
        elseif($acl->isAllowed($role,$resource,$privilege.':mine')) {
            
            if($resource->created_by == $role->id) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}

?>
