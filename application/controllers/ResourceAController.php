<?php

class ResourceAController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $resourceAList = array();
        
        $resourceA = new Application_Model_ResourceA();        
        $resourceA->id = 1;
        $resourceA->name = "ResourceA_1";
        $resourceAList[] = $resourceA;
        
        $resourceA = new Application_Model_ResourceA();
        
        $resourceA->id = 2;
        $resourceA->name = "ResourceA_2";
        $resourceAList[] = $resourceA;
        
        $resourceA = new Application_Model_ResourceA();
        
        $resourceA->id = 3;
        $resourceA->name = "ResourceA_3";
        $resourceAList[] = $resourceA;
        
        $resourceA = new Application_Model_ResourceA();
        
        $resourceA->id = 4;
        $resourceA->name = "ResourceA_4";
        $resourceAList[] = $resourceA;
        
        $this->view->resources = $resourceAList;
    }


}

