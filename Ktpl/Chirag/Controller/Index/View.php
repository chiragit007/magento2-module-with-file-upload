<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Chirag\Controller\Index;

class View extends \Magento\Framework\App\Action\Action
{
    

    public function execute()
    {
         $this->_view->loadLayout();
         $this->_view->renderLayout();
    }
    /*public function execute()
    {
        $model = $this->_objectManager->create('Ktpl\Chirag\Model\Employee');
        $employeeCollection = $model->getCollection();
        $employeeCollectionData = $employeeCollection->getData();
        foreach ($employeeCollectionData as $employee) 
        {
            $e_id = $employee['e_id'];
            $e_name = $employee['e_name'];
            $e_address = $employee['e_address'];
            $is_active = $employee['is_active'];
            echo "Id " . $e_id . '<br/>' ;
            echo "Name " . $e_name . '<br/>';
            echo "Address " . $e_address. '<br/>' ;
            echo "Active " . $is_active. '<br/>' ;
            echo "<br/><br/>";
        }
        $this->messageManager->addSuccess(__('Employee details have been inserted successfully.'));    
    }*/
}
