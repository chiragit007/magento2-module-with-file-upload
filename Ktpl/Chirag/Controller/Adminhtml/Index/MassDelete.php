<?php
namespace Ktpl\Chirag\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $empIds = $this->getRequest()->getParam('ktpl_emp');
        if (!is_array($empIds) || empty($empIds)) {
            $this->messageManager->addError(__('Please select Employee.'));
        } else {
            try {
                foreach ($empIds as $empId) {
                    $emp = $this->_objectManager->get('Ktpl\Chirag\Model\Employee')->load($empId);
                    $emp->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($empIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('chirag/*/index');
    }
}
