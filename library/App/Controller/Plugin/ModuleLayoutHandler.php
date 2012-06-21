<?php
/* /library/Plugin/ModuleLayoutHandler.php */

class App_Controller_Plugin_ModuleLayoutHandler 
                extends Zend_Controller_Plugin_Abstract
{

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $module = $request->getModuleName();
        if($module != 'default'){
            Zend_Layout::getMvcInstance()->setLayoutPath(
                APPLICATION_PATH. DIRECTORY_SEPARATOR . "modules" . DIRECTORY_SEPARATOR .$module. DIRECTORY_SEPARATOR ."layouts". DIRECTORY_SEPARATOR ."scripts"
            );
        }
    }

}

?>
