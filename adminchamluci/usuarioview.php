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
$usuario_view = new usuario_view();

// Run the page
$usuario_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusuarioview = currentForm = new ew.Form("fusuarioview", "view");

// Form_CustomValidate event
fusuarioview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuario_view->ExportOptions->render("body") ?>
<?php $usuario_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuario_view->showPageHeader(); ?>
<?php
$usuario_view->showMessage();
?>
<form name="fusuarioview" id="fusuarioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuario->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_id"><?php echo $usuario->id->caption() ?></span></td>
		<td data-name="id"<?php echo $usuario->id->cellAttributes() ?>>
<span id="el_usuario_id" data-page="1">
<span<?php echo $usuario->id->viewAttributes() ?>>
<?php echo $usuario->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->user->Visible) { // user ?>
	<tr id="r_user">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_user"><?php echo $usuario->user->caption() ?></span></td>
		<td data-name="user"<?php echo $usuario->user->cellAttributes() ?>>
<span id="el_usuario_user" data-page="1">
<span<?php echo $usuario->user->viewAttributes() ?>>
<?php echo $usuario->user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->clave->Visible) { // clave ?>
	<tr id="r_clave">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_clave"><?php echo $usuario->clave->caption() ?></span></td>
		<td data-name="clave"<?php echo $usuario->clave->cellAttributes() ?>>
<span id="el_usuario_clave" data-page="1">
<span<?php echo $usuario->clave->viewAttributes() ?>>
<?php echo $usuario->clave->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$usuario_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuario_view->terminate();
?>