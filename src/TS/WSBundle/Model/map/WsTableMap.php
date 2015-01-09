<?php

namespace TS\WSBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'WS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.TS.WSBundle.Model.map
 */
class WsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.TS.WSBundle.Model.map.WsTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('WS');
        $this->setPhpName('Ws');
        $this->setClassname('TS\\WSBundle\\Model\\Ws');
        $this->setPackage('src.TS.WSBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('telefono', 'Telefono', 'VARCHAR', false, 100, null);
        $this->getColumn('telefono', false)->setPrimaryString(true);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 100, null);
        $this->addColumn('marca', 'Marca', 'VARCHAR', false, 100, null);
        $this->addColumn('modelo', 'Modelo', 'VARCHAR', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // WsTableMap
