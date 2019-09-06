<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/6/18
 * Time: 11:43 AM
 */

namespace SM\PWAKeyword\Block\Adminhtml;


class Keyword extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'SM_PWAKeyword';
        $this->_headerText = __('Manage Keywords');
        $this->_addButtonLabel = __('Add New Keyword');
        parent::_construct();
    }
}