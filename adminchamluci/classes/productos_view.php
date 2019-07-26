<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class productos_view extends productos
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}";

	// Table name
	public $TableName = 'productos';

	// Page object name
	public $PageObjName = "productos_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;
	public $CancelUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (productos)
		if (!isset($GLOBALS["productos"]) || get_class($GLOBALS["productos"]) == PROJECT_NAMESPACE . "productos") {
			$GLOBALS["productos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["productos"];
		}
		$keyUrl = "";
		if (Get("id") !== NULL) {
			$this->RecKey["id"] = Get("id");
			$keyUrl .= "&amp;id=" . urlencode($this->RecKey["id"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (categorias)
		if (!isset($GLOBALS['categorias']))
			$GLOBALS['categorias'] = new categorias();

		// Table object (usuario)
		if (!isset($GLOBALS['usuario']))
			$GLOBALS['usuario'] = new usuario();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'productos');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (usuario)
		if (!isset($UserTable)) {
			$UserTable = new usuario();
			$UserTableConn = Conn($UserTable->Dbid);
		}

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $productos;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($productos);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "productosview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecs = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $RecCnt;
	public $RecKey = array();
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SkipHeaderFooter, $EXPORT;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("productoslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->titulo->setVisibility();
		$this->detalle->setVisibility();
		$this->img1->setVisibility();
		$this->img2->setVisibility();
		$this->img3->setVisibility();
		$this->img4->setVisibility();
		$this->img5->setVisibility();
		$this->img6->setVisibility();
		$this->img7->setVisibility();
		$this->img8->setVisibility();
		$this->img9->setVisibility();
		$this->destacado_inicio->setVisibility();
		$this->destacado_footer->setVisibility();
		$this->destacado_productos->setVisibility();
		$this->id_cate->setVisibility();
		$this->ficha_tecnica->setVisibility();
		$this->img_principal->setVisibility();
		$this->url->setVisibility();
		$this->keywords->setVisibility();
		$this->description->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->id_cate);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$returnUrl = "";
		$matchRecord = FALSE;

		// Set up master/detail parameters
		$this->setupMasterParms();
		if ($this->isPageRequest()) { // Validate request
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (IsApi() && Key(0) != NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->RecKey["id"] = $this->id->FormValue;
			} elseif (IsApi() && Route(2) != NULL) {
				$this->id->setFormValue(Route(2));
				$this->RecKey["id"] = $this->id->FormValue;
			} else {
				$returnUrl = "productoslist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = &$this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "productoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$returnUrl = "productoslist.php"; // Not page request, return to list
		}
		if ($returnUrl <> "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->canEdit());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "" && $Security->canDelete());

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = TRUE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->titulo->setDbValue($row['titulo']);
		$this->detalle->setDbValue($row['detalle']);
		$this->img1->Upload->DbValue = $row['img1'];
		$this->img1->setDbValue($this->img1->Upload->DbValue);
		$this->img2->Upload->DbValue = $row['img2'];
		$this->img2->setDbValue($this->img2->Upload->DbValue);
		$this->img3->Upload->DbValue = $row['img3'];
		$this->img3->setDbValue($this->img3->Upload->DbValue);
		$this->img4->Upload->DbValue = $row['img4'];
		$this->img4->setDbValue($this->img4->Upload->DbValue);
		$this->img5->Upload->DbValue = $row['img5'];
		$this->img5->setDbValue($this->img5->Upload->DbValue);
		$this->img6->Upload->DbValue = $row['img6'];
		$this->img6->setDbValue($this->img6->Upload->DbValue);
		$this->img7->Upload->DbValue = $row['img7'];
		$this->img7->setDbValue($this->img7->Upload->DbValue);
		$this->img8->Upload->DbValue = $row['img8'];
		$this->img8->setDbValue($this->img8->Upload->DbValue);
		$this->img9->Upload->DbValue = $row['img9'];
		$this->img9->setDbValue($this->img9->Upload->DbValue);
		$this->destacado_inicio->setDbValue($row['destacado_inicio']);
		$this->destacado_footer->setDbValue($row['destacado_footer']);
		$this->destacado_productos->setDbValue($row['destacado_productos']);
		$this->id_cate->setDbValue($row['id_cate']);
		if (array_key_exists('EV__id_cate', $rs->fields)) {
			$this->id_cate->VirtualValue = $rs->fields('EV__id_cate'); // Set up virtual field value
		} else {
			$this->id_cate->VirtualValue = ""; // Clear value
		}
		$this->ficha_tecnica->Upload->DbValue = $row['ficha_tecnica'];
		$this->ficha_tecnica->setDbValue($this->ficha_tecnica->Upload->DbValue);
		$this->img_principal->setDbValue($row['img_principal']);
		$this->url->setDbValue($row['url']);
		$this->keywords->setDbValue($row['keywords']);
		$this->description->setDbValue($row['description']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['titulo'] = NULL;
		$row['detalle'] = NULL;
		$row['img1'] = NULL;
		$row['img2'] = NULL;
		$row['img3'] = NULL;
		$row['img4'] = NULL;
		$row['img5'] = NULL;
		$row['img6'] = NULL;
		$row['img7'] = NULL;
		$row['img8'] = NULL;
		$row['img9'] = NULL;
		$row['destacado_inicio'] = NULL;
		$row['destacado_footer'] = NULL;
		$row['destacado_productos'] = NULL;
		$row['id_cate'] = NULL;
		$row['ficha_tecnica'] = NULL;
		$row['img_principal'] = NULL;
		$row['url'] = NULL;
		$row['keywords'] = NULL;
		$row['description'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// titulo
		// detalle
		// img1
		// img2
		// img3
		// img4
		// img5
		// img6
		// img7
		// img8
		// img9
		// destacado_inicio
		// destacado_footer
		// destacado_productos
		// id_cate
		// ficha_tecnica
		// img_principal
		// url
		// keywords
		// description

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// titulo
			$this->titulo->ViewValue = $this->titulo->CurrentValue;
			$this->titulo->ViewCustomAttributes = "";

			// detalle
			$this->detalle->ViewValue = $this->detalle->CurrentValue;
			$this->detalle->ViewCustomAttributes = "";

			// img1
			if (!EmptyValue($this->img1->Upload->DbValue)) {
				$this->img1->ImageWidth = 50;
				$this->img1->ImageHeight = 50;
				$this->img1->ImageAlt = $this->img1->alt();
				$this->img1->ViewValue = $this->img1->Upload->DbValue;
			} else {
				$this->img1->ViewValue = "";
			}
			$this->img1->ViewCustomAttributes = "";

			// img2
			if (!EmptyValue($this->img2->Upload->DbValue)) {
				$this->img2->ImageWidth = 50;
				$this->img2->ImageHeight = 50;
				$this->img2->ImageAlt = $this->img2->alt();
				$this->img2->ViewValue = $this->img2->Upload->DbValue;
			} else {
				$this->img2->ViewValue = "";
			}
			$this->img2->ViewCustomAttributes = "";

			// img3
			if (!EmptyValue($this->img3->Upload->DbValue)) {
				$this->img3->ImageWidth = 50;
				$this->img3->ImageHeight = 50;
				$this->img3->ImageAlt = $this->img3->alt();
				$this->img3->ViewValue = $this->img3->Upload->DbValue;
			} else {
				$this->img3->ViewValue = "";
			}
			$this->img3->ViewCustomAttributes = "";

			// img4
			if (!EmptyValue($this->img4->Upload->DbValue)) {
				$this->img4->ImageWidth = 50;
				$this->img4->ImageHeight = 50;
				$this->img4->ImageAlt = $this->img4->alt();
				$this->img4->ViewValue = $this->img4->Upload->DbValue;
			} else {
				$this->img4->ViewValue = "";
			}
			$this->img4->ViewCustomAttributes = "";

			// img5
			if (!EmptyValue($this->img5->Upload->DbValue)) {
				$this->img5->ImageWidth = 50;
				$this->img5->ImageHeight = 50;
				$this->img5->ImageAlt = $this->img5->alt();
				$this->img5->ViewValue = $this->img5->Upload->DbValue;
			} else {
				$this->img5->ViewValue = "";
			}
			$this->img5->ViewCustomAttributes = "";

			// img6
			if (!EmptyValue($this->img6->Upload->DbValue)) {
				$this->img6->ImageWidth = 50;
				$this->img6->ImageHeight = 50;
				$this->img6->ImageAlt = $this->img6->alt();
				$this->img6->ViewValue = $this->img6->Upload->DbValue;
			} else {
				$this->img6->ViewValue = "";
			}
			$this->img6->ViewCustomAttributes = "";

			// img7
			if (!EmptyValue($this->img7->Upload->DbValue)) {
				$this->img7->ImageWidth = 50;
				$this->img7->ImageHeight = 50;
				$this->img7->ImageAlt = $this->img7->alt();
				$this->img7->ViewValue = $this->img7->Upload->DbValue;
			} else {
				$this->img7->ViewValue = "";
			}
			$this->img7->ViewCustomAttributes = "";

			// img8
			if (!EmptyValue($this->img8->Upload->DbValue)) {
				$this->img8->ImageWidth = 50;
				$this->img8->ImageHeight = 50;
				$this->img8->ImageAlt = $this->img8->alt();
				$this->img8->ViewValue = $this->img8->Upload->DbValue;
			} else {
				$this->img8->ViewValue = "";
			}
			$this->img8->ViewCustomAttributes = "";

			// img9
			if (!EmptyValue($this->img9->Upload->DbValue)) {
				$this->img9->ImageWidth = 50;
				$this->img9->ImageHeight = 50;
				$this->img9->ImageAlt = $this->img9->alt();
				$this->img9->ViewValue = $this->img9->Upload->DbValue;
			} else {
				$this->img9->ViewValue = "";
			}
			$this->img9->ViewCustomAttributes = "";

			// destacado_inicio
			if (strval($this->destacado_inicio->CurrentValue) <> "") {
				$this->destacado_inicio->ViewValue = $this->destacado_inicio->optionCaption($this->destacado_inicio->CurrentValue);
			} else {
				$this->destacado_inicio->ViewValue = NULL;
			}
			$this->destacado_inicio->ViewCustomAttributes = "";

			// destacado_footer
			if (strval($this->destacado_footer->CurrentValue) <> "") {
				$this->destacado_footer->ViewValue = $this->destacado_footer->optionCaption($this->destacado_footer->CurrentValue);
			} else {
				$this->destacado_footer->ViewValue = NULL;
			}
			$this->destacado_footer->ViewCustomAttributes = "";

			// destacado_productos
			if (strval($this->destacado_productos->CurrentValue) <> "") {
				$this->destacado_productos->ViewValue = $this->destacado_productos->optionCaption($this->destacado_productos->CurrentValue);
			} else {
				$this->destacado_productos->ViewValue = NULL;
			}
			$this->destacado_productos->ViewCustomAttributes = "";

			// id_cate
			if ($this->id_cate->VirtualValue <> "") {
				$this->id_cate->ViewValue = $this->id_cate->VirtualValue;
			} else {
			$curVal = strval($this->id_cate->CurrentValue);
			if ($curVal <> "") {
				$this->id_cate->ViewValue = $this->id_cate->lookupCacheOption($curVal);
				if ($this->id_cate->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_cate->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->id_cate->ViewValue = $this->id_cate->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_cate->ViewValue = $this->id_cate->CurrentValue;
					}
				}
			} else {
				$this->id_cate->ViewValue = NULL;
			}
			}
			$this->id_cate->ViewCustomAttributes = "";

			// ficha_tecnica
			if (!EmptyValue($this->ficha_tecnica->Upload->DbValue)) {
				$this->ficha_tecnica->ViewValue = $this->ficha_tecnica->Upload->DbValue;
			} else {
				$this->ficha_tecnica->ViewValue = "";
			}
			$this->ficha_tecnica->ViewCustomAttributes = "";

			// img_principal
			if (strval($this->img_principal->CurrentValue) <> "") {
				$this->img_principal->ViewValue = $this->img_principal->optionCaption($this->img_principal->CurrentValue);
			} else {
				$this->img_principal->ViewValue = NULL;
			}
			$this->img_principal->ViewCustomAttributes = "";

			// url
			$this->url->ViewValue = $this->url->CurrentValue;
			$this->url->ViewCustomAttributes = "";

			// keywords
			$this->keywords->ViewValue = $this->keywords->CurrentValue;
			$this->keywords->ViewCustomAttributes = "";

			// description
			$this->description->ViewValue = $this->description->CurrentValue;
			$this->description->ViewCustomAttributes = "";

			// titulo
			$this->titulo->LinkCustomAttributes = "";
			$this->titulo->HrefValue = "";
			$this->titulo->TooltipValue = "";

			// detalle
			$this->detalle->LinkCustomAttributes = "";
			$this->detalle->HrefValue = "";
			$this->detalle->TooltipValue = "";

			// img1
			$this->img1->LinkCustomAttributes = "";
			if (!EmptyValue($this->img1->Upload->DbValue)) {
				$this->img1->HrefValue = GetFileUploadUrl($this->img1, $this->img1->Upload->DbValue); // Add prefix/suffix
				$this->img1->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img1->HrefValue = FullUrl($this->img1->HrefValue, "href");
			} else {
				$this->img1->HrefValue = "";
			}
			$this->img1->ExportHrefValue = $this->img1->UploadPath . $this->img1->Upload->DbValue;
			$this->img1->TooltipValue = "";
			if ($this->img1->UseColorbox) {
				if (EmptyValue($this->img1->TooltipValue))
					$this->img1->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img1->LinkAttrs["data-rel"] = "productos_x_img1";
				AppendClass($this->img1->LinkAttrs["class"], "ew-lightbox");
			}

			// img2
			$this->img2->LinkCustomAttributes = "";
			if (!EmptyValue($this->img2->Upload->DbValue)) {
				$this->img2->HrefValue = GetFileUploadUrl($this->img2, $this->img2->Upload->DbValue); // Add prefix/suffix
				$this->img2->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img2->HrefValue = FullUrl($this->img2->HrefValue, "href");
			} else {
				$this->img2->HrefValue = "";
			}
			$this->img2->ExportHrefValue = $this->img2->UploadPath . $this->img2->Upload->DbValue;
			$this->img2->TooltipValue = "";
			if ($this->img2->UseColorbox) {
				if (EmptyValue($this->img2->TooltipValue))
					$this->img2->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img2->LinkAttrs["data-rel"] = "productos_x_img2";
				AppendClass($this->img2->LinkAttrs["class"], "ew-lightbox");
			}

			// img3
			$this->img3->LinkCustomAttributes = "";
			if (!EmptyValue($this->img3->Upload->DbValue)) {
				$this->img3->HrefValue = GetFileUploadUrl($this->img3, $this->img3->Upload->DbValue); // Add prefix/suffix
				$this->img3->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img3->HrefValue = FullUrl($this->img3->HrefValue, "href");
			} else {
				$this->img3->HrefValue = "";
			}
			$this->img3->ExportHrefValue = $this->img3->UploadPath . $this->img3->Upload->DbValue;
			$this->img3->TooltipValue = "";
			if ($this->img3->UseColorbox) {
				if (EmptyValue($this->img3->TooltipValue))
					$this->img3->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img3->LinkAttrs["data-rel"] = "productos_x_img3";
				AppendClass($this->img3->LinkAttrs["class"], "ew-lightbox");
			}

			// img4
			$this->img4->LinkCustomAttributes = "";
			if (!EmptyValue($this->img4->Upload->DbValue)) {
				$this->img4->HrefValue = GetFileUploadUrl($this->img4, $this->img4->Upload->DbValue); // Add prefix/suffix
				$this->img4->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img4->HrefValue = FullUrl($this->img4->HrefValue, "href");
			} else {
				$this->img4->HrefValue = "";
			}
			$this->img4->ExportHrefValue = $this->img4->UploadPath . $this->img4->Upload->DbValue;
			$this->img4->TooltipValue = "";
			if ($this->img4->UseColorbox) {
				if (EmptyValue($this->img4->TooltipValue))
					$this->img4->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img4->LinkAttrs["data-rel"] = "productos_x_img4";
				AppendClass($this->img4->LinkAttrs["class"], "ew-lightbox");
			}

			// img5
			$this->img5->LinkCustomAttributes = "";
			if (!EmptyValue($this->img5->Upload->DbValue)) {
				$this->img5->HrefValue = GetFileUploadUrl($this->img5, $this->img5->Upload->DbValue); // Add prefix/suffix
				$this->img5->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img5->HrefValue = FullUrl($this->img5->HrefValue, "href");
			} else {
				$this->img5->HrefValue = "";
			}
			$this->img5->ExportHrefValue = $this->img5->UploadPath . $this->img5->Upload->DbValue;
			$this->img5->TooltipValue = "";
			if ($this->img5->UseColorbox) {
				if (EmptyValue($this->img5->TooltipValue))
					$this->img5->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img5->LinkAttrs["data-rel"] = "productos_x_img5";
				AppendClass($this->img5->LinkAttrs["class"], "ew-lightbox");
			}

			// img6
			$this->img6->LinkCustomAttributes = "";
			if (!EmptyValue($this->img6->Upload->DbValue)) {
				$this->img6->HrefValue = GetFileUploadUrl($this->img6, $this->img6->Upload->DbValue); // Add prefix/suffix
				$this->img6->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img6->HrefValue = FullUrl($this->img6->HrefValue, "href");
			} else {
				$this->img6->HrefValue = "";
			}
			$this->img6->ExportHrefValue = $this->img6->UploadPath . $this->img6->Upload->DbValue;
			$this->img6->TooltipValue = "";
			if ($this->img6->UseColorbox) {
				if (EmptyValue($this->img6->TooltipValue))
					$this->img6->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img6->LinkAttrs["data-rel"] = "productos_x_img6";
				AppendClass($this->img6->LinkAttrs["class"], "ew-lightbox");
			}

			// img7
			$this->img7->LinkCustomAttributes = "";
			if (!EmptyValue($this->img7->Upload->DbValue)) {
				$this->img7->HrefValue = GetFileUploadUrl($this->img7, $this->img7->Upload->DbValue); // Add prefix/suffix
				$this->img7->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img7->HrefValue = FullUrl($this->img7->HrefValue, "href");
			} else {
				$this->img7->HrefValue = "";
			}
			$this->img7->ExportHrefValue = $this->img7->UploadPath . $this->img7->Upload->DbValue;
			$this->img7->TooltipValue = "";
			if ($this->img7->UseColorbox) {
				if (EmptyValue($this->img7->TooltipValue))
					$this->img7->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img7->LinkAttrs["data-rel"] = "productos_x_img7";
				AppendClass($this->img7->LinkAttrs["class"], "ew-lightbox");
			}

			// img8
			$this->img8->LinkCustomAttributes = "";
			if (!EmptyValue($this->img8->Upload->DbValue)) {
				$this->img8->HrefValue = GetFileUploadUrl($this->img8, $this->img8->Upload->DbValue); // Add prefix/suffix
				$this->img8->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img8->HrefValue = FullUrl($this->img8->HrefValue, "href");
			} else {
				$this->img8->HrefValue = "";
			}
			$this->img8->ExportHrefValue = $this->img8->UploadPath . $this->img8->Upload->DbValue;
			$this->img8->TooltipValue = "";
			if ($this->img8->UseColorbox) {
				if (EmptyValue($this->img8->TooltipValue))
					$this->img8->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img8->LinkAttrs["data-rel"] = "productos_x_img8";
				AppendClass($this->img8->LinkAttrs["class"], "ew-lightbox");
			}

			// img9
			$this->img9->LinkCustomAttributes = "";
			if (!EmptyValue($this->img9->Upload->DbValue)) {
				$this->img9->HrefValue = GetFileUploadUrl($this->img9, $this->img9->Upload->DbValue); // Add prefix/suffix
				$this->img9->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img9->HrefValue = FullUrl($this->img9->HrefValue, "href");
			} else {
				$this->img9->HrefValue = "";
			}
			$this->img9->ExportHrefValue = $this->img9->UploadPath . $this->img9->Upload->DbValue;
			$this->img9->TooltipValue = "";
			if ($this->img9->UseColorbox) {
				if (EmptyValue($this->img9->TooltipValue))
					$this->img9->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img9->LinkAttrs["data-rel"] = "productos_x_img9";
				AppendClass($this->img9->LinkAttrs["class"], "ew-lightbox");
			}

			// destacado_inicio
			$this->destacado_inicio->LinkCustomAttributes = "";
			$this->destacado_inicio->HrefValue = "";
			$this->destacado_inicio->TooltipValue = "";

			// destacado_footer
			$this->destacado_footer->LinkCustomAttributes = "";
			$this->destacado_footer->HrefValue = "";
			$this->destacado_footer->TooltipValue = "";

			// destacado_productos
			$this->destacado_productos->LinkCustomAttributes = "";
			$this->destacado_productos->HrefValue = "";
			$this->destacado_productos->TooltipValue = "";

			// id_cate
			$this->id_cate->LinkCustomAttributes = "";
			$this->id_cate->HrefValue = "";
			$this->id_cate->TooltipValue = "";

			// ficha_tecnica
			$this->ficha_tecnica->LinkCustomAttributes = "";
			$this->ficha_tecnica->HrefValue = "";
			$this->ficha_tecnica->ExportHrefValue = $this->ficha_tecnica->UploadPath . $this->ficha_tecnica->Upload->DbValue;
			$this->ficha_tecnica->TooltipValue = "";

			// img_principal
			$this->img_principal->LinkCustomAttributes = "";
			$this->img_principal->HrefValue = "";
			$this->img_principal->TooltipValue = "";

			// url
			$this->url->LinkCustomAttributes = "";
			$this->url->HrefValue = "";
			$this->url->TooltipValue = "";

			// keywords
			$this->keywords->LinkCustomAttributes = "";
			$this->keywords->HrefValue = "";
			$this->keywords->TooltipValue = "";

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";
			$this->description->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (Get(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Get(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "categorias") {
				$validMaster = TRUE;
				if (Get("fk_id") !== NULL) {
					$this->id_cate->setQueryStringValue(Get("fk_id"));
					$this->id_cate->setSessionValue($this->id_cate->QueryStringValue);
					if (!is_numeric($this->id_cate->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (Post(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Post(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "categorias") {
				$validMaster = TRUE;
				if (Post("fk_id") !== NULL) {
					$this->id_cate->setFormValue(Post("fk_id"));
					$this->id_cate->setSessionValue($this->id_cate->FormValue);
					if (!is_numeric($this->id_cate->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($masterTblVar <> "categorias") {
				if ($this->id_cate->CurrentValue == "")
					$this->id_cate->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("productoslist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_id_cate":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>