<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 10:59 AM
 */

namespace SM\PWAKeyword\Model;


use SM\PWAKeyword\Api\Data\KeywordInterface;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\Context;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;

class Keyword extends \Magento\Framework\Model\AbstractModel implements KeywordInterface, IdentityInterface
{
    const CACHE_TAG = 'sm_pwa_keyword';

    protected $_cacheTag = 'sm_pwa_keyword';

    protected $_eventPrefix = 'sm_pwa_keyword';

    private $dateFactory;

    /**
     * Keyword constructor.
     * @param Context $context
     * @param DateTimeFactory $dateFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        DateTimeFactory $dateFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->dateFactory = $dateFactory;
    }

    protected function _construct()
    {
        $this->_init('SM\PWAKeyword\Model\ResourceModel\Keyword');
    }


    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->getData(self::TEXT);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        return $this->setData(self::TEXT, $text);
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setCreatedAt($date)
    {
        return $this->setData(self::CREATED_AT, $date);
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setUpdatedAt($date)
    {
        return $this->setData(self::UPDATED_AT, $date);
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->getData(self::ID);
    }

    /**
     * @param int
     * @return $this
     */
    public function setId($id) {
        return $this->setData(self::ID, $id);
    }

    public function beforeSave() {
        if (! $this->getId()) {
            $this->setCreatedAt($this->dateFactory->create()->gmtDate());
        }

        $this->setUpdatedAt($this->dateFactory->create()->gmtDate());

        return parent::beforeSave();
    }
}