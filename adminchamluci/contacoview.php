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
$contaco_view = new contaco_view();

// Run the page
$contaco_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contaco_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contaco->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcontacoview = currentForm = new ew.Form("fcontacoview", "view");

// Form_CustomValidate event
fcontacoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontacoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contaco->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contaco_view->ExportOptions->render("body") ?>
<?php $contaco_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contaco_view->showPageHeader(); ?>
<?php
$contaco_view->showMessage();
?>
<form name="fcontacoview" id="fcontacoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contaco_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contaco_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contaco">
<input type="hidden" name="modal" value="<?php echo (int)$contaco_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contaco->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_correo"><?php echo $contaco->correo->caption() ?></span></td>
		<td data-name="correo"<?php echo $contaco->correo->cellAttributes() ?>>
<span id="el_contaco_correo">
<span<?php echo $contaco->correo->viewAttributes() ?>>
<?php echo $contaco->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->direccion->Visible) { // direccion ?>
	<tr id="r_direccion">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_direccion"><?php echo $contaco->direccion->caption() ?></span></td>
		<td data-name="direccion"<?php echo $contaco->direccion->cellAttributes() ?>>
<span id="el_contaco_direccion">
<span<?php echo $contaco->direccion->viewAttributes() ?>>
<?php echo $contaco->direccion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->tel1->Visible) { // tel1 ?>
	<tr id="r_tel1">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_tel1"><?php echo $contaco->tel1->caption() ?></span></td>
		<td data-name="tel1"<?php echo $contaco->tel1->cellAttributes() ?>>
<span id="el_contaco_tel1">
<span<?php echo $contaco->tel1->viewAttributes() ?>>
<?php echo $contaco->tel1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->tel2->Visible) { // tel2 ?>
	<tr id="r_tel2">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_tel2"><?php echo $contaco->tel2->caption() ?></span></td>
		<td data-name="tel2"<?php echo $contaco->tel2->cellAttributes() ?>>
<span id="el_contaco_tel2">
<span<?php echo $contaco->tel2->viewAttributes() ?>>
<?php echo $contaco->tel2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->tel3->Visible) { // tel3 ?>
	<tr id="r_tel3">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_tel3"><?php echo $contaco->tel3->caption() ?></span></td>
		<td data-name="tel3"<?php echo $contaco->tel3->cellAttributes() ?>>
<span id="el_contaco_tel3">
<span<?php echo $contaco->tel3->viewAttributes() ?>>
<?php echo $contaco->tel3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->tel4->Visible) { // tel4 ?>
	<tr id="r_tel4">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_tel4"><?php echo $contaco->tel4->caption() ?></span></td>
		<td data-name="tel4"<?php echo $contaco->tel4->cellAttributes() ?>>
<span id="el_contaco_tel4">
<span<?php echo $contaco->tel4->viewAttributes() ?>>
<?php echo $contaco->tel4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->tel5->Visible) { // tel5 ?>
	<tr id="r_tel5">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_tel5"><?php echo $contaco->tel5->caption() ?></span></td>
		<td data-name="tel5"<?php echo $contaco->tel5->cellAttributes() ?>>
<span id="el_contaco_tel5">
<span<?php echo $contaco->tel5->viewAttributes() ?>>
<?php echo $contaco->tel5->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->horario->Visible) { // horario ?>
	<tr id="r_horario">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_horario"><?php echo $contaco->horario->caption() ?></span></td>
		<td data-name="horario"<?php echo $contaco->horario->cellAttributes() ?>>
<span id="el_contaco_horario">
<span<?php echo $contaco->horario->viewAttributes() ?>>
<?php echo $contaco->horario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->img_bcp->Visible) { // img_bcp ?>
	<tr id="r_img_bcp">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_img_bcp"><?php echo $contaco->img_bcp->caption() ?></span></td>
		<td data-name="img_bcp"<?php echo $contaco->img_bcp->cellAttributes() ?>>
<span id="el_contaco_img_bcp">
<span>
<?php echo GetFileViewTag($contaco->img_bcp, $contaco->img_bcp->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->t_bcp1->Visible) { // t_bcp1 ?>
	<tr id="r_t_bcp1">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_t_bcp1"><?php echo $contaco->t_bcp1->caption() ?></span></td>
		<td data-name="t_bcp1"<?php echo $contaco->t_bcp1->cellAttributes() ?>>
<span id="el_contaco_t_bcp1">
<span<?php echo $contaco->t_bcp1->viewAttributes() ?>>
<?php echo $contaco->t_bcp1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->t_bcp2->Visible) { // t_bcp2 ?>
	<tr id="r_t_bcp2">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_t_bcp2"><?php echo $contaco->t_bcp2->caption() ?></span></td>
		<td data-name="t_bcp2"<?php echo $contaco->t_bcp2->cellAttributes() ?>>
<span id="el_contaco_t_bcp2">
<span<?php echo $contaco->t_bcp2->viewAttributes() ?>>
<?php echo $contaco->t_bcp2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->t_bcp3->Visible) { // t_bcp3 ?>
	<tr id="r_t_bcp3">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_t_bcp3"><?php echo $contaco->t_bcp3->caption() ?></span></td>
		<td data-name="t_bcp3"<?php echo $contaco->t_bcp3->cellAttributes() ?>>
<span id="el_contaco_t_bcp3">
<span<?php echo $contaco->t_bcp3->viewAttributes() ?>>
<?php echo $contaco->t_bcp3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->img_bbva->Visible) { // img_bbva ?>
	<tr id="r_img_bbva">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_img_bbva"><?php echo $contaco->img_bbva->caption() ?></span></td>
		<td data-name="img_bbva"<?php echo $contaco->img_bbva->cellAttributes() ?>>
<span id="el_contaco_img_bbva">
<span>
<?php echo GetFileViewTag($contaco->img_bbva, $contaco->img_bbva->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->t_bbva_1->Visible) { // t_bbva_1 ?>
	<tr id="r_t_bbva_1">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_t_bbva_1"><?php echo $contaco->t_bbva_1->caption() ?></span></td>
		<td data-name="t_bbva_1"<?php echo $contaco->t_bbva_1->cellAttributes() ?>>
<span id="el_contaco_t_bbva_1">
<span<?php echo $contaco->t_bbva_1->viewAttributes() ?>>
<?php echo $contaco->t_bbva_1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->t_bbva_2->Visible) { // t_bbva_2 ?>
	<tr id="r_t_bbva_2">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_t_bbva_2"><?php echo $contaco->t_bbva_2->caption() ?></span></td>
		<td data-name="t_bbva_2"<?php echo $contaco->t_bbva_2->cellAttributes() ?>>
<span id="el_contaco_t_bbva_2">
<span<?php echo $contaco->t_bbva_2->viewAttributes() ?>>
<?php echo $contaco->t_bbva_2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->t_bbva_3->Visible) { // t_bbva_3 ?>
	<tr id="r_t_bbva_3">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_t_bbva_3"><?php echo $contaco->t_bbva_3->caption() ?></span></td>
		<td data-name="t_bbva_3"<?php echo $contaco->t_bbva_3->cellAttributes() ?>>
<span id="el_contaco_t_bbva_3">
<span<?php echo $contaco->t_bbva_3->viewAttributes() ?>>
<?php echo $contaco->t_bbva_3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->fa->Visible) { // fa ?>
	<tr id="r_fa">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_fa"><?php echo $contaco->fa->caption() ?></span></td>
		<td data-name="fa"<?php echo $contaco->fa->cellAttributes() ?>>
<span id="el_contaco_fa">
<span<?php echo $contaco->fa->viewAttributes() ?>>
<?php echo $contaco->fa->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->tw->Visible) { // tw ?>
	<tr id="r_tw">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_tw"><?php echo $contaco->tw->caption() ?></span></td>
		<td data-name="tw"<?php echo $contaco->tw->cellAttributes() ?>>
<span id="el_contaco_tw">
<span<?php echo $contaco->tw->viewAttributes() ?>>
<?php echo $contaco->tw->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->in->Visible) { // in ?>
	<tr id="r_in">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_in"><?php echo $contaco->in->caption() ?></span></td>
		<td data-name="in"<?php echo $contaco->in->cellAttributes() ?>>
<span id="el_contaco_in">
<span<?php echo $contaco->in->viewAttributes() ?>>
<?php echo $contaco->in->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->go->Visible) { // go ?>
	<tr id="r_go">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_go"><?php echo $contaco->go->caption() ?></span></td>
		<td data-name="go"<?php echo $contaco->go->cellAttributes() ?>>
<span id="el_contaco_go">
<span<?php echo $contaco->go->viewAttributes() ?>>
<?php echo $contaco->go->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->you->Visible) { // you ?>
	<tr id="r_you">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_you"><?php echo $contaco->you->caption() ?></span></td>
		<td data-name="you"<?php echo $contaco->you->cellAttributes() ?>>
<span id="el_contaco_you">
<span<?php echo $contaco->you->viewAttributes() ?>>
<?php echo $contaco->you->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->correo_formulario->Visible) { // correo_formulario ?>
	<tr id="r_correo_formulario">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_correo_formulario"><?php echo $contaco->correo_formulario->caption() ?></span></td>
		<td data-name="correo_formulario"<?php echo $contaco->correo_formulario->cellAttributes() ?>>
<span id="el_contaco_correo_formulario">
<span<?php echo $contaco->correo_formulario->viewAttributes() ?>>
<?php echo $contaco->correo_formulario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->keywords->Visible) { // keywords ?>
	<tr id="r_keywords">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_keywords"><?php echo $contaco->keywords->caption() ?></span></td>
		<td data-name="keywords"<?php echo $contaco->keywords->cellAttributes() ?>>
<span id="el_contaco_keywords">
<span<?php echo $contaco->keywords->viewAttributes() ?>>
<?php echo $contaco->keywords->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contaco->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $contaco_view->TableLeftColumnClass ?>"><span id="elh_contaco_description"><?php echo $contaco->description->caption() ?></span></td>
		<td data-name="description"<?php echo $contaco->description->cellAttributes() ?>>
<span id="el_contaco_description">
<span<?php echo $contaco->description->viewAttributes() ?>>
<?php echo $contaco->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$contaco_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contaco->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contaco_view->terminate();
?>