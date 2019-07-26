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
$slider_view = new slider_view();

// Run the page
$slider_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slider_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$slider->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fsliderview = currentForm = new ew.Form("fsliderview", "view");

// Form_CustomValidate event
fsliderview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsliderview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$slider->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $slider_view->ExportOptions->render("body") ?>
<?php $slider_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $slider_view->showPageHeader(); ?>
<?php
$slider_view->showMessage();
?>
<form name="fsliderview" id="fsliderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slider_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slider_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slider">
<input type="hidden" name="modal" value="<?php echo (int)$slider_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($slider->img->Visible) { // img ?>
	<tr id="r_img">
		<td class="<?php echo $slider_view->TableLeftColumnClass ?>"><span id="elh_slider_img"><?php echo $slider->img->caption() ?></span></td>
		<td data-name="img"<?php echo $slider->img->cellAttributes() ?>>
<span id="el_slider_img">
<span>
<?php echo GetFileViewTag($slider->img, $slider->img->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($slider->t1->Visible) { // t1 ?>
	<tr id="r_t1">
		<td class="<?php echo $slider_view->TableLeftColumnClass ?>"><span id="elh_slider_t1"><?php echo $slider->t1->caption() ?></span></td>
		<td data-name="t1"<?php echo $slider->t1->cellAttributes() ?>>
<span id="el_slider_t1">
<span<?php echo $slider->t1->viewAttributes() ?>>
<?php echo $slider->t1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($slider->t2->Visible) { // t2 ?>
	<tr id="r_t2">
		<td class="<?php echo $slider_view->TableLeftColumnClass ?>"><span id="elh_slider_t2"><?php echo $slider->t2->caption() ?></span></td>
		<td data-name="t2"<?php echo $slider->t2->cellAttributes() ?>>
<span id="el_slider_t2">
<span<?php echo $slider->t2->viewAttributes() ?>>
<?php echo $slider->t2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($slider->url->Visible) { // url ?>
	<tr id="r_url">
		<td class="<?php echo $slider_view->TableLeftColumnClass ?>"><span id="elh_slider_url"><?php echo $slider->url->caption() ?></span></td>
		<td data-name="url"<?php echo $slider->url->cellAttributes() ?>>
<span id="el_slider_url">
<span<?php echo $slider->url->viewAttributes() ?>>
<?php echo $slider->url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$slider_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$slider->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$slider_view->terminate();
?>