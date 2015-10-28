<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Chirag\Controller\Index;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class Post extends \Magento\Framework\App\Action\Action
{
    /**
     * Show Contact Us page
     *
     * @return void
     */
    protected $_objectManager;
    protected $_storeManager;
    protected $_filesystem;
    protected $_fileUploaderFactory;
    
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\ObjectManagerInterface $objectManager, StoreManagerInterface $storeManager,\Magento\Framework\Filesystem $filesystem,\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory) 
    {
        $this->_objectManager = $objectManager;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        parent::__construct($context);    
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        
        $pathurl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'chirag/';
        $mediaDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        $mediapath = $this->_mediaBaseDirectory = rtrim($mediaDir, '/');

        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'e_profile_picture']);
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
        $uploader->setAllowRenameFiles(true);
        $path = $mediapath . '/chirag/';
        $result = $uploader->save($path);
        $currenttime = date('Y-m-d H:i:s');
        $model = $this->_objectManager->create('Ktpl\Chirag\Model\Employee');
        $model->setData('e_name', $post['e_name']);
        $model->setData('e_address', $post['e_address']);
        $model->setData('is_active', $post['is_active']);
        $model->setData('created_at', $currenttime);
        $model->setData('e_profile_picture', $_FILES['e_profile_picture']['name']);
        $model->save();
        $this->_redirect('myform/index/view');
        $this->messageManager->addSuccess(__('Employee details have been inserted successfully.'));    
        
        /*if(isset($_FILES['e_profile_picture']))
        {
          
            $file_name = $_FILES['e_profile_picture']['name'];
            $file_size =$_FILES['e_profile_picture']['size'];
            $file_tmp =$_FILES['e_profile_picture']['tmp_name'];
            $file_type=$_FILES['e_profile_picture']['type'];
            $file_ext = explode('.',$file_name);
            $file_ext = end($file_ext);
            $extensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false)
            {
                $this->messageManager->addError(__('extension not allowed, please choose a JPEG or PNG file'));   
            }
            if($file_size > 20000000)
            {
                 $this->messageManager->addError(__('File size must be less than 20 MB'));   
            }
            move_uploaded_file($file_tmp, $mediapath . '/chirag/' . $file_name);
            
        }*/
    }
}
