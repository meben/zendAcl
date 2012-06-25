<?php
/**
 * Description of User
 *
 * @author Nandini
 */
class Application_Model_Mapper_DB_User extends App_Model_Mapper_Db_Abstract {
    
    public function isValid($values) {
        Zend_Registry::get('log')->info(__METHOD__);
            
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        
        $adapter->setIdentity($values['username']); 
        $adapter->setCredential($values['password']);

        $result = Zend_Auth::getInstance()->authenticate($adapter);
        if ($result->isValid()) {
            $user = $this->_getUser($adapter);
            Zend_Registry::get('log')->debug(var_export($user,true));            
            return $user;
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

    public function getTable() {
        
    }
}

?>
