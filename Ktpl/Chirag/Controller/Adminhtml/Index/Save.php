<?php
namespace Ktpl\Chirag\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    protected $_fileUploaderFactory;

    public function __construct(Action\Context $context,\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,StoreManagerInterface $storeManager,\Magento\Framework\Filesystem $filesystem)
    {
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $pathurl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'chirag/';
        $mediaDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        $mediapath = $this->_mediaBaseDirectory = rtrim($mediaDir, '/');

        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'e_profile_picture']);
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
        $uploader->setAllowRenameFiles(true);
        $path = $mediapath . '/chirag/';
        $result = $uploader->save($path);
        $currenttime = date('Y-m-d H:i:s');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Ktpl\Chirag\Model\Employee');

            $id = $this->getRequest()->getParam('e_id');
            if ($id) {
                $model->load($id);
            }
            $model->setData('e_profile_picture', $_FILES['e_profile_picture']['name']);
            $model->setData('e_name', $data['e_name']);
            $model->setData('e_address', $data['e_address']);
            $model->setData('is_active', $data['is_active']);
            //$model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Employee detail has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['e_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the entry.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['e_id' => $this->getRequest()->getParam('e_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
