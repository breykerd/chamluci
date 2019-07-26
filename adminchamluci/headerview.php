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
$header_view = new header_view();

// Run the page
$header_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$header_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$header->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fheaderview = currentForm = new ew.Form("fheaderview", "view");

// Form_CustomValidate event
fheaderview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fheaderview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$header->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $header_view->ExportOptions->render("body") ?>
<?php $header_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $header_view->showPageHeader(); ?>
<?php
$header_view->showMessage();
?>
<form name="fheaderview" id="fheaderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($header_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $header_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="header">
<input type="hidden" name="modal" value="<?php echo (int)$header_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($header->img_empresa->Visible) { // img_empresa ?>
	<tr id="r_img_empresa">
		<td class="<?php echo $header_view->TableLeftColumnClass ?>"><span id="elh_header_img_empresa"><?php echo $header->img_empresa->caption() ?></span></td>
		<td data-name="img_empresa"<?php echo $header->img_empresa->cellAttributes() ?>>
<span id="el_header_img_empresa">
<span>
<?php echo GetFileViewTag($header->img_empresa, $header->img_empresa->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($header->img_blog->Visible) { // img_blog ?>
	<tr id="r_img_blog">
		<td class="<?php echo $header_view->TableLeftColumnClass ?>"><span id="elh_header_img_blog"><?php echo $header->img_blog->caption() ?></span></td>
		<td data-name="img_blog"<?php echo $header->img_blog->cellAttributes() ?>>
<span id="el_header_img_blog">
<span>
<?php echo GetFileViewTag($header->img_blog, $header->img_blog->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($header->img_contacto->Visible) { // img_contacto ?>
	<tr id="r_img_contacto">
		<td class="<?php echo $header_view->TableLeftColumnClass ?>"><span id="elh_header_img_contacto"><?php echo $header->img_contacto->caption() ?></span></td>
		<td data-name="img_contacto"<?php echo $header->img_contacto->cellAttributes() ?>>
<span id="el_header_img_contacto">
<span>
<?php echo GetFileViewTag($header->img_contacto, $header->img_contacto->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($header->img_pasarela->Visible) { // img_pasarela ?>
	<tr id="r_img_pasarela">
		<td class="<?php echo $header_view->TableLeftColumnClass ?>"><span id="elh_header_img_pasarela"><?php echo $header->img_pasarela->caption() ?></span></td>
		<td data-name="img_pasarela"<?php echo $header->img_pasarela->cellAttributes() ?>>
<span id="el_header_img_pasarela">
<span>
<?php echo GetFileViewTag($header->img_pasarela, $header->img_pasarela->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$header_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$header->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$header_view->terminate();
?>