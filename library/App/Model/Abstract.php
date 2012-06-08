<?php

/**
 * Description of Abstract
 *
 * @author Nandini
 */
abstract class App_Model_Abstract implements Zend_Acl_Resource_Interface {

    protected $_id;
    protected $_name;
    protected $_createdBy;

    public function __get($name) {
        $property = '_' . $name;
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    public function __set($name, $value) {
        $property = '_' . $name;
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __toString() {
        $retstr = "";

        foreach ($this as $key => $value) {
            if (is_array($value)) {
                $retstr.="\n" . "$key =>" . implode(",", $value);
            } else {
                $retstr.="\n" . "$key =>" . $value;
            }
        }

        $retstr.="\n";

        return $retstr;
    }
    
    abstract protected function _getModelType();
    
    public function getResourceId() {
        return $this->_getModelType();
    }
}

?>
