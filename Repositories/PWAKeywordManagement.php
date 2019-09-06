<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/6/18
 * Time: 2:54 PM
 */

namespace SM\PWAKeyword\Repositories;


use SM\Core\Api\Data\PWAKeyword;
use SM\XRetail\Repositories\Contract\ServiceAbstract;

class PWAKeywordManagement extends ServiceAbstract
{
    /**
     * @var \SM\PWAKeyword\Model\KeywordFactory
     */
    protected $_keywordFactory;

    /**
     * PWAKeywordManagement constructor.
     * @param \Magento\Framework\App\RequestInterface $requestInterface
     * @param \SM\XRetail\Helper\DataConfig $dataConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \SM\PWAKeyword\Model\KeywordFactory $keywordFactory
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $requestInterface,
        \SM\XRetail\Helper\DataConfig $dataConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \SM\PWAKeyword\Model\KeywordFactory $keywordFactory)
    {
        $this->_keywordFactory = $keywordFactory;
        parent::__construct($requestInterface, $dataConfig, $storeManager);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getKeywordData() {
        $items      = [];
        $collection = $this->getKeywordCollection($this->getSearchCriteria());
        $storeId = $this->getSearchCriteria()->getData('storeId');
        if ($collection->getLastPageNumber() < $this->getSearchCriteria()->getData('currentPage')) {
        }
        else {
            foreach ($collection as $keyword) {
                /* string $stores */
                $stores = $keyword->getData('store');
                $stores = explode(',', $stores);
                if(in_array('0', $stores) || in_array($storeId, $stores)) {
                    $k = new PWAKeyword();
                    $k->addData(
                        [
                            'keyword_id'   => $keyword->getId(),
                            'text' => $keyword->getData('text'),
                        ]);
                    $items[] = $k;
                }
            }
        }

        return $this->getSearchResult()
            ->setSearchCriteria($this->getSearchCriteria())
            ->setItems($items)
            ->setTotalCount($collection->getSize())
            ->getOutput();
    }

    public function getKeywordCollection($searchCriteria) {
        /** @var \SM\PWAKeyword\Model\ResourceModel\Keyword\Collection $collection */
        $collection = $this->_keywordFactory->create()->getCollection();
        $collection->setCurPage(is_nan($searchCriteria->getData('currentPage')) ? 1 : $searchCriteria->getData('currentPage'));
        $collection->setPageSize(
            is_nan($searchCriteria->getData('pageSize')) ? DataConfig::PAGE_SIZE_LOAD_CUSTOMER : $searchCriteria->getData('pageSize')
        );

        return $collection;
    }
}