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
$productos_view = new productos_view();

// Run the page
$productos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$productos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$productos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproductosview = currentForm = new ew.Form("fproductosview", "view");

// Form_CustomValidate event
fproductosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductosview.lists["x_destacado_inicio"] = <?php echo $productos_view->destacado_inicio->Lookup->toClientList() ?>;
fproductosview.lists["x_destacado_inicio"].options = <?php echo JsonEncode($productos_view->destacado_inicio->options(FALSE, TRUE)) ?>;
fproductosview.lists["x_destacado_footer"] = <?php echo $productos_view->destacado_footer->Lookup->toClientList() ?>;
fproductosview.lists["x_destacado_footer"].options = <?php echo JsonEncode($productos_view->destacado_footer->options(FALSE, TRUE)) ?>;
fproductosview.lists["x_destacado_productos"] = <?php echo $productos_view->destacado_productos->Lookup->toClientList() ?>;
fproductosview.lists["x_destacado_productos"].options = <?php echo JsonEncode($productos_view->destacado_productos->options(FALSE, TRUE)) ?>;
fproductosview.lists["x_id_cate"] = <?php echo $productos_view->id_cate->Lookup->toClientList() ?>;
fproductosview.lists["x_id_cate"].options = <?php echo JsonEncode($productos_view->id_cate->lookupOptions()) ?>;
fproductosview.lists["x_img_principal"] = <?php echo $productos_view->img_principal->Lookup->toClientList() ?>;
fproductosview.lists["x_img_principal"].options = <?php echo JsonEncode($productos_view->img_principal->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$productos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $productos_view->ExportOptions->render("body") ?>
<?php $productos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $productos_view->showPageHeader(); ?>
<?php
$productos_view->showMessage();
?>
<form name="fproductosview" id="fproductosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($productos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $productos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="productos">
<input type="hidden" name="modal" value="<?php echo (int)$productos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($productos->titulo->Visible) { // titulo ?>
	<tr id="r_titulo">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_titulo"><?php echo $productos->titulo->caption() ?></span></td>
		<td data-name="titulo"<?php echo $productos->titulo->cellAttributes() ?>>
<span id="el_productos_titulo">
<span<?php echo $productos->titulo->viewAttributes() ?>>
<?php echo $productos->titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->detalle->Visible) { // detalle ?>
	<tr id="r_detalle">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_detalle"><?php echo $productos->detalle->caption() ?></span></td>
		<td data-name="detalle"<?php echo $productos->detalle->cellAttributes() ?>>
<span id="el_productos_detalle">
<span<?php echo $productos->detalle->viewAttributes() ?>>
<?php echo $productos->detalle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img1->Visible) { // img1 ?>
	<tr id="r_img1">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img1"><?php echo $productos->img1->caption() ?></span></td>
		<td data-name="img1"<?php echo $productos->img1->cellAttributes() ?>>
<span id="el_productos_img1">
<span>
<?php echo GetFileViewTag($productos->img1, $productos->img1->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img2->Visible) { // img2 ?>
	<tr id="r_img2">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img2"><?php echo $productos->img2->caption() ?></span></td>
		<td data-name="img2"<?php echo $productos->img2->cellAttributes() ?>>
<span id="el_productos_img2">
<span>
<?php echo GetFileViewTag($productos->img2, $productos->img2->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img3->Visible) { // img3 ?>
	<tr id="r_img3">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img3"><?php echo $productos->img3->caption() ?></span></td>
		<td data-name="img3"<?php echo $productos->img3->cellAttributes() ?>>
<span id="el_productos_img3">
<span>
<?php echo GetFileViewTag($productos->img3, $productos->img3->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img4->Visible) { // img4 ?>
	<tr id="r_img4">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img4"><?php echo $productos->img4->caption() ?></span></td>
		<td data-name="img4"<?php echo $productos->img4->cellAttributes() ?>>
<span id="el_productos_img4">
<span>
<?php echo GetFileViewTag($productos->img4, $productos->img4->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img5->Visible) { // img5 ?>
	<tr id="r_img5">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img5"><?php echo $productos->img5->caption() ?></span></td>
		<td data-name="img5"<?php echo $productos->img5->cellAttributes() ?>>
<span id="el_productos_img5">
<span>
<?php echo GetFileViewTag($productos->img5, $productos->img5->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img6->Visible) { // img6 ?>
	<tr id="r_img6">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img6"><?php echo $productos->img6->caption() ?></span></td>
		<td data-name="img6"<?php echo $productos->img6->cellAttributes() ?>>
<span id="el_productos_img6">
<span>
<?php echo GetFileViewTag($productos->img6, $productos->img6->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img7->Visible) { // img7 ?>
	<tr id="r_img7">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img7"><?php echo $productos->img7->caption() ?></span></td>
		<td data-name="img7"<?php echo $productos->img7->cellAttributes() ?>>
<span id="el_productos_img7">
<span>
<?php echo GetFileViewTag($productos->img7, $productos->img7->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img8->Visible) { // img8 ?>
	<tr id="r_img8">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img8"><?php echo $productos->img8->caption() ?></span></td>
		<td data-name="img8"<?php echo $productos->img8->cellAttributes() ?>>
<span id="el_productos_img8">
<span>
<?php echo GetFileViewTag($productos->img8, $productos->img8->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img9->Visible) { // img9 ?>
	<tr id="r_img9">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img9"><?php echo $productos->img9->caption() ?></span></td>
		<td data-name="img9"<?php echo $productos->img9->cellAttributes() ?>>
<span id="el_productos_img9">
<span>
<?php echo GetFileViewTag($productos->img9, $productos->img9->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
	<tr id="r_destacado_inicio">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_destacado_inicio"><?php echo $productos->destacado_inicio->caption() ?></span></td>
		<td data-name="destacado_inicio"<?php echo $productos->destacado_inicio->cellAttributes() ?>>
<span id="el_productos_destacado_inicio">
<span<?php echo $productos->destacado_inicio->viewAttributes() ?>>
<?php echo $productos->destacado_inicio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
	<tr id="r_destacado_footer">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_destacado_footer"><?php echo $productos->destacado_footer->caption() ?></span></td>
		<td data-name="destacado_footer"<?php echo $productos->destacado_footer->cellAttributes() ?>>
<span id="el_productos_destacado_footer">
<span<?php echo $productos->destacado_footer->viewAttributes() ?>>
<?php echo $productos->destacado_footer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
	<tr id="r_destacado_productos">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_destacado_productos"><?php echo $productos->destacado_productos->caption() ?></span></td>
		<td data-name="destacado_productos"<?php echo $productos->destacado_productos->cellAttributes() ?>>
<span id="el_productos_destacado_productos">
<span<?php echo $productos->destacado_productos->viewAttributes() ?>>
<?php echo $productos->destacado_productos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->id_cate->Visible) { // id_cate ?>
	<tr id="r_id_cate">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_id_cate"><?php echo $productos->id_cate->caption() ?></span></td>
		<td data-name="id_cate"<?php echo $productos->id_cate->cellAttributes() ?>>
<span id="el_productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<?php echo $productos->id_cate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->ficha_tecnica->Visible) { // ficha_tecnica ?>
	<tr id="r_ficha_tecnica">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_ficha_tecnica"><?php echo $productos->ficha_tecnica->caption() ?></span></td>
		<td data-name="ficha_tecnica"<?php echo $productos->ficha_tecnica->cellAttributes() ?>>
<span id="el_productos_ficha_tecnica">
<span<?php echo $productos->ficha_tecnica->viewAttributes() ?>>
<?php echo GetFileViewTag($productos->ficha_tecnica, $productos->ficha_tecnica->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->img_principal->Visible) { // img_principal ?>
	<tr id="r_img_principal">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_img_principal"><?php echo $productos->img_principal->caption() ?></span></td>
		<td data-name="img_principal"<?php echo $productos->img_principal->cellAttributes() ?>>
<span id="el_productos_img_principal">
<span>
<?php echo GetImageViewTag($productos->img_principal, $productos->img_principal->getViewValue()) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->url->Visible) { // url ?>
	<tr id="r_url">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_url"><?php echo $productos->url->caption() ?></span></td>
		<td data-name="url"<?php echo $productos->url->cellAttributes() ?>>
<span id="el_productos_url">
<span<?php echo $productos->url->viewAttributes() ?>>
<?php echo $productos->url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->keywords->Visible) { // keywords ?>
	<tr id="r_keywords">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_keywords"><?php echo $productos->keywords->caption() ?></span></td>
		<td data-name="keywords"<?php echo $productos->keywords->cellAttributes() ?>>
<span id="el_productos_keywords">
<span<?php echo $productos->keywords->viewAttributes() ?>>
<?php echo $productos->keywords->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($productos->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $productos_view->TableLeftColumnClass ?>"><span id="elh_productos_description"><?php echo $productos->description->caption() ?></span></td>
		<td data-name="description"<?php echo $productos->description->cellAttributes() ?>>
<span id="el_productos_description">
<span<?php echo $productos->description->viewAttributes() ?>>
<?php echo $productos->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$productos_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$productos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$productos_view->terminate();
?>