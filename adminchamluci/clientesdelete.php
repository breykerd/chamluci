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
$clientes_delete = new clientes_delete();

// Run the page
$clientes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fclientesdelete = currentForm = new ew.Form("fclientesdelete", "delete");

// Form_CustomValidate event
fclientesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fclientesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $clientes_delete->showPageHeader(); ?>
<?php
$clientes_delete->showMessage();
?>
<form name="fclientesdelete" id="fclientesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($clientes_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $clientes_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($clientes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($clientes->ruc->Visible) { // ruc ?>
		<th class="<?php echo $clientes->ruc->headerCellClass() ?>"><span id="elh_clientes_ruc" class="clientes_ruc"><?php echo $clientes->ruc->caption() ?></span></th>
<?php } ?>
<?php if ($clientes->nom->Visible) { // nom ?>
		<th class="<?php echo $clientes->nom->headerCellClass() ?>"><span id="elh_clientes_nom" class="clientes_nom"><?php echo $clientes->nom->caption() ?></span></th>
<?php } ?>
<?php if ($clientes->tel->Visible) { // tel ?>
		<th class="<?php echo $clientes->tel->headerCellClass() ?>"><span id="elh_clientes_tel" class="clientes_tel"><?php echo $clientes->tel->caption() ?></span></th>
<?php } ?>
<?php if ($clientes->cor->Visible) { // cor ?>
		<th class="<?php echo $clientes->cor->headerCellClass() ?>"><span id="elh_clientes_cor" class="clientes_cor"><?php echo $clientes->cor->caption() ?></span></th>
<?php } ?>
<?php if ($clientes->codigo->Visible) { // codigo ?>
		<th class="<?php echo $clientes->codigo->headerCellClass() ?>"><span id="elh_clientes_codigo" class="clientes_codigo"><?php echo $clientes->codigo->caption() ?></span></th>
<?php } ?>
<?php if ($clientes->hora->Visible) { // hora ?>
		<th class="<?php echo $clientes->hora->headerCellClass() ?>"><span id="elh_clientes_hora" class="clientes_hora"><?php echo $clientes->hora->caption() ?></span></th>
<?php } ?>
<?php if ($clientes->fecha->Visible) { // fecha ?>
		<th class="<?php echo $clientes->fecha->headerCellClass() ?>"><span id="elh_clientes_fecha" class="clientes_fecha"><?php echo $clientes->fecha->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$clientes_delete->RecCnt = 0;
$i = 0;
while (!$clientes_delete->Recordset->EOF) {
	$clientes_delete->RecCnt++;
	$clientes_delete->RowCnt++;

	// Set row properties
	$clientes->resetAttributes();
	$clientes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$clientes_delete->loadRowValues($clientes_delete->Recordset);

	// Render row
	$clientes_delete->renderRow();
?>
	<tr<?php echo $clientes->rowAttributes() ?>>
<?php if ($clientes->ruc->Visible) { // ruc ?>
		<td<?php echo $clientes->ruc->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCnt ?>_clientes_ruc" class="clientes_ruc">
<span<?php echo $clientes->ruc->viewAttributes() ?>>
<?php echo $clientes->ruc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes->nom->Visible) { // nom ?>
		<td<?php echo $clientes->nom->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCnt ?>_clientes_nom" class="clientes_nom">
<span<?php echo $clientes->nom->viewAttributes() ?>>
<?php echo $clientes->nom->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes->tel->Visible) { // tel ?>
		<td<?php echo $clientes->tel->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCnt ?>_clientes_tel" class="clientes_tel">
<span<?php echo $clientes->tel->viewAttributes() ?>>
<?php echo $clientes->tel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes->cor->Visible) { // cor ?>
		<td<?php echo $clientes->cor->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCnt ?>_clientes_cor" class="clientes_cor">
<span<?php echo $clientes->cor->viewAttributes() ?>>
<?php echo $clientes->cor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes->codigo->Visible) { // codigo ?>
		<td<?php echo $clientes->codigo->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCnt ?>_clientes_codigo" class="clientes_codigo">
<span<?php echo $clientes->codigo->viewAttributes() ?>>
<?php echo $clientes->codigo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes->hora->Visible) { // hora ?>
		<td<?php echo $clientes->hora->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCnt ?>_clientes_hora" class="clientes_hora">
<span<?php echo $clientes->hora->viewAttributes() ?>>
<?php echo $clientes->hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes->fecha->Visible) { // fecha ?>
		<td<?php echo $clientes->fecha->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCnt ?>_clientes_fecha" class="clientes_fecha">
<span<?php echo $clientes->fecha->viewAttributes() ?>>
<?php echo $clientes->fecha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$clientes_delete->Recordset->moveNext();
}
$clientes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $clientes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$clientes_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$clientes_delete->terminate();
?>