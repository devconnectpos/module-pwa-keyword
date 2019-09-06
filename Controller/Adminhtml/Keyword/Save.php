<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 6:54 PM
 */

namespace SM\PWAKeyword\Controller\Adminhtml\Keyword;

use Magento\Backend\App\Action;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Save extends Action
{
    protected $scopeConfig;

    /**
     * @param Action\Context $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(Action\Context $context, ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            $model = $this->_objectManager->create('SM\PWAKeyword\Model\Keyword');

            $id = $this->getRequest()->getParam('keyword_id');
            if ($id) {
                $model->load($id);
            }

            try {
                $data['store'] = implode(',', $data['store']);

                //save keyword
                $model->setData($data);
                $model->save();
                $this->messageManager->addSuccess(__('The keyword has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['keyword_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->messageManager->addException($e, __('Something went wrong while saving the keyword.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['keyword_id' => $this->getRequest()->getParam('keyword_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}