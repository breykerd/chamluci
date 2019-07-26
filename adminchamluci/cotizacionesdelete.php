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
$cotizaciones_delete = new cotizaciones_delete();

// Run the page
$cotizaciones_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cotizaciones_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcotizacionesdelete = currentForm = new ew.Form("fcotizacionesdelete", "delete");

// Form_CustomValidate event
fcotizacionesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcotizacionesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cotizaciones_delete->showPageHeader(); ?>
<?php
$cotizaciones_delete->showMessage();
?>
<form name="fcotizacionesdelete" id="fcotizacionesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cotizaciones_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cotizaciones_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cotizaciones">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cotizaciones_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
		<th class="<?php echo $cotizaciones->titulo->headerCellClass() ?>"><span id="elh_cotizaciones_titulo" class="cotizaciones_titulo"><?php echo $cotizaciones->titulo->caption() ?></span></th>
<?php } ?>
<?php if ($cotizaciones->img->Visible) { // img ?>
		<th class="<?php echo $cotizaciones->img->headerCellClass() ?>"><span id="elh_cotizaciones_img" class="cotizaciones_img"><?php echo $cotizaciones->img->caption() ?></span></th>
<?php } ?>
<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
		<th class="<?php echo $cotizaciones->cantidad->headerCellClass() ?>"><span id="elh_cotizaciones_cantidad" class="cotizaciones_cantidad"><?php echo $cotizaciones->cantidad->caption() ?></span></th>
<?php } ?>
<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
		<th class="<?php echo $cotizaciones->codigo->headerCellClass() ?>"><span id="elh_cotizaciones_codigo" class="cotizaciones_codigo"><?php echo $cotizaciones->codigo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cotizaciones_delete->RecCnt = 0;
$i = 0;
while (!$cotizaciones_delete->Recordset->EOF) {
	$cotizaciones_delete->RecCnt++;
	$cotizaciones_delete->RowCnt++;

	// Set row properties
	$cotizaciones->resetAttributes();
	$cotizaciones->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cotizaciones_delete->loadRowValues($cotizaciones_delete->Recordset);

	// Render row
	$cotizaciones_delete->renderRow();
?>
	<tr<?php echo $cotizaciones->rowAttributes() ?>>
<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
		<td<?php echo $cotizaciones->titulo->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_delete->RowCnt ?>_cotizaciones_titulo" class="cotizaciones_titulo">
<span<?php echo $cotizaciones->titulo->viewAttributes() ?>>
<?php echo $cotizaciones->titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cotizaciones->img->Visible) { // img ?>
		<td<?php echo $cotizaciones->img->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_delete->RowCnt ?>_cotizaciones_img" class="cotizaciones_img">
<span>
<?php echo GetFileViewTag($cotizaciones->img, $cotizaciones->img->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
		<td<?php echo $cotizaciones->cantidad->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_delete->RowCnt ?>_cotizaciones_cantidad" class="cotizaciones_cantidad">
<span<?php echo $cotizaciones->cantidad->viewAttributes() ?>>
<?php echo $cotizaciones->cantidad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
		<td<?php echo $cotizaciones->codigo->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_delete->RowCnt ?>_cotizaciones_codigo" class="cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<?php echo $cotizaciones->codigo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cotizaciones_delete->Recordset->moveNext();
}
$cotizaciones_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cotizaciones_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cotizaciones_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cotizaciones_delete->terminate();
?>