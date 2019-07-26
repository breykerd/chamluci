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
$clientes_view = new clientes_view();

// Run the page
$clientes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$clientes->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fclientesview = currentForm = new ew.Form("fclientesview", "view");

// Form_CustomValidate event
fclientesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fclientesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$clientes->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $clientes_view->ExportOptions->render("body") ?>
<?php $clientes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $clientes_view->showPageHeader(); ?>
<?php
$clientes_view->showMessage();
?>
<form name="fclientesview" id="fclientesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($clientes_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $clientes_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<input type="hidden" name="modal" value="<?php echo (int)$clientes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($clientes->ruc->Visible) { // ruc ?>
	<tr id="r_ruc">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_ruc"><?php echo $clientes->ruc->caption() ?></span></td>
		<td data-name="ruc"<?php echo $clientes->ruc->cellAttributes() ?>>
<span id="el_clientes_ruc" data-page="1">
<span<?php echo $clientes->ruc->viewAttributes() ?>>
<?php echo $clientes->ruc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes->nom->Visible) { // nom ?>
	<tr id="r_nom">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_nom"><?php echo $clientes->nom->caption() ?></span></td>
		<td data-name="nom"<?php echo $clientes->nom->cellAttributes() ?>>
<span id="el_clientes_nom" data-page="1">
<span<?php echo $clientes->nom->viewAttributes() ?>>
<?php echo $clientes->nom->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes->tel->Visible) { // tel ?>
	<tr id="r_tel">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_tel"><?php echo $clientes->tel->caption() ?></span></td>
		<td data-name="tel"<?php echo $clientes->tel->cellAttributes() ?>>
<span id="el_clientes_tel" data-page="1">
<span<?php echo $clientes->tel->viewAttributes() ?>>
<?php echo $clientes->tel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes->cor->Visible) { // cor ?>
	<tr id="r_cor">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_cor"><?php echo $clientes->cor->caption() ?></span></td>
		<td data-name="cor"<?php echo $clientes->cor->cellAttributes() ?>>
<span id="el_clientes_cor" data-page="1">
<span<?php echo $clientes->cor->viewAttributes() ?>>
<?php echo $clientes->cor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes->msj->Visible) { // msj ?>
	<tr id="r_msj">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_msj"><?php echo $clientes->msj->caption() ?></span></td>
		<td data-name="msj"<?php echo $clientes->msj->cellAttributes() ?>>
<span id="el_clientes_msj" data-page="1">
<span<?php echo $clientes->msj->viewAttributes() ?>>
<?php echo $clientes->msj->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes->codigo->Visible) { // codigo ?>
	<tr id="r_codigo">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_codigo"><?php echo $clientes->codigo->caption() ?></span></td>
		<td data-name="codigo"<?php echo $clientes->codigo->cellAttributes() ?>>
<span id="el_clientes_codigo" data-page="1">
<span<?php echo $clientes->codigo->viewAttributes() ?>>
<?php echo $clientes->codigo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes->hora->Visible) { // hora ?>
	<tr id="r_hora">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_hora"><?php echo $clientes->hora->caption() ?></span></td>
		<td data-name="hora"<?php echo $clientes->hora->cellAttributes() ?>>
<span id="el_clientes_hora" data-page="1">
<span<?php echo $clientes->hora->viewAttributes() ?>>
<?php echo $clientes->hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes->fecha->Visible) { // fecha ?>
	<tr id="r_fecha">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_fecha"><?php echo $clientes->fecha->caption() ?></span></td>
		<td data-name="fecha"<?php echo $clientes->fecha->cellAttributes() ?>>
<span id="el_clientes_fecha" data-page="1">
<span<?php echo $clientes->fecha->viewAttributes() ?>>
<?php echo $clientes->fecha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("cotizaciones", explode(",", $clientes->getCurrentDetailTable())) && $cotizaciones->DetailView) {
?>
<?php if ($clientes->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("cotizaciones", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cotizacionesgrid.php" ?>
<?php } ?>
</form>
<?php
$clientes_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$clientes->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$clientes_view->terminate();
?>