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
$correos_delete = new correos_delete();

// Run the page
$correos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$correos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcorreosdelete = currentForm = new ew.Form("fcorreosdelete", "delete");

// Form_CustomValidate event
fcorreosdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcorreosdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $correos_delete->showPageHeader(); ?>
<?php
$correos_delete->showMessage();
?>
<form name="fcorreosdelete" id="fcorreosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($correos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $correos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="correos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($correos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($correos->nombre->Visible) { // nombre ?>
		<th class="<?php echo $correos->nombre->headerCellClass() ?>"><span id="elh_correos_nombre" class="correos_nombre"><?php echo $correos->nombre->caption() ?></span></th>
<?php } ?>
<?php if ($correos->correo->Visible) { // correo ?>
		<th class="<?php echo $correos->correo->headerCellClass() ?>"><span id="elh_correos_correo" class="correos_correo"><?php echo $correos->correo->caption() ?></span></th>
<?php } ?>
<?php if ($correos->hora->Visible) { // hora ?>
		<th class="<?php echo $correos->hora->headerCellClass() ?>"><span id="elh_correos_hora" class="correos_hora"><?php echo $correos->hora->caption() ?></span></th>
<?php } ?>
<?php if ($correos->fecha->Visible) { // fecha ?>
		<th class="<?php echo $correos->fecha->headerCellClass() ?>"><span id="elh_correos_fecha" class="correos_fecha"><?php echo $correos->fecha->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$correos_delete->RecCnt = 0;
$i = 0;
while (!$correos_delete->Recordset->EOF) {
	$correos_delete->RecCnt++;
	$correos_delete->RowCnt++;

	// Set row properties
	$correos->resetAttributes();
	$correos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$correos_delete->loadRowValues($correos_delete->Recordset);

	// Render row
	$correos_delete->renderRow();
?>
	<tr<?php echo $correos->rowAttributes() ?>>
<?php if ($correos->nombre->Visible) { // nombre ?>
		<td<?php echo $correos->nombre->cellAttributes() ?>>
<span id="el<?php echo $correos_delete->RowCnt ?>_correos_nombre" class="correos_nombre">
<span<?php echo $correos->nombre->viewAttributes() ?>>
<?php echo $correos->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($correos->correo->Visible) { // correo ?>
		<td<?php echo $correos->correo->cellAttributes() ?>>
<span id="el<?php echo $correos_delete->RowCnt ?>_correos_correo" class="correos_correo">
<span<?php echo $correos->correo->viewAttributes() ?>>
<?php echo $correos->correo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($correos->hora->Visible) { // hora ?>
		<td<?php echo $correos->hora->cellAttributes() ?>>
<span id="el<?php echo $correos_delete->RowCnt ?>_correos_hora" class="correos_hora">
<span<?php echo $correos->hora->viewAttributes() ?>>
<?php echo $correos->hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($correos->fecha->Visible) { // fecha ?>
		<td<?php echo $correos->fecha->cellAttributes() ?>>
<span id="el<?php echo $correos_delete->RowCnt ?>_correos_fecha" class="correos_fecha">
<span<?php echo $correos->fecha->viewAttributes() ?>>
<?php echo $correos->fecha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$correos_delete->Recordset->moveNext();
}
$correos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $correos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$correos_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$correos_delete->terminate();
?>