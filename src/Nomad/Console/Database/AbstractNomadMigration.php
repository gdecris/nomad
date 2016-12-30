<?php

namespace Nomad\Console\Database;

use Closure;
use PDO;
use Phinx\Migration\AbstractMigration;

abstract class AbstractNomadMigration extends AbstractMigration {

	/**
	 * @var \PDOStatement
	 */
	private $query;

	/**
	 * @var mixed
	 */
	private $result;

	/**
	 * @param string  $tableName
	 * @param Closure $callback
     */
	public function create($tableName, Closure $callback) {
		if ( $callback instanceof Closure ) {
			$builder = $this->buildTable($tableName, $callback);

			$builder->create();
		}
	}

	/**
	 * @param string  $tableName
	 * @param Closure $callback
     */
	public function update($tableName, Closure $callback) {
		if ( $callback instanceof Closure ) {
			$builder = $this->buildTable($tableName, $callback);

			$builder->update();
		}
	}

	/**
	 * @param string       $tableName
	 * @param Closure|null $callback
	 * @return NomadTable
     */
	public function buildTable($tableName, Closure $callback = null) {
		return new NomadTable($tableName, $callback, $this->getAdapter());
	}

	/**
	 * {@inheritdoc}
	 */
	public function query($sql)
	{
		$this->query = $this->getAdapter()->query($sql);

		$this->getQueryResult();

		return $this;
	}

	/**
	 *  Gets the results from the query and assigns it to result property
     */
	private function getQueryResult()
	{
		$this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Get one column from the results
	 *
	 * @param $name
	 * @return $this
     */
	public function column($name)
	{
		$this->result = array_column($this->result, $name);

		return $this;
	}

	/**
	 * Return all results
	 *
	 * @return mixed
     */
	public function get()
	{
		return $this->result;
	}

	/**
	 * Return the first result
	 *
	 * @return mixed
     */
	public function first()
	{
		return array_shift($this->result);
	}
}