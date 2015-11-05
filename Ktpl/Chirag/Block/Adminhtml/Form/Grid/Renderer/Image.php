<?php

namespace Ktpl\Chirag\Block\Adminhtml\Form\Grid\Renderer;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    private $_storeManager;
    /**
     * @param \Magento\Backend\Block\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Context $context, StoreManagerInterface $storemanager,\Magento\Framework\Filesystem $filesystem, array $data = [])
    {
        $this->_storeManager = $storemanager;
        $this->_filesystem = $filesystem;
        parent::__construct($context, $data);
        //$this->_authorization = $context->getAuthorization();
    }
    /**
     * Renders grid column
     *
     * @param Object $row
     * @return  string
     */
    public function render(\Magento\Framework\Object $row)
    {
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $mediaDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        $mediapath = $this->_mediaBaseDirectory = rtrim($mediaDir, '/');
        $imageUrl = $mediapath.'/chirag/'. $this->_getValue($row);
        $imagepath = $mediaDirectory.'/chirag/'. $this->_getValue($row);

        if(file_exists($imageUrl) && $this->_getValue($row) !="" && $this->_getValue($row))
        {
        
            return '<img src="'.$imagepath.'" width="50"/>';
        }
        else
        {
            return 'No Image Found';
        }
        //return '<img src="'.$imageUrl.'" width="50"/>';
    }
}