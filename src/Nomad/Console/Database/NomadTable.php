<?php

namespace Nomad\Console\Database;

use Closure;
use Phinx\Db\Adapter\AdapterInterface;
use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Db\Table;
use Phinx\Db\Table\Column;

class NomadTable extends Table {

	/**
	 * @var Column
	 */
	private $column;

	/**
	 * NomadTable constructor.
	 *
	 * @param string                $name
	 * @param Closure|null          $callback
	 * @param AdapterInterface|null $adapter
	 */
	public function __construct($name, Closure $callback = null,  AdapterInterface $adapter = null) {
		parent::__construct($name, [], $adapter);

		if ( !is_null($callback) ) {
			$callback($this);
		}
	}

	/**
	 * Set limit for column
	 *
	 * @param $limit
	 * @return $this
	 */
	public function limit($limit) {
		$this->getColumn()->setLimit($limit);

		return $this;
	}

	/**
	 * Put the current column after the passed column
	 *
	 * @param $column
	 * @return $this
	 */
	public function after($column) {
		$this->getColumn()->setAfter($column);

		return $this;
	}

	/**
	 * Set current column as an index
	 *
	 * @return $this
	 */
	public function index() {
		$this->addIndex($this->column->getName());

		return $this;
	}

	/**
	 * Make the column allow null
	 *
	 * @return $this
	 */
	public function nullable() {
		$this->getColumn()->setNull(true);

		return $this;
	}

	/**
	 * Set the default column value
	 *
	 * @param $default
	 * @return $this
	 */
	public function setDefault($default) {
		$this->getColumn()->setDefault($default);

		return $this;
	}

	/**
	 * Set a comment for the column
	 *
	 * @param $comment
	 * @return $this
	 */
	public function comment($comment) {
		$this->getColumn()->setComment($comment);

		return $this;
	}

	/**
	 * @param $column
	 * @return Table
	 */
	public function increments($column) {
		return $this->setOptions(['id' => $column]);
	}

	/**
	 * @param string $column
	 * @param bool   $unsigned
	 * @param bool   $autoIncrement
	 * @return Table
	 */
	public function integer($column, $unsigned = false, $autoIncrement = false) {
		$this->addColumn($column, 'integer', ['signed' => !$unsigned, 'identity' => $autoIncrement]);

		return $this;
	}

	/**
	 * @param            $column
	 * @param bool|false $unsigned
	 * @param bool|false $autoIncrement
	 * @return $this
	 */
	public function tinyInteger($column, $unsigned = false, $autoIncrement = false) {
		$this->addColumn($column, 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => !$unsigned, 'identity' => $autoIncrement]);

		return $this;
	}

	/**
	 * @param            $column
	 * @param bool|false $unsigned
	 * @param bool|false $autoIncrement
	 * @return $this
	 */
	public function smallInteger($column, $unsigned = false, $autoIncrement = false) {
		$this->addColumn($column, 'integer', ['limit' => MysqlAdapter::INT_SMALL, 'signed' => !$unsigned, 'identity' => $autoIncrement]);

		return $this;
	}

	/**
	 * @param            $column
	 * @param bool|false $unsigned
	 * @param bool|false $autoIncrement
	 * @return $this
	 */
	public function mediumInteger($column, $unsigned = false, $autoIncrement = false) {
		$this->addColumn($column, 'integer', ['limit' => MysqlAdapter::INT_MEDIUM, 'signed' => !$unsigned, 'identity' => $autoIncrement]);

		return $this;
	}

	/**
	 * @param            $column
	 * @param bool|false $unsigned
	 * @param bool|false $autoIncrement
	 * @return $this
	 */
	public function bigInteger($column, $unsigned = false, $autoIncrement = false) {
		$this->addColumn($column, 'biginteger', ['signed' => !$unsigned, 'identity' => $autoIncrement]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function binary($column) {
		$this->addColumn($column, 'binary');

		return $this;
	}

	/**
	 * @param            $column
	 * @param bool|false $unsigned
	 * @return $this
	 */
	public function boolean($column, $unsigned = false) {
		$this->addColumn($column, 'boolean', ['signed' => !$unsigned]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function date($column) {
		$this->addColumn($column, 'date');

		return $this;
	}

	/**
	 * @param            $column
	 * @param            $precision
	 * @param            $scale
	 * @param bool|false $unsigned
	 * @return $this
	 */
	public function decimal($column, $precision, $scale, $unsigned = false) {
		$this->addColumn($column, 'decimal', ['precision' => $precision, 'scale' => $scale, 'signed' => !$unsigned]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function float($column) {
		$this->addColumn($column, 'float');

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function text($column) {
		$this->addColumn($column, 'text');

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function tinyText($column) {
		$this->addColumn($column, 'text', ['limit' => MysqlAdapter::TEXT_TINY]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function mediumText($column) {
		$this->addColumn($column, 'text', ['limit' => MysqlAdapter::TEXT_MEDIUM]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function longText($column) {
		$this->addColumn($column, 'text', ['limit' => MysqlAdapter::TEXT_LONG]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function blob($column) {
		$this->addColumn($column, 'blob');

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function tinyBlob($column) {
		$this->addColumn($column, 'blob', ['limit' => MysqlAdapter::BLOB_TINY]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function mediumBlob($column) {
		$this->addColumn($column, 'blob', ['limit' => MysqlAdapter::BLOB_MEDIUM]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function longBlob($column) {
		$this->addColumn($column, 'blob', ['limit' => MysqlAdapter::BLOB_LONG]);

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function time($column) {
		$this->addColumn($column, 'time');

		return $this;
	}

	/**
	 * @param string  $column
	 * @param int     $length
	 * @return Table
	 */
	public function string($column, $length = 255) {
		$this->addColumn($column, 'string', compact('length'));

		return $this;
	}

	/**
	 * @param string $column
	 * @param array  $options
	 * @return Table
	 */
	public function timestamp($column, $options = []) {
		$this->addColumn($column, 'timestamp', $options);

		return $this;
	}

	/**
	 * @param string $column
	 * @return Table
	 */
	public function datetime($column) {
		$this->addColumn($column, 'datetime');

		return $this;
	}

	/**
	 * Add the default vault columns
	 */
	public function vaultStandardColumns() {
		$this->integer('active')->limit(1)->setDefault('1')->nullable();

		$this->datetime('create_date')->setDefault(NULL)->nullable();

		$this->integer('create_by')->setDefault(NULL)->nullable();

		$this->datetime('modify_date')->setDefault(NULL)->nullable();

		$this->integer('modify_by')->setDefault(NULL)->nullable();
	}

	/**
	 * @param Column|string $columnName
	 * @param null          $type
	 * @param array         $options
	 * @return $this
	 */
	public function addColumn($columnName, $type = null, $options = array()) {
		$this->column = new Column();
		$this->column->setName($columnName);
		$this->column->setType($type);
		$this->column->setOptions($options);

		parent::addColumn($columnName, $type, $options);

		return $this;
	}

	/**
	 * @return Column
	 */
	private function getColumn() {
		$pending = $this->getPendingColumns();
		foreach ( $pending as $key => $col ) {
			if ( $col->getName() == $this->column->getName() ) {
				return $col;
			}
		}
	}
}