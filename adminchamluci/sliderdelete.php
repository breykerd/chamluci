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
$slider_delete = new slider_delete();

// Run the page
$slider_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slider_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fsliderdelete = currentForm = new ew.Form("fsliderdelete", "delete");

// Form_CustomValidate event
fsliderdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsliderdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $slider_delete->showPageHeader(); ?>
<?php
$slider_delete->showMessage();
?>
<form name="fsliderdelete" id="fsliderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slider_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slider_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slider">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($slider_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($slider->img->Visible) { // img ?>
		<th class="<?php echo $slider->img->headerCellClass() ?>"><span id="elh_slider_img" class="slider_img"><?php echo $slider->img->caption() ?></span></th>
<?php } ?>
<?php if ($slider->t1->Visible) { // t1 ?>
		<th class="<?php echo $slider->t1->headerCellClass() ?>"><span id="elh_slider_t1" class="slider_t1"><?php echo $slider->t1->caption() ?></span></th>
<?php } ?>
<?php if ($slider->t2->Visible) { // t2 ?>
		<th class="<?php echo $slider->t2->headerCellClass() ?>"><span id="elh_slider_t2" class="slider_t2"><?php echo $slider->t2->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$slider_delete->RecCnt = 0;
$i = 0;
while (!$slider_delete->Recordset->EOF) {
	$slider_delete->RecCnt++;
	$slider_delete->RowCnt++;

	// Set row properties
	$slider->resetAttributes();
	$slider->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$slider_delete->loadRowValues($slider_delete->Recordset);

	// Render row
	$slider_delete->renderRow();
?>
	<tr<?php echo $slider->rowAttributes() ?>>
<?php if ($slider->img->Visible) { // img ?>
		<td<?php echo $slider->img->cellAttributes() ?>>
<span id="el<?php echo $slider_delete->RowCnt ?>_slider_img" class="slider_img">
<span>
<?php echo GetFileViewTag($slider->img, $slider->img->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($slider->t1->Visible) { // t1 ?>
		<td<?php echo $slider->t1->cellAttributes() ?>>
<span id="el<?php echo $slider_delete->RowCnt ?>_slider_t1" class="slider_t1">
<span<?php echo $slider->t1->viewAttributes() ?>>
<?php echo $slider->t1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($slider->t2->Visible) { // t2 ?>
		<td<?php echo $slider->t2->cellAttributes() ?>>
<span id="el<?php echo $slider_delete->RowCnt ?>_slider_t2" class="slider_t2">
<span<?php echo $slider->t2->viewAttributes() ?>>
<?php echo $slider->t2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$slider_delete->Recordset->moveNext();
}
$slider_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $slider_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$slider_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$slider_delete->terminate();
?>