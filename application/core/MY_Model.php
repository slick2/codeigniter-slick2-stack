<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Extended Model Class
 *
 * Provides a number of useful functions to generate model specific queries.
 * Takes inspiration from CakePHP's implementation of Model and keeps the function
 * names pretty same.
 *
 * A list of functions would be:
 *
 * - loadTable
 * - find
 * - findAll
 * - findCount
 * - field
 * - generateList
 * - generateSingleArray
 * - getAffectedRows
 * - getID
 * - getInsertID
 * - getNumRows
 * - insert
 * - read
 * - save
 * - remove
 * - query
 * - lastQuery
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Md Emran Hasan (phpfour@gmail.com)
 * @link		http://phpfour.com
 */
class MY_Model extends CI_Model {

	/**
	 * Value of the primary key ID of the record that this model is currently pointing to
	 *
	 * @var unknown_type
	 * @access public
	 */
	var $id = null;

	/**
	 * Container for the data that this model gets from persistent storage (the database).
	 *
	 * @var array
	 * @access public
	 */
	var $data = array();

	/**
	 * The name of the associate table name of the Model object
	 * @var string
	 * @access public
	 */
	var $_table;

	/**
	 * The name of the ID field for this Model.
	 *
	 * @var string
	 * @access public
	 */
	var $primaryKey = 'id';

	/**
	 * Container for the fields of the table that this model gets from persistent storage (the database).
	 *
	 * @var array
	 * @access public
	 */
	var $fields = array();

	/**
	 * The last inserted ID of the data that this model created
	 *
	 * @var int
	 * @access private
	 */
	var $__insertID = null;

	/**
	 * The number of records returned by the last query
	 *
	 * @access private
	 * @var int
	 */
	var $__numRows = null;

	/**
	 * The number of records affected by the last query
	 *
	 * @access private
	 * @var int
	 */
	var $__affectedRows = null;

	/**
	 * Tells the model whether to return results in array or not
	 *
	 * @var string
	 * @access public
	 */
	var $returnArray = TRUE;

	/**
	 * Prints helpful debug messages if asked
	 *
	 * @var string
	 * @access public
	 */
	var $debug = FALSE;

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function Model()
	{
		parent::Model();
		log_message('debug', "Extended Model Class Initialized");
	}

	/**
	 * Load the associated database table.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @access public
	 */
	function loadTable($table, $fields = array())
	{
		if ($this->debug)
			log_message('debug', "Loading model table: $table");

		if (!isset($this->db))
		{
			$this->setDb('default');
		}

		$this->_table = $table;
		$this->fields = (!empty($fields)) ? $fields : $this->db->list_fields($table);

		if ($this->debug)
		{
			log_message('debug', "Successfully Loaded model table: $table");
		}
	}

	function setDb($db)
	{
		try
		{
			$this->db = $this->load->database($db, true);
			return true;
		}
		catch (Exception $e)
		{
			if ($this->debug)
				log_message('debug', "Error setting db: $db. " . $e->getMessage());
			return false;
		}
	}

	/**
	 * Returns a resultset array with specified fields from database matching given conditions.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return query result either in array or in object based on model config
	 * @access public
	 */
	function findAll($conditions = NULL, $fields = '*', $order = NULL, $start = 0, $limit = NULL)
	{
		if ($conditions != NULL)
		{
			if (is_array($conditions))
			{
				$this->db->where($conditions);
			}
			else
			{
				$this->db->where($conditions, NULL, FALSE);
			}
		}

		if ($fields != NULL)
		{
			$this->db->select($fields);
		}

		if ($order != NULL)
		{
			$this->db->order_by($order);
		}

		if ($limit != NULL)
		{
			$this->db->limit($limit, $start);
		}

		$query = $this->db->get($this->_table);
		$this->__numRows = $query->num_rows();
//print_r($this->db->last_query());
//print_r($query->result());
		return ($this->returnArray) ? $query->result_array() : $query->result();
	}

