<?php
namespace PHPMaker2019\project1;

/**
 * Table class for contaco
 */
class contaco extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $correo;
	public $direccion;
	public $tel1;
	public $tel2;
	public $tel3;
	public $tel4;
	public $tel5;
	public $horario;
	public $img_bcp;
	public $t_bcp1;
	public $t_bcp2;
	public $t_bcp3;
	public $img_bbva;
	public $t_bbva_1;
	public $t_bbva_2;
	public $t_bbva_3;
	public $fa;
	public $tw;
	public $in;
	public $go;
	public $you;
	public $correo_formulario;
	public $keywords;
	public $description;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'contaco';
		$this->TableName = 'contaco';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`contaco`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('contaco', 'contaco', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// correo
		$this->correo = new DbField('contaco', 'contaco', 'x_correo', 'correo', '`correo`', '`correo`', 200, -1, FALSE, '`correo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->correo->Sortable = TRUE; // Allow sort
		$this->fields['correo'] = &$this->correo;

		// direccion
		$this->direccion = new DbField('contaco', 'contaco', 'x_direccion', 'direccion', '`direccion`', '`direccion`', 200, -1, FALSE, '`direccion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->direccion->Sortable = TRUE; // Allow sort
		$this->fields['direccion'] = &$this->direccion;

		// tel1
		$this->tel1 = new DbField('contaco', 'contaco', 'x_tel1', 'tel1', '`tel1`', '`tel1`', 200, -1, FALSE, '`tel1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tel1->Sortable = TRUE; // Allow sort
		$this->fields['tel1'] = &$this->tel1;

		// tel2
		$this->tel2 = new DbField('contaco', 'contaco', 'x_tel2', 'tel2', '`tel2`', '`tel2`', 200, -1, FALSE, '`tel2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tel2->Sortable = TRUE; // Allow sort
		$this->fields['tel2'] = &$this->tel2;

		// tel3
		$this->tel3 = new DbField('contaco', 'contaco', 'x_tel3', 'tel3', '`tel3`', '`tel3`', 200, -1, FALSE, '`tel3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tel3->Sortable = TRUE; // Allow sort
		$this->fields['tel3'] = &$this->tel3;

		// tel4
		$this->tel4 = new DbField('contaco', 'contaco', 'x_tel4', 'tel4', '`tel4`', '`tel4`', 200, -1, FALSE, '`tel4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tel4->Sortable = TRUE; // Allow sort
		$this->fields['tel4'] = &$this->tel4;

		// tel5
		$this->tel5 = new DbField('contaco', 'contaco', 'x_tel5', 'tel5', '`tel5`', '`tel5`', 200, -1, FALSE, '`tel5`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tel5->Sortable = TRUE; // Allow sort
		$this->fields['tel5'] = &$this->tel5;

		// horario
		$this->horario = new DbField('contaco', 'contaco', 'x_horario', 'horario', '`horario`', '`horario`', 200, -1, FALSE, '`horario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->horario->Sortable = TRUE; // Allow sort
		$this->fields['horario'] = &$this->horario;

		// img_bcp
		$this->img_bcp = new DbField('contaco', 'contaco', 'x_img_bcp', 'img_bcp', '`img_bcp`', '`img_bcp`', 200, -1, TRUE, '`img_bcp`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_bcp->Sortable = TRUE; // Allow sort
		$this->img_bcp->ImageResize = TRUE;
		$this->fields['img_bcp'] = &$this->img_bcp;

		// t_bcp1
		$this->t_bcp1 = new DbField('contaco', 'contaco', 'x_t_bcp1', 't_bcp1', '`t_bcp1`', '`t_bcp1`', 200, -1, FALSE, '`t_bcp1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->t_bcp1->Sortable = TRUE; // Allow sort
		$this->fields['t_bcp1'] = &$this->t_bcp1;

		// t_bcp2
		$this->t_bcp2 = new DbField('contaco', 'contaco', 'x_t_bcp2', 't_bcp2', '`t_bcp2`', '`t_bcp2`', 200, -1, FALSE, '`t_bcp2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->t_bcp2->Sortable = TRUE; // Allow sort
		$this->fields['t_bcp2'] = &$this->t_bcp2;

		// t_bcp3
		$this->t_bcp3 = new DbField('contaco', 'contaco', 'x_t_bcp3', 't_bcp3', '`t_bcp3`', '`t_bcp3`', 200, -1, FALSE, '`t_bcp3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->t_bcp3->Sortable = TRUE; // Allow sort
		$this->fields['t_bcp3'] = &$this->t_bcp3;

		// img_bbva
		$this->img_bbva = new DbField('contaco', 'contaco', 'x_img_bbva', 'img_bbva', '`img_bbva`', '`img_bbva`', 200, -1, TRUE, '`img_bbva`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->img_bbva->Sortable = TRUE; // Allow sort
		$this->fields['img_bbva'] = &$this->img_bbva;

		// t_bbva_1
		$this->t_bbva_1 = new DbField('contaco', 'contaco', 'x_t_bbva_1', 't_bbva_1', '`t_bbva_1`', '`t_bbva_1`', 200, -1, FALSE, '`t_bbva_1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->t_bbva_1->Sortable = TRUE; // Allow sort
		$this->fields['t_bbva_1'] = &$this->t_bbva_1;

		// t_bbva_2
		$this->t_bbva_2 = new DbField('contaco', 'contaco', 'x_t_bbva_2', 't_bbva_2', '`t_bbva_2`', '`t_bbva_2`', 200, -1, FALSE, '`t_bbva_2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->t_bbva_2->Sortable = TRUE; // Allow sort
		$this->fields['t_bbva_2'] = &$this->t_bbva_2;

		// t_bbva_3
		$this->t_bbva_3 = new DbField('contaco', 'contaco', 'x_t_bbva_3', 't_bbva_3', '`t_bbva_3`', '`t_bbva_3`', 200, -1, FALSE, '`t_bbva_3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->t_bbva_3->Sortable = TRUE; // Allow sort
		$this->fields['t_bbva_3'] = &$this->t_bbva_3;

		// fa
		$this->fa = new DbField('contaco', 'contaco', 'x_fa', 'fa', '`fa`', '`fa`', 200, -1, FALSE, '`fa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fa->Sortable = TRUE; // Allow sort
		$this->fields['fa'] = &$this->fa;

		// tw
		$this->tw = new DbField('contaco', 'contaco', 'x_tw', 'tw', '`tw`', '`tw`', 200, -1, FALSE, '`tw`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tw->Sortable = TRUE; // Allow sort
		$this->fields['tw'] = &$this->tw;

		// in
		$this->in = new DbField('contaco', 'contaco', 'x_in', 'in', '`in`', '`in`', 200, -1, FALSE, '`in`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->in->Sortable = TRUE; // Allow sort
		$this->fields['in'] = &$this->in;

		// go
		$this->go = new DbField('contaco', 'contaco', 'x_go', 'go', '`go`', '`go`', 200, -1, FALSE, '`go`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->go->Sortable = TRUE; // Allow sort
		$this->fields['go'] = &$this->go;

		// you
		$this->you = new DbField('contaco', 'contaco', 'x_you', 'you', '`you`', '`you`', 200, -1, FALSE, '`you`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->you->Sortable = TRUE; // Allow sort
		$this->fields['you'] = &$this->you;

		// correo_formulario
		$this->correo_formulario = new DbField('contaco', 'contaco', 'x_correo_formulario', 'correo_formulario', '`correo_formulario`', '`correo_formulario`', 200, -1, FALSE, '`correo_formulario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->correo_formulario->Sortable = TRUE; // Allow sort
		$this->fields['correo_formulario'] = &$this->correo_formulario;

		// keywords
		$this->keywords = new DbField('contaco', 'contaco', 'x_keywords', 'keywords', '`keywords`', '`keywords`', 201, -1, FALSE, '`keywords`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keywords->Sortable = TRUE; // Allow sort
		$this->fields['keywords'] = &$this->keywords;

		// description
		$this->description = new DbField('contaco', 'contaco', 'x_description', 'description', '`description`', '`description`', 201, -1, FALSE, '`description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->description->Sortable = TRUE; // Allow sort
		$this->fields['description'] = &$this->description;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`contaco`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->correo->DbValue = $row['correo'];
		$this->direccion->DbValue = $row['direccion'];
		$this->tel1->DbValue = $row['tel1'];
		$this->tel2->DbValue = $row['tel2'];
		$this->tel3->DbValue = $row['tel3'];
		$this->tel4->DbValue = $row['tel4'];
		$this->tel5->DbValue = $row['tel5'];
		$this->horario->DbValue = $row['horario'];
		$this->img_bcp->Upload->DbValue = $row['img_bcp'];
		$this->t_bcp1->DbValue = $row['t_bcp1'];
		$this->t_bcp2->DbValue = $row['t_bcp2'];
		$this->t_bcp3->DbValue = $row['t_bcp3'];
		$this->img_bbva->Upload->DbValue = $row['img_bbva'];
		$this->t_bbva_1->DbValue = $row['t_bbva_1'];
		$this->t_bbva_2->DbValue = $row['t_bbva_2'];
		$this->t_bbva_3->DbValue = $row['t_bbva_3'];
		$this->fa->DbValue = $row['fa'];
		$this->tw->DbValue = $row['tw'];
		$this->in->DbValue = $row['in'];
		$this->go->DbValue = $row['go'];
		$this->you->DbValue = $row['you'];
		$this->correo_formulario->DbValue = $row['correo_formulario'];
		$this->keywords->DbValue = $row['keywords'];
		$this->description->DbValue = $row['description'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['img_bcp']) ? [] : [$row['img_bcp']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->img_bcp->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->img_bcp->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['img_bbva']) ? [] : [$row['img_bbva']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->img_bbva->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->img_bbva->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('id', $row) ? $row['id'] : NULL) : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "contacolist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "contacoview.php")
			return $Language->phrase("View");
		elseif ($pageName == "contacoedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "contacoadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "contacolist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("contacoview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("contacoview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "contacoadd.php?" . $this->getUrlParm($parm);
		else
			$url = "contacoadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("contacoedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("contacoadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("contacodelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->correo->setDbValue($rs->fields('correo'));
		$this->direccion->setDbValue($rs->fields('direccion'));
		$this->tel1->setDbValue($rs->fields('tel1'));
		$this->tel2->setDbValue($rs->fields('tel2'));
		$this->tel3->setDbValue($rs->fields('tel3'));
		$this->tel4->setDbValue($rs->fields('tel4'));
		$this->tel5->setDbValue($rs->fields('tel5'));
		$this->horario->setDbValue($rs->fields('horario'));
		$this->img_bcp->Upload->DbValue = $rs->fields('img_bcp');
		$this->t_bcp1->setDbValue($rs->fields('t_bcp1'));
		$this->t_bcp2->setDbValue($rs->fields('t_bcp2'));
		$this->t_bcp3->setDbValue($rs->fields('t_bcp3'));
		$this->img_bbva->Upload->DbValue = $rs->fields('img_bbva');
		$this->t_bbva_1->setDbValue($rs->fields('t_bbva_1'));
		$this->t_bbva_2->setDbValue($rs->fields('t_bbva_2'));
		$this->t_bbva_3->setDbValue($rs->fields('t_bbva_3'));
		$this->fa->setDbValue($rs->fields('fa'));
		$this->tw->setDbValue($rs->fields('tw'));
		$this->in->setDbValue($rs->fields('in'));
		$this->go->setDbValue($rs->fields('go'));
		$this->you->setDbValue($rs->fields('you'));
		$this->correo_formulario->setDbValue($rs->fields('correo_formulario'));
		$this->keywords->setDbValue($rs->fields('keywords'));
		$this->description->setDbValue($rs->fields('description'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// correo
		// direccion
		// tel1
		// tel2
		// tel3
		// tel4
		// tel5
		// horario
		// img_bcp
		// t_bcp1
		// t_bcp2
		// t_bcp3
		// img_bbva
		// t_bbva_1
		// t_bbva_2
		// t_bbva_3
		// fa
		// tw
		// in
		// go
		// you
		// correo_formulario
		// keywords
		// description
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// correo
		$this->correo->ViewValue = $this->correo->CurrentValue;
		$this->correo->ViewCustomAttributes = "";

		// direccion
		$this->direccion->ViewValue = $this->direccion->CurrentValue;
		$this->direccion->ViewCustomAttributes = "";

		// tel1
		$this->tel1->ViewValue = $this->tel1->CurrentValue;
		$this->tel1->ViewCustomAttributes = "";

		// tel2
		$this->tel2->ViewValue = $this->tel2->CurrentValue;
		$this->tel2->ViewCustomAttributes = "";

		// tel3
		$this->tel3->ViewValue = $this->tel3->CurrentValue;
		$this->tel3->ViewCustomAttributes = "";

		// tel4
		$this->tel4->ViewValue = $this->tel4->CurrentValue;
		$this->tel4->ViewCustomAttributes = "";

		// tel5
		$this->tel5->ViewValue = $this->tel5->CurrentValue;
		$this->tel5->ViewCustomAttributes = "";

		// horario
		$this->horario->ViewValue = $this->horario->CurrentValue;
		$this->horario->ViewCustomAttributes = "";

		// img_bcp
		if (!EmptyValue($this->img_bcp->Upload->DbValue)) {
			$this->img_bcp->ImageWidth = 50;
			$this->img_bcp->ImageHeight = 30;
			$this->img_bcp->ImageAlt = $this->img_bcp->alt();
			$this->img_bcp->ViewValue = $this->img_bcp->Upload->DbValue;
		} else {
			$this->img_bcp->ViewValue = "";
		}
		$this->img_bcp->ViewCustomAttributes = "";

		// t_bcp1
		$this->t_bcp1->ViewValue = $this->t_bcp1->CurrentValue;
		$this->t_bcp1->ViewCustomAttributes = "";

		// t_bcp2
		$this->t_bcp2->ViewValue = $this->t_bcp2->CurrentValue;
		$this->t_bcp2->ViewCustomAttributes = "";

		// t_bcp3
		$this->t_bcp3->ViewValue = $this->t_bcp3->CurrentValue;
		$this->t_bcp3->ViewCustomAttributes = "";

		// img_bbva
		if (!EmptyValue($this->img_bbva->Upload->DbValue)) {
			$this->img_bbva->ImageWidth = 50;
			$this->img_bbva->ImageHeight = 40;
			$this->img_bbva->ImageAlt = $this->img_bbva->alt();
			$this->img_bbva->ViewValue = $this->img_bbva->Upload->DbValue;
		} else {
			$this->img_bbva->ViewValue = "";
		}
		$this->img_bbva->ViewCustomAttributes = "";

		// t_bbva_1
		$this->t_bbva_1->ViewValue = $this->t_bbva_1->CurrentValue;
		$this->t_bbva_1->ViewCustomAttributes = "";

		// t_bbva_2
		$this->t_bbva_2->ViewValue = $this->t_bbva_2->CurrentValue;
		$this->t_bbva_2->ViewCustomAttributes = "";

		// t_bbva_3
		$this->t_bbva_3->ViewValue = $this->t_bbva_3->CurrentValue;
		$this->t_bbva_3->ViewCustomAttributes = "";

		// fa
		$this->fa->ViewValue = $this->fa->CurrentValue;
		$this->fa->ViewCustomAttributes = "";

		// tw
		$this->tw->ViewValue = $this->tw->CurrentValue;
		$this->tw->ViewCustomAttributes = "";

		// in
		$this->in->ViewValue = $this->in->CurrentValue;
		$this->in->ViewCustomAttributes = "";

		// go
		$this->go->ViewValue = $this->go->CurrentValue;
		$this->go->ViewCustomAttributes = "";

		// you
		$this->you->ViewValue = $this->you->CurrentValue;
		$this->you->ViewCustomAttributes = "";

		// correo_formulario
		$this->correo_formulario->ViewValue = $this->correo_formulario->CurrentValue;
		$this->correo_formulario->ViewCustomAttributes = "";

		// keywords
		$this->keywords->ViewValue = $this->keywords->CurrentValue;
		$this->keywords->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// correo
		$this->correo->LinkCustomAttributes = "";
		$this->correo->HrefValue = "";
		$this->correo->TooltipValue = "";

		// direccion
		$this->direccion->LinkCustomAttributes = "";
		$this->direccion->HrefValue = "";
		$this->direccion->TooltipValue = "";

		// tel1
		$this->tel1->LinkCustomAttributes = "";
		$this->tel1->HrefValue = "";
		$this->tel1->TooltipValue = "";

		// tel2
		$this->tel2->LinkCustomAttributes = "";
		$this->tel2->HrefValue = "";
		$this->tel2->TooltipValue = "";

		// tel3
		$this->tel3->LinkCustomAttributes = "";
		$this->tel3->HrefValue = "";
		$this->tel3->TooltipValue = "";

		// tel4
		$this->tel4->LinkCustomAttributes = "";
		$this->tel4->HrefValue = "";
		$this->tel4->TooltipValue = "";

		// tel5
		$this->tel5->LinkCustomAttributes = "";
		$this->tel5->HrefValue = "";
		$this->tel5->TooltipValue = "";

		// horario
		$this->horario->LinkCustomAttributes = "";
		$this->horario->HrefValue = "";
		$this->horario->TooltipValue = "";

		// img_bcp
		$this->img_bcp->LinkCustomAttributes = "";
		if (!EmptyValue($this->img_bcp->Upload->DbValue)) {
			$this->img_bcp->HrefValue = GetFileUploadUrl($this->img_bcp, $this->img_bcp->Upload->DbValue); // Add prefix/suffix
			$this->img_bcp->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport()) $this->img_bcp->HrefValue = FullUrl($this->img_bcp->HrefValue, "href");
		} else {
			$this->img_bcp->HrefValue = "";
		}
		$this->img_bcp->ExportHrefValue = $this->img_bcp->UploadPath . $this->img_bcp->Upload->DbValue;
		$this->img_bcp->TooltipValue = "";
		if ($this->img_bcp->UseColorbox) {
			if (EmptyValue($this->img_bcp->TooltipValue))
				$this->img_bcp->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->img_bcp->LinkAttrs["data-rel"] = "contaco_x_img_bcp";
			AppendClass($this->img_bcp->LinkAttrs["class"], "ew-lightbox");
		}

		// t_bcp1
		$this->t_bcp1->LinkCustomAttributes = "";
		$this->t_bcp1->HrefValue = "";
		$this->t_bcp1->TooltipValue = "";

		// t_bcp2
		$this->t_bcp2->LinkCustomAttributes = "";
		$this->t_bcp2->HrefValue = "";
		$this->t_bcp2->TooltipValue = "";

		// t_bcp3
		$this->t_bcp3->LinkCustomAttributes = "";
		$this->t_bcp3->HrefValue = "";
		$this->t_bcp3->TooltipValue = "";

		// img_bbva
		$this->img_bbva->LinkCustomAttributes = "";
		if (!EmptyValue($this->img_bbva->Upload->DbValue)) {
			$this->img_bbva->HrefValue = GetFileUploadUrl($this->img_bbva, $this->img_bbva->Upload->DbValue); // Add prefix/suffix
			$this->img_bbva->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport()) $this->img_bbva->HrefValue = FullUrl($this->img_bbva->HrefValue, "href");
		} else {
			$this->img_bbva->HrefValue = "";
		}
		$this->img_bbva->ExportHrefValue = $this->img_bbva->UploadPath . $this->img_bbva->Upload->DbValue;
		$this->img_bbva->TooltipValue = "";
		if ($this->img_bbva->UseColorbox) {
			if (EmptyValue($this->img_bbva->TooltipValue))
				$this->img_bbva->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->img_bbva->LinkAttrs["data-rel"] = "contaco_x_img_bbva";
			AppendClass($this->img_bbva->LinkAttrs["class"], "ew-lightbox");
		}

		// t_bbva_1
		$this->t_bbva_1->LinkCustomAttributes = "";
		$this->t_bbva_1->HrefValue = "";
		$this->t_bbva_1->TooltipValue = "";

		// t_bbva_2
		$this->t_bbva_2->LinkCustomAttributes = "";
		$this->t_bbva_2->HrefValue = "";
		$this->t_bbva_2->TooltipValue = "";

		// t_bbva_3
		$this->t_bbva_3->LinkCustomAttributes = "";
		$this->t_bbva_3->HrefValue = "";
		$this->t_bbva_3->TooltipValue = "";

		// fa
		$this->fa->LinkCustomAttributes = "";
		$this->fa->HrefValue = "";
		$this->fa->TooltipValue = "";

		// tw
		$this->tw->LinkCustomAttributes = "";
		$this->tw->HrefValue = "";
		$this->tw->TooltipValue = "";

		// in
		$this->in->LinkCustomAttributes = "";
		$this->in->HrefValue = "";
		$this->in->TooltipValue = "";

		// go
		$this->go->LinkCustomAttributes = "";
		$this->go->HrefValue = "";
		$this->go->TooltipValue = "";

		// you
		$this->you->LinkCustomAttributes = "";
		$this->you->HrefValue = "";
		$this->you->TooltipValue = "";

		// correo_formulario
		$this->correo_formulario->LinkCustomAttributes = "";
		$this->correo_formulario->HrefValue = "";
		$this->correo_formulario->TooltipValue = "";

		// keywords
		$this->keywords->LinkCustomAttributes = "";
		$this->keywords->HrefValue = "";
		$this->keywords->TooltipValue = "";

		// description
		$this->description->LinkCustomAttributes = "";
		$this->description->HrefValue = "";
		$this->description->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// correo
		$this->correo->EditAttrs["class"] = "form-control";
		$this->correo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->correo->CurrentValue = HtmlDecode($this->correo->CurrentValue);
		$this->correo->EditValue = $this->correo->CurrentValue;
		$this->correo->PlaceHolder = RemoveHtml($this->correo->caption());

		// direccion
		$this->direccion->EditAttrs["class"] = "form-control";
		$this->direccion->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->direccion->CurrentValue = HtmlDecode($this->direccion->CurrentValue);
		$this->direccion->EditValue = $this->direccion->CurrentValue;
		$this->direccion->PlaceHolder = RemoveHtml($this->direccion->caption());

		// tel1
		$this->tel1->EditAttrs["class"] = "form-control";
		$this->tel1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tel1->CurrentValue = HtmlDecode($this->tel1->CurrentValue);
		$this->tel1->EditValue = $this->tel1->CurrentValue;
		$this->tel1->PlaceHolder = RemoveHtml($this->tel1->caption());

		// tel2
		$this->tel2->EditAttrs["class"] = "form-control";
		$this->tel2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tel2->CurrentValue = HtmlDecode($this->tel2->CurrentValue);
		$this->tel2->EditValue = $this->tel2->CurrentValue;
		$this->tel2->PlaceHolder = RemoveHtml($this->tel2->caption());

		// tel3
		$this->tel3->EditAttrs["class"] = "form-control";
		$this->tel3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tel3->CurrentValue = HtmlDecode($this->tel3->CurrentValue);
		$this->tel3->EditValue = $this->tel3->CurrentValue;
		$this->tel3->PlaceHolder = RemoveHtml($this->tel3->caption());

		// tel4
		$this->tel4->EditAttrs["class"] = "form-control";
		$this->tel4->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tel4->CurrentValue = HtmlDecode($this->tel4->CurrentValue);
		$this->tel4->EditValue = $this->tel4->CurrentValue;
		$this->tel4->PlaceHolder = RemoveHtml($this->tel4->caption());

		// tel5
		$this->tel5->EditAttrs["class"] = "form-control";
		$this->tel5->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tel5->CurrentValue = HtmlDecode($this->tel5->CurrentValue);
		$this->tel5->EditValue = $this->tel5->CurrentValue;
		$this->tel5->PlaceHolder = RemoveHtml($this->tel5->caption());

		// horario
		$this->horario->EditAttrs["class"] = "form-control";
		$this->horario->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->horario->CurrentValue = HtmlDecode($this->horario->CurrentValue);
		$this->horario->EditValue = $this->horario->CurrentValue;
		$this->horario->PlaceHolder = RemoveHtml($this->horario->caption());

		// img_bcp
		$this->img_bcp->EditAttrs["class"] = "form-control";
		$this->img_bcp->EditCustomAttributes = "";
		if (!EmptyValue($this->img_bcp->Upload->DbValue)) {
			$this->img_bcp->ImageWidth = 50;
			$this->img_bcp->ImageHeight = 30;
			$this->img_bcp->ImageAlt = $this->img_bcp->alt();
			$this->img_bcp->EditValue = $this->img_bcp->Upload->DbValue;
		} else {
			$this->img_bcp->EditValue = "";
		}
		if (!EmptyValue($this->img_bcp->CurrentValue))
				$this->img_bcp->Upload->FileName = $this->img_bcp->CurrentValue;

		// t_bcp1
		$this->t_bcp1->EditAttrs["class"] = "form-control";
		$this->t_bcp1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->t_bcp1->CurrentValue = HtmlDecode($this->t_bcp1->CurrentValue);
		$this->t_bcp1->EditValue = $this->t_bcp1->CurrentValue;
		$this->t_bcp1->PlaceHolder = RemoveHtml($this->t_bcp1->caption());

		// t_bcp2
		$this->t_bcp2->EditAttrs["class"] = "form-control";
		$this->t_bcp2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->t_bcp2->CurrentValue = HtmlDecode($this->t_bcp2->CurrentValue);
		$this->t_bcp2->EditValue = $this->t_bcp2->CurrentValue;
		$this->t_bcp2->PlaceHolder = RemoveHtml($this->t_bcp2->caption());

		// t_bcp3
		$this->t_bcp3->EditAttrs["class"] = "form-control";
		$this->t_bcp3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->t_bcp3->CurrentValue = HtmlDecode($this->t_bcp3->CurrentValue);
		$this->t_bcp3->EditValue = $this->t_bcp3->CurrentValue;
		$this->t_bcp3->PlaceHolder = RemoveHtml($this->t_bcp3->caption());

		// img_bbva
		$this->img_bbva->EditAttrs["class"] = "form-control";
		$this->img_bbva->EditCustomAttributes = "";
		if (!EmptyValue($this->img_bbva->Upload->DbValue)) {
			$this->img_bbva->ImageWidth = 50;
			$this->img_bbva->ImageHeight = 40;
			$this->img_bbva->ImageAlt = $this->img_bbva->alt();
			$this->img_bbva->EditValue = $this->img_bbva->Upload->DbValue;
		} else {
			$this->img_bbva->EditValue = "";
		}
		if (!EmptyValue($this->img_bbva->CurrentValue))
				$this->img_bbva->Upload->FileName = $this->img_bbva->CurrentValue;

		// t_bbva_1
		$this->t_bbva_1->EditAttrs["class"] = "form-control";
		$this->t_bbva_1->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->t_bbva_1->CurrentValue = HtmlDecode($this->t_bbva_1->CurrentValue);
		$this->t_bbva_1->EditValue = $this->t_bbva_1->CurrentValue;
		$this->t_bbva_1->PlaceHolder = RemoveHtml($this->t_bbva_1->caption());

		// t_bbva_2
		$this->t_bbva_2->EditAttrs["class"] = "form-control";
		$this->t_bbva_2->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->t_bbva_2->CurrentValue = HtmlDecode($this->t_bbva_2->CurrentValue);
		$this->t_bbva_2->EditValue = $this->t_bbva_2->CurrentValue;
		$this->t_bbva_2->PlaceHolder = RemoveHtml($this->t_bbva_2->caption());

		// t_bbva_3
		$this->t_bbva_3->EditAttrs["class"] = "form-control";
		$this->t_bbva_3->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->t_bbva_3->CurrentValue = HtmlDecode($this->t_bbva_3->CurrentValue);
		$this->t_bbva_3->EditValue = $this->t_bbva_3->CurrentValue;
		$this->t_bbva_3->PlaceHolder = RemoveHtml($this->t_bbva_3->caption());

		// fa
		$this->fa->EditAttrs["class"] = "form-control";
		$this->fa->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->fa->CurrentValue = HtmlDecode($this->fa->CurrentValue);
		$this->fa->EditValue = $this->fa->CurrentValue;
		$this->fa->PlaceHolder = RemoveHtml($this->fa->caption());

		// tw
		$this->tw->EditAttrs["class"] = "form-control";
		$this->tw->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->tw->CurrentValue = HtmlDecode($this->tw->CurrentValue);
		$this->tw->EditValue = $this->tw->CurrentValue;
		$this->tw->PlaceHolder = RemoveHtml($this->tw->caption());

		// in
		$this->in->EditAttrs["class"] = "form-control";
		$this->in->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->in->CurrentValue = HtmlDecode($this->in->CurrentValue);
		$this->in->EditValue = $this->in->CurrentValue;
		$this->in->PlaceHolder = RemoveHtml($this->in->caption());

		// go
		$this->go->EditAttrs["class"] = "form-control";
		$this->go->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->go->CurrentValue = HtmlDecode($this->go->CurrentValue);
		$this->go->EditValue = $this->go->CurrentValue;
		$this->go->PlaceHolder = RemoveHtml($this->go->caption());

		// you
		$this->you->EditAttrs["class"] = "form-control";
		$this->you->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->you->CurrentValue = HtmlDecode($this->you->CurrentValue);
		$this->you->EditValue = $this->you->CurrentValue;
		$this->you->PlaceHolder = RemoveHtml($this->you->caption());

		// correo_formulario
		$this->correo_formulario->EditAttrs["class"] = "form-control";
		$this->correo_formulario->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->correo_formulario->CurrentValue = HtmlDecode($this->correo_formulario->CurrentValue);
		$this->correo_formulario->EditValue = $this->correo_formulario->CurrentValue;
		$this->correo_formulario->PlaceHolder = RemoveHtml($this->correo_formulario->caption());

		// keywords
		$this->keywords->EditAttrs["class"] = "form-control";
		$this->keywords->EditCustomAttributes = "";
		$this->keywords->EditValue = $this->keywords->CurrentValue;
		$this->keywords->PlaceHolder = RemoveHtml($this->keywords->caption());

		// description
		$this->description->EditAttrs["class"] = "form-control";
		$this->description->EditCustomAttributes = "";
		$this->description->EditValue = $this->description->CurrentValue;
		$this->description->PlaceHolder = RemoveHtml($this->description->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->correo);
					$doc->exportCaption($this->direccion);
					$doc->exportCaption($this->tel1);
					$doc->exportCaption($this->tel2);
					$doc->exportCaption($this->tel3);
					$doc->exportCaption($this->tel4);
					$doc->exportCaption($this->tel5);
					$doc->exportCaption($this->horario);
					$doc->exportCaption($this->img_bcp);
					$doc->exportCaption($this->t_bcp1);
					$doc->exportCaption($this->t_bcp2);
					$doc->exportCaption($this->t_bcp3);
					$doc->exportCaption($this->img_bbva);
					$doc->exportCaption($this->t_bbva_1);
					$doc->exportCaption($this->t_bbva_2);
					$doc->exportCaption($this->t_bbva_3);
					$doc->exportCaption($this->fa);
					$doc->exportCaption($this->tw);
					$doc->exportCaption($this->in);
					$doc->exportCaption($this->go);
					$doc->exportCaption($this->you);
					$doc->exportCaption($this->correo_formulario);
					$doc->exportCaption($this->keywords);
					$doc->exportCaption($this->description);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->correo);
					$doc->exportCaption($this->direccion);
					$doc->exportCaption($this->tel1);
					$doc->exportCaption($this->tel2);
					$doc->exportCaption($this->tel3);
					$doc->exportCaption($this->tel4);
					$doc->exportCaption($this->tel5);
					$doc->exportCaption($this->horario);
					$doc->exportCaption($this->img_bcp);
					$doc->exportCaption($this->t_bcp1);
					$doc->exportCaption($this->t_bcp2);
					$doc->exportCaption($this->t_bcp3);
					$doc->exportCaption($this->img_bbva);
					$doc->exportCaption($this->t_bbva_1);
					$doc->exportCaption($this->t_bbva_2);
					$doc->exportCaption($this->t_bbva_3);
					$doc->exportCaption($this->fa);
					$doc->exportCaption($this->tw);
					$doc->exportCaption($this->in);
					$doc->exportCaption($this->go);
					$doc->exportCaption($this->you);
					$doc->exportCaption($this->correo_formulario);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->correo);
						$doc->exportField($this->direccion);
						$doc->exportField($this->tel1);
						$doc->exportField($this->tel2);
						$doc->exportField($this->tel3);
						$doc->exportField($this->tel4);
						$doc->exportField($this->tel5);
						$doc->exportField($this->horario);
						$doc->exportField($this->img_bcp);
						$doc->exportField($this->t_bcp1);
						$doc->exportField($this->t_bcp2);
						$doc->exportField($this->t_bcp3);
						$doc->exportField($this->img_bbva);
						$doc->exportField($this->t_bbva_1);
						$doc->exportField($this->t_bbva_2);
						$doc->exportField($this->t_bbva_3);
						$doc->exportField($this->fa);
						$doc->exportField($this->tw);
						$doc->exportField($this->in);
						$doc->exportField($this->go);
						$doc->exportField($this->you);
						$doc->exportField($this->correo_formulario);
						$doc->exportField($this->keywords);
						$doc->exportField($this->description);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->correo);
						$doc->exportField($this->direccion);
						$doc->exportField($this->tel1);
						$doc->exportField($this->tel2);
						$doc->exportField($this->tel3);
						$doc->exportField($this->tel4);
						$doc->exportField($this->tel5);
						$doc->exportField($this->horario);
						$doc->exportField($this->img_bcp);
						$doc->exportField($this->t_bcp1);
						$doc->exportField($this->t_bcp2);
						$doc->exportField($this->t_bcp3);
						$doc->exportField($this->img_bbva);
						$doc->exportField($this->t_bbva_1);
						$doc->exportField($this->t_bbva_2);
						$doc->exportField($this->t_bbva_3);
						$doc->exportField($this->fa);
						$doc->exportField($this->tw);
						$doc->exportField($this->in);
						$doc->exportField($this->go);
						$doc->exportField($this->you);
						$doc->exportField($this->correo_formulario);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					$validRequest = $Security->isLoggedIn(); // Logged in
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$validRequest = $Security->isLoggedIn(); // Logged in
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'img_bcp') {
			$fldName = "img_bcp";
			$fileNameFld = "img_bcp";
		} elseif ($fldparm == 'img_bbva') {
			$fldName = "img_bbva";
			$fileNameFld = "img_bbva";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear output buffer
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>