<?php
/**
 * Created by PhpStorm.
 * User: xuantung
 * Date: 10/3/18
 * Time: 10:47 AM
 */

namespace SM\PWAKeyword\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->addPWAKeywordTable($setup);
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param OutputInterface      $output
     *
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup, OutputInterface $output)
    {
        $output->writeln('  |__ Create PWA banner table');
        $this->addPWAKeywordTable($setup);
    }

    /**
     * @param SchemaSetupInterface $setup
     *
     * @throws \Zend_Db_Exception
     */
    protected function addPWAKeywordTable(SchemaSetupInterface $setup)
    {
        $setup->startSetup();

        if ($setup->getConnection()->isTableExists($setup->getTable('sm_pwa_keyword'))) {
            $setup->endSetup();

            return;
        }

        $table = $setup->getConnection()->newTable(
            $setup->getTable('sm_pwa_keyword')
        )->addColumn(
            'keyword_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true,],
            'Keyword ID'
        )->addColumn(
            'text',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true, 'unsigned' => true,],
            'Text'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT,],
            'Creation Time'
        )->addColumn(
            'updated_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE,],
            'Modification Time'
        )->addColumn(
            'store',
            Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Store Ids'
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
