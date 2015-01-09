<?php

namespace TS\WSBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use TS\WSBundle\Model\Ws;
use TS\WSBundle\Model\WsPeer;
use TS\WSBundle\Model\WsQuery;

/**
 * @method WsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method WsQuery orderByTelefono($order = Criteria::ASC) Order by the telefono column
 * @method WsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method WsQuery orderByMarca($order = Criteria::ASC) Order by the marca column
 * @method WsQuery orderByModelo($order = Criteria::ASC) Order by the modelo column
 *
 * @method WsQuery groupById() Group by the id column
 * @method WsQuery groupByTelefono() Group by the telefono column
 * @method WsQuery groupByStatus() Group by the status column
 * @method WsQuery groupByMarca() Group by the marca column
 * @method WsQuery groupByModelo() Group by the modelo column
 *
 * @method WsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method WsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method WsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Ws findOne(PropelPDO $con = null) Return the first Ws matching the query
 * @method Ws findOneOrCreate(PropelPDO $con = null) Return the first Ws matching the query, or a new Ws object populated from the query conditions when no match is found
 *
 * @method Ws findOneByTelefono(string $telefono) Return the first Ws filtered by the telefono column
 * @method Ws findOneByStatus(string $status) Return the first Ws filtered by the status column
 * @method Ws findOneByMarca(string $marca) Return the first Ws filtered by the marca column
 * @method Ws findOneByModelo(string $modelo) Return the first Ws filtered by the modelo column
 *
 * @method array findById(int $id) Return Ws objects filtered by the id column
 * @method array findByTelefono(string $telefono) Return Ws objects filtered by the telefono column
 * @method array findByStatus(string $status) Return Ws objects filtered by the status column
 * @method array findByMarca(string $marca) Return Ws objects filtered by the marca column
 * @method array findByModelo(string $modelo) Return Ws objects filtered by the modelo column
 */
abstract class BaseWsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseWsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'TS\\WSBundle\\Model\\Ws';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new WsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   WsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return WsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof WsQuery) {
            return $criteria;
        }
        $query = new WsQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Ws|Ws[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(WsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Ws A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Ws A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `telefono`, `status`, `marca`, `modelo` FROM `WS` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Ws();
            $obj->hydrate($row);
            WsPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Ws|Ws[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Ws[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WsPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the telefono column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefono('fooValue');   // WHERE telefono = 'fooValue'
     * $query->filterByTelefono('%fooValue%'); // WHERE telefono LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefono The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function filterByTelefono($telefono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefono)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefono)) {
                $telefono = str_replace('*', '%', $telefono);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WsPeer::TELEFONO, $telefono, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WsPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the marca column
     *
     * Example usage:
     * <code>
     * $query->filterByMarca('fooValue');   // WHERE marca = 'fooValue'
     * $query->filterByMarca('%fooValue%'); // WHERE marca LIKE '%fooValue%'
     * </code>
     *
     * @param     string $marca The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function filterByMarca($marca = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($marca)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $marca)) {
                $marca = str_replace('*', '%', $marca);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WsPeer::MARCA, $marca, $comparison);
    }

    /**
     * Filter the query on the modelo column
     *
     * Example usage:
     * <code>
     * $query->filterByModelo('fooValue');   // WHERE modelo = 'fooValue'
     * $query->filterByModelo('%fooValue%'); // WHERE modelo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modelo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function filterByModelo($modelo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modelo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $modelo)) {
                $modelo = str_replace('*', '%', $modelo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WsPeer::MODELO, $modelo, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Ws $ws Object to remove from the list of results
     *
     * @return WsQuery The current query, for fluid interface
     */
    public function prune($ws = null)
    {
        if ($ws) {
            $this->addUsingAlias(WsPeer::ID, $ws->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
