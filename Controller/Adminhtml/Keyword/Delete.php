<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/6/18
 * Time: 11:42 AM
 */

namespace SM\PWAKeyword\Controller\Adminhtml\Keyword;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('keyword_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('SM\PWAKeyword\Model\Keyword');
                $model->load($id);
                $model->delete();

                $this->messageManager->addSuccess(__('The keyword has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['keyword_id' => $id]);
            }
        } else {
            $this->messageManager->addError(__('We can\'t find the keyword to delete.'));
            return $resultRedirect->setPath('*/*/');
        }
    }
}
