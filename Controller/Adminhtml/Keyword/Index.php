<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 11:22 AM
 */

namespace SM\PWAKeyword\Controller\Adminhtml\Keyword;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SM_PWAKeyword::keywords');
        $resultPage->addBreadcrumb(__('PWA'), __('PWA'));
        $resultPage->addBreadcrumb(__('Manage Keyword'), __('Manage Keyword'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Keyword'));

        return $resultPage;
    }
}
