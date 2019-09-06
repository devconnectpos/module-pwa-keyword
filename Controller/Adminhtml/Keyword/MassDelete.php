<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 6:33 PM
 */

namespace SM\PWAKeyword\Controller\Adminhtml\Keyword;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $keywordFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param \SM\PWAKeyword\Model\ResourceModel\Keyword\CollectionFactory $keywordFactory
     */
    public function __construct(Context $context, Filter $filter, \SM\PWAKeyword\Model\ResourceModel\Keyword\CollectionFactory $keywordFactory)
    {
        $this->filter = $filter;
        $this->keywordFactory = $keywordFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->keywordFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $page) {
            $page->delete();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
