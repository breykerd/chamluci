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
$categorias_add = new categorias_add();

// Run the page
$categorias_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorias_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcategoriasadd = currentForm = new ew.Form("fcategoriasadd", "add");

// Validate form
fcategoriasadd.validate = function() {
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
		<?php if ($categorias_add->img_header->Required) { ?>
			felm = this.getElements("x" + infix + "_img_header");
			elm = this.getElements("fn_x" + infix + "_img_header");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $categorias->img_header->caption(), $categorias->img_header->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($categorias_add->titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categorias->titulo->caption(), $categorias->titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($categorias_add->url->Required) { ?>
			elm = this.getElements("x" + infix + "_url");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categorias->url->caption(), $categorias->url->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($categorias_add->keywords->Required) { ?>
			elm = this.getElements("x" + infix + "_keywords");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categorias->keywords->caption(), $categorias->keywords->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($categorias_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categorias->description->caption(), $categorias->description->RequiredErrorMessage)) ?>");
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
fcategoriasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriasadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $categorias_add->showPageHeader(); ?>
<?php
$categorias_add->showMessage();
?>
<form name="fcategoriasadd" id="fcategoriasadd" class="<?php echo $categorias_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorias_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorias_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorias">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$categorias_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($categorias->img_header->Visible) { // img_header ?>
	<div id="r_img_header" class="form-group row">
		<label id="elh_categorias_img_header" class="<?php echo $categorias_add->LeftColumnClass ?>"><?php echo $categorias->img_header->caption() ?><?php echo ($categorias->img_header->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categorias_add->RightColumnClass ?>"><div<?php echo $categorias->img_header->cellAttributes() ?>>
<span id="el_categorias_img_header">
<div id="fd_x_img_header">
<span title="<?php echo $categorias->img_header->title() ? $categorias->img_header->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($categorias->img_header->ReadOnly || $categorias->img_header->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="categorias" data-field="x_img_header" name="x_img_header" id="x_img_header"<?php echo $categorias->img_header->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_header" id= "fn_x_img_header" value="<?php echo $categorias->img_header->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_header" id= "fa_x_img_header" value="0">
<input type="hidden" name="fs_x_img_header" id= "fs_x_img_header" value="255">
<input type="hidden" name="fx_x_img_header" id= "fx_x_img_header" value="<?php echo $categorias->img_header->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_header" id= "fm_x_img_header" value="<?php echo $categorias->img_header->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_header" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $categorias->img_header->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categorias->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_categorias_titulo" for="x_titulo" class="<?php echo $categorias_add->LeftColumnClass ?>"><?php echo $categorias->titulo->caption() ?><?php echo ($categorias->titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categorias_add->RightColumnClass ?>"><div<?php echo $categorias->titulo->cellAttributes() ?>>
<span id="el_categorias_titulo">
<input type="text" data-table="categorias" data-field="x_titulo" name="x_titulo" id="x_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categorias->titulo->getPlaceHolder()) ?>" value="<?php echo $categorias->titulo->EditValue ?>"<?php echo $categorias->titulo->editAttributes() ?>>
</span>
<?php echo $categorias->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categorias->url->Visible) { // url ?>
	<div id="r_url" class="form-group row">
		<label id="elh_categorias_url" for="x_url" class="<?php echo $categorias_add->LeftColumnClass ?>"><?php echo $categorias->url->caption() ?><?php echo ($categorias->url->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categorias_add->RightColumnClass ?>"><div<?php echo $categorias->url->cellAttributes() ?>>
<span id="el_categorias_url">
<input type="text" data-table="categorias" data-field="x_url" name="x_url" id="x_url" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categorias->url->getPlaceHolder()) ?>" value="<?php echo $categorias->url->EditValue ?>"<?php echo $categorias->url->editAttributes() ?>>
</span>
<?php echo $categorias->url->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categorias->keywords->Visible) { // keywords ?>
	<div id="r_keywords" class="form-group row">
		<label id="elh_categorias_keywords" for="x_keywords" class="<?php echo $categorias_add->LeftColumnClass ?>"><?php echo $categorias->keywords->caption() ?><?php echo ($categorias->keywords->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categorias_add->RightColumnClass ?>"><div<?php echo $categorias->keywords->cellAttributes() ?>>
<span id="el_categorias_keywords">
<textarea data-table="categorias" data-field="x_keywords" name="x_keywords" id="x_keywords" cols="35" rows="4" placeholder="<?php echo HtmlEncode($categorias->keywords->getPlaceHolder()) ?>"<?php echo $categorias->keywords->editAttributes() ?>><?php echo $categorias->keywords->EditValue ?></textarea>
</span>
<?php echo $categorias->keywords->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categorias->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_categorias_description" for="x_description" class="<?php echo $categorias_add->LeftColumnClass ?>"><?php echo $categorias->description->caption() ?><?php echo ($categorias->description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categorias_add->RightColumnClass ?>"><div<?php echo $categorias->description->cellAttributes() ?>>
<span id="el_categorias_description">
<textarea data-table="categorias" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($categorias->description->getPlaceHolder()) ?>"<?php echo $categorias->description->editAttributes() ?>><?php echo $categorias->description->EditValue ?></textarea>
</span>
<?php echo $categorias->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("productos", explode(",", $categorias->getCurrentDetailTable())) && $productos->DetailAdd) {
?>
<?php if ($categorias->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("productos", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "productosgrid.php" ?>
<?php } ?>
<?php if (!$categorias_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $categorias_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categorias_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$categorias_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$categorias_add->terminate();
?>