	/**
	 * Return a single row as a resultset array with specified fields from database matching given conditions.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return single row either in array or in object based on model config
	 * @access public
	 */
	function find($conditions = NULL, $fields = '*', $order = NULL)
	{
		$data = $this->findAll($conditions, $fields, $order, 0, 1);

		if ($data)
		{
			return $data[0];
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns contents of a field in a query matching given conditions.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return string the value of the field specified of the first row
	 * @access public
	 */
	function field($conditions = null, $name, $fields = '*', $order = NULL)
	{
		$data = $this->findAll($conditions, $fields, $order, 0, 1);

		if ($data)
		{
			$row = $data[0];

			if (isset($row[$name]))
			{
				return $row[$name];
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns number of rows matching given SQL condition.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return integer the number of records returned by the condition
	 * @access public
	 */
	function findCount($conditions = null)
	{
		$data = $this->findAll($conditions, 'COUNT(*) AS count', null, 0, 1);

		if ($data)
		{
			return $data[0]['count'];
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns a key value pair array from database matching given conditions.
	 *
	 * Example use: generateList(null, '', 0. 10, 'id', 'username');
	 * Returns: array('10' => 'emran', '11' => 'hasan')
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return array a list of key val ue pairs given criteria
	 * @access public
	 */
	function generateList($conditions = null, $order = 'id ASC', $start = 0, $limit = NULL, $key = null, $value = null)
	{
		$data = $this->findAll($conditions, "$key, $value", $order, $start, $limit);

		if ($data)
		{
			foreach ($data as $row)
			{
				$keys[] = ($this->returnArray) ? $row[$key] : $row->$key;
				$vals[] = ($this->returnArray) ? $row[$value] : $row->$value;
			}

			if (!empty($keys) && !empty($vals))
			{
				$return = array_combine($keys, $vals);
				return $return;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns an array of the values of a specific column from database matching given conditions.
	 *
	 * Example use: generateSingleArray(null, 'name');
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return array a list of key value pairs given criteria
	 * @access public
	 */
	function generateSingleArray($conditions = null, $field = null, $order = 'id ASC', $start = 0, $limit = NULL)
	{
		$data = $this->findAll($conditions, "$field", $order, $start, $limit);

		if ($data)
		{
			foreach ($data as $row)
			{
				$arr[] = ($this->returnArray) ? $row[$field] : $row->$field;
			}

			return $arr;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Initializes the model for writing a new record.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return boolean True
	 * @access public
	 */
	function create()
	{
		$this->id = false;
		unset($this->data);

		$this->data = array();
		return true;
	}

	/**
	 * Returns a list of fields from the database and saves in the model
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return array Array of database fields
	 * @access public
	 */
	function read($id = null, $fields = null)
	{
		if ($id != null)
		{
			$this->id = $id;
		}

		$id = $this->id;

		if ($this->id !== null && $this->id !== false)
		{
			$this->data = $this->find($this->primaryKey . ' = ' . $id, $fields);
			return $this->data;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Inserts a new record in the database.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return boolean success
	 * @access public
	 */
	function insert($data = null)
	{
		if ($data == null)
		{
			return FALSE;
		}

		$this->data = $data;
		$this->data['create_date'] = date("Y-m-d H:i:s");

		foreach ($this->data as $key => $value)
		{
			if (array_search($key, $this->fields) === FALSE)
			{
				unset($this->data[$key]);
			}
		}

		$this->db->insert($this->_table, $this->data);

		$this->__insertID = $this->db->insert_id();
		return $this->__insertID;
	}

	/**
	 * Saves model data to the database.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return boolean success
	 * @access public
	 */
	function save($data = null, $id = null)
	{
		if ($data)
		{
			$this->data = $data;
		}

		foreach ($this->data as $key => $value)
		{
			if (array_search($key, $this->fields) === FALSE)
			{
				unset($this->data[$key]);
			}
		}

		if ($id != null)
		{
			$this->id = $id;
		}

		$id = $this->id;

		if ($this->id !== null && $this->id !== false)
		{
			$this->db->where($this->primaryKey, $id);
			$this->db->update($this->_table, $this->data);

			$this->__affectedRows = $this->db->affected_rows();
			return $this->id;
		}
		else
		{
			$this->db->insert($this->_table, $this->data);

			$this->__insertID = $this->db->insert_id();
			return $this->__insertID;
		}
	}

	/**
	 * Removes record for given id. If no id is given, the current id is used. Returns true on success.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return boolean True on success
	 * @access public
	 */
	function remove($id = null)
	{
		if ($id != null)
		{
			$this->id = $id;
		}

		$id = $this->id;

		if ($this->id !== null && $this->id !== false)
		{
			if ($this->db->delete($this->_table, array($this->primaryKey => $id)))
			{
				$this->id = null;
				$this->data = array();

				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns a resultset for given SQL statement. Generic SQL queries should be made with this method.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return array Resultset
	 * @access public
	 */
	function query($sql)
	{
		return $this->db->query($sql);
	}

	/**
	 * Returns the last query that was run (the query string, not the result).
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return string SQL statement
	 * @access public
	 */
	function lastQuery()
	{
		return $this->db->last_query();
	}

	/**
	 * This function simplifies the process of writing database inserts. It returns a correctly formatted SQL insert string.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return string SQL statement
	 * @access public
	 */
	function insertString($data)
	{
		return $this->db->insert_string($this->_table, $data);
	}

	/**
	 * Returns the current record's ID.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return integer The ID of the current record
	 * @access public
	 */
	function getID()
	{
		return $this->id;
	}

	/**
	 * Returns the ID of the last record this Model inserted.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return int
	 * @access public
	 */
	function getInsertID()
	{
		return $this->__insertID;
	}

	/**
	 * Returns the number of rows returned from the last query.
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return int
	 * @access public
	 */
	function getNumRows()
	{
		return $this->__numRows;
	}

	/**
	 * Returns the number of rows affected by the last query
	 *
	 * @author md emran hasan <emran@rightbrainsolution.com>
	 * @return int
	 * @access public
	 */
	function getAffectedRows()
	{
		return $this->__affectedRows;
	}

	/*	 * * Added Methods ** */

	function allFields($modelName = null, $alias = null)
	{
		if (empty($modelName))
			$modelName = $this->_table;
		$f = array();
		foreach ($this->fields as $field)
		{
			if ($alias)
			{
				$str = "`{$alias}`.`{$field}` as `{$alias}.{$field}`";
			}
			else
			{
				$str = "`{$modelName}`.`{$field}` as `{$modelName}.{$field}`";
			}

			$f[] = $str;
		}

		return join(", ", $f);
	}

	function load_model($model_name)
	{
		if (empty($model_name))
			return false;
		$CI = & get_instance();
		$CI->load->model($model_name);
		return $CI->$model_name;
	}

	function fielder($fields)
	{
		$flds = explode(",", $fields);
		$b = array();
		foreach ($flds as $fld)
		{
			$f = trim($fld);
			$f1 = str_replace('.', "`.`", $f);
			$b[] = "`$f1` as `$f`";
		}
		return join(", ", $b);
	}

	function getFields($models = array())
	{
		if (empty($models))
			return false;
		$flds = array();
		foreach ($models as $model)
		{
			$model_ = $model . '_modelobject';
			if (!isset($this->{$model_}))
				$this->{$model_} = $this->load_model($model);
			$flds[] = $this->{$model_}->allFields($model);
		}
		return join(", ", $flds);
	}

	function getAllWithJoinsTotal($modelName, $joins = array(), $where = " 1 = 1 ")
	{
		return $this->getAllWithJoins($modelName, $joins, $where, "TOTALCOUNT");
	}

	function getAllWithJoinsLatest($fieldKey, $modelName, $joins = array(), $where = " 1 = 1 ")
	{
		$data = $this->getAllWithJoins($modelName, $joins, $where, $fieldKey, "{$fieldKey} desc", 0, 1);

		if (!$data)
			return false;

		$key = explode(".", $fieldKey);
		$key = $key[1];
		return $data[0][$key];
	}

	function getAllWithJoins($modelName, $joins = array(), $where = " 1 = 1 ", $fields = "*", $order = null, $page = 0, $limit = 100, $offset = null, $having = null)
	{
		if ($order == null)
		{
			$order = "{$modelName}.id asc";
		}

		if ($offset === null)
		{
			if ($page < 1)
			{
				$offset = $page;
			}
			else
			{
				$offset = (($page - 1 ) * $limit);
			}
		}

		$modelPointer = array();
		if (!empty($joins))
		{
			if (isset($joins['group']))
			{
				$this->db->group_by($joins['group']);
				unset($joins['group']);
			}

			foreach ($joins as $key => $join)
			{
				$m = explode("as", $join[0]);
				$modelAlias = $model = trim($m[1]);
				$table = trim($m[0]);

				if (strpos($model, '_model') === false)
				{
					$model = $table . '_model';
				}

				$model_ = $model . '_modelobject';
				if (!isset($this->{$model_}))
				{
					$this->{$model_} = $this->load_model($model);
				}
				$modelPointer[$model] = array($model_, $modelAlias);
			}
		}
		$from = "{$this->_table} as {$modelName}";

		$this->db
			  ->from($from)
			  ->where($where, null, false);

		$totalCount = false;

		if ($fields == "TOTALCOUNT")
		{
			$fields = "count(*) as total";
			$totalCount = true;
		}
		else
		{
			$this->db->order_by($order);
		}

		if ($limit !== null || ($limit * 1) > 0)
		{
			$this->db->limit($limit, $offset);
		}

		if ($having !== null)
		{
			$this->db->having($having);
		}

		$f = array();
		if ($fields == '*' || $fields == null)
		{
			$f[] = $this->allFields($modelName);
			if (!empty($modelPointer))
			{
				foreach ($modelPointer as $model_name => $modelObjName)
				{
					$f[] = $this->{$modelObjName[0]}->allFields($model_name, $modelObjName[1]);
				}
			}

			$fields = join(", ", $f);
		}

		if (!empty($joins))
		{
			foreach ($joins as $join)
			{
				$j = (isset($join[2])) ? $join[2] : "left";
				$this->db->join($join[0], $join[1], $j);
			}
		}

		$q = $this->db->select($fields, false)->get();
		if (is_object($q))
		{
			$data = $q->result_array();
		}
		else
		{
			return false;
		}
		/*
		  $this->db->select();
		  echo $SQL = $this->db->get_compiled_select();
		  $data = $this->db->query($SQL)->result_array();

		 */

		if (count($data) < 1)
			return false;

		if ($totalCount)
			return (int) $data[0]['total'];

		return $data;
	}

	function getCountFromSQL($lsql, $field = null)
	{

		if (strpos($lsql, "from"))
		{
			$lsql = str_replace('from', 'FROM', $lsql);
		}

		if (strpos($lsql, "order by"))
		{
			$lsql = str_replace('order by', 'ORDER BY', $lsql);
		}

		$sql = explode("FROM", $lsql);

		if (!$field)
		{
			$nsql = "SELECT * FROM " . $sql[1];
		}
		else
		{
			$nsql = "SELECT {$field} FROM " . $sql[1];
		}

		$nsql = explode("ORDER BY", $nsql);
		$nsql = $nsql[0];

		$cSQL = "
			SELECT count(*) as total from ({$nsql}) as sqlcount
		";

		$result = $this->query($cSQL);
		if (!$result)
			return false;

		$total = $result->result_array();

		return $total[0]['total'];
	}

	function getCountFromLastQuery($field = null)
	{
		$lsql = $this->lastQuery();

		return $this->getCountFromSQL($lsql, $field);
	}

	function fixDate($mmddyyyy)
	{
		if (empty($mmddyyyy))
			return null;
		$date = split("/", trim($mmddyyyy));
		return "{$date[2]}-{$date[0]}-{$date[1]}";
	}

	function getConst($className, $pre = '')
	{
		$refl = new ReflectionClass($className);
		$cons = $refl->getConstants();
		if (empty($pre))
			return $cons;

		$arr = array();
		$prelen = strlen($pre);
		foreach ($cons as $k => $v)
		{
			if (strpos($k, $pre) === 0)
			{
				$arr[$k] = $v;
			}
		}

		return $arr;
	}

	function makePrefixAsKeyData($row, $removePre = true)
	{
		$data = [];
		foreach ($row as $k => $d)
		{
			$kk = explode("_", $k);
			$pre = $kk[0];
			if ($removePre)
			{
				unset($kk[0]);
				$k = join("_", $kk);
			}

			$data[$pre][$k] = $d;
		}

		return $data;
	}

}

// END Model Class