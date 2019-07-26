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
$categorias_delete = new categorias_delete();

// Run the page
$categorias_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorias_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcategoriasdelete = currentForm = new ew.Form("fcategoriasdelete", "delete");

// Form_CustomValidate event
fcategoriasdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriasdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $categorias_delete->showPageHeader(); ?>
<?php
$categorias_delete->showMessage();
?>
<form name="fcategoriasdelete" id="fcategoriasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorias_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorias_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorias">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($categorias_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($categorias->img_header->Visible) { // img_header ?>
		<th class="<?php echo $categorias->img_header->headerCellClass() ?>"><span id="elh_categorias_img_header" class="categorias_img_header"><?php echo $categorias->img_header->caption() ?></span></th>
<?php } ?>
<?php if ($categorias->titulo->Visible) { // titulo ?>
		<th class="<?php echo $categorias->titulo->headerCellClass() ?>"><span id="elh_categorias_titulo" class="categorias_titulo"><?php echo $categorias->titulo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$categorias_delete->RecCnt = 0;
$i = 0;
while (!$categorias_delete->Recordset->EOF) {
	$categorias_delete->RecCnt++;
	$categorias_delete->RowCnt++;

	// Set row properties
	$categorias->resetAttributes();
	$categorias->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$categorias_delete->loadRowValues($categorias_delete->Recordset);

	// Render row
	$categorias_delete->renderRow();
?>
	<tr<?php echo $categorias->rowAttributes() ?>>
<?php if ($categorias->img_header->Visible) { // img_header ?>
		<td<?php echo $categorias->img_header->cellAttributes() ?>>
<span id="el<?php echo $categorias_delete->RowCnt ?>_categorias_img_header" class="categorias_img_header">
<span>
<?php echo GetFileViewTag($categorias->img_header, $categorias->img_header->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($categorias->titulo->Visible) { // titulo ?>
		<td<?php echo $categorias->titulo->cellAttributes() ?>>
<span id="el<?php echo $categorias_delete->RowCnt ?>_categorias_titulo" class="categorias_titulo">
<span<?php echo $categorias->titulo->viewAttributes() ?>>
<?php echo $categorias->titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$categorias_delete->Recordset->moveNext();
}
$categorias_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categorias_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$categorias_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$categorias_delete->terminate();
?>