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
$blog_edit = new blog_edit();

// Run the page
$blog_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$blog_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fblogedit = currentForm = new ew.Form("fblogedit", "edit");

// Validate form
fblogedit.validate = function() {
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
		<?php if ($blog_edit->img->Required) { ?>
			felm = this.getElements("x" + infix + "_img");
			elm = this.getElements("fn_x" + infix + "_img");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $blog->img->caption(), $blog->img->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($blog_edit->titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $blog->titulo->caption(), $blog->titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($blog_edit->detalle->Required) { ?>
			elm = this.getElements("x" + infix + "_detalle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $blog->detalle->caption(), $blog->detalle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($blog_edit->detalle2->Required) { ?>
			elm = this.getElements("x" + infix + "_detalle2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $blog->detalle2->caption(), $blog->detalle2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($blog_edit->url->Required) { ?>
			elm = this.getElements("x" + infix + "_url");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $blog->url->caption(), $blog->url->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($blog_edit->keywords->Required) { ?>
			elm = this.getElements("x" + infix + "_keywords");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $blog->keywords->caption(), $blog->keywords->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($blog_edit->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $blog->description->caption(), $blog->description->RequiredErrorMessage)) ?>");
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
fblogedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fblogedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $blog_edit->showPageHeader(); ?>
<?php
$blog_edit->showMessage();
?>
<form name="fblogedit" id="fblogedit" class="<?php echo $blog_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($blog_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $blog_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="blog">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$blog_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($blog->img->Visible) { // img ?>
	<div id="r_img" class="form-group row">
		<label id="elh_blog_img" class="<?php echo $blog_edit->LeftColumnClass ?>"><?php echo $blog->img->caption() ?><?php echo ($blog->img->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $blog_edit->RightColumnClass ?>"><div<?php echo $blog->img->cellAttributes() ?>>
<span id="el_blog_img">
<div id="fd_x_img">
<span title="<?php echo $blog->img->title() ? $blog->img->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($blog->img->ReadOnly || $blog->img->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="blog" data-field="x_img" name="x_img" id="x_img"<?php echo $blog->img->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img" id= "fn_x_img" value="<?php echo $blog->img->Upload->FileName ?>">
<?php if (Post("fa_x_img") == "0") { ?>
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="1">
<?php } ?>
<input type="hidden" name="fs_x_img" id= "fs_x_img" value="255">
<input type="hidden" name="fx_x_img" id= "fx_x_img" value="<?php echo $blog->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img" id= "fm_x_img" value="<?php echo $blog->img->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $blog->img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($blog->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_blog_titulo" for="x_titulo" class="<?php echo $blog_edit->LeftColumnClass ?>"><?php echo $blog->titulo->caption() ?><?php echo ($blog->titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $blog_edit->RightColumnClass ?>"><div<?php echo $blog->titulo->cellAttributes() ?>>
<span id="el_blog_titulo">
<input type="text" data-table="blog" data-field="x_titulo" name="x_titulo" id="x_titulo" size="70" maxlength="255" placeholder="<?php echo HtmlEncode($blog->titulo->getPlaceHolder()) ?>" value="<?php echo $blog->titulo->EditValue ?>"<?php echo $blog->titulo->editAttributes() ?>>
</span>
<?php echo $blog->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($blog->detalle->Visible) { // detalle ?>
	<div id="r_detalle" class="form-group row">
		<label id="elh_blog_detalle" class="<?php echo $blog_edit->LeftColumnClass ?>"><?php echo $blog->detalle->caption() ?><?php echo ($blog->detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $blog_edit->RightColumnClass ?>"><div<?php echo $blog->detalle->cellAttributes() ?>>
<span id="el_blog_detalle">
<?php AppendClass($blog->detalle->EditAttrs["class"], "editor"); ?>
<textarea data-table="blog" data-field="x_detalle" name="x_detalle" id="x_detalle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($blog->detalle->getPlaceHolder()) ?>"<?php echo $blog->detalle->editAttributes() ?>><?php echo $blog->detalle->EditValue ?></textarea>
<script>
ew.createEditor("fblogedit", "x_detalle", 35, 4, <?php echo ($blog->detalle->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $blog->detalle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($blog->detalle2->Visible) { // detalle2 ?>
	<div id="r_detalle2" class="form-group row">
		<label id="elh_blog_detalle2" class="<?php echo $blog_edit->LeftColumnClass ?>"><?php echo $blog->detalle2->caption() ?><?php echo ($blog->detalle2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $blog_edit->RightColumnClass ?>"><div<?php echo $blog->detalle2->cellAttributes() ?>>
<span id="el_blog_detalle2">
<?php AppendClass($blog->detalle2->EditAttrs["class"], "editor"); ?>
<textarea data-table="blog" data-field="x_detalle2" name="x_detalle2" id="x_detalle2" cols="35" rows="4" placeholder="<?php echo HtmlEncode($blog->detalle2->getPlaceHolder()) ?>"<?php echo $blog->detalle2->editAttributes() ?>><?php echo $blog->detalle2->EditValue ?></textarea>
<script>
ew.createEditor("fblogedit", "x_detalle2", 35, 4, <?php echo ($blog->detalle2->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $blog->detalle2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($blog->url->Visible) { // url ?>
	<div id="r_url" class="form-group row">
		<label id="elh_blog_url" for="x_url" class="<?php echo $blog_edit->LeftColumnClass ?>"><?php echo $blog->url->caption() ?><?php echo ($blog->url->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $blog_edit->RightColumnClass ?>"><div<?php echo $blog->url->cellAttributes() ?>>
<span id="el_blog_url">
<input type="text" data-table="blog" data-field="x_url" name="x_url" id="x_url" size="70" maxlength="255" placeholder="<?php echo HtmlEncode($blog->url->getPlaceHolder()) ?>" value="<?php echo $blog->url->EditValue ?>"<?php echo $blog->url->editAttributes() ?>>
</span>
<?php echo $blog->url->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($blog->keywords->Visible) { // keywords ?>
	<div id="r_keywords" class="form-group row">
		<label id="elh_blog_keywords" class="<?php echo $blog_edit->LeftColumnClass ?>"><?php echo $blog->keywords->caption() ?><?php echo ($blog->keywords->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $blog_edit->RightColumnClass ?>"><div<?php echo $blog->keywords->cellAttributes() ?>>
<span id="el_blog_keywords">
<?php AppendClass($blog->keywords->EditAttrs["class"], "editor"); ?>
<textarea data-table="blog" data-field="x_keywords" name="x_keywords" id="x_keywords" cols="35" rows="4" placeholder="<?php echo HtmlEncode($blog->keywords->getPlaceHolder()) ?>"<?php echo $blog->keywords->editAttributes() ?>><?php echo $blog->keywords->EditValue ?></textarea>
<script>
ew.createEditor("fblogedit", "x_keywords", 35, 4, <?php echo ($blog->keywords->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $blog->keywords->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($blog->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_blog_description" for="x_description" class="<?php echo $blog_edit->LeftColumnClass ?>"><?php echo $blog->description->caption() ?><?php echo ($blog->description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $blog_edit->RightColumnClass ?>"><div<?php echo $blog->description->cellAttributes() ?>>
<span id="el_blog_description">
<textarea data-table="blog" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($blog->description->getPlaceHolder()) ?>"<?php echo $blog->description->editAttributes() ?>><?php echo $blog->description->EditValue ?></textarea>
</span>
<?php echo $blog->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="blog" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($blog->id->CurrentValue) ?>">
<?php if (!$blog_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $blog_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $blog_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$blog_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$blog_edit->terminate();
?>