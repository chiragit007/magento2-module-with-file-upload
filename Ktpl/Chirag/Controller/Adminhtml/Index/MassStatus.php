<?php
namespace Ktpl\Chirag\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * Update blog post(s) status action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $empIds = $this->getRequest()->getParam('ktpl_emp');
        if (!is_array($empIds) || empty($empIds)) {
            $this->messageManager->addError(__('Please select Employee.'));
        } else {
            try {
                $status = $this->getRequest()->getParam('status');
                foreach ($empIds as $empId) 
                {
                    $emp = $this->_objectManager->get('Ktpl\Chirag\Model\Employee')->load($empId);
                    $emp->setData('is_active',$status)->save();
                }
                
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been updated.', count($empIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('chirag/*/index');
    }

}
