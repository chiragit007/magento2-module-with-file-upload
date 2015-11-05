<?php

namespace Ktpl\Chirag\Block\Adminhtml\Form\Edit\Tab;

/**
 * Blog post edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;
    
    protected $_formFactory;

    
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Ktpl\Chirag\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_formFactory = $formFactory;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        

        $model = $this->_coreRegistry->registry('form_post');
       
        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Employee Information')]);

        if ($model->getId()) {
            $fieldset->addField('e_id', 'hidden', ['name' => 'e_id']);
        }

        $fieldset->addField(
            'e_name',
            'text',
            [
                'name' => 'e_name',
                'label' => __('Employee Name'),
                'title' => __('Employee Name'),
                'required' => true,
                'disabled' => $isElementDisabled,
                'value' =>'abc'
            ]
        );

        $fieldset->addField(
            'e_address',
            'textarea',
            [
                'name' => 'e_address',
                'label' => __('Employee Address'),
                'title' => __('Employee Address'),
                'required' => true,
                'disabled' => $isElementDisabled,
                'value' =>'abc'
            ]
        );

        

        $fieldset->addField(
            'e_profile_picture',
            'image',
            [
                'label' => __('Employee Profile Picture'),
                'title' => __('Employee Profile Picture'),
                'name' => 'e_profile_picture',
                'required' => true,
                'disabled' => $isElementDisabled,
                //'value' =>'abc'               
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => $this->_status->getOptionArray(),
                'disabled' => $isElementDisabled
            ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        if($model->getData('e_profile_picture'))
            $model->setData('e_profile_picture','chirag/'.$model->getData('e_profile_picture'));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
