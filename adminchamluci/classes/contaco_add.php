<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class contaco_add extends contaco
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}";

	// Table name
	public $TableName = 'contaco';

	// Page object name
	public $PageObjName = "contaco_add";

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

		// Table object (contaco)
		if (!isset($GLOBALS["contaco"]) || get_class($GLOBALS["contaco"]) == PROJECT_NAMESPACE . "contaco") {
			$GLOBALS["contaco"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["contaco"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'contaco');

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
		global $EXPORT, $contaco;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($contaco);
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
					if ($pageName == "contacoview.php")
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
					$this->terminate(GetUrl("contacolist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->correo->setVisibility();
		$this->direccion->setVisibility();
		$this->tel1->setVisibility();
		$this->tel2->setVisibility();
		$this->tel3->setVisibility();
		$this->tel4->setVisibility();
		$this->tel5->setVisibility();
		$this->horario->setVisibility();
		$this->img_bcp->setVisibility();
		$this->t_bcp1->setVisibility();
		$this->t_bcp2->setVisibility();
		$this->t_bcp3->setVisibility();
		$this->img_bbva->setVisibility();
		$this->t_bbva_1->setVisibility();
		$this->t_bbva_2->setVisibility();
		$this->t_bbva_3->setVisibility();
		$this->fa->setVisibility();
		$this->tw->setVisibility();
		$this->in->setVisibility();
		$this->go->setVisibility();
		$this->you->setVisibility();
		$this->correo_formulario->setVisibility();
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
					$this->terminate("contacolist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "contacolist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "contacoview.php")
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
		$this->img_bcp->Upload->Index = $CurrentForm->Index;
		$this->img_bcp->Upload->uploadFile();
		$this->img_bcp->CurrentValue = $this->img_bcp->Upload->FileName;
		$this->img_bbva->Upload->Index = $CurrentForm->Index;
		$this->img_bbva->Upload->uploadFile();
		$this->img_bbva->CurrentValue = $this->img_bbva->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->correo->CurrentValue = NULL;
		$this->correo->OldValue = $this->correo->CurrentValue;
		$this->direccion->CurrentValue = NULL;
		$this->direccion->OldValue = $this->direccion->CurrentValue;
		$this->tel1->CurrentValue = NULL;
		$this->tel1->OldValue = $this->tel1->CurrentValue;
		$this->tel2->CurrentValue = NULL;
		$this->tel2->OldValue = $this->tel2->CurrentValue;
		$this->tel3->CurrentValue = NULL;
		$this->tel3->OldValue = $this->tel3->CurrentValue;
		$this->tel4->CurrentValue = NULL;
		$this->tel4->OldValue = $this->tel4->CurrentValue;
		$this->tel5->CurrentValue = NULL;
		$this->tel5->OldValue = $this->tel5->CurrentValue;
		$this->horario->CurrentValue = NULL;
		$this->horario->OldValue = $this->horario->CurrentValue;
		$this->img_bcp->Upload->DbValue = NULL;
		$this->img_bcp->OldValue = $this->img_bcp->Upload->DbValue;
		$this->img_bcp->CurrentValue = NULL; // Clear file related field
		$this->t_bcp1->CurrentValue = NULL;
		$this->t_bcp1->OldValue = $this->t_bcp1->CurrentValue;
		$this->t_bcp2->CurrentValue = NULL;
		$this->t_bcp2->OldValue = $this->t_bcp2->CurrentValue;
		$this->t_bcp3->CurrentValue = NULL;
		$this->t_bcp3->OldValue = $this->t_bcp3->CurrentValue;
		$this->img_bbva->Upload->DbValue = NULL;
		$this->img_bbva->OldValue = $this->img_bbva->Upload->DbValue;
		$this->img_bbva->CurrentValue = NULL; // Clear file related field
		$this->t_bbva_1->CurrentValue = NULL;
		$this->t_bbva_1->OldValue = $this->t_bbva_1->CurrentValue;
		$this->t_bbva_2->CurrentValue = NULL;
		$this->t_bbva_2->OldValue = $this->t_bbva_2->CurrentValue;
		$this->t_bbva_3->CurrentValue = NULL;
		$this->t_bbva_3->OldValue = $this->t_bbva_3->CurrentValue;
		$this->fa->CurrentValue = NULL;
		$this->fa->OldValue = $this->fa->CurrentValue;
		$this->tw->CurrentValue = NULL;
		$this->tw->OldValue = $this->tw->CurrentValue;
		$this->in->CurrentValue = NULL;
		$this->in->OldValue = $this->in->CurrentValue;
		$this->go->CurrentValue = NULL;
		$this->go->OldValue = $this->go->CurrentValue;
		$this->you->CurrentValue = NULL;
		$this->you->OldValue = $this->you->CurrentValue;
		$this->correo_formulario->CurrentValue = NULL;
		$this->correo_formulario->OldValue = $this->correo_formulario->CurrentValue;
		$this->keywords->CurrentValue = NULL;
		$this->keywords->OldValue = $this->keywords->CurrentValue;
		$this->description->CurrentValue = NULL;
		$this->description->OldValue = $this->description->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'correo' first before field var 'x_correo'
		$val = $CurrentForm->hasValue("correo") ? $CurrentForm->getValue("correo") : $CurrentForm->getValue("x_correo");
		if (!$this->correo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->correo->Visible = FALSE; // Disable update for API request
			else
				$this->correo->setFormValue($val);
		}

		// Check field name 'direccion' first before field var 'x_direccion'
		$val = $CurrentForm->hasValue("direccion") ? $CurrentForm->getValue("direccion") : $CurrentForm->getValue("x_direccion");
		if (!$this->direccion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direccion->Visible = FALSE; // Disable update for API request
			else
				$this->direccion->setFormValue($val);
		}

		// Check field name 'tel1' first before field var 'x_tel1'
		$val = $CurrentForm->hasValue("tel1") ? $CurrentForm->getValue("tel1") : $CurrentForm->getValue("x_tel1");
		if (!$this->tel1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tel1->Visible = FALSE; // Disable update for API request
			else
				$this->tel1->setFormValue($val);
		}

		// Check field name 'tel2' first before field var 'x_tel2'
		$val = $CurrentForm->hasValue("tel2") ? $CurrentForm->getValue("tel2") : $CurrentForm->getValue("x_tel2");
		if (!$this->tel2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tel2->Visible = FALSE; // Disable update for API request
			else
				$this->tel2->setFormValue($val);
		}

		// Check field name 'tel3' first before field var 'x_tel3'
		$val = $CurrentForm->hasValue("tel3") ? $CurrentForm->getValue("tel3") : $CurrentForm->getValue("x_tel3");
		if (!$this->tel3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tel3->Visible = FALSE; // Disable update for API request
			else
				$this->tel3->setFormValue($val);
		}

		// Check field name 'tel4' first before field var 'x_tel4'
		$val = $CurrentForm->hasValue("tel4") ? $CurrentForm->getValue("tel4") : $CurrentForm->getValue("x_tel4");
		if (!$this->tel4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tel4->Visible = FALSE; // Disable update for API request
			else
				$this->tel4->setFormValue($val);
		}

		// Check field name 'tel5' first before field var 'x_tel5'
		$val = $CurrentForm->hasValue("tel5") ? $CurrentForm->getValue("tel5") : $CurrentForm->getValue("x_tel5");
		if (!$this->tel5->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tel5->Visible = FALSE; // Disable update for API request
			else
				$this->tel5->setFormValue($val);
		}

		// Check field name 'horario' first before field var 'x_horario'
		$val = $CurrentForm->hasValue("horario") ? $CurrentForm->getValue("horario") : $CurrentForm->getValue("x_horario");
		if (!$this->horario->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->horario->Visible = FALSE; // Disable update for API request
			else
				$this->horario->setFormValue($val);
		}

		// Check field name 't_bcp1' first before field var 'x_t_bcp1'
		$val = $CurrentForm->hasValue("t_bcp1") ? $CurrentForm->getValue("t_bcp1") : $CurrentForm->getValue("x_t_bcp1");
		if (!$this->t_bcp1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->t_bcp1->Visible = FALSE; // Disable update for API request
			else
				$this->t_bcp1->setFormValue($val);
		}

		// Check field name 't_bcp2' first before field var 'x_t_bcp2'
		$val = $CurrentForm->hasValue("t_bcp2") ? $CurrentForm->getValue("t_bcp2") : $CurrentForm->getValue("x_t_bcp2");
		if (!$this->t_bcp2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->t_bcp2->Visible = FALSE; // Disable update for API request
			else
				$this->t_bcp2->setFormValue($val);
		}

		// Check field name 't_bcp3' first before field var 'x_t_bcp3'
		$val = $CurrentForm->hasValue("t_bcp3") ? $CurrentForm->getValue("t_bcp3") : $CurrentForm->getValue("x_t_bcp3");
		if (!$this->t_bcp3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->t_bcp3->Visible = FALSE; // Disable update for API request
			else
				$this->t_bcp3->setFormValue($val);
		}

		// Check field name 't_bbva_1' first before field var 'x_t_bbva_1'
		$val = $CurrentForm->hasValue("t_bbva_1") ? $CurrentForm->getValue("t_bbva_1") : $CurrentForm->getValue("x_t_bbva_1");
		if (!$this->t_bbva_1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->t_bbva_1->Visible = FALSE; // Disable update for API request
			else
				$this->t_bbva_1->setFormValue($val);
		}

		// Check field name 't_bbva_2' first before field var 'x_t_bbva_2'
		$val = $CurrentForm->hasValue("t_bbva_2") ? $CurrentForm->getValue("t_bbva_2") : $CurrentForm->getValue("x_t_bbva_2");
		if (!$this->t_bbva_2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->t_bbva_2->Visible = FALSE; // Disable update for API request
			else
				$this->t_bbva_2->setFormValue($val);
		}

		// Check field name 't_bbva_3' first before field var 'x_t_bbva_3'
		$val = $CurrentForm->hasValue("t_bbva_3") ? $CurrentForm->getValue("t_bbva_3") : $CurrentForm->getValue("x_t_bbva_3");
		if (!$this->t_bbva_3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->t_bbva_3->Visible = FALSE; // Disable update for API request
			else
				$this->t_bbva_3->setFormValue($val);
		}

		// Check field name 'fa' first before field var 'x_fa'
		$val = $CurrentForm->hasValue("fa") ? $CurrentForm->getValue("fa") : $CurrentForm->getValue("x_fa");
		if (!$this->fa->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fa->Visible = FALSE; // Disable update for API request
			else
				$this->fa->setFormValue($val);
		}

		// Check field name 'tw' first before field var 'x_tw'
		$val = $CurrentForm->hasValue("tw") ? $CurrentForm->getValue("tw") : $CurrentForm->getValue("x_tw");
		if (!$this->tw->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tw->Visible = FALSE; // Disable update for API request
			else
				$this->tw->setFormValue($val);
		}

		// Check field name 'in' first before field var 'x_in'
		$val = $CurrentForm->hasValue("in") ? $CurrentForm->getValue("in") : $CurrentForm->getValue("x_in");
		if (!$this->in->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->in->Visible = FALSE; // Disable update for API request
			else
				$this->in->setFormValue($val);
		}

		// Check field name 'go' first before field var 'x_go'
		$val = $CurrentForm->hasValue("go") ? $CurrentForm->getValue("go") : $CurrentForm->getValue("x_go");
		if (!$this->go->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->go->Visible = FALSE; // Disable update for API request
			else
				$this->go->setFormValue($val);
		}

		// Check field name 'you' first before field var 'x_you'
		$val = $CurrentForm->hasValue("you") ? $CurrentForm->getValue("you") : $CurrentForm->getValue("x_you");
		if (!$this->you->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->you->Visible = FALSE; // Disable update for API request
			else
				$this->you->setFormValue($val);
		}

		// Check field name 'correo_formulario' first before field var 'x_correo_formulario'
		$val = $CurrentForm->hasValue("correo_formulario") ? $CurrentForm->getValue("correo_formulario") : $CurrentForm->getValue("x_correo_formulario");
		if (!$this->correo_formulario->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->correo_formulario->Visible = FALSE; // Disable update for API request
			else
				$this->correo_formulario->setFormValue($val);
		}

		// Check field name 'keywords' first before field var 'x_keywords'
		$val = $CurrentForm->hasValue("keywords") ? $CurrentForm->getValue("keywords") : $CurrentForm->getValue("x_keywords");
		if (!$this->keywords->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keywords->Visible = FALSE; // Disable update for API request
			else
				$this->keywords->setFormValue($val);
		}

		// Check field name 'description' first before field var 'x_description'
		$val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
		if (!$this->description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->description->Visible = FALSE; // Disable update for API request
			else
				$this->description->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->correo->CurrentValue = $this->correo->FormValue;
		$this->direccion->CurrentValue = $this->direccion->FormValue;
		$this->tel1->CurrentValue = $this->tel1->FormValue;
		$this->tel2->CurrentValue = $this->tel2->FormValue;
		$this->tel3->CurrentValue = $this->tel3->FormValue;
		$this->tel4->CurrentValue = $this->tel4->FormValue;
		$this->tel5->CurrentValue = $this->tel5->FormValue;
		$this->horario->CurrentValue = $this->horario->FormValue;
		$this->t_bcp1->CurrentValue = $this->t_bcp1->FormValue;
		$this->t_bcp2->CurrentValue = $this->t_bcp2->FormValue;
		$this->t_bcp3->CurrentValue = $this->t_bcp3->FormValue;
		$this->t_bbva_1->CurrentValue = $this->t_bbva_1->FormValue;
		$this->t_bbva_2->CurrentValue = $this->t_bbva_2->FormValue;
		$this->t_bbva_3->CurrentValue = $this->t_bbva_3->FormValue;
		$this->fa->CurrentValue = $this->fa->FormValue;
		$this->tw->CurrentValue = $this->tw->FormValue;
		$this->in->CurrentValue = $this->in->FormValue;
		$this->go->CurrentValue = $this->go->FormValue;
		$this->you->CurrentValue = $this->you->FormValue;
		$this->correo_formulario->CurrentValue = $this->correo_formulario->FormValue;
		$this->keywords->CurrentValue = $this->keywords->FormValue;
		$this->description->CurrentValue = $this->description->FormValue;
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
		$this->correo->setDbValue($row['correo']);
		$this->direccion->setDbValue($row['direccion']);
		$this->tel1->setDbValue($row['tel1']);
		$this->tel2->setDbValue($row['tel2']);
		$this->tel3->setDbValue($row['tel3']);
		$this->tel4->setDbValue($row['tel4']);
		$this->tel5->setDbValue($row['tel5']);
		$this->horario->setDbValue($row['horario']);
		$this->img_bcp->Upload->DbValue = $row['img_bcp'];
		$this->img_bcp->setDbValue($this->img_bcp->Upload->DbValue);
		$this->t_bcp1->setDbValue($row['t_bcp1']);
		$this->t_bcp2->setDbValue($row['t_bcp2']);
		$this->t_bcp3->setDbValue($row['t_bcp3']);
		$this->img_bbva->Upload->DbValue = $row['img_bbva'];
		$this->img_bbva->setDbValue($this->img_bbva->Upload->DbValue);
		$this->t_bbva_1->setDbValue($row['t_bbva_1']);
		$this->t_bbva_2->setDbValue($row['t_bbva_2']);
		$this->t_bbva_3->setDbValue($row['t_bbva_3']);
		$this->fa->setDbValue($row['fa']);
		$this->tw->setDbValue($row['tw']);
		$this->in->setDbValue($row['in']);
		$this->go->setDbValue($row['go']);
		$this->you->setDbValue($row['you']);
		$this->correo_formulario->setDbValue($row['correo_formulario']);
		$this->keywords->setDbValue($row['keywords']);
		$this->description->setDbValue($row['description']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['correo'] = $this->correo->CurrentValue;
		$row['direccion'] = $this->direccion->CurrentValue;
		$row['tel1'] = $this->tel1->CurrentValue;
		$row['tel2'] = $this->tel2->CurrentValue;
		$row['tel3'] = $this->tel3->CurrentValue;
		$row['tel4'] = $this->tel4->CurrentValue;
		$row['tel5'] = $this->tel5->CurrentValue;
		$row['horario'] = $this->horario->CurrentValue;
		$row['img_bcp'] = $this->img_bcp->Upload->DbValue;
		$row['t_bcp1'] = $this->t_bcp1->CurrentValue;
		$row['t_bcp2'] = $this->t_bcp2->CurrentValue;
		$row['t_bcp3'] = $this->t_bcp3->CurrentValue;
		$row['img_bbva'] = $this->img_bbva->Upload->DbValue;
		$row['t_bbva_1'] = $this->t_bbva_1->CurrentValue;
		$row['t_bbva_2'] = $this->t_bbva_2->CurrentValue;
		$row['t_bbva_3'] = $this->t_bbva_3->CurrentValue;
		$row['fa'] = $this->fa->CurrentValue;
		$row['tw'] = $this->tw->CurrentValue;
		$row['in'] = $this->in->CurrentValue;
		$row['go'] = $this->go->CurrentValue;
		$row['you'] = $this->you->CurrentValue;
		$row['correo_formulario'] = $this->correo_formulario->CurrentValue;
		$row['keywords'] = $this->keywords->CurrentValue;
		$row['description'] = $this->description->CurrentValue;
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// correo
			$this->correo->EditAttrs["class"] = "form-control";
			$this->correo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->correo->CurrentValue = HtmlDecode($this->correo->CurrentValue);
			$this->correo->EditValue = HtmlEncode($this->correo->CurrentValue);
			$this->correo->PlaceHolder = RemoveHtml($this->correo->caption());

			// direccion
			$this->direccion->EditAttrs["class"] = "form-control";
			$this->direccion->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direccion->CurrentValue = HtmlDecode($this->direccion->CurrentValue);
			$this->direccion->EditValue = HtmlEncode($this->direccion->CurrentValue);
			$this->direccion->PlaceHolder = RemoveHtml($this->direccion->caption());

			// tel1
			$this->tel1->EditAttrs["class"] = "form-control";
			$this->tel1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->tel1->CurrentValue = HtmlDecode($this->tel1->CurrentValue);
			$this->tel1->EditValue = HtmlEncode($this->tel1->CurrentValue);
			$this->tel1->PlaceHolder = RemoveHtml($this->tel1->caption());

			// tel2
			$this->tel2->EditAttrs["class"] = "form-control";
			$this->tel2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->tel2->CurrentValue = HtmlDecode($this->tel2->CurrentValue);
			$this->tel2->EditValue = HtmlEncode($this->tel2->CurrentValue);
			$this->tel2->PlaceHolder = RemoveHtml($this->tel2->caption());

			// tel3
			$this->tel3->EditAttrs["class"] = "form-control";
			$this->tel3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->tel3->CurrentValue = HtmlDecode($this->tel3->CurrentValue);
			$this->tel3->EditValue = HtmlEncode($this->tel3->CurrentValue);
			$this->tel3->PlaceHolder = RemoveHtml($this->tel3->caption());

			// tel4
			$this->tel4->EditAttrs["class"] = "form-control";
			$this->tel4->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->tel4->CurrentValue = HtmlDecode($this->tel4->CurrentValue);
			$this->tel4->EditValue = HtmlEncode($this->tel4->CurrentValue);
			$this->tel4->PlaceHolder = RemoveHtml($this->tel4->caption());

			// tel5
			$this->tel5->EditAttrs["class"] = "form-control";
			$this->tel5->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->tel5->CurrentValue = HtmlDecode($this->tel5->CurrentValue);
			$this->tel5->EditValue = HtmlEncode($this->tel5->CurrentValue);
			$this->tel5->PlaceHolder = RemoveHtml($this->tel5->caption());

			// horario
			$this->horario->EditAttrs["class"] = "form-control";
			$this->horario->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->horario->CurrentValue = HtmlDecode($this->horario->CurrentValue);
			$this->horario->EditValue = HtmlEncode($this->horario->CurrentValue);
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
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->img_bcp);

			// t_bcp1
			$this->t_bcp1->EditAttrs["class"] = "form-control";
			$this->t_bcp1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->t_bcp1->CurrentValue = HtmlDecode($this->t_bcp1->CurrentValue);
			$this->t_bcp1->EditValue = HtmlEncode($this->t_bcp1->CurrentValue);
			$this->t_bcp1->PlaceHolder = RemoveHtml($this->t_bcp1->caption());

			// t_bcp2
			$this->t_bcp2->EditAttrs["class"] = "form-control";
			$this->t_bcp2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->t_bcp2->CurrentValue = HtmlDecode($this->t_bcp2->CurrentValue);
			$this->t_bcp2->EditValue = HtmlEncode($this->t_bcp2->CurrentValue);
			$this->t_bcp2->PlaceHolder = RemoveHtml($this->t_bcp2->caption());

			// t_bcp3
			$this->t_bcp3->EditAttrs["class"] = "form-control";
			$this->t_bcp3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->t_bcp3->CurrentValue = HtmlDecode($this->t_bcp3->CurrentValue);
			$this->t_bcp3->EditValue = HtmlEncode($this->t_bcp3->CurrentValue);
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
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->img_bbva);

			// t_bbva_1
			$this->t_bbva_1->EditAttrs["class"] = "form-control";
			$this->t_bbva_1->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->t_bbva_1->CurrentValue = HtmlDecode($this->t_bbva_1->CurrentValue);
			$this->t_bbva_1->EditValue = HtmlEncode($this->t_bbva_1->CurrentValue);
			$this->t_bbva_1->PlaceHolder = RemoveHtml($this->t_bbva_1->caption());

			// t_bbva_2
			$this->t_bbva_2->EditAttrs["class"] = "form-control";
			$this->t_bbva_2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->t_bbva_2->CurrentValue = HtmlDecode($this->t_bbva_2->CurrentValue);
			$this->t_bbva_2->EditValue = HtmlEncode($this->t_bbva_2->CurrentValue);
			$this->t_bbva_2->PlaceHolder = RemoveHtml($this->t_bbva_2->caption());

			// t_bbva_3
			$this->t_bbva_3->EditAttrs["class"] = "form-control";
			$this->t_bbva_3->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->t_bbva_3->CurrentValue = HtmlDecode($this->t_bbva_3->CurrentValue);
			$this->t_bbva_3->EditValue = HtmlEncode($this->t_bbva_3->CurrentValue);
			$this->t_bbva_3->PlaceHolder = RemoveHtml($this->t_bbva_3->caption());

			// fa
			$this->fa->EditAttrs["class"] = "form-control";
			$this->fa->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->fa->CurrentValue = HtmlDecode($this->fa->CurrentValue);
			$this->fa->EditValue = HtmlEncode($this->fa->CurrentValue);
			$this->fa->PlaceHolder = RemoveHtml($this->fa->caption());

			// tw
			$this->tw->EditAttrs["class"] = "form-control";
			$this->tw->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->tw->CurrentValue = HtmlDecode($this->tw->CurrentValue);
			$this->tw->EditValue = HtmlEncode($this->tw->CurrentValue);
			$this->tw->PlaceHolder = RemoveHtml($this->tw->caption());

			// in
			$this->in->EditAttrs["class"] = "form-control";
			$this->in->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->in->CurrentValue = HtmlDecode($this->in->CurrentValue);
			$this->in->EditValue = HtmlEncode($this->in->CurrentValue);
			$this->in->PlaceHolder = RemoveHtml($this->in->caption());

			// go
			$this->go->EditAttrs["class"] = "form-control";
			$this->go->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->go->CurrentValue = HtmlDecode($this->go->CurrentValue);
			$this->go->EditValue = HtmlEncode($this->go->CurrentValue);
			$this->go->PlaceHolder = RemoveHtml($this->go->caption());

			// you
			$this->you->EditAttrs["class"] = "form-control";
			$this->you->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->you->CurrentValue = HtmlDecode($this->you->CurrentValue);
			$this->you->EditValue = HtmlEncode($this->you->CurrentValue);
			$this->you->PlaceHolder = RemoveHtml($this->you->caption());

			// correo_formulario
			$this->correo_formulario->EditAttrs["class"] = "form-control";
			$this->correo_formulario->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->correo_formulario->CurrentValue = HtmlDecode($this->correo_formulario->CurrentValue);
			$this->correo_formulario->EditValue = HtmlEncode($this->correo_formulario->CurrentValue);
			$this->correo_formulario->PlaceHolder = RemoveHtml($this->correo_formulario->caption());

			// keywords
			$this->keywords->EditAttrs["class"] = "form-control";
			$this->keywords->EditCustomAttributes = "";
			$this->keywords->EditValue = HtmlEncode($this->keywords->CurrentValue);
			$this->keywords->PlaceHolder = RemoveHtml($this->keywords->caption());

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = HtmlEncode($this->description->CurrentValue);
			$this->description->PlaceHolder = RemoveHtml($this->description->caption());

			// Add refer script
			// correo

			$this->correo->LinkCustomAttributes = "";
			$this->correo->HrefValue = "";

			// direccion
			$this->direccion->LinkCustomAttributes = "";
			$this->direccion->HrefValue = "";

			// tel1
			$this->tel1->LinkCustomAttributes = "";
			$this->tel1->HrefValue = "";

			// tel2
			$this->tel2->LinkCustomAttributes = "";
			$this->tel2->HrefValue = "";

			// tel3
			$this->tel3->LinkCustomAttributes = "";
			$this->tel3->HrefValue = "";

			// tel4
			$this->tel4->LinkCustomAttributes = "";
			$this->tel4->HrefValue = "";

			// tel5
			$this->tel5->LinkCustomAttributes = "";
			$this->tel5->HrefValue = "";

			// horario
			$this->horario->LinkCustomAttributes = "";
			$this->horario->HrefValue = "";

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

			// t_bcp1
			$this->t_bcp1->LinkCustomAttributes = "";
			$this->t_bcp1->HrefValue = "";

			// t_bcp2
			$this->t_bcp2->LinkCustomAttributes = "";
			$this->t_bcp2->HrefValue = "";

			// t_bcp3
			$this->t_bcp3->LinkCustomAttributes = "";
			$this->t_bcp3->HrefValue = "";

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

			// t_bbva_1
			$this->t_bbva_1->LinkCustomAttributes = "";
			$this->t_bbva_1->HrefValue = "";

			// t_bbva_2
			$this->t_bbva_2->LinkCustomAttributes = "";
			$this->t_bbva_2->HrefValue = "";

			// t_bbva_3
			$this->t_bbva_3->LinkCustomAttributes = "";
			$this->t_bbva_3->HrefValue = "";

			// fa
			$this->fa->LinkCustomAttributes = "";
			$this->fa->HrefValue = "";

			// tw
			$this->tw->LinkCustomAttributes = "";
			$this->tw->HrefValue = "";

			// in
			$this->in->LinkCustomAttributes = "";
			$this->in->HrefValue = "";

			// go
			$this->go->LinkCustomAttributes = "";
			$this->go->HrefValue = "";

			// you
			$this->you->LinkCustomAttributes = "";
			$this->you->HrefValue = "";

			// correo_formulario
			$this->correo_formulario->LinkCustomAttributes = "";
			$this->correo_formulario->HrefValue = "";

			// keywords
			$this->keywords->LinkCustomAttributes = "";
			$this->keywords->HrefValue = "";

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";
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
		if ($this->correo->Required) {
			if (!$this->correo->IsDetailKey && $this->correo->FormValue != NULL && $this->correo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->correo->caption(), $this->correo->RequiredErrorMessage));
			}
		}
		if ($this->direccion->Required) {
			if (!$this->direccion->IsDetailKey && $this->direccion->FormValue != NULL && $this->direccion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direccion->caption(), $this->direccion->RequiredErrorMessage));
			}
		}
		if ($this->tel1->Required) {
			if (!$this->tel1->IsDetailKey && $this->tel1->FormValue != NULL && $this->tel1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tel1->caption(), $this->tel1->RequiredErrorMessage));
			}
		}
		if ($this->tel2->Required) {
			if (!$this->tel2->IsDetailKey && $this->tel2->FormValue != NULL && $this->tel2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tel2->caption(), $this->tel2->RequiredErrorMessage));
			}
		}
		if ($this->tel3->Required) {
			if (!$this->tel3->IsDetailKey && $this->tel3->FormValue != NULL && $this->tel3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tel3->caption(), $this->tel3->RequiredErrorMessage));
			}
		}
		if ($this->tel4->Required) {
			if (!$this->tel4->IsDetailKey && $this->tel4->FormValue != NULL && $this->tel4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tel4->caption(), $this->tel4->RequiredErrorMessage));
			}
		}
		if ($this->tel5->Required) {
			if (!$this->tel5->IsDetailKey && $this->tel5->FormValue != NULL && $this->tel5->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tel5->caption(), $this->tel5->RequiredErrorMessage));
			}
		}
		if ($this->horario->Required) {
			if (!$this->horario->IsDetailKey && $this->horario->FormValue != NULL && $this->horario->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->horario->caption(), $this->horario->RequiredErrorMessage));
			}
		}
		if ($this->img_bcp->Required) {
			if ($this->img_bcp->Upload->FileName == "" && !$this->img_bcp->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img_bcp->caption(), $this->img_bcp->RequiredErrorMessage));
			}
		}
		if ($this->t_bcp1->Required) {
			if (!$this->t_bcp1->IsDetailKey && $this->t_bcp1->FormValue != NULL && $this->t_bcp1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->t_bcp1->caption(), $this->t_bcp1->RequiredErrorMessage));
			}
		}
		if ($this->t_bcp2->Required) {
			if (!$this->t_bcp2->IsDetailKey && $this->t_bcp2->FormValue != NULL && $this->t_bcp2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->t_bcp2->caption(), $this->t_bcp2->RequiredErrorMessage));
			}
		}
		if ($this->t_bcp3->Required) {
			if (!$this->t_bcp3->IsDetailKey && $this->t_bcp3->FormValue != NULL && $this->t_bcp3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->t_bcp3->caption(), $this->t_bcp3->RequiredErrorMessage));
			}
		}
		if ($this->img_bbva->Required) {
			if ($this->img_bbva->Upload->FileName == "" && !$this->img_bbva->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img_bbva->caption(), $this->img_bbva->RequiredErrorMessage));
			}
		}
		if ($this->t_bbva_1->Required) {
			if (!$this->t_bbva_1->IsDetailKey && $this->t_bbva_1->FormValue != NULL && $this->t_bbva_1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->t_bbva_1->caption(), $this->t_bbva_1->RequiredErrorMessage));
			}
		}
		if ($this->t_bbva_2->Required) {
			if (!$this->t_bbva_2->IsDetailKey && $this->t_bbva_2->FormValue != NULL && $this->t_bbva_2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->t_bbva_2->caption(), $this->t_bbva_2->RequiredErrorMessage));
			}
		}
		if ($this->t_bbva_3->Required) {
			if (!$this->t_bbva_3->IsDetailKey && $this->t_bbva_3->FormValue != NULL && $this->t_bbva_3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->t_bbva_3->caption(), $this->t_bbva_3->RequiredErrorMessage));
			}
		}
		if ($this->fa->Required) {
			if (!$this->fa->IsDetailKey && $this->fa->FormValue != NULL && $this->fa->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fa->caption(), $this->fa->RequiredErrorMessage));
			}
		}
		if ($this->tw->Required) {
			if (!$this->tw->IsDetailKey && $this->tw->FormValue != NULL && $this->tw->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tw->caption(), $this->tw->RequiredErrorMessage));
			}
		}
		if ($this->in->Required) {
			if (!$this->in->IsDetailKey && $this->in->FormValue != NULL && $this->in->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->in->caption(), $this->in->RequiredErrorMessage));
			}
		}
		if ($this->go->Required) {
			if (!$this->go->IsDetailKey && $this->go->FormValue != NULL && $this->go->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->go->caption(), $this->go->RequiredErrorMessage));
			}
		}
		if ($this->you->Required) {
			if (!$this->you->IsDetailKey && $this->you->FormValue != NULL && $this->you->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->you->caption(), $this->you->RequiredErrorMessage));
			}
		}
		if ($this->correo_formulario->Required) {
			if (!$this->correo_formulario->IsDetailKey && $this->correo_formulario->FormValue != NULL && $this->correo_formulario->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->correo_formulario->caption(), $this->correo_formulario->RequiredErrorMessage));
			}
		}
		if ($this->keywords->Required) {
			if (!$this->keywords->IsDetailKey && $this->keywords->FormValue != NULL && $this->keywords->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keywords->caption(), $this->keywords->RequiredErrorMessage));
			}
		}
		if ($this->description->Required) {
			if (!$this->description->IsDetailKey && $this->description->FormValue != NULL && $this->description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
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

		// correo
		$this->correo->setDbValueDef($rsnew, $this->correo->CurrentValue, NULL, FALSE);

		// direccion
		$this->direccion->setDbValueDef($rsnew, $this->direccion->CurrentValue, NULL, FALSE);

		// tel1
		$this->tel1->setDbValueDef($rsnew, $this->tel1->CurrentValue, NULL, FALSE);

		// tel2
		$this->tel2->setDbValueDef($rsnew, $this->tel2->CurrentValue, NULL, FALSE);

		// tel3
		$this->tel3->setDbValueDef($rsnew, $this->tel3->CurrentValue, NULL, FALSE);

		// tel4
		$this->tel4->setDbValueDef($rsnew, $this->tel4->CurrentValue, NULL, FALSE);

		// tel5
		$this->tel5->setDbValueDef($rsnew, $this->tel5->CurrentValue, NULL, FALSE);

		// horario
		$this->horario->setDbValueDef($rsnew, $this->horario->CurrentValue, NULL, FALSE);

		// img_bcp
		if ($this->img_bcp->Visible && !$this->img_bcp->Upload->KeepFile) {
			$this->img_bcp->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_bcp->Upload->FileName == "") {
				$rsnew['img_bcp'] = NULL;
			} else {
				$rsnew['img_bcp'] = $this->img_bcp->Upload->FileName;
			}
		}

		// t_bcp1
		$this->t_bcp1->setDbValueDef($rsnew, $this->t_bcp1->CurrentValue, NULL, FALSE);

		// t_bcp2
		$this->t_bcp2->setDbValueDef($rsnew, $this->t_bcp2->CurrentValue, NULL, FALSE);

		// t_bcp3
		$this->t_bcp3->setDbValueDef($rsnew, $this->t_bcp3->CurrentValue, NULL, FALSE);

		// img_bbva
		if ($this->img_bbva->Visible && !$this->img_bbva->Upload->KeepFile) {
			$this->img_bbva->Upload->DbValue = ""; // No need to delete old file
			if ($this->img_bbva->Upload->FileName == "") {
				$rsnew['img_bbva'] = NULL;
			} else {
				$rsnew['img_bbva'] = $this->img_bbva->Upload->FileName;
			}
		}

		// t_bbva_1
		$this->t_bbva_1->setDbValueDef($rsnew, $this->t_bbva_1->CurrentValue, NULL, FALSE);

		// t_bbva_2
		$this->t_bbva_2->setDbValueDef($rsnew, $this->t_bbva_2->CurrentValue, NULL, FALSE);

		// t_bbva_3
		$this->t_bbva_3->setDbValueDef($rsnew, $this->t_bbva_3->CurrentValue, NULL, FALSE);

		// fa
		$this->fa->setDbValueDef($rsnew, $this->fa->CurrentValue, NULL, FALSE);

		// tw
		$this->tw->setDbValueDef($rsnew, $this->tw->CurrentValue, NULL, FALSE);

		// in
		$this->in->setDbValueDef($rsnew, $this->in->CurrentValue, NULL, FALSE);

		// go
		$this->go->setDbValueDef($rsnew, $this->go->CurrentValue, NULL, FALSE);

		// you
		$this->you->setDbValueDef($rsnew, $this->you->CurrentValue, NULL, FALSE);

		// correo_formulario
		$this->correo_formulario->setDbValueDef($rsnew, $this->correo_formulario->CurrentValue, NULL, FALSE);

		// keywords
		$this->keywords->setDbValueDef($rsnew, $this->keywords->CurrentValue, NULL, FALSE);

		// description
		$this->description->setDbValueDef($rsnew, $this->description->CurrentValue, NULL, FALSE);
		if ($this->img_bcp->Visible && !$this->img_bcp->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->img_bcp->Upload->DbValue) ? array() : array($this->img_bcp->Upload->DbValue);
			if (!EmptyValue($this->img_bcp->Upload->FileName)) {
				$newFiles = array($this->img_bcp->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->img_bcp, $this->img_bcp->Upload->Index) . $file)) {
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
							$file1 = UniqueFilename($this->img_bcp->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->img_bcp, $this->img_bcp->Upload->Index) . $file1) || file_exists($this->img_bcp->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->img_bcp->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->img_bcp, $this->img_bcp->Upload->Index) . $file, UploadTempPath($this->img_bcp, $this->img_bcp->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_bcp->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->img_bcp->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->img_bcp->setDbValueDef($rsnew, $this->img_bcp->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->img_bbva->Visible && !$this->img_bbva->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->img_bbva->Upload->DbValue) ? array() : array($this->img_bbva->Upload->DbValue);
			if (!EmptyValue($this->img_bbva->Upload->FileName)) {
				$newFiles = array($this->img_bbva->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->img_bbva, $this->img_bbva->Upload->Index) . $file)) {
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
							$file1 = UniqueFilename($this->img_bbva->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->img_bbva, $this->img_bbva->Upload->Index) . $file1) || file_exists($this->img_bbva->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->img_bbva->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->img_bbva, $this->img_bbva->Upload->Index) . $file, UploadTempPath($this->img_bbva, $this->img_bbva->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->img_bbva->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->img_bbva->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->img_bbva->setDbValueDef($rsnew, $this->img_bbva->Upload->FileName, NULL, FALSE);
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
				if ($this->img_bcp->Visible && !$this->img_bcp->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->img_bcp->Upload->DbValue) ? array() : array($this->img_bcp->Upload->DbValue);
					if (!EmptyValue($this->img_bcp->Upload->FileName)) {
						$newFiles = array($this->img_bcp->Upload->FileName);
						$newFiles2 = array($rsnew['img_bcp']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->img_bcp, $this->img_bcp->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->img_bcp->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->img_bcp->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->img_bbva->Visible && !$this->img_bbva->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->img_bbva->Upload->DbValue) ? array() : array($this->img_bbva->Upload->DbValue);
					if (!EmptyValue($this->img_bbva->Upload->FileName)) {
						$newFiles = array($this->img_bbva->Upload->FileName);
						$newFiles2 = array($rsnew['img_bbva']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->img_bbva, $this->img_bbva->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->img_bbva->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->img_bbva->oldPhysicalUploadPath() . $oldFile);
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

		// img_bcp
		if ($this->img_bcp->Upload->FileToken <> "")
			CleanUploadTempPath($this->img_bcp->Upload->FileToken, $this->img_bcp->Upload->Index);
		else
			CleanUploadTempPath($this->img_bcp, $this->img_bcp->Upload->Index);

		// img_bbva
		if ($this->img_bbva->Upload->FileToken <> "")
			CleanUploadTempPath($this->img_bbva->Upload->FileToken, $this->img_bbva->Upload->Index);
		else
			CleanUploadTempPath($this->img_bbva, $this->img_bbva->Upload->Index);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("contacolist.php"), "", $this->TableVar, TRUE);
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