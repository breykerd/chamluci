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
$contaco_delete = new contaco_delete();

// Run the page
$contaco_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contaco_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcontacodelete = currentForm = new ew.Form("fcontacodelete", "delete");

// Form_CustomValidate event
fcontacodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontacodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contaco_delete->showPageHeader(); ?>
<?php
$contaco_delete->showMessage();
?>
<form name="fcontacodelete" id="fcontacodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contaco_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contaco_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contaco">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contaco_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contaco->correo->Visible) { // correo ?>
		<th class="<?php echo $contaco->correo->headerCellClass() ?>"><span id="elh_contaco_correo" class="contaco_correo"><?php echo $contaco->correo->caption() ?></span></th>
<?php } ?>
<?php if ($contaco->direccion->Visible) { // direccion ?>
		<th class="<?php echo $contaco->direccion->headerCellClass() ?>"><span id="elh_contaco_direccion" class="contaco_direccion"><?php echo $contaco->direccion->caption() ?></span></th>
<?php } ?>
<?php if ($contaco->horario->Visible) { // horario ?>
		<th class="<?php echo $contaco->horario->headerCellClass() ?>"><span id="elh_contaco_horario" class="contaco_horario"><?php echo $contaco->horario->caption() ?></span></th>
<?php } ?>
<?php if ($contaco->img_bcp->Visible) { // img_bcp ?>
		<th class="<?php echo $contaco->img_bcp->headerCellClass() ?>"><span id="elh_contaco_img_bcp" class="contaco_img_bcp"><?php echo $contaco->img_bcp->caption() ?></span></th>
<?php } ?>
<?php if ($contaco->img_bbva->Visible) { // img_bbva ?>
		<th class="<?php echo $contaco->img_bbva->headerCellClass() ?>"><span id="elh_contaco_img_bbva" class="contaco_img_bbva"><?php echo $contaco->img_bbva->caption() ?></span></th>
<?php } ?>
<?php if ($contaco->correo_formulario->Visible) { // correo_formulario ?>
		<th class="<?php echo $contaco->correo_formulario->headerCellClass() ?>"><span id="elh_contaco_correo_formulario" class="contaco_correo_formulario"><?php echo $contaco->correo_formulario->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contaco_delete->RecCnt = 0;
$i = 0;
while (!$contaco_delete->Recordset->EOF) {
	$contaco_delete->RecCnt++;
	$contaco_delete->RowCnt++;

	// Set row properties
	$contaco->resetAttributes();
	$contaco->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contaco_delete->loadRowValues($contaco_delete->Recordset);

	// Render row
	$contaco_delete->renderRow();
?>
	<tr<?php echo $contaco->rowAttributes() ?>>
<?php if ($contaco->correo->Visible) { // correo ?>
		<td<?php echo $contaco->correo->cellAttributes() ?>>
<span id="el<?php echo $contaco_delete->RowCnt ?>_contaco_correo" class="contaco_correo">
<span<?php echo $contaco->correo->viewAttributes() ?>>
<?php echo $contaco->correo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contaco->direccion->Visible) { // direccion ?>
		<td<?php echo $contaco->direccion->cellAttributes() ?>>
<span id="el<?php echo $contaco_delete->RowCnt ?>_contaco_direccion" class="contaco_direccion">
<span<?php echo $contaco->direccion->viewAttributes() ?>>
<?php echo $contaco->direccion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contaco->horario->Visible) { // horario ?>
		<td<?php echo $contaco->horario->cellAttributes() ?>>
<span id="el<?php echo $contaco_delete->RowCnt ?>_contaco_horario" class="contaco_horario">
<span<?php echo $contaco->horario->viewAttributes() ?>>
<?php echo $contaco->horario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contaco->img_bcp->Visible) { // img_bcp ?>
		<td<?php echo $contaco->img_bcp->cellAttributes() ?>>
<span id="el<?php echo $contaco_delete->RowCnt ?>_contaco_img_bcp" class="contaco_img_bcp">
<span>
<?php echo GetFileViewTag($contaco->img_bcp, $contaco->img_bcp->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($contaco->img_bbva->Visible) { // img_bbva ?>
		<td<?php echo $contaco->img_bbva->cellAttributes() ?>>
<span id="el<?php echo $contaco_delete->RowCnt ?>_contaco_img_bbva" class="contaco_img_bbva">
<span>
<?php echo GetFileViewTag($contaco->img_bbva, $contaco->img_bbva->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($contaco->correo_formulario->Visible) { // correo_formulario ?>
		<td<?php echo $contaco->correo_formulario->cellAttributes() ?>>
<span id="el<?php echo $contaco_delete->RowCnt ?>_contaco_correo_formulario" class="contaco_correo_formulario">
<span<?php echo $contaco->correo_formulario->viewAttributes() ?>>
<?php echo $contaco->correo_formulario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contaco_delete->Recordset->moveNext();
}
$contaco_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contaco_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contaco_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contaco_delete->terminate();
?>