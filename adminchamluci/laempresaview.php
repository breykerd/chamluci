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
$laempresa_view = new laempresa_view();

// Run the page
$laempresa_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laempresa_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$laempresa->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var flaempresaview = currentForm = new ew.Form("flaempresaview", "view");

// Form_CustomValidate event
flaempresaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flaempresaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$laempresa->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $laempresa_view->ExportOptions->render("body") ?>
<?php $laempresa_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $laempresa_view->showPageHeader(); ?>
<?php
$laempresa_view->showMessage();
?>
<form name="flaempresaview" id="flaempresaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($laempresa_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $laempresa_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laempresa">
<input type="hidden" name="modal" value="<?php echo (int)$laempresa_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($laempresa->img->Visible) { // img ?>
	<tr id="r_img">
		<td class="<?php echo $laempresa_view->TableLeftColumnClass ?>"><span id="elh_laempresa_img"><?php echo $laempresa->img->caption() ?></span></td>
		<td data-name="img"<?php echo $laempresa->img->cellAttributes() ?>>
<span id="el_laempresa_img">
<span>
<?php echo GetFileViewTag($laempresa->img, $laempresa->img->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laempresa->titulo->Visible) { // titulo ?>
	<tr id="r_titulo">
		<td class="<?php echo $laempresa_view->TableLeftColumnClass ?>"><span id="elh_laempresa_titulo"><?php echo $laempresa->titulo->caption() ?></span></td>
		<td data-name="titulo"<?php echo $laempresa->titulo->cellAttributes() ?>>
<span id="el_laempresa_titulo">
<span<?php echo $laempresa->titulo->viewAttributes() ?>>
<?php echo $laempresa->titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laempresa->detalle->Visible) { // detalle ?>
	<tr id="r_detalle">
		<td class="<?php echo $laempresa_view->TableLeftColumnClass ?>"><span id="elh_laempresa_detalle"><?php echo $laempresa->detalle->caption() ?></span></td>
		<td data-name="detalle"<?php echo $laempresa->detalle->cellAttributes() ?>>
<span id="el_laempresa_detalle">
<span<?php echo $laempresa->detalle->viewAttributes() ?>>
<?php echo $laempresa->detalle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laempresa->keywords->Visible) { // keywords ?>
	<tr id="r_keywords">
		<td class="<?php echo $laempresa_view->TableLeftColumnClass ?>"><span id="elh_laempresa_keywords"><?php echo $laempresa->keywords->caption() ?></span></td>
		<td data-name="keywords"<?php echo $laempresa->keywords->cellAttributes() ?>>
<span id="el_laempresa_keywords">
<span<?php echo $laempresa->keywords->viewAttributes() ?>>
<?php echo $laempresa->keywords->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laempresa->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $laempresa_view->TableLeftColumnClass ?>"><span id="elh_laempresa_description"><?php echo $laempresa->description->caption() ?></span></td>
		<td data-name="description"<?php echo $laempresa->description->cellAttributes() ?>>
<span id="el_laempresa_description">
<span<?php echo $laempresa->description->viewAttributes() ?>>
<?php echo $laempresa->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laempresa->tituloimg->Visible) { // tituloimg ?>
	<tr id="r_tituloimg">
		<td class="<?php echo $laempresa_view->TableLeftColumnClass ?>"><span id="elh_laempresa_tituloimg"><?php echo $laempresa->tituloimg->caption() ?></span></td>
		<td data-name="tituloimg"<?php echo $laempresa->tituloimg->cellAttributes() ?>>
<span id="el_laempresa_tituloimg">
<span<?php echo $laempresa->tituloimg->viewAttributes() ?>>
<?php echo $laempresa->tituloimg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$laempresa_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$laempresa->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$laempresa_view->terminate();
?>