<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class productos_edit extends productos
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}";

	// Table name
	public $TableName = 'productos';

	// Page object name
	public $PageObjName = "productos_edit";

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
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (categorias)
		if (!isset($GLOBALS['categorias']))
			$GLOBALS['categorias'] = new categorias();

		// Table object (usuario)
		if (!isset($GLOBALS['usuario']))
			$GLOBALS['usuario'] = new usuario();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("productoslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
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
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_id")) {
				$this->id->setFormValue($CurrentForm->getValue("x_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
			}
		}

		// Set up master detail parameters
		$this->setupMasterParms();

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("productoslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "productoslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
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

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->img1->Upload->Index = $CurrentForm->Index;
		$this->img1->Upload->uploadFile();
		$this->img1->CurrentValue = $this->img1->Upload->FileName;
		$this->img2->Upload->Index = $CurrentForm->Index;
		$this->img2->Upload->uploadFile();
		$this->img2->CurrentValue = $this->img2->Upload->FileName;
		$this->img3->Upload->Index = $CurrentForm->Index;
		$this->img3->Upload->uploadFile();
		$this->img3->CurrentValue = $this->img3->Upload->FileName;
		$this->img4->Upload->Index = $CurrentForm->Index;
		$this->img4->Upload->uploadFile();
		$this->img4->CurrentValue = $this->img4->Upload->FileName;
		$this->img5->Upload->Index = $CurrentForm->Index;
		$this->img5->Upload->uploadFile();
		$this->img5->CurrentValue = $this->img5->Upload->FileName;
		$this->img6->Upload->Index = $CurrentForm->Index;
		$this->img6->Upload->uploadFile();
		$this->img6->CurrentValue = $this->img6->Upload->FileName;
		$this->img7->Upload->Index = $CurrentForm->Index;
		$this->img7->Upload->uploadFile();
		$this->img7->CurrentValue = $this->img7->Upload->FileName;
		$this->img8->Upload->Index = $CurrentForm->Index;
		$this->img8->Upload->uploadFile();
		$this->img8->CurrentValue = $this->img8->Upload->FileName;
		$this->img9->Upload->Index = $CurrentForm->Index;
		$this->img9->Upload->uploadFile();
		$this->img9->CurrentValue = $this->img9->Upload->FileName;
		$this->ficha_tecnica->Upload->Index = $CurrentForm->Index;
		$this->ficha_tecnica->Upload->uploadFile();
		$this->ficha_tecnica->CurrentValue = $this->ficha_tecnica->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'titulo' first before field var 'x_titulo'
		$val = $CurrentForm->hasValue("titulo") ? $CurrentForm->getValue("titulo") : $CurrentForm->getValue("x_titulo");
		if (!$this->titulo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->titulo->Visible = FALSE; // Disable update for API request
			else
				$this->titulo->setFormValue($val);
		}

		// Check field name 'detalle' first before field var 'x_detalle'
		$val = $CurrentForm->hasValue("detalle") ? $CurrentForm->getValue("detalle") : $CurrentForm->getValue("x_detalle");
		if (!$this->detalle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->detalle->Visible = FALSE; // Disable update for API request
			else
				$this->detalle->setFormValue($val);
		}

		// Check field name 'destacado_inicio' first before field var 'x_destacado_inicio'
		$val = $CurrentForm->hasValue("destacado_inicio") ? $CurrentForm->getValue("destacado_inicio") : $CurrentForm->getValue("x_destacado_inicio");
		if (!$this->destacado_inicio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->destacado_inicio->Visible = FALSE; // Disable update for API request
			else
				$this->destacado_inicio->setFormValue($val);
		}

		// Check field name 'destacado_footer' first before field var 'x_destacado_footer'
		$val = $CurrentForm->hasValue("destacado_footer") ? $CurrentForm->getValue("destacado_footer") : $CurrentForm->getValue("x_destacado_footer");
		if (!$this->destacado_footer->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->destacado_footer->Visible = FALSE; // Disable update for API request
			else
				$this->destacado_footer->setFormValue($val);
		}

		// Check field name 'destacado_productos' first before field var 'x_destacado_productos'
		$val = $CurrentForm->hasValue("destacado_productos") ? $CurrentForm->getValue("destacado_productos") : $CurrentForm->getValue("x_destacado_productos");
		if (!$this->destacado_productos->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->destacado_productos->Visible = FALSE; // Disable update for API request
			else
				$this->destacado_productos->setFormValue($val);
		}

		// Check field name 'id_cate' first before field var 'x_id_cate'
		$val = $CurrentForm->hasValue("id_cate") ? $CurrentForm->getValue("id_cate") : $CurrentForm->getValue("x_id_cate");
		if (!$this->id_cate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_cate->Visible = FALSE; // Disable update for API request
			else
				$this->id_cate->setFormValue($val);
		}

		// Check field name 'img_principal' first before field var 'x_img_principal'
		$val = $CurrentForm->hasValue("img_principal") ? $CurrentForm->getValue("img_principal") : $CurrentForm->getValue("x_img_principal");
		if (!$this->img_principal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->img_principal->Visible = FALSE; // Disable update for API request
			else
				$this->img_principal->setFormValue($val);
		}

		// Check field name 'url' first before field var 'x_url'
		$val = $CurrentForm->hasValue("url") ? $CurrentForm->getValue("url") : $CurrentForm->getValue("x_url");
		if (!$this->url->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->url->Visible = FALSE; // Disable update for API request
			else
				$this->url->setFormValue($val);
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
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->titulo->CurrentValue = $this->titulo->FormValue;
		$this->detalle->CurrentValue = $this->detalle->FormValue;
		$this->destacado_inicio->CurrentValue = $this->destacado_inicio->FormValue;
		$this->destacado_footer->CurrentValue = $this->destacado_footer->FormValue;
		$this->destacado_productos->CurrentValue = $this->destacado_productos->FormValue;
		$this->id_cate->CurrentValue = $this->id_cate->FormValue;
		$this->url->CurrentValue = $this->url->FormValue;
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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// titulo
			$this->titulo->EditAttrs["class"] = "form-control";
			$this->titulo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->titulo->CurrentValue = HtmlDecode($this->titulo->CurrentValue);
			$this->titulo->EditValue = HtmlEncode($this->titulo->CurrentValue);
			$this->titulo->PlaceHolder = RemoveHtml($this->titulo->caption());

			// detalle
			$this->detalle->EditAttrs["class"] = "form-control";
			$this->detalle->EditCustomAttributes = "";
			$this->detalle->EditValue = HtmlEncode($this->detalle->CurrentValue);
			$this->detalle->PlaceHolder = RemoveHtml($this->detalle->caption());

			// img1
			$this->img1->EditAttrs["class"] = "form-control";
			$this->img1->EditCustomAttributes = "";
			if (!EmptyValue($this->img1->Upload->DbValue)) {
				$this->img1->ImageWidth = 50;
				$this->img1->ImageHeight = 50;
				$this->img1->ImageAlt = $this->img1->alt();
				$this->img1->EditValue = $this->img1->Upload->DbValue;
			} else {
				$this->img1->EditValue = "";
			}
			if (!EmptyValue($this->img1->CurrentValue))
					$this->img1->Upload->FileName = $this->img1->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img1);

			// img2
			$this->img2->EditAttrs["class"] = "form-control";
			$this->img2->EditCustomAttributes = "";
			if (!EmptyValue($this->img2->Upload->DbValue)) {
				$this->img2->ImageWidth = 50;
				$this->img2->ImageHeight = 50;
				$this->img2->ImageAlt = $this->img2->alt();
				$this->img2->EditValue = $this->img2->Upload->DbValue;
			} else {
				$this->img2->EditValue = "";
			}
			if (!EmptyValue($this->img2->CurrentValue))
					$this->img2->Upload->FileName = $this->img2->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img2);

			// img3
			$this->img3->EditAttrs["class"] = "form-control";
			$this->img3->EditCustomAttributes = "";
			if (!EmptyValue($this->img3->Upload->DbValue)) {
				$this->img3->ImageWidth = 50;
				$this->img3->ImageHeight = 50;
				$this->img3->ImageAlt = $this->img3->alt();
				$this->img3->EditValue = $this->img3->Upload->DbValue;
			} else {
				$this->img3->EditValue = "";
			}
			if (!EmptyValue($this->img3->CurrentValue))
					$this->img3->Upload->FileName = $this->img3->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img3);

			// img4
			$this->img4->EditAttrs["class"] = "form-control";
			$this->img4->EditCustomAttributes = "";
			if (!EmptyValue($this->img4->Upload->DbValue)) {
				$this->img4->ImageWidth = 50;
				$this->img4->ImageHeight = 50;
				$this->img4->ImageAlt = $this->img4->alt();
				$this->img4->EditValue = $this->img4->Upload->DbValue;
			} else {
				$this->img4->EditValue = "";
			}
			if (!EmptyValue($this->img4->CurrentValue))
					$this->img4->Upload->FileName = $this->img4->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img4);

			// img5
			$this->img5->EditAttrs["class"] = "form-control";
			$this->img5->EditCustomAttributes = "";
			if (!EmptyValue($this->img5->Upload->DbValue)) {
				$this->img5->ImageWidth = 50;
				$this->img5->ImageHeight = 50;
				$this->img5->ImageAlt = $this->img5->alt();
				$this->img5->EditValue = $this->img5->Upload->DbValue;
			} else {
				$this->img5->EditValue = "";
			}
			if (!EmptyValue($this->img5->CurrentValue))
					$this->img5->Upload->FileName = $this->img5->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img5);

			// img6
			$this->img6->EditAttrs["class"] = "form-control";
			$this->img6->EditCustomAttributes = "";
			if (!EmptyValue($this->img6->Upload->DbValue)) {
				$this->img6->ImageWidth = 50;
				$this->img6->ImageHeight = 50;
				$this->img6->ImageAlt = $this->img6->alt();
				$this->img6->EditValue = $this->img6->Upload->DbValue;
			} else {
				$this->img6->EditValue = "";
			}
			if (!EmptyValue($this->img6->CurrentValue))
					$this->img6->Upload->FileName = $this->img6->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img6);

			// img7
			$this->img7->EditAttrs["class"] = "form-control";
			$this->img7->EditCustomAttributes = "";
			if (!EmptyValue($this->img7->Upload->DbValue)) {
				$this->img7->ImageWidth = 50;
				$this->img7->ImageHeight = 50;
				$this->img7->ImageAlt = $this->img7->alt();
				$this->img7->EditValue = $this->img7->Upload->DbValue;
			} else {
				$this->img7->EditValue = "";
			}
			if (!EmptyValue($this->img7->CurrentValue))
					$this->img7->Upload->FileName = $this->img7->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img7);

			// img8
			$this->img8->EditAttrs["class"] = "form-control";
			$this->img8->EditCustomAttributes = "";
			if (!EmptyValue($this->img8->Upload->DbValue)) {
				$this->img8->ImageWidth = 50;
				$this->img8->ImageHeight = 50;
				$this->img8->ImageAlt = $this->img8->alt();
				$this->img8->EditValue = $this->img8->Upload->DbValue;
			} else {
				$this->img8->EditValue = "";
			}
			if (!EmptyValue($this->img8->CurrentValue))
					$this->img8->Upload->FileName = $this->img8->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img8);

			// img9
			$this->img9->EditAttrs["class"] = "form-control";
			$this->img9->EditCustomAttributes = "";
			if (!EmptyValue($this->img9->Upload->DbValue)) {
				$this->img9->ImageWidth = 50;
				$this->img9->ImageHeight = 50;
				$this->img9->ImageAlt = $this->img9->alt();
				$this->img9->EditValue = $this->img9->Upload->DbValue;
			} else {
				$this->img9->EditValue = "";
			}
			if (!EmptyValue($this->img9->CurrentValue))
					$this->img9->Upload->FileName = $this->img9->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->img9);

			// destacado_inicio
			$this->destacado_inicio->EditCustomAttributes = "";
			$this->destacado_inicio->EditValue = $this->destacado_inicio->options(FALSE);

			// destacado_footer
			$this->destacado_footer->EditCustomAttributes = "";
			$this->destacado_footer->EditValue = $this->destacado_footer->options(FALSE);

			// destacado_productos
			$this->destacado_productos->EditCustomAttributes = "";
			$this->destacado_productos->EditValue = $this->destacado_productos->options(FALSE);

			// id_cate
			$this->id_cate->EditAttrs["class"] = "form-control";
			$this->id_cate->EditCustomAttributes = "";
			if ($this->id_cate->getSessionValue() <> "") {
				$this->id_cate->CurrentValue = $this->id_cate->getSessionValue();
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
			} else {
			$curVal = trim(strval($this->id_cate->CurrentValue));
			if ($curVal <> "")
				$this->id_cate->ViewValue = $this->id_cate->lookupCacheOption($curVal);
			else
				$this->id_cate->ViewValue = $this->id_cate->Lookup !== NULL && is_array($this->id_cate->Lookup->Options) ? $curVal : NULL;
			if ($this->id_cate->ViewValue !== NULL) { // Load from cache
				$this->id_cate->EditValue = array_values($this->id_cate->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->id_cate->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_cate->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->id_cate->EditValue = $arwrk;
			}
			}

			// ficha_tecnica
			$this->ficha_tecnica->EditAttrs["class"] = "form-control";
			$this->ficha_tecnica->EditCustomAttributes = "";
			if (!EmptyValue($this->ficha_tecnica->Upload->DbValue)) {
				$this->ficha_tecnica->EditValue = $this->ficha_tecnica->Upload->DbValue;
			} else {
				$this->ficha_tecnica->EditValue = "";
			}
			if (!EmptyValue($this->ficha_tecnica->CurrentValue))
					$this->ficha_tecnica->Upload->FileName = $this->ficha_tecnica->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->ficha_tecnica);

			// img_principal
			$this->img_principal->EditAttrs["class"] = "form-control";
			$this->img_principal->EditCustomAttributes = "";
			$this->img_principal->EditValue = $this->img_principal->options(TRUE);

			// url
			$this->url->EditAttrs["class"] = "form-control";
			$this->url->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->url->CurrentValue = HtmlDecode($this->url->CurrentValue);
			$this->url->EditValue = HtmlEncode($this->url->CurrentValue);
			$this->url->PlaceHolder = RemoveHtml($this->url->caption());

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

			// Edit refer script
			// titulo

			$this->titulo->LinkCustomAttributes = "";
			$this->titulo->HrefValue = "";

			// detalle
			$this->detalle->LinkCustomAttributes = "";
			$this->detalle->HrefValue = "";

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

			// destacado_inicio
			$this->destacado_inicio->LinkCustomAttributes = "";
			$this->destacado_inicio->HrefValue = "";

			// destacado_footer
			$this->destacado_footer->LinkCustomAttributes = "";
			$this->destacado_footer->HrefValue = "";

			// destacado_productos
			$this->destacado_productos->LinkCustomAttributes = "";
			$this->destacado_productos->HrefValue = "";

			// id_cate
			$this->id_cate->LinkCustomAttributes = "";
			$this->id_cate->HrefValue = "";

			// ficha_tecnica
			$this->ficha_tecnica->LinkCustomAttributes = "";
			$this->ficha_tecnica->HrefValue = "";
			$this->ficha_tecnica->ExportHrefValue = $this->ficha_tecnica->UploadPath . $this->ficha_tecnica->Upload->DbValue;

			// img_principal
			$this->img_principal->LinkCustomAttributes = "";
			$this->img_principal->HrefValue = "";

			// url
			$this->url->LinkCustomAttributes = "";
			$this->url->HrefValue = "";

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
		if ($this->titulo->Required) {
			if (!$this->titulo->IsDetailKey && $this->titulo->FormValue != NULL && $this->titulo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->titulo->caption(), $this->titulo->RequiredErrorMessage));
			}
		}
		if ($this->detalle->Required) {
			if (!$this->detalle->IsDetailKey && $this->detalle->FormValue != NULL && $this->detalle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->detalle->caption(), $this->detalle->RequiredErrorMessage));
			}
		}
		if ($this->img1->Required) {
			if ($this->img1->Upload->FileName == "" && !$this->img1->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img1->caption(), $this->img1->RequiredErrorMessage));
			}
		}
		if ($this->img2->Required) {
			if ($this->img2->Upload->FileName == "" && !$this->img2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img2->caption(), $this->img2->RequiredErrorMessage));
			}
		}
		if ($this->img3->Required) {
			if ($this->img3->Upload->FileName == "" && !$this->img3->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img3->caption(), $this->img3->RequiredErrorMessage));
			}
		}
		if ($this->img4->Required) {
			if ($this->img4->Upload->FileName == "" && !$this->img4->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img4->caption(), $this->img4->RequiredErrorMessage));
			}
		}
		if ($this->img5->Required) {
			if ($this->img5->Upload->FileName == "" && !$this->img5->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img5->caption(), $this->img5->RequiredErrorMessage));
			}
		}
		if ($this->img6->Required) {
			if ($this->img6->Upload->FileName == "" && !$this->img6->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img6->caption(), $this->img6->RequiredErrorMessage));
			}
		}
		if ($this->img7->Required) {
			if ($this->img7->Upload->FileName == "" && !$this->img7->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img7->caption(), $this->img7->RequiredErrorMessage));
			}
		}
		if ($this->img8->Required) {
			if ($this->img8->Upload->FileName == "" && !$this->img8->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img8->caption(), $this->img8->RequiredErrorMessage));
			}
		}
		if ($this->img9->Required) {
			if ($this->img9->Upload->FileName == "" && !$this->img9->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->img9->caption(), $this->img9->RequiredErrorMessage));
			}
		}
		if ($this->destacado_inicio->Required) {
			if ($this->destacado_inicio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->destacado_inicio->caption(), $this->destacado_inicio->RequiredErrorMessage));
			}
		}
		if ($this->destacado_footer->Required) {
			if ($this->destacado_footer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->destacado_footer->caption(), $this->destacado_footer->RequiredErrorMessage));
			}
		}
		if ($this->destacado_productos->Required) {
			if ($this->destacado_productos->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->destacado_productos->caption(), $this->destacado_productos->RequiredErrorMessage));
			}
		}
		if ($this->id_cate->Required) {
			if (!$this->id_cate->IsDetailKey && $this->id_cate->FormValue != NULL && $this->id_cate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_cate->caption(), $this->id_cate->RequiredErrorMessage));
			}
		}
		if ($this->ficha_tecnica->Required) {
			if ($this->ficha_tecnica->Upload->FileName == "" && !$this->ficha_tecnica->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->ficha_tecnica->caption(), $this->ficha_tecnica->RequiredErrorMessage));
			}
		}
		if ($this->img_principal->Required) {
			if (!$this->img_principal->IsDetailKey && $this->img_principal->FormValue != NULL && $this->img_principal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->img_principal->caption(), $this->img_principal->RequiredErrorMessage));
			}
		}
		if ($this->url->Required) {
			if (!$this->url->IsDetailKey && $this->url->FormValue != NULL && $this->url->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->url->caption(), $this->url->RequiredErrorMessage));
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// titulo
			$this->titulo->setDbValueDef($rsnew, $this->titulo->CurrentValue, NULL, $this->titulo->ReadOnly);

			// detalle
			$this->detalle->setDbValueDef($rsnew, $this->detalle->CurrentValue, NULL, $this->detalle->ReadOnly);

			// img1
			if ($this->img1->Visible && !$this->img1->ReadOnly && !$this->img1->Upload->KeepFile) {
				$this->img1->Upload->DbValue = $rsold['img1']; // Get original value
				if ($this->img1->Upload->FileName == "") {
					$rsnew['img1'] = NULL;
				} else {
					$rsnew['img1'] = $this->img1->Upload->FileName;
				}
			}

			// img2
			if ($this->img2->Visible && !$this->img2->ReadOnly && !$this->img2->Upload->KeepFile) {
				$this->img2->Upload->DbValue = $rsold['img2']; // Get original value
				if ($this->img2->Upload->FileName == "") {
					$rsnew['img2'] = NULL;
				} else {
					$rsnew['img2'] = $this->img2->Upload->FileName;
				}
			}

			// img3
			if ($this->img3->Visible && !$this->img3->ReadOnly && !$this->img3->Upload->KeepFile) {
				$this->img3->Upload->DbValue = $rsold['img3']; // Get original value
				if ($this->img3->Upload->FileName == "") {
					$rsnew['img3'] = NULL;
				} else {
					$rsnew['img3'] = $this->img3->Upload->FileName;
				}
			}

			// img4
			if ($this->img4->Visible && !$this->img4->ReadOnly && !$this->img4->Upload->KeepFile) {
				$this->img4->Upload->DbValue = $rsold['img4']; // Get original value
				if ($this->img4->Upload->FileName == "") {
					$rsnew['img4'] = NULL;
				} else {
					$rsnew['img4'] = $this->img4->Upload->FileName;
				}
			}

			// img5
			if ($this->img5->Visible && !$this->img5->ReadOnly && !$this->img5->Upload->KeepFile) {
				$this->img5->Upload->DbValue = $rsold['img5']; // Get original value
				if ($this->img5->Upload->FileName == "") {
					$rsnew['img5'] = NULL;
				} else {
					$rsnew['img5'] = $this->img5->Upload->FileName;
				}
			}

			// img6
			if ($this->img6->Visible && !$this->img6->ReadOnly && !$this->img6->Upload->KeepFile) {
				$this->img6->Upload->DbValue = $rsold['img6']; // Get original value
				if ($this->img6->Upload->FileName == "") {
					$rsnew['img6'] = NULL;
				} else {
					$rsnew['img6'] = $this->img6->Upload->FileName;
				}
			}

			// img7
			if ($this->img7->Visible && !$this->img7->ReadOnly && !$this->img7->Upload->KeepFile) {
				$this->img7->Upload->DbValue = $rsold['img7']; // Get original value
				if ($this->img7->Upload->FileName == "") {
					$rsnew['img7'] = NULL;
				} else {
					$rsnew['img7'] = $this->img7->Upload->FileName;
				}
			}

			// img8
			if ($this->img8->Visible && !$this->img8->ReadOnly && !$this->img8->Upload->KeepFile) {
				$this->img8->Upload->DbValue = $rsold['img8']; // Get original value
				if ($this->img8->Upload->FileName == "") {
					$rsnew['img8'] = NULL;
				} else {
					$rsnew['img8'] = $this->img8->Upload->FileName;
				}
			}

			// img9
			if ($this->img9->Visible && !$this->img9->ReadOnly && !$this->img9->Upload->KeepFile) {
				$this->img9->Upload->DbValue = $rsold['img9']; // Get original value
				if ($this->img9->Upload->FileName == "") {
					$rsnew['img9'] = NULL;
				} else {
					$rsnew['img9'] = $this->img9->Upload->FileName;
				}
			}

			// destacado_inicio
			$this->destacado_inicio->setDbValueDef($rsnew, $this->destacado_inicio->CurrentValue, NULL, $this->destacado_inicio->ReadOnly);

			// destacado_footer
			$this->destacado_footer->setDbValueDef($rsnew, $this->destacado_footer->CurrentValue, NULL, $this->destacado_footer->ReadOnly);

			// destacado_productos
			$this->destacado_productos->setDbValueDef($rsnew, $this->destacado_productos->CurrentValue, "", $this->destacado_productos->ReadOnly);

			// id_cate
			$this->id_cate->setDbValueDef($rsnew, $this->id_cate->CurrentValue, NULL, $this->id_cate->ReadOnly);

			// ficha_tecnica
			if ($this->ficha_tecnica->Visible && !$this->ficha_tecnica->ReadOnly && !$this->ficha_tecnica->Upload->KeepFile) {
				$this->ficha_tecnica->Upload->DbValue = $rsold['ficha_tecnica']; // Get original value
				if ($this->ficha_tecnica->Upload->FileName == "") {
					$rsnew['ficha_tecnica'] = NULL;
				} else {
					$rsnew['ficha_tecnica'] = $this->ficha_tecnica->Upload->FileName;
				}
			}

			// img_principal
			// url

			$this->url->setDbValueDef($rsnew, $this->url->CurrentValue, NULL, $this->url->ReadOnly);

			// keywords
			$this->keywords->setDbValueDef($rsnew, $this->keywords->CurrentValue, NULL, $this->keywords->ReadOnly);

			// description
			$this->description->setDbValueDef($rsnew, $this->description->CurrentValue, NULL, $this->description->ReadOnly);

			// Check referential integrity for master table 'categorias'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_categorias();
			$keyValue = isset($rsnew['id_cate']) ? $rsnew['id_cate'] : $rsold['id_cate'];
			if (strval($keyValue) <> "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["categorias"]))
					$GLOBALS["categorias"] = new categorias();
				$rsmaster = $GLOBALS["categorias"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "categorias", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}
			if ($this->img1->Visible && !$this->img1->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img1->Upload->DbValue) ? array() : array($this->img1->Upload->DbValue);
				if (!EmptyValue($this->img1->Upload->FileName)) {
					$newFiles = array($this->img1->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img1, $this->img1->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img1->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img1, $this->img1->Upload->Index) . $file1) || file_exists($this->img1->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img1->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img1, $this->img1->Upload->Index) . $file, UploadTempPath($this->img1, $this->img1->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img1->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img1->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img1->setDbValueDef($rsnew, $this->img1->Upload->FileName, NULL, $this->img1->ReadOnly);
				}
			}
			if ($this->img2->Visible && !$this->img2->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img2->Upload->DbValue) ? array() : array($this->img2->Upload->DbValue);
				if (!EmptyValue($this->img2->Upload->FileName)) {
					$newFiles = array($this->img2->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img2, $this->img2->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img2->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img2, $this->img2->Upload->Index) . $file1) || file_exists($this->img2->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img2->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img2, $this->img2->Upload->Index) . $file, UploadTempPath($this->img2, $this->img2->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img2->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img2->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img2->setDbValueDef($rsnew, $this->img2->Upload->FileName, NULL, $this->img2->ReadOnly);
				}
			}
			if ($this->img3->Visible && !$this->img3->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img3->Upload->DbValue) ? array() : array($this->img3->Upload->DbValue);
				if (!EmptyValue($this->img3->Upload->FileName)) {
					$newFiles = array($this->img3->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img3, $this->img3->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img3->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img3, $this->img3->Upload->Index) . $file1) || file_exists($this->img3->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img3->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img3, $this->img3->Upload->Index) . $file, UploadTempPath($this->img3, $this->img3->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img3->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img3->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img3->setDbValueDef($rsnew, $this->img3->Upload->FileName, NULL, $this->img3->ReadOnly);
				}
			}
			if ($this->img4->Visible && !$this->img4->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img4->Upload->DbValue) ? array() : array($this->img4->Upload->DbValue);
				if (!EmptyValue($this->img4->Upload->FileName)) {
					$newFiles = array($this->img4->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img4, $this->img4->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img4->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img4, $this->img4->Upload->Index) . $file1) || file_exists($this->img4->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img4->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img4, $this->img4->Upload->Index) . $file, UploadTempPath($this->img4, $this->img4->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img4->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img4->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img4->setDbValueDef($rsnew, $this->img4->Upload->FileName, NULL, $this->img4->ReadOnly);
				}
			}
			if ($this->img5->Visible && !$this->img5->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img5->Upload->DbValue) ? array() : array($this->img5->Upload->DbValue);
				if (!EmptyValue($this->img5->Upload->FileName)) {
					$newFiles = array($this->img5->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img5, $this->img5->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img5->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img5, $this->img5->Upload->Index) . $file1) || file_exists($this->img5->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img5->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img5, $this->img5->Upload->Index) . $file, UploadTempPath($this->img5, $this->img5->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img5->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img5->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img5->setDbValueDef($rsnew, $this->img5->Upload->FileName, NULL, $this->img5->ReadOnly);
				}
			}
			if ($this->img6->Visible && !$this->img6->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img6->Upload->DbValue) ? array() : array($this->img6->Upload->DbValue);
				if (!EmptyValue($this->img6->Upload->FileName)) {
					$newFiles = array($this->img6->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img6, $this->img6->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img6->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img6, $this->img6->Upload->Index) . $file1) || file_exists($this->img6->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img6->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img6, $this->img6->Upload->Index) . $file, UploadTempPath($this->img6, $this->img6->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img6->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img6->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img6->setDbValueDef($rsnew, $this->img6->Upload->FileName, NULL, $this->img6->ReadOnly);
				}
			}
			if ($this->img7->Visible && !$this->img7->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img7->Upload->DbValue) ? array() : array($this->img7->Upload->DbValue);
				if (!EmptyValue($this->img7->Upload->FileName)) {
					$newFiles = array($this->img7->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img7, $this->img7->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img7->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img7, $this->img7->Upload->Index) . $file1) || file_exists($this->img7->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img7->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img7, $this->img7->Upload->Index) . $file, UploadTempPath($this->img7, $this->img7->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img7->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img7->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img7->setDbValueDef($rsnew, $this->img7->Upload->FileName, NULL, $this->img7->ReadOnly);
				}
			}
			if ($this->img8->Visible && !$this->img8->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img8->Upload->DbValue) ? array() : array($this->img8->Upload->DbValue);
				if (!EmptyValue($this->img8->Upload->FileName)) {
					$newFiles = array($this->img8->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img8, $this->img8->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img8->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img8, $this->img8->Upload->Index) . $file1) || file_exists($this->img8->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img8->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img8, $this->img8->Upload->Index) . $file, UploadTempPath($this->img8, $this->img8->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img8->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img8->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img8->setDbValueDef($rsnew, $this->img8->Upload->FileName, NULL, $this->img8->ReadOnly);
				}
			}
			if ($this->img9->Visible && !$this->img9->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->img9->Upload->DbValue) ? array() : array($this->img9->Upload->DbValue);
				if (!EmptyValue($this->img9->Upload->FileName)) {
					$newFiles = array($this->img9->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->img9, $this->img9->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->img9->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->img9, $this->img9->Upload->Index) . $file1) || file_exists($this->img9->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->img9->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->img9, $this->img9->Upload->Index) . $file, UploadTempPath($this->img9, $this->img9->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->img9->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->img9->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->img9->setDbValueDef($rsnew, $this->img9->Upload->FileName, NULL, $this->img9->ReadOnly);
				}
			}
			if ($this->ficha_tecnica->Visible && !$this->ficha_tecnica->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->ficha_tecnica->Upload->DbValue) ? array() : array($this->ficha_tecnica->Upload->DbValue);
				if (!EmptyValue($this->ficha_tecnica->Upload->FileName)) {
					$newFiles = array($this->ficha_tecnica->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->ficha_tecnica, $this->ficha_tecnica->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->ficha_tecnica->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->ficha_tecnica, $this->ficha_tecnica->Upload->Index) . $file1) || file_exists($this->ficha_tecnica->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->ficha_tecnica->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->ficha_tecnica, $this->ficha_tecnica->Upload->Index) . $file, UploadTempPath($this->ficha_tecnica, $this->ficha_tecnica->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->ficha_tecnica->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->ficha_tecnica->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->ficha_tecnica->setDbValueDef($rsnew, $this->ficha_tecnica->Upload->FileName, NULL, $this->ficha_tecnica->ReadOnly);
				}
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
					if ($this->img1->Visible && !$this->img1->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img1->Upload->DbValue) ? array() : array($this->img1->Upload->DbValue);
						if (!EmptyValue($this->img1->Upload->FileName)) {
							$newFiles = array($this->img1->Upload->FileName);
							$newFiles2 = array($rsnew['img1']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img1, $this->img1->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img1->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img1->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img2->Visible && !$this->img2->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img2->Upload->DbValue) ? array() : array($this->img2->Upload->DbValue);
						if (!EmptyValue($this->img2->Upload->FileName)) {
							$newFiles = array($this->img2->Upload->FileName);
							$newFiles2 = array($rsnew['img2']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img2, $this->img2->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img2->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img2->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img3->Visible && !$this->img3->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img3->Upload->DbValue) ? array() : array($this->img3->Upload->DbValue);
						if (!EmptyValue($this->img3->Upload->FileName)) {
							$newFiles = array($this->img3->Upload->FileName);
							$newFiles2 = array($rsnew['img3']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img3, $this->img3->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img3->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img3->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img4->Visible && !$this->img4->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img4->Upload->DbValue) ? array() : array($this->img4->Upload->DbValue);
						if (!EmptyValue($this->img4->Upload->FileName)) {
							$newFiles = array($this->img4->Upload->FileName);
							$newFiles2 = array($rsnew['img4']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img4, $this->img4->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img4->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img4->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img5->Visible && !$this->img5->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img5->Upload->DbValue) ? array() : array($this->img5->Upload->DbValue);
						if (!EmptyValue($this->img5->Upload->FileName)) {
							$newFiles = array($this->img5->Upload->FileName);
							$newFiles2 = array($rsnew['img5']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img5, $this->img5->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img5->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img5->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img6->Visible && !$this->img6->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img6->Upload->DbValue) ? array() : array($this->img6->Upload->DbValue);
						if (!EmptyValue($this->img6->Upload->FileName)) {
							$newFiles = array($this->img6->Upload->FileName);
							$newFiles2 = array($rsnew['img6']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img6, $this->img6->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img6->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img6->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img7->Visible && !$this->img7->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img7->Upload->DbValue) ? array() : array($this->img7->Upload->DbValue);
						if (!EmptyValue($this->img7->Upload->FileName)) {
							$newFiles = array($this->img7->Upload->FileName);
							$newFiles2 = array($rsnew['img7']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img7, $this->img7->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img7->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img7->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img8->Visible && !$this->img8->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img8->Upload->DbValue) ? array() : array($this->img8->Upload->DbValue);
						if (!EmptyValue($this->img8->Upload->FileName)) {
							$newFiles = array($this->img8->Upload->FileName);
							$newFiles2 = array($rsnew['img8']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img8, $this->img8->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img8->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img8->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->img9->Visible && !$this->img9->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->img9->Upload->DbValue) ? array() : array($this->img9->Upload->DbValue);
						if (!EmptyValue($this->img9->Upload->FileName)) {
							$newFiles = array($this->img9->Upload->FileName);
							$newFiles2 = array($rsnew['img9']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->img9, $this->img9->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->img9->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->img9->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->ficha_tecnica->Visible && !$this->ficha_tecnica->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->ficha_tecnica->Upload->DbValue) ? array() : array($this->ficha_tecnica->Upload->DbValue);
						if (!EmptyValue($this->ficha_tecnica->Upload->FileName)) {
							$newFiles = array($this->ficha_tecnica->Upload->FileName);
							$newFiles2 = array($rsnew['ficha_tecnica']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->ficha_tecnica, $this->ficha_tecnica->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->ficha_tecnica->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->ficha_tecnica->oldPhysicalUploadPath() . $oldFile);
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
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// img1
		if ($this->img1->Upload->FileToken <> "")
			CleanUploadTempPath($this->img1->Upload->FileToken, $this->img1->Upload->Index);
		else
			CleanUploadTempPath($this->img1, $this->img1->Upload->Index);

		// img2
		if ($this->img2->Upload->FileToken <> "")
			CleanUploadTempPath($this->img2->Upload->FileToken, $this->img2->Upload->Index);
		else
			CleanUploadTempPath($this->img2, $this->img2->Upload->Index);

		// img3
		if ($this->img3->Upload->FileToken <> "")
			CleanUploadTempPath($this->img3->Upload->FileToken, $this->img3->Upload->Index);
		else
			CleanUploadTempPath($this->img3, $this->img3->Upload->Index);

		// img4
		if ($this->img4->Upload->FileToken <> "")
			CleanUploadTempPath($this->img4->Upload->FileToken, $this->img4->Upload->Index);
		else
			CleanUploadTempPath($this->img4, $this->img4->Upload->Index);

		// img5
		if ($this->img5->Upload->FileToken <> "")
			CleanUploadTempPath($this->img5->Upload->FileToken, $this->img5->Upload->Index);
		else
			CleanUploadTempPath($this->img5, $this->img5->Upload->Index);

		// img6
		if ($this->img6->Upload->FileToken <> "")
			CleanUploadTempPath($this->img6->Upload->FileToken, $this->img6->Upload->Index);
		else
			CleanUploadTempPath($this->img6, $this->img6->Upload->Index);

		// img7
		if ($this->img7->Upload->FileToken <> "")
			CleanUploadTempPath($this->img7->Upload->FileToken, $this->img7->Upload->Index);
		else
			CleanUploadTempPath($this->img7, $this->img7->Upload->Index);

		// img8
		if ($this->img8->Upload->FileToken <> "")
			CleanUploadTempPath($this->img8->Upload->FileToken, $this->img8->Upload->Index);
		else
			CleanUploadTempPath($this->img8, $this->img8->Upload->Index);

		// img9
		if ($this->img9->Upload->FileToken <> "")
			CleanUploadTempPath($this->img9->Upload->FileToken, $this->img9->Upload->Index);
		else
			CleanUploadTempPath($this->img9, $this->img9->Upload->Index);

		// ficha_tecnica
		if ($this->ficha_tecnica->Upload->FileToken <> "")
			CleanUploadTempPath($this->ficha_tecnica->Upload->FileToken, $this->ficha_tecnica->Upload->Index);
		else
			CleanUploadTempPath($this->ficha_tecnica, $this->ficha_tecnica->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
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
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>