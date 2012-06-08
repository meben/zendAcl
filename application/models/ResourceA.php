<?php

class Application_Model_ResourceA extends App_Model_Abstract
{
    protected $_modelType = "A";    
    
    protected function _getModelType() {
        return $this->_modelType;
    }
}

