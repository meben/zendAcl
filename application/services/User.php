<?php

/**
 * Description of TestZendACl
 *
 * @author Nandini
 */
class Application_Service_User extends App_Service_Abstract {

    public function getMapper() {
        if (null === $this->_mapper) {
            $this->setMapper('Application_Model_Mapper_Db_User');
        }
        return $this->_mapper;
    }
    
    public function isValid($values) {
        Zend_Registry::get('log')->info(__METHOD__);
        return $this->getMapper()->isValid($values);
    }

    public function getAcl() {
        Zend_Registry::get('log')->info(__METHOD__);

        $acl = new Zend_Acl();

        $acl->addRole(new Zend_Acl_Role(1));

        $acl->add(new Zend_Acl_Resource('As'));
        $acl->add(new Zend_Acl_Resource('Bs'));
        $acl->add(new Zend_Acl_Resource('A'));
        $acl->add(new Zend_Acl_Resource('B'));

        $acl->allow(1, 'As');
        //$acl->allow(1, 'Bs');
        $acl->allow(1, 'A', 'edit', new App_Acl_Assert_ResourceAccess());
        $acl->allow(1, 'A', 'edit:all');
        $acl->allow(1, 'A', 'delete', new App_Acl_Assert_ResourceAccess());
        $acl->allow(1, 'A', 'delete:mine');

        return $acl;
    }
}