<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 11:06 AM
 */

namespace SM\PWAKeyword\Model\ResourceModel\Keyword;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'keyword_id';
    
    public function _construct()
    {
        $this->_init('SM\PWAKeyword\Model\Keyword','SM\PWAKeyword\Model\ResourceModel\Keyword');
    }
}