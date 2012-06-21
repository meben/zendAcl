<?php
/**
 * Description of TestZendACl
 *
 * @author Nandini
 */
class Application_Service_User extends App_Service_Abstract {
    
     public function isValid($values) {
        Zend_Registry::get('log')->info(__METHOD__);
            
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username']); 
        $adapter->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $this->_getUser($adapter);
            Zend_Registry::get('log')->debug(var_export($user,true));            
            $auth->getStorage()->write($user);
            $this->_loadAcl();
            return true;
        }
        return false;
     }
     
     protected function _getAuthAdapter() {
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('user')
            ->setIdentityColumn('name')
            ->setCredentialColumn('password')
            ->setCredentialTreatment('SHA1(CONCAT(?,salt))');
            
        
        return $authAdapter;
    }
    
    protected function _getUser($adapter) {
        $user = $adapter->getResultRowObject();        
        $user = new Application_Model_User($user);
        return $user;
    }
    
    protected function _loadAcl() {
        $acl = new Zend_Acl();
 
        $acl->addRole(new Zend_Acl_Role(1));
        
        $acl->add(new Zend_Acl_Resource('As'));
        $acl->add(new Zend_Acl_Resource('Bs'));
        $acl->add(new Zend_Acl_Resource('A'));
        $acl->add(new Zend_Acl_Resource('B'));
        
        $acl->allow(1, 'As');
        $acl->allow(1, 'Bs');
        $acl->allow(1, 'A','edit',new App_Acl_Assert_ResourceAccess());
        $acl->allow(1, 'A','edit:all');
        $acl->allow(1, 'A','delete',new App_Acl_Assert_ResourceAccess());
        $acl->allow(1, 'A','delete:mine');
        
        $session = new Zend_Session_Namespace('zend');
        
        $session->acl = $acl;
    }

    public function getMapper() {
        if (null === $this->_mapper) {
            $this->setMapper('Application_Model_Mapper_Db_User');
        }
        return $this->_dbTable;
    }
}

?>
