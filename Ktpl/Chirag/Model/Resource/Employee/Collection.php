<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Chirag\Model\Resource\Employee;
 
class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Ktpl\Chirag\Model\Employee', 'Ktpl\Chirag\Model\Resource\Employee');
        //$this->_map['fields']['page_id'] = 'main_table.page_id';
    }
 
    
}
