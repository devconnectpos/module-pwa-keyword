<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 7:00 PM
 */

namespace SM\PWAKeyword\Api\Data;


/**
 * Interface KeywordInterface
 * @package SM\PWAKeyword\Api\Data
 */
interface KeywordInterface
{
    const ID = 'keyword_id';
    const TEXT = 'text';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getText();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text);

    /**
     * @param string $date
     * @return $this
     */
    public function setCreatedAt($date);

    /**
     * @param string $date
     * @return $this
     */
    public function setUpdatedAt($date);
}