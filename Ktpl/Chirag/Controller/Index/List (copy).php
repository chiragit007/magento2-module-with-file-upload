<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Chirag\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ktpl\Chirag\Model\EmployeeFactory;

class List extends \Magento\Framework\App\Action\Action
{
    /**
     * Show Contact Us page
     *
     * @return void
     */
    protected $_employeeFactory;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory
    )

    {
        parent::__construct($context);
        $this->_employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        exit('here');
        $employeeModel = $this->_employeeFactory->create();
        $employeeCollection = $employeeModel->getCollection();
        var_dump($employeeCollection->getData());
        die();
    }
}
