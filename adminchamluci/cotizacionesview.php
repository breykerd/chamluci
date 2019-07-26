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
$cotizaciones_view = new cotizaciones_view();

// Run the page
$cotizaciones_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cotizaciones_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cotizaciones->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcotizacionesview = currentForm = new ew.Form("fcotizacionesview", "view");

// Form_CustomValidate event
fcotizacionesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcotizacionesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cotizaciones->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cotizaciones_view->ExportOptions->render("body") ?>
<?php $cotizaciones_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cotizaciones_view->showPageHeader(); ?>
<?php
$cotizaciones_view->showMessage();
?>
<form name="fcotizacionesview" id="fcotizacionesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cotizaciones_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cotizaciones_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cotizaciones">
<input type="hidden" name="modal" value="<?php echo (int)$cotizaciones_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
	<tr id="r_titulo">
		<td class="<?php echo $cotizaciones_view->TableLeftColumnClass ?>"><span id="elh_cotizaciones_titulo"><?php echo $cotizaciones->titulo->caption() ?></span></td>
		<td data-name="titulo"<?php echo $cotizaciones->titulo->cellAttributes() ?>>
<span id="el_cotizaciones_titulo">
<span<?php echo $cotizaciones->titulo->viewAttributes() ?>>
<?php echo $cotizaciones->titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cotizaciones->img->Visible) { // img ?>
	<tr id="r_img">
		<td class="<?php echo $cotizaciones_view->TableLeftColumnClass ?>"><span id="elh_cotizaciones_img"><?php echo $cotizaciones->img->caption() ?></span></td>
		<td data-name="img"<?php echo $cotizaciones->img->cellAttributes() ?>>
<span id="el_cotizaciones_img">
<span>
<?php echo GetFileViewTag($cotizaciones->img, $cotizaciones->img->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
	<tr id="r_cantidad">
		<td class="<?php echo $cotizaciones_view->TableLeftColumnClass ?>"><span id="elh_cotizaciones_cantidad"><?php echo $cotizaciones->cantidad->caption() ?></span></td>
		<td data-name="cantidad"<?php echo $cotizaciones->cantidad->cellAttributes() ?>>
<span id="el_cotizaciones_cantidad">
<span<?php echo $cotizaciones->cantidad->viewAttributes() ?>>
<?php echo $cotizaciones->cantidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
	<tr id="r_codigo">
		<td class="<?php echo $cotizaciones_view->TableLeftColumnClass ?>"><span id="elh_cotizaciones_codigo"><?php echo $cotizaciones->codigo->caption() ?></span></td>
		<td data-name="codigo"<?php echo $cotizaciones->codigo->cellAttributes() ?>>
<span id="el_cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<?php echo $cotizaciones->codigo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$cotizaciones_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cotizaciones->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cotizaciones_view->terminate();
?>