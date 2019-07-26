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
$productos_delete = new productos_delete();

// Run the page
$productos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$productos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproductosdelete = currentForm = new ew.Form("fproductosdelete", "delete");

// Form_CustomValidate event
fproductosdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductosdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductosdelete.lists["x_destacado_inicio"] = <?php echo $productos_delete->destacado_inicio->Lookup->toClientList() ?>;
fproductosdelete.lists["x_destacado_inicio"].options = <?php echo JsonEncode($productos_delete->destacado_inicio->options(FALSE, TRUE)) ?>;
fproductosdelete.lists["x_destacado_footer"] = <?php echo $productos_delete->destacado_footer->Lookup->toClientList() ?>;
fproductosdelete.lists["x_destacado_footer"].options = <?php echo JsonEncode($productos_delete->destacado_footer->options(FALSE, TRUE)) ?>;
fproductosdelete.lists["x_destacado_productos"] = <?php echo $productos_delete->destacado_productos->Lookup->toClientList() ?>;
fproductosdelete.lists["x_destacado_productos"].options = <?php echo JsonEncode($productos_delete->destacado_productos->options(FALSE, TRUE)) ?>;
fproductosdelete.lists["x_id_cate"] = <?php echo $productos_delete->id_cate->Lookup->toClientList() ?>;
fproductosdelete.lists["x_id_cate"].options = <?php echo JsonEncode($productos_delete->id_cate->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $productos_delete->showPageHeader(); ?>
<?php
$productos_delete->showMessage();
?>
<form name="fproductosdelete" id="fproductosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($productos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $productos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="productos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($productos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($productos->titulo->Visible) { // titulo ?>
		<th class="<?php echo $productos->titulo->headerCellClass() ?>"><span id="elh_productos_titulo" class="productos_titulo"><?php echo $productos->titulo->caption() ?></span></th>
<?php } ?>
<?php if ($productos->img1->Visible) { // img1 ?>
		<th class="<?php echo $productos->img1->headerCellClass() ?>"><span id="elh_productos_img1" class="productos_img1"><?php echo $productos->img1->caption() ?></span></th>
<?php } ?>
<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
		<th class="<?php echo $productos->destacado_inicio->headerCellClass() ?>"><span id="elh_productos_destacado_inicio" class="productos_destacado_inicio"><?php echo $productos->destacado_inicio->caption() ?></span></th>
<?php } ?>
<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
		<th class="<?php echo $productos->destacado_footer->headerCellClass() ?>"><span id="elh_productos_destacado_footer" class="productos_destacado_footer"><?php echo $productos->destacado_footer->caption() ?></span></th>
<?php } ?>
<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
		<th class="<?php echo $productos->destacado_productos->headerCellClass() ?>"><span id="elh_productos_destacado_productos" class="productos_destacado_productos"><?php echo $productos->destacado_productos->caption() ?></span></th>
<?php } ?>
<?php if ($productos->id_cate->Visible) { // id_cate ?>
		<th class="<?php echo $productos->id_cate->headerCellClass() ?>"><span id="elh_productos_id_cate" class="productos_id_cate"><?php echo $productos->id_cate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$productos_delete->RecCnt = 0;
$i = 0;
while (!$productos_delete->Recordset->EOF) {
	$productos_delete->RecCnt++;
	$productos_delete->RowCnt++;

	// Set row properties
	$productos->resetAttributes();
	$productos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$productos_delete->loadRowValues($productos_delete->Recordset);

	// Render row
	$productos_delete->renderRow();
?>
	<tr<?php echo $productos->rowAttributes() ?>>
<?php if ($productos->titulo->Visible) { // titulo ?>
		<td<?php echo $productos->titulo->cellAttributes() ?>>
<span id="el<?php echo $productos_delete->RowCnt ?>_productos_titulo" class="productos_titulo">
<span<?php echo $productos->titulo->viewAttributes() ?>>
<?php echo $productos->titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($productos->img1->Visible) { // img1 ?>
		<td<?php echo $productos->img1->cellAttributes() ?>>
<span id="el<?php echo $productos_delete->RowCnt ?>_productos_img1" class="productos_img1">
<span>
<?php echo GetFileViewTag($productos->img1, $productos->img1->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
		<td<?php echo $productos->destacado_inicio->cellAttributes() ?>>
<span id="el<?php echo $productos_delete->RowCnt ?>_productos_destacado_inicio" class="productos_destacado_inicio">
<span<?php echo $productos->destacado_inicio->viewAttributes() ?>>
<?php echo $productos->destacado_inicio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
		<td<?php echo $productos->destacado_footer->cellAttributes() ?>>
<span id="el<?php echo $productos_delete->RowCnt ?>_productos_destacado_footer" class="productos_destacado_footer">
<span<?php echo $productos->destacado_footer->viewAttributes() ?>>
<?php echo $productos->destacado_footer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
		<td<?php echo $productos->destacado_productos->cellAttributes() ?>>
<span id="el<?php echo $productos_delete->RowCnt ?>_productos_destacado_productos" class="productos_destacado_productos">
<span<?php echo $productos->destacado_productos->viewAttributes() ?>>
<?php echo $productos->destacado_productos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($productos->id_cate->Visible) { // id_cate ?>
		<td<?php echo $productos->id_cate->cellAttributes() ?>>
<span id="el<?php echo $productos_delete->RowCnt ?>_productos_id_cate" class="productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<?php echo $productos->id_cate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$productos_delete->Recordset->moveNext();
}
$productos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $productos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$productos_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$productos_delete->terminate();
?>