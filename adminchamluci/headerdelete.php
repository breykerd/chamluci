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
$header_delete = new header_delete();

// Run the page
$header_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$header_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fheaderdelete = currentForm = new ew.Form("fheaderdelete", "delete");

// Form_CustomValidate event
fheaderdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fheaderdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $header_delete->showPageHeader(); ?>
<?php
$header_delete->showMessage();
?>
<form name="fheaderdelete" id="fheaderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($header_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $header_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="header">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($header_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($header->img_empresa->Visible) { // img_empresa ?>
		<th class="<?php echo $header->img_empresa->headerCellClass() ?>"><span id="elh_header_img_empresa" class="header_img_empresa"><?php echo $header->img_empresa->caption() ?></span></th>
<?php } ?>
<?php if ($header->img_blog->Visible) { // img_blog ?>
		<th class="<?php echo $header->img_blog->headerCellClass() ?>"><span id="elh_header_img_blog" class="header_img_blog"><?php echo $header->img_blog->caption() ?></span></th>
<?php } ?>
<?php if ($header->img_contacto->Visible) { // img_contacto ?>
		<th class="<?php echo $header->img_contacto->headerCellClass() ?>"><span id="elh_header_img_contacto" class="header_img_contacto"><?php echo $header->img_contacto->caption() ?></span></th>
<?php } ?>
<?php if ($header->img_pasarela->Visible) { // img_pasarela ?>
		<th class="<?php echo $header->img_pasarela->headerCellClass() ?>"><span id="elh_header_img_pasarela" class="header_img_pasarela"><?php echo $header->img_pasarela->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$header_delete->RecCnt = 0;
$i = 0;
while (!$header_delete->Recordset->EOF) {
	$header_delete->RecCnt++;
	$header_delete->RowCnt++;

	// Set row properties
	$header->resetAttributes();
	$header->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$header_delete->loadRowValues($header_delete->Recordset);

	// Render row
	$header_delete->renderRow();
?>
	<tr<?php echo $header->rowAttributes() ?>>
<?php if ($header->img_empresa->Visible) { // img_empresa ?>
		<td<?php echo $header->img_empresa->cellAttributes() ?>>
<span id="el<?php echo $header_delete->RowCnt ?>_header_img_empresa" class="header_img_empresa">
<span>
<?php echo GetFileViewTag($header->img_empresa, $header->img_empresa->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($header->img_blog->Visible) { // img_blog ?>
		<td<?php echo $header->img_blog->cellAttributes() ?>>
<span id="el<?php echo $header_delete->RowCnt ?>_header_img_blog" class="header_img_blog">
<span>
<?php echo GetFileViewTag($header->img_blog, $header->img_blog->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($header->img_contacto->Visible) { // img_contacto ?>
		<td<?php echo $header->img_contacto->cellAttributes() ?>>
<span id="el<?php echo $header_delete->RowCnt ?>_header_img_contacto" class="header_img_contacto">
<span>
<?php echo GetFileViewTag($header->img_contacto, $header->img_contacto->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($header->img_pasarela->Visible) { // img_pasarela ?>
		<td<?php echo $header->img_pasarela->cellAttributes() ?>>
<span id="el<?php echo $header_delete->RowCnt ?>_header_img_pasarela" class="header_img_pasarela">
<span>
<?php echo GetFileViewTag($header->img_pasarela, $header->img_pasarela->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$header_delete->Recordset->moveNext();
}
$header_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $header_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$header_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$header_delete->terminate();
?>