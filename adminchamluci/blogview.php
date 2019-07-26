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
$blog_view = new blog_view();

// Run the page
$blog_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$blog_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$blog->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fblogview = currentForm = new ew.Form("fblogview", "view");

// Form_CustomValidate event
fblogview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fblogview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$blog->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $blog_view->ExportOptions->render("body") ?>
<?php $blog_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $blog_view->showPageHeader(); ?>
<?php
$blog_view->showMessage();
?>
<form name="fblogview" id="fblogview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($blog_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $blog_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="blog">
<input type="hidden" name="modal" value="<?php echo (int)$blog_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($blog->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_id"><?php echo $blog->id->caption() ?></span></td>
		<td data-name="id"<?php echo $blog->id->cellAttributes() ?>>
<span id="el_blog_id" data-page="1">
<span<?php echo $blog->id->viewAttributes() ?>>
<?php echo $blog->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($blog->img->Visible) { // img ?>
	<tr id="r_img">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_img"><?php echo $blog->img->caption() ?></span></td>
		<td data-name="img"<?php echo $blog->img->cellAttributes() ?>>
<span id="el_blog_img" data-page="1">
<span>
<?php echo GetFileViewTag($blog->img, $blog->img->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($blog->titulo->Visible) { // titulo ?>
	<tr id="r_titulo">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_titulo"><?php echo $blog->titulo->caption() ?></span></td>
		<td data-name="titulo"<?php echo $blog->titulo->cellAttributes() ?>>
<span id="el_blog_titulo" data-page="1">
<span<?php echo $blog->titulo->viewAttributes() ?>>
<?php echo $blog->titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($blog->detalle->Visible) { // detalle ?>
	<tr id="r_detalle">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_detalle"><?php echo $blog->detalle->caption() ?></span></td>
		<td data-name="detalle"<?php echo $blog->detalle->cellAttributes() ?>>
<span id="el_blog_detalle" data-page="1">
<span<?php echo $blog->detalle->viewAttributes() ?>>
<?php echo $blog->detalle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($blog->detalle2->Visible) { // detalle2 ?>
	<tr id="r_detalle2">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_detalle2"><?php echo $blog->detalle2->caption() ?></span></td>
		<td data-name="detalle2"<?php echo $blog->detalle2->cellAttributes() ?>>
<span id="el_blog_detalle2" data-page="1">
<span<?php echo $blog->detalle2->viewAttributes() ?>>
<?php echo $blog->detalle2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($blog->url->Visible) { // url ?>
	<tr id="r_url">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_url"><?php echo $blog->url->caption() ?></span></td>
		<td data-name="url"<?php echo $blog->url->cellAttributes() ?>>
<span id="el_blog_url" data-page="1">
<span<?php echo $blog->url->viewAttributes() ?>>
<?php echo $blog->url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($blog->keywords->Visible) { // keywords ?>
	<tr id="r_keywords">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_keywords"><?php echo $blog->keywords->caption() ?></span></td>
		<td data-name="keywords"<?php echo $blog->keywords->cellAttributes() ?>>
<span id="el_blog_keywords" data-page="1">
<span<?php echo $blog->keywords->viewAttributes() ?>>
<?php echo $blog->keywords->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($blog->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $blog_view->TableLeftColumnClass ?>"><span id="elh_blog_description"><?php echo $blog->description->caption() ?></span></td>
		<td data-name="description"<?php echo $blog->description->cellAttributes() ?>>
<span id="el_blog_description" data-page="1">
<span<?php echo $blog->description->viewAttributes() ?>>
<?php echo $blog->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$blog_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$blog->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$blog_view->terminate();
?>