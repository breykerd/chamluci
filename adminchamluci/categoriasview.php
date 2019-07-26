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
$categorias_view = new categorias_view();

// Run the page
$categorias_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorias_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$categorias->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcategoriasview = currentForm = new ew.Form("fcategoriasview", "view");

// Form_CustomValidate event
fcategoriasview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriasview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$categorias->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $categorias_view->ExportOptions->render("body") ?>
<?php $categorias_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $categorias_view->showPageHeader(); ?>
<?php
$categorias_view->showMessage();
?>
<form name="fcategoriasview" id="fcategoriasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorias_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorias_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorias">
<input type="hidden" name="modal" value="<?php echo (int)$categorias_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($categorias->img_header->Visible) { // img_header ?>
	<tr id="r_img_header">
		<td class="<?php echo $categorias_view->TableLeftColumnClass ?>"><span id="elh_categorias_img_header"><?php echo $categorias->img_header->caption() ?></span></td>
		<td data-name="img_header"<?php echo $categorias->img_header->cellAttributes() ?>>
<span id="el_categorias_img_header">
<span>
<?php echo GetFileViewTag($categorias->img_header, $categorias->img_header->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categorias->titulo->Visible) { // titulo ?>
	<tr id="r_titulo">
		<td class="<?php echo $categorias_view->TableLeftColumnClass ?>"><span id="elh_categorias_titulo"><?php echo $categorias->titulo->caption() ?></span></td>
		<td data-name="titulo"<?php echo $categorias->titulo->cellAttributes() ?>>
<span id="el_categorias_titulo">
<span<?php echo $categorias->titulo->viewAttributes() ?>>
<?php echo $categorias->titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categorias->url->Visible) { // url ?>
	<tr id="r_url">
		<td class="<?php echo $categorias_view->TableLeftColumnClass ?>"><span id="elh_categorias_url"><?php echo $categorias->url->caption() ?></span></td>
		<td data-name="url"<?php echo $categorias->url->cellAttributes() ?>>
<span id="el_categorias_url">
<span<?php echo $categorias->url->viewAttributes() ?>>
<?php echo $categorias->url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categorias->keywords->Visible) { // keywords ?>
	<tr id="r_keywords">
		<td class="<?php echo $categorias_view->TableLeftColumnClass ?>"><span id="elh_categorias_keywords"><?php echo $categorias->keywords->caption() ?></span></td>
		<td data-name="keywords"<?php echo $categorias->keywords->cellAttributes() ?>>
<span id="el_categorias_keywords">
<span<?php echo $categorias->keywords->viewAttributes() ?>>
<?php echo $categorias->keywords->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categorias->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $categorias_view->TableLeftColumnClass ?>"><span id="elh_categorias_description"><?php echo $categorias->description->caption() ?></span></td>
		<td data-name="description"<?php echo $categorias->description->cellAttributes() ?>>
<span id="el_categorias_description">
<span<?php echo $categorias->description->viewAttributes() ?>>
<?php echo $categorias->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("productos", explode(",", $categorias->getCurrentDetailTable())) && $productos->DetailView) {
?>
<?php if ($categorias->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("productos", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "productosgrid.php" ?>
<?php } ?>
</form>
<?php
$categorias_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$categorias->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$categorias_view->terminate();
?>