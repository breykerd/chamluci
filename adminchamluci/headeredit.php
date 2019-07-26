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
$header_edit = new header_edit();

// Run the page
$header_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$header_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fheaderedit = currentForm = new ew.Form("fheaderedit", "edit");

// Validate form
fheaderedit.validate = function() {
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
		<?php if ($header_edit->img_empresa->Required) { ?>
			felm = this.getElements("x" + infix + "_img_empresa");
			elm = this.getElements("fn_x" + infix + "_img_empresa");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $header->img_empresa->caption(), $header->img_empresa->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($header_edit->img_blog->Required) { ?>
			felm = this.getElements("x" + infix + "_img_blog");
			elm = this.getElements("fn_x" + infix + "_img_blog");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $header->img_blog->caption(), $header->img_blog->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($header_edit->img_contacto->Required) { ?>
			felm = this.getElements("x" + infix + "_img_contacto");
			elm = this.getElements("fn_x" + infix + "_img_contacto");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $header->img_contacto->caption(), $header->img_contacto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($header_edit->img_pasarela->Required) { ?>
			felm = this.getElements("x" + infix + "_img_pasarela");
			elm = this.getElements("fn_x" + infix + "_img_pasarela");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $header->img_pasarela->caption(), $header->img_pasarela->RequiredErrorMessage)) ?>");
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
fheaderedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fheaderedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $header_edit->showPageHeader(); ?>
<?php
$header_edit->showMessage();
?>
<form name="fheaderedit" id="fheaderedit" class="<?php echo $header_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($header_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $header_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="header">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$header_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($header->img_empresa->Visible) { // img_empresa ?>
	<div id="r_img_empresa" class="form-group row">
		<label id="elh_header_img_empresa" class="<?php echo $header_edit->LeftColumnClass ?>"><?php echo $header->img_empresa->caption() ?><?php echo ($header->img_empresa->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $header_edit->RightColumnClass ?>"><div<?php echo $header->img_empresa->cellAttributes() ?>>
<span id="el_header_img_empresa">
<div id="fd_x_img_empresa">
<span title="<?php echo $header->img_empresa->title() ? $header->img_empresa->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($header->img_empresa->ReadOnly || $header->img_empresa->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="header" data-field="x_img_empresa" name="x_img_empresa" id="x_img_empresa"<?php echo $header->img_empresa->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_empresa" id= "fn_x_img_empresa" value="<?php echo $header->img_empresa->Upload->FileName ?>">
<?php if (Post("fa_x_img_empresa") == "0") { ?>
<input type="hidden" name="fa_x_img_empresa" id= "fa_x_img_empresa" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_img_empresa" id= "fa_x_img_empresa" value="1">
<?php } ?>
<input type="hidden" name="fs_x_img_empresa" id= "fs_x_img_empresa" value="255">
<input type="hidden" name="fx_x_img_empresa" id= "fx_x_img_empresa" value="<?php echo $header->img_empresa->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_empresa" id= "fm_x_img_empresa" value="<?php echo $header->img_empresa->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_empresa" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $header->img_empresa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($header->img_blog->Visible) { // img_blog ?>
	<div id="r_img_blog" class="form-group row">
		<label id="elh_header_img_blog" class="<?php echo $header_edit->LeftColumnClass ?>"><?php echo $header->img_blog->caption() ?><?php echo ($header->img_blog->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $header_edit->RightColumnClass ?>"><div<?php echo $header->img_blog->cellAttributes() ?>>
<span id="el_header_img_blog">
<div id="fd_x_img_blog">
<span title="<?php echo $header->img_blog->title() ? $header->img_blog->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($header->img_blog->ReadOnly || $header->img_blog->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="header" data-field="x_img_blog" name="x_img_blog" id="x_img_blog"<?php echo $header->img_blog->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_blog" id= "fn_x_img_blog" value="<?php echo $header->img_blog->Upload->FileName ?>">
<?php if (Post("fa_x_img_blog") == "0") { ?>
<input type="hidden" name="fa_x_img_blog" id= "fa_x_img_blog" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_img_blog" id= "fa_x_img_blog" value="1">
<?php } ?>
<input type="hidden" name="fs_x_img_blog" id= "fs_x_img_blog" value="255">
<input type="hidden" name="fx_x_img_blog" id= "fx_x_img_blog" value="<?php echo $header->img_blog->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_blog" id= "fm_x_img_blog" value="<?php echo $header->img_blog->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_blog" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $header->img_blog->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($header->img_contacto->Visible) { // img_contacto ?>
	<div id="r_img_contacto" class="form-group row">
		<label id="elh_header_img_contacto" class="<?php echo $header_edit->LeftColumnClass ?>"><?php echo $header->img_contacto->caption() ?><?php echo ($header->img_contacto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $header_edit->RightColumnClass ?>"><div<?php echo $header->img_contacto->cellAttributes() ?>>
<span id="el_header_img_contacto">
<div id="fd_x_img_contacto">
<span title="<?php echo $header->img_contacto->title() ? $header->img_contacto->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($header->img_contacto->ReadOnly || $header->img_contacto->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="header" data-field="x_img_contacto" name="x_img_contacto" id="x_img_contacto"<?php echo $header->img_contacto->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_contacto" id= "fn_x_img_contacto" value="<?php echo $header->img_contacto->Upload->FileName ?>">
<?php if (Post("fa_x_img_contacto") == "0") { ?>
<input type="hidden" name="fa_x_img_contacto" id= "fa_x_img_contacto" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_img_contacto" id= "fa_x_img_contacto" value="1">
<?php } ?>
<input type="hidden" name="fs_x_img_contacto" id= "fs_x_img_contacto" value="255">
<input type="hidden" name="fx_x_img_contacto" id= "fx_x_img_contacto" value="<?php echo $header->img_contacto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_contacto" id= "fm_x_img_contacto" value="<?php echo $header->img_contacto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_contacto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $header->img_contacto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($header->img_pasarela->Visible) { // img_pasarela ?>
	<div id="r_img_pasarela" class="form-group row">
		<label id="elh_header_img_pasarela" class="<?php echo $header_edit->LeftColumnClass ?>"><?php echo $header->img_pasarela->caption() ?><?php echo ($header->img_pasarela->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $header_edit->RightColumnClass ?>"><div<?php echo $header->img_pasarela->cellAttributes() ?>>
<span id="el_header_img_pasarela">
<div id="fd_x_img_pasarela">
<span title="<?php echo $header->img_pasarela->title() ? $header->img_pasarela->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($header->img_pasarela->ReadOnly || $header->img_pasarela->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="header" data-field="x_img_pasarela" name="x_img_pasarela" id="x_img_pasarela"<?php echo $header->img_pasarela->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_pasarela" id= "fn_x_img_pasarela" value="<?php echo $header->img_pasarela->Upload->FileName ?>">
<?php if (Post("fa_x_img_pasarela") == "0") { ?>
<input type="hidden" name="fa_x_img_pasarela" id= "fa_x_img_pasarela" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_img_pasarela" id= "fa_x_img_pasarela" value="1">
<?php } ?>
<input type="hidden" name="fs_x_img_pasarela" id= "fs_x_img_pasarela" value="255">
<input type="hidden" name="fx_x_img_pasarela" id= "fx_x_img_pasarela" value="<?php echo $header->img_pasarela->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_pasarela" id= "fm_x_img_pasarela" value="<?php echo $header->img_pasarela->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_pasarela" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $header->img_pasarela->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="header" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($header->id->CurrentValue) ?>">
<?php if (!$header_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $header_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $header_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$header_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$header_edit->terminate();
?>