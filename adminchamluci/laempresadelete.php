<?php
namespace PHPMaker2019\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$laempresa_delete = new laempresa_delete();

// Run the page
$laempresa_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laempresa_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var flaempresadelete = currentForm = new ew.Form("flaempresadelete", "delete");

// Form_CustomValidate event
flaempresadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flaempresadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $laempresa_delete->showPageHeader(); ?>
<?php
$laempresa_delete->showMessage();
?>
<form name="flaempresadelete" id="flaempresadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($laempresa_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $laempresa_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laempresa">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($laempresa_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($laempresa->img->Visible) { // img ?>
		<th class="<?php echo $laempresa->img->headerCellClass() ?>"><span id="elh_laempresa_img" class="laempresa_img"><?php echo $laempresa->img->caption() ?></span></th>
<?php } ?>
<?php if ($laempresa->titulo->Visible) { // titulo ?>
		<th class="<?php echo $laempresa->titulo->headerCellClass() ?>"><span id="elh_laempresa_titulo" class="laempresa_titulo"><?php echo $laempresa->titulo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$laempresa_delete->RecCnt = 0;
$i = 0;
while (!$laempresa_delete->Recordset->EOF) {
	$laempresa_delete->RecCnt++;
	$laempresa_delete->RowCnt++;

	// Set row properties
	$laempresa->resetAttributes();
	$laempresa->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$laempresa_delete->loadRowValues($laempresa_delete->Recordset);

	// Render row
	$laempresa_delete->renderRow();
?>
	<tr<?php echo $laempresa->rowAttributes() ?>>
<?php if ($laempresa->img->Visible) { // img ?>
		<td<?php echo $laempresa->img->cellAttributes() ?>>
<span id="el<?php echo $laempresa_delete->RowCnt ?>_laempresa_img" class="laempresa_img">
<span>
<?php echo GetFileViewTag($laempresa->img, $laempresa->img->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($laempresa->titulo->Visible) { // titulo ?>
		<td<?php echo $laempresa->titulo->cellAttributes() ?>>
<span id="el<?php echo $laempresa_delete->RowCnt ?>_laempresa_titulo" class="laempresa_titulo">
<span<?php echo $laempresa->titulo->viewAttributes() ?>>
<?php echo $laempresa->titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$laempresa_delete->Recordset->moveNext();
}
$laempresa_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $laempresa_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$laempresa_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$laempresa_delete->terminate();
?>