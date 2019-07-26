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
$correos_view = new correos_view();

// Run the page
$correos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$correos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$correos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcorreosview = currentForm = new ew.Form("fcorreosview", "view");

// Form_CustomValidate event
fcorreosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcorreosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$correos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $correos_view->ExportOptions->render("body") ?>
<?php $correos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $correos_view->showPageHeader(); ?>
<?php
$correos_view->showMessage();
?>
<form name="fcorreosview" id="fcorreosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($correos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $correos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="correos">
<input type="hidden" name="modal" value="<?php echo (int)$correos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($correos->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $correos_view->TableLeftColumnClass ?>"><span id="elh_correos_nombre"><?php echo $correos->nombre->caption() ?></span></td>
		<td data-name="nombre"<?php echo $correos->nombre->cellAttributes() ?>>
<span id="el_correos_nombre">
<span<?php echo $correos->nombre->viewAttributes() ?>>
<?php echo $correos->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($correos->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $correos_view->TableLeftColumnClass ?>"><span id="elh_correos_correo"><?php echo $correos->correo->caption() ?></span></td>
		<td data-name="correo"<?php echo $correos->correo->cellAttributes() ?>>
<span id="el_correos_correo">
<span<?php echo $correos->correo->viewAttributes() ?>>
<?php echo $correos->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($correos->hora->Visible) { // hora ?>
	<tr id="r_hora">
		<td class="<?php echo $correos_view->TableLeftColumnClass ?>"><span id="elh_correos_hora"><?php echo $correos->hora->caption() ?></span></td>
		<td data-name="hora"<?php echo $correos->hora->cellAttributes() ?>>
<span id="el_correos_hora">
<span<?php echo $correos->hora->viewAttributes() ?>>
<?php echo $correos->hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($correos->fecha->Visible) { // fecha ?>
	<tr id="r_fecha">
		<td class="<?php echo $correos_view->TableLeftColumnClass ?>"><span id="elh_correos_fecha"><?php echo $correos->fecha->caption() ?></span></td>
		<td data-name="fecha"<?php echo $correos->fecha->cellAttributes() ?>>
<span id="el_correos_fecha">
<span<?php echo $correos->fecha->viewAttributes() ?>>
<?php echo $correos->fecha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$correos_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$correos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$correos_view->terminate();
?>