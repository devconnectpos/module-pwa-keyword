<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 11:02 AM
 */

namespace SM\PWAKeyword\Model\ResourceModel;


class Keyword extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('sm_pwa_keyword','keyword_id');
    }
}