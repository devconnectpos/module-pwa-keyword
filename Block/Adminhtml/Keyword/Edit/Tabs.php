<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/6/18
 * Time: 11:45 AM
 */

namespace SM\PWAKeyword\Block\Adminhtml\Keyword\Edit;


class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('keyword_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Keyword Information'));
    }
}
