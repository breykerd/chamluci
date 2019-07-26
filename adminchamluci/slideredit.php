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
$slider_edit = new slider_edit();

// Run the page
$slider_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slider_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fslideredit = currentForm = new ew.Form("fslideredit", "edit");

// Validate form
fslideredit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($slider_edit->img->Required) { ?>
			felm = this.getElements("x" + infix + "_img");
			elm = this.getElements("fn_x" + infix + "_img");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $slider->img->caption(), $slider->img->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($slider_edit->t1->Required) { ?>
			elm = this.getElements("x" + infix + "_t1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $slider->t1->caption(), $slider->t1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($slider_edit->t2->Required) { ?>
			elm = this.getElements("x" + infix + "_t2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $slider->t2->caption(), $slider->t2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($slider_edit->url->Required) { ?>
			elm = this.getElements("x" + infix + "_url");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $slider->url->caption(), $slider->url->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fslideredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fslideredit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $slider_edit->showPageHeader(); ?>
<?php
$slider_edit->showMessage();
?>
<form name="fslideredit" id="fslideredit" class="<?php echo $slider_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slider_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slider_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slider">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$slider_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($slider->img->Visible) { // img ?>
	<div id="r_img" class="form-group row">
		<label id="elh_slider_img" class="<?php echo $slider_edit->LeftColumnClass ?>"><?php echo $slider->img->caption() ?><?php echo ($slider->img->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slider_edit->RightColumnClass ?>"><div<?php echo $slider->img->cellAttributes() ?>>
<span id="el_slider_img">
<div id="fd_x_img">
<span title="<?php echo $slider->img->title() ? $slider->img->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($slider->img->ReadOnly || $slider->img->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="slider" data-field="x_img" name="x_img" id="x_img"<?php echo $slider->img->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img" id= "fn_x_img" value="<?php echo $slider->img->Upload->FileName ?>">
<?php if (Post("fa_x_img") == "0") { ?>
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="1">
<?php } ?>
<input type="hidden" name="fs_x_img" id= "fs_x_img" value="255">
<input type="hidden" name="fx_x_img" id= "fx_x_img" value="<?php echo $slider->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img" id= "fm_x_img" value="<?php echo $slider->img->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $slider->img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($slider->t1->Visible) { // t1 ?>
	<div id="r_t1" class="form-group row">
		<label id="elh_slider_t1" for="x_t1" class="<?php echo $slider_edit->LeftColumnClass ?>"><?php echo $slider->t1->caption() ?><?php echo ($slider->t1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slider_edit->RightColumnClass ?>"><div<?php echo $slider->t1->cellAttributes() ?>>
<span id="el_slider_t1">
<input type="text" data-table="slider" data-field="x_t1" name="x_t1" id="x_t1" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($slider->t1->getPlaceHolder()) ?>" value="<?php echo $slider->t1->EditValue ?>"<?php echo $slider->t1->editAttributes() ?>>
</span>
<?php echo $slider->t1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($slider->t2->Visible) { // t2 ?>
	<div id="r_t2" class="form-group row">
		<label id="elh_slider_t2" for="x_t2" class="<?php echo $slider_edit->LeftColumnClass ?>"><?php echo $slider->t2->caption() ?><?php echo ($slider->t2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slider_edit->RightColumnClass ?>"><div<?php echo $slider->t2->cellAttributes() ?>>
<span id="el_slider_t2">
<input type="text" data-table="slider" data-field="x_t2" name="x_t2" id="x_t2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($slider->t2->getPlaceHolder()) ?>" value="<?php echo $slider->t2->EditValue ?>"<?php echo $slider->t2->editAttributes() ?>>
</span>
<?php echo $slider->t2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($slider->url->Visible) { // url ?>
	<div id="r_url" class="form-group row">
		<label id="elh_slider_url" for="x_url" class="<?php echo $slider_edit->LeftColumnClass ?>"><?php echo $slider->url->caption() ?><?php echo ($slider->url->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slider_edit->RightColumnClass ?>"><div<?php echo $slider->url->cellAttributes() ?>>
<span id="el_slider_url">
<input type="text" data-table="slider" data-field="x_url" name="x_url" id="x_url" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($slider->url->getPlaceHolder()) ?>" value="<?php echo $slider->url->EditValue ?>"<?php echo $slider->url->editAttributes() ?>>
</span>
<?php echo $slider->url->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="slider" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($slider->id->CurrentValue) ?>">
<?php if (!$slider_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $slider_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $slider_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$slider_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$slider_edit->terminate();
?>