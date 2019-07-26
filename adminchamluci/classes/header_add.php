<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class header_add extends header
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}";

	// Table name
	public $TableName = 'header';

	// Page object name
	public $PageObjName = "header_add";

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

		// Table object (header)
		if (!isset($GLOBALS["header"]) || get_class($GLOBALS["header"]) == PROJECT_NAMESPACE . "header") {
			$GLOBALS["header"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["header"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario']))
			$GLOBALS['usuario'] = new usuario();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'header');

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
		global $EXPORT, $header;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($header);
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
					if ($pageName == "headerview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("headerlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->img_empresa->setVisibility();
		$this->img_blog->setVisibility();
		$this->img_contacto->setVisibility();
		$this->img_pasarela->setVisibility();
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
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("headerlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "headerlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "headerview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->img_empresa->Upload->Index = $CurrentForm->Index;
		$this->img_empresa->Upload->uploadFile();
		$this->img_empresa->CurrentValue = $this->img_empresa->Upload->FileName;
		$this->img_blog->Upload->Index = $CurrentForm->Index;
		$this->img_blog->Upload->uploadFile();
		$this->img_blog->CurrentValue = $this->img_blog->Upload->FileName;
		$this->img_contacto->Upload->Index = $CurrentForm->Index;
		$this->img_contacto->Upload->uploadFile();
		$this->img_contacto->CurrentValue = $this->img_contacto->Upload->FileName;
		$this->img_pasarela->Upload->Index = $CurrentForm->Index;
		$this->img_pasarela->Upload->uploadFile();
		$this->img_pasarela->CurrentValue = $this->img_pasarela->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->img_empresa->Upload->DbValue = NULL;
		$this->img_empresa->OldValue = $this->img_empresa->Upload->DbValue;
		$this->img_empresa->CurrentValue = NULL; // Clear file related field
		$this->img_blog->Upload->DbValue = NULL;
		$this->img_blog->OldValue = $this->img_blog->Upload->DbValue;
		$this->img_blog->CurrentValue = NULL; // Clear file related field
		$this->img_contacto->Upload->DbValue = NULL;
		$this->img_contacto->OldValue = $this->img_contacto->Upload->DbValue;
		$this->img_contacto->CurrentValue = NULL; // Clear file related field
		$this->img_pasarela->Upload->DbValue = NULL;
		$this->img_pasarela->OldValue = $this->img_pasarela->Upload->DbValue;
		$this->img_pasarela->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
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
		$this->img_empresa->Upload->DbValue = $row['img_empresa'];
		$this->img_empresa->setDbValue($this->img_empresa->Upload->DbValue);
		$this->img_blog->Upload->DbValue = $row['img_blog'];
		$this->img_blog->setDbValue($this->img_blog->Upload->DbValue);
		$this->img_contacto->Upload->DbValue = $row['img_contacto'];
		$this->img_contacto->setDbValue($this->img_contacto->Upload->DbValue);
		$this->img_pasarela->Upload->DbValue = $row['img_pasarela'];
		$this->img_pasarela->setDbValue($this->img_pasarela->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['img_empresa'] = $this->img_empresa->Upload->DbValue;
		$row['img_blog'] = $this->img_blog->Upload->DbValue;
		$row['img_contacto'] = $this->img_contacto->Upload->DbValue;
		$row['img_pasarela'] = $this->img_pasarela->Upload->DbValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// img_empresa
		// img_blog
		// img_contacto
		// img_pasarela

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// img_empresa
			if (!EmptyValue($this->img_empresa->Upload->DbValue)) {
				$this->img_empresa->ImageWidth = 200;
				$this->img_empresa->ImageHeight = 70;
				$this->img_empresa->ImageAlt = $this->img_empresa->alt();
				$this->img_empresa->ViewValue = $this->img_empresa->Upload->DbValue;
			} else {
				$this->img_empresa->ViewValue = "";
			}
			$this->img_empresa->ViewCustomAttributes = "";

			// img_blog
			if (!EmptyValue($this->img_blog->Upload->DbValue)) {
				$this->img_blog->ImageWidth = 200;
				$this->img_blog->ImageHeight = 70;
				$this->img_blog->ImageAlt = $this->img_blog->alt();
				$this->img_blog->ViewValue = $this->img_blog->Upload->DbValue;
			} else {
				$this->img_blog->ViewValue = "";
			}
			$this->img_blog->ViewCustomAttributes = "";

			// img_contacto
			if (!EmptyValue($this->img_contacto->Upload->DbValue)) {
				$this->img_contacto->ImageWidth = 200;
				$this->img_contacto->ImageHeight = 70;
				$this->img_contacto->ImageAlt = $this->img_contacto->alt();
				$this->img_contacto->ViewValue = $this->img_contacto->Upload->DbValue;
			} else {
				$this->img_contacto->ViewValue = "";
			}
			$this->img_contacto->ViewCustomAttributes = "";

			// img_pasarela
			if (!EmptyValue($this->img_pasarela->Upload->DbValue)) {
				$this->img_pasarela->ImageWidth = 200;
				$this->img_pasarela->ImageHeight = 70;
				$this->img_pasarela->ImageAlt = $this->img_pasarela->alt();
				$this->img_pasarela->ViewValue = $this->img_pasarela->Upload->DbValue;
			} else {
				$this->img_pasarela->ViewValue = "";
			}
			$this->img_pasarela->ViewCustomAttributes = "";

			// img_empresa
			$this->img_empresa->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_empresa->Upload->DbValue)) {
				$this->img_empresa->HrefValue = GetFileUploadUrl($this->img_empresa, $this->img_empresa->Upload->DbValue); // Add prefix/suffix
				$this->img_empresa->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_empresa->HrefValue = FullUrl($this->img_empresa->HrefValue, "href");
			} else {
				$this->img_empresa->HrefValue = "";
			}
			$this->img_empresa->ExportHrefValue = $this->img_empresa->UploadPath . $this->img_empresa->Upload->DbValue;
			$this->img_empresa->TooltipValue = "";
			if ($this->img_empresa->UseColorbox) {
				if (EmptyValue($this->img_empresa->TooltipValue))
					$this->img_empresa->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img_empresa->LinkAttrs["data-rel"] = "header_x_img_empresa";
				AppendClass($this->img_empresa->LinkAttrs["class"], "ew-lightbox");
			}

			// img_blog
			$this->img_blog->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_blog->Upload->DbValue)) {
				$this->img_blog->HrefValue = GetFileUploadUrl($this->img_blog, $this->img_blog->Upload->DbValue); // Add prefix/suffix
				$this->img_blog->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_blog->HrefValue = FullUrl($this->img_blog->HrefValue, "href");
			} else {
				$this->img_blog->HrefValue = "";
			}
			$this->img_blog->ExportHrefValue = $this->img_blog->UploadPath . $this->img_blog->Upload->DbValue;
			$this->img_blog->TooltipValue = "";
			if ($this->img_blog->UseColorbox) {
				if (EmptyValue($this->img_blog->TooltipValue))
					$this->img_blog->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img_blog->LinkAttrs["data-rel"] = "header_x_img_blog";
				AppendClass($this->img_blog->LinkAttrs["class"], "ew-lightbox");
			}

			// img_contacto
			$this->img_contacto->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_contacto->Upload->DbValue)) {
				$this->img_contacto->HrefValue = GetFileUploadUrl($this->img_contacto, $this->img_contacto->Upload->DbValue); // Add prefix/suffix
				$this->img_contacto->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_contacto->HrefValue = FullUrl($this->img_contacto->HrefValue, "href");
			} else {
				$this->img_contacto->HrefValue = "";
			}
			$this->img_contacto->ExportHrefValue = $this->img_contacto->UploadPath . $this->img_contacto->Upload->DbValue;
			$this->img_contacto->TooltipValue = "";
			if ($this->img_contacto->UseColorbox) {
				if (EmptyValue($this->img_contacto->TooltipValue))
					$this->img_contacto->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img_contacto->LinkAttrs["data-rel"] = "header_x_img_contacto";
				AppendClass($this->img_contacto->LinkAttrs["class"], "ew-lightbox");
			}

			// img_pasarela
			$this->img_pasarela->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_pasarela->Upload->DbValue)) {
				$this->img_pasarela->HrefValue = GetFileUploadUrl($this->img_pasarela, $this->img_pasarela->Upload->DbValue); // Add prefix/suffix
				$this->img_pasarela->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_pasarela->HrefValue = FullUrl($this->img_pasarela->HrefValue, "href");
			} else {
				$this->img_pasarela->HrefValue = "";
			}
			$this->img_pasarela->ExportHrefValue = $this->img_pasarela->UploadPath . $this->img_pasarela->Upload->DbValue;
			$this->img_pasarela->TooltipValue = "";
			if ($this->img_pasarela->UseColorbox) {
				if (EmptyValue($this->img_pasarela->TooltipValue))
					$this->img_pasarela->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->img_pasarela->LinkAttrs["data-rel"] = "header_x_img_pasarela";
				AppendClass($this->img_pasarela->LinkAttrs["class"], "ew-lightbox");
			}
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// img_empresa
			$this->img_empresa->EditAttrs["class"] = "form-control";
			$this->img_empresa->EditCustomAttributes = "";
			if (!EmptyValue($this->img_empresa->Upload->DbValue)) {
				$this->img_empresa->ImageWidth = 200;
				$this->img_empresa->ImageHeight = 70;
				$this->img_empresa->ImageAlt = $this->img_empresa->alt();
				$this->img_empresa->EditValue = $this->img_empresa->Upload->DbValue;
			} else {
				$this->img_empresa->EditValue = "";
			}
			if (!EmptyValue($this->img_empresa->CurrentValue))
					$this->img_empresa->Upload->FileName = $this->img_empresa->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->img_empresa);

			// img_blog
			$this->img_blog->EditAttrs["class"] = "form-control";
			$this->img_blog->EditCustomAttributes = "";
			if (!EmptyValue($this->img_blog->Upload->DbValue)) {
				$this->img_blog->ImageWidth = 200;
				$this->img_blog->ImageHeight = 70;
				$this->img_blog->ImageAlt = $this->img_blog->alt();
				$this->img_blog->EditValue = $this->img_blog->Upload->DbValue;
			} else {
				$this->img_blog->EditValue = "";
			}
			if (!EmptyValue($this->img_blog->CurrentValue))
					$this->img_blog->Upload->FileName = $this->img_blog->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->img_blog);

			// img_contacto
			$this->img_contacto->EditAttrs["class"] = "form-control";
			$this->img_contacto->EditCustomAttributes = "";
			if (!EmptyValue($this->img_contacto->Upload->DbValue)) {
				$this->img_contacto->ImageWidth = 200;
				$this->img_contacto->ImageHeight = 70;
				$this->img_contacto->ImageAlt = $this->img_contacto->alt();
				$this->img_contacto->EditValue = $this->img_contacto->Upload->DbValue;
			} else {
				$this->img_contacto->EditValue = "";
			}
			if (!EmptyValue($this->img_contacto->CurrentValue))
					$this->img_contacto->Upload->FileName = $this->img_contacto->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->img_contacto);

			// img_pasarela
			$this->img_pasarela->EditAttrs["class"] = "form-control";
			$this->img_pasarela->EditCustomAttributes = "";
			if (!EmptyValue($this->img_pasarela->Upload->DbValue)) {
				$this->img_pasarela->ImageWidth = 200;
				$this->img_pasarela->ImageHeight = 70;
				$this->img_pasarela->ImageAlt = $this->img_pasarela->alt();
				$this->img_pasarela->EditValue = $this->img_pasarela->Upload->DbValue;
			} else {
				$this->img_pasarela->EditValue = "";
			}
			if (!EmptyValue($this->img_pasarela->CurrentValue))
					$this->img_pasarela->Upload->FileName = $this->img_pasarela->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->img_pasarela);

			// Add refer script
			// img_empresa

			$this->img_empresa->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_empresa->Upload->DbValue)) {
				$this->img_empresa->HrefValue = GetFileUploadUrl($this->img_empresa, $this->img_empresa->Upload->DbValue); // Add prefix/suffix
				$this->img_empresa->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_empresa->HrefValue = FullUrl($this->img_empresa->HrefValue, "href");
			} else {
				$this->img_empresa->HrefValue = "";
			}
			$this->img_empresa->ExportHrefValue = $this->img_empresa->UploadPath . $this->img_empresa->Upload->DbValue;

			// img_blog
			$this->img_blog->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_blog->Upload->DbValue)) {
				$this->img_blog->HrefValue = GetFileUploadUrl($this->img_blog, $this->img_blog->Upload->DbValue); // Add prefix/suffix
				$this->img_blog->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_blog->HrefValue = FullUrl($this->img_blog->HrefValue, "href");
			} else {
				$this->img_blog->HrefValue = "";
			}
			$this->img_blog->ExportHrefValue = $this->img_blog->UploadPath . $this->img_blog->Upload->DbValue;

			// img_contacto
			$this->img_contacto->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_contacto->Upload->DbValue)) {
				$this->img_contacto->HrefValue = GetFileUploadUrl($this->img_contacto, $this->img_contacto->Upload->DbValue); // Add prefix/suffix
				$this->img_contacto->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_contacto->HrefValue = FullUrl($this->img_contacto->HrefValue, "href");
			} else {
				$this->img_contacto->HrefValue = "";
			}
			$this->img_contacto->ExportHrefValue = $this->img_contacto->UploadPath . $this->img_contacto->Upload->DbValue;

			// img_pasarela
			$this->img_pasarela->LinkCustomAttributes = "";
			if (!EmptyValue($this->img_pasarela->Upload->DbValue)) {
				$this->img_pasarela->HrefValue = GetFileUploadUrl($this->img_pasarela, $this->img_pasarela->Upload->DbValue); // Add prefix/suffix
				$this->img_pasarela->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->img_pasarela->HrefValue = FullUrl($this->img_pasarela->HrefValue, "href");
			} else {
				$this->img_pasarela->HrefValue = "";
			}
			$this->img_pasarela->ExportHrefValue = $this->img_pasarela->UploadPath . $this->img_pasarela->Upload->DbValue;
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->img_empresa->Required) {
			if ($this->img_empresa->Upload->FileName == "" && !$this->img_empresa->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img_empresa->caption(), $this->img_empresa->RequiredErrorMessage));
			}
		}
		if ($this->img_blog->Required) {
			if ($this->img_blog->Upload->FileName == "" && !$this->img_blog->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img_blog->caption(), $this->img_blog->RequiredErrorMessage));
			}
		}
		if ($this->img_contacto->Required) {
			if ($this->img_contacto->Upload->FileName == "" && !$this->img_contacto->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img_contacto->caption(), $this->img_contacto->RequiredErrorMessage));
			}
		}
		if ($this->img_pasarela->Required) {
			if ($this->img_pasarela->Upload->FileName == "" && !$this->img_pasarela->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img_pasarela->caption(), $this->img_pasarela->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// img_empresa
		if ($this->img_empresa->Visible && !$this->img_empresa->Upload->KeepFile) {
			$this->img_empresa->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_empresa->Upload->FileName == "") {
				$rsnew['img_empresa'] = NULL;
			} else {
				$rsnew['img_empresa'] = $this->img_empresa->Upload->FileName;
			}
		}

		// img_blog
		if ($this->img_blog->Visible && !$this->img_blog->Upload->KeepFile) {
			$this->img_blog->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_blog->Upload->FileName == "") {
				$rsnew['img_blog'] = NULL;
			} else {
				$rsnew['img_blog'] = $this->img_blog->Upload->FileName;
			}
		}

		// img_contacto
		if ($this->img_contacto->Visible && !$this->img_contacto->Upload->KeepFile) {
			$this->img_contacto->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_contacto->Upload->FileName == "") {
				$rsnew['img_contacto'] = NULL;
			} else {
				$rsnew['img_contacto'] = $this->img_contacto->Upload->FileName;
			}
		}

		// img_pasarela
		if ($this->img_pasarela->Visible && !$this->img_pasarela->Upload->KeepFile) {
			$this->img_pasarela->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_pasarela->Upload->FileName == "") {
				$rsnew['img_pasarela'] = NULL;
			} else {
				$rsnew['img_pasarela'] = $this->img_pasarela->Upload->FileName;
			}
		}
		if ($this->img_empresa->Visible && !$this->img_empresa->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->img_empresa->Upload->DbValue) ? array() : array($this->img_empresa->Upload->DbValue);
			if (!EmptyValue($this->img_empresa->Upload->FileName)) {
				$newFiles = array($this->img_empresa->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->img_empresa, $this->img_empresa->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->img_empresa->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->img_empresa, $this->img_empresa->Upload->Index) . $file1) || file_exists($this->img_empresa->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->img_empresa->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->img_empresa, $this->img_empresa->Upload->Index) . $file, UploadTempPath($this->img_empresa, $this->img_empresa->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_empresa->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->img_empresa->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->img_empresa->setDbValueDef($rsnew, $this->img_empresa->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_blog->Visible && !$this->img_blog->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->img_blog->Upload->DbValue) ? array() : array($this->img_blog->Upload->DbValue);
			if (!EmptyValue($this->img_blog->Upload->FileName)) {
				$newFiles = array($this->img_blog->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->img_blog, $this->img_blog->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->img_blog->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->img_blog, $this->img_blog->Upload->Index) . $file1) || file_exists($this->img_blog->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->img_blog->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->img_blog, $this->img_blog->Upload->Index) . $file, UploadTempPath($this->img_blog, $this->img_blog->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_blog->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->img_blog->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->img_blog->setDbValueDef($rsnew, $this->img_blog->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_contacto->Visible && !$this->img_contacto->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->img_contacto->Upload->DbValue) ? array() : array($this->img_contacto->Upload->DbValue);
			if (!EmptyValue($this->img_contacto->Upload->FileName)) {
				$newFiles = array($this->img_contacto->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->img_contacto, $this->img_contacto->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->img_contacto->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->img_contacto, $this->img_contacto->Upload->Index) . $file1) || file_exists($this->img_contacto->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->img_contacto->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->img_contacto, $this->img_contacto->Upload->Index) . $file, UploadTempPath($this->img_contacto, $this->img_contacto->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_contacto->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->img_contacto->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->img_contacto->setDbValueDef($rsnew, $this->img_contacto->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_pasarela->Visible && !$this->img_pasarela->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->img_pasarela->Upload->DbValue) ? array() : array($this->img_pasarela->Upload->DbValue);
			if (!EmptyValue($this->img_pasarela->Upload->FileName)) {
				$newFiles = array($this->img_pasarela->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->img_pasarela, $this->img_pasarela->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->img_pasarela->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->img_pasarela, $this->img_pasarela->Upload->Index) . $file1) || file_exists($this->img_pasarela->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->img_pasarela->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->img_pasarela, $this->img_pasarela->Upload->Index) . $file, UploadTempPath($this->img_pasarela, $this->img_pasarela->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_pasarela->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->img_pasarela->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->img_pasarela->setDbValueDef($rsnew, $this->img_pasarela->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
				if ($this->img_empresa->Visible && !$this->img_empresa->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->img_empresa->Upload->DbValue) ? array() : array($this->img_empresa->Upload->DbValue);
					if (!EmptyValue($this->img_empresa->Upload->FileName)) {
						$newFiles = array($this->img_empresa->Upload->FileName);
						$newFiles2 = array($rsnew['img_empresa']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->img_empresa, $this->img_empresa->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->img_empresa->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->img_empresa->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->img_blog->Visible && !$this->img_blog->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->img_blog->Upload->DbValue) ? array() : array($this->img_blog->Upload->DbValue);
					if (!EmptyValue($this->img_blog->Upload->FileName)) {
						$newFiles = array($this->img_blog->Upload->FileName);
						$newFiles2 = array($rsnew['img_blog']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->img_blog, $this->img_blog->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->img_blog->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->img_blog->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->img_contacto->Visible && !$this->img_contacto->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->img_contacto->Upload->DbValue) ? array() : array($this->img_contacto->Upload->DbValue);
					if (!EmptyValue($this->img_contacto->Upload->FileName)) {
						$newFiles = array($this->img_contacto->Upload->FileName);
						$newFiles2 = array($rsnew['img_contacto']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->img_contacto, $this->img_contacto->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->img_contacto->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->img_contacto->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->img_pasarela->Visible && !$this->img_pasarela->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->img_pasarela->Upload->DbValue) ? array() : array($this->img_pasarela->Upload->DbValue);
					if (!EmptyValue($this->img_pasarela->Upload->FileName)) {
						$newFiles = array($this->img_pasarela->Upload->FileName);
						$newFiles2 = array($rsnew['img_pasarela']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->img_pasarela, $this->img_pasarela->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->img_pasarela->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->img_pasarela->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// img_empresa
		if ($this->img_empresa->Upload->FileToken <> "")
			CleanUploadTempPath($this->img_empresa->Upload->FileToken, $this->img_empresa->Upload->Index);
		else
			CleanUploadTempPath($this->img_empresa, $this->img_empresa->Upload->Index);

		// img_blog
		if ($this->img_blog->Upload->FileToken <> "")
			CleanUploadTempPath($this->img_blog->Upload->FileToken, $this->img_blog->Upload->Index);
		else
			CleanUploadTempPath($this->img_blog, $this->img_blog->Upload->Index);

		// img_contacto
		if ($this->img_contacto->Upload->FileToken <> "")
			CleanUploadTempPath($this->img_contacto->Upload->FileToken, $this->img_contacto->Upload->Index);
		else
			CleanUploadTempPath($this->img_contacto, $this->img_contacto->Upload->Index);

		// img_pasarela
		if ($this->img_pasarela->Upload->FileToken <> "")
			CleanUploadTempPath($this->img_pasarela->Upload->FileToken, $this->img_pasarela->Upload->Index);
		else
			CleanUploadTempPath($this->img_pasarela, $this->img_pasarela->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("headerlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>