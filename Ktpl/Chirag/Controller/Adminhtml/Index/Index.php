<?php
namespace Ktpl\Chirag\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ktpl_Chirag::chirag');
        $resultPage->addBreadcrumb(__('Krish'), __('Krish'));
        $resultPage->addBreadcrumb(__('Manage Employees'), __('Manage Employees'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Employees'));
        return $resultPage;
    }
}
