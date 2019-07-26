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
$blog_delete = new blog_delete();

// Run the page
$blog_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$blog_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fblogdelete = currentForm = new ew.Form("fblogdelete", "delete");

// Form_CustomValidate event
fblogdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fblogdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $blog_delete->showPageHeader(); ?>
<?php
$blog_delete->showMessage();
?>
<form name="fblogdelete" id="fblogdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($blog_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $blog_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="blog">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($blog_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($blog->img->Visible) { // img ?>
		<th class="<?php echo $blog->img->headerCellClass() ?>"><span id="elh_blog_img" class="blog_img"><?php echo $blog->img->caption() ?></span></th>
<?php } ?>
<?php if ($blog->titulo->Visible) { // titulo ?>
		<th class="<?php echo $blog->titulo->headerCellClass() ?>"><span id="elh_blog_titulo" class="blog_titulo"><?php echo $blog->titulo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$blog_delete->RecCnt = 0;
$i = 0;
while (!$blog_delete->Recordset->EOF) {
	$blog_delete->RecCnt++;
	$blog_delete->RowCnt++;

	// Set row properties
	$blog->resetAttributes();
	$blog->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$blog_delete->loadRowValues($blog_delete->Recordset);

	// Render row
	$blog_delete->renderRow();
?>
	<tr<?php echo $blog->rowAttributes() ?>>
<?php if ($blog->img->Visible) { // img ?>
		<td<?php echo $blog->img->cellAttributes() ?>>
<span id="el<?php echo $blog_delete->RowCnt ?>_blog_img" class="blog_img">
<span>
<?php echo GetFileViewTag($blog->img, $blog->img->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($blog->titulo->Visible) { // titulo ?>
		<td<?php echo $blog->titulo->cellAttributes() ?>>
<span id="el<?php echo $blog_delete->RowCnt ?>_blog_titulo" class="blog_titulo">
<span<?php echo $blog->titulo->viewAttributes() ?>>
<?php echo $blog->titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$blog_delete->Recordset->moveNext();
}
$blog_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $blog_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$blog_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$blog_delete->terminate();
?>