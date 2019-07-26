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
$laempresa_add = new laempresa_add();

// Run the page
$laempresa_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laempresa_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var flaempresaadd = currentForm = new ew.Form("flaempresaadd", "add");

// Validate form
flaempresaadd.validate = function() {
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
		<?php if ($laempresa_add->img->Required) { ?>
			felm = this.getElements("x" + infix + "_img");
			elm = this.getElements("fn_x" + infix + "_img");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $laempresa->img->caption(), $laempresa->img->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($laempresa_add->titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laempresa->titulo->caption(), $laempresa->titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($laempresa_add->detalle->Required) { ?>
			elm = this.getElements("x" + infix + "_detalle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laempresa->detalle->caption(), $laempresa->detalle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($laempresa_add->keywords->Required) { ?>
			elm = this.getElements("x" + infix + "_keywords");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laempresa->keywords->caption(), $laempresa->keywords->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($laempresa_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laempresa->description->caption(), $laempresa->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($laempresa_add->tituloimg->Required) { ?>
			elm = this.getElements("x" + infix + "_tituloimg");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laempresa->tituloimg->caption(), $laempresa->tituloimg->RequiredErrorMessage)) ?>");
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
flaempresaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flaempresaadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $laempresa_add->showPageHeader(); ?>
<?php
$laempresa_add->showMessage();
?>
<form name="flaempresaadd" id="flaempresaadd" class="<?php echo $laempresa_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($laempresa_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $laempresa_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laempresa">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$laempresa_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($laempresa->img->Visible) { // img ?>
	<div id="r_img" class="form-group row">
		<label id="elh_laempresa_img" class="<?php echo $laempresa_add->LeftColumnClass ?>"><?php echo $laempresa->img->caption() ?><?php echo ($laempresa->img->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laempresa_add->RightColumnClass ?>"><div<?php echo $laempresa->img->cellAttributes() ?>>
<span id="el_laempresa_img">
<div id="fd_x_img">
<span title="<?php echo $laempresa->img->title() ? $laempresa->img->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($laempresa->img->ReadOnly || $laempresa->img->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="laempresa" data-field="x_img" name="x_img" id="x_img"<?php echo $laempresa->img->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img" id= "fn_x_img" value="<?php echo $laempresa->img->Upload->FileName ?>">
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="0">
<input type="hidden" name="fs_x_img" id= "fs_x_img" value="255">
<input type="hidden" name="fx_x_img" id= "fx_x_img" value="<?php echo $laempresa->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img" id= "fm_x_img" value="<?php echo $laempresa->img->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $laempresa->img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laempresa->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_laempresa_titulo" for="x_titulo" class="<?php echo $laempresa_add->LeftColumnClass ?>"><?php echo $laempresa->titulo->caption() ?><?php echo ($laempresa->titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laempresa_add->RightColumnClass ?>"><div<?php echo $laempresa->titulo->cellAttributes() ?>>
<span id="el_laempresa_titulo">
<input type="text" data-table="laempresa" data-field="x_titulo" name="x_titulo" id="x_titulo" size="70" maxlength="255" placeholder="<?php echo HtmlEncode($laempresa->titulo->getPlaceHolder()) ?>" value="<?php echo $laempresa->titulo->EditValue ?>"<?php echo $laempresa->titulo->editAttributes() ?>>
</span>
<?php echo $laempresa->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laempresa->detalle->Visible) { // detalle ?>
	<div id="r_detalle" class="form-group row">
		<label id="elh_laempresa_detalle" class="<?php echo $laempresa_add->LeftColumnClass ?>"><?php echo $laempresa->detalle->caption() ?><?php echo ($laempresa->detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laempresa_add->RightColumnClass ?>"><div<?php echo $laempresa->detalle->cellAttributes() ?>>
<span id="el_laempresa_detalle">
<?php AppendClass($laempresa->detalle->EditAttrs["class"], "editor"); ?>
<textarea data-table="laempresa" data-field="x_detalle" name="x_detalle" id="x_detalle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($laempresa->detalle->getPlaceHolder()) ?>"<?php echo $laempresa->detalle->editAttributes() ?>><?php echo $laempresa->detalle->EditValue ?></textarea>
<script>
ew.createEditor("flaempresaadd", "x_detalle", 35, 4, <?php echo ($laempresa->detalle->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $laempresa->detalle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laempresa->keywords->Visible) { // keywords ?>
	<div id="r_keywords" class="form-group row">
		<label id="elh_laempresa_keywords" for="x_keywords" class="<?php echo $laempresa_add->LeftColumnClass ?>"><?php echo $laempresa->keywords->caption() ?><?php echo ($laempresa->keywords->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laempresa_add->RightColumnClass ?>"><div<?php echo $laempresa->keywords->cellAttributes() ?>>
<span id="el_laempresa_keywords">
<textarea data-table="laempresa" data-field="x_keywords" name="x_keywords" id="x_keywords" cols="35" rows="4" placeholder="<?php echo HtmlEncode($laempresa->keywords->getPlaceHolder()) ?>"<?php echo $laempresa->keywords->editAttributes() ?>><?php echo $laempresa->keywords->EditValue ?></textarea>
</span>
<?php echo $laempresa->keywords->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laempresa->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_laempresa_description" for="x_description" class="<?php echo $laempresa_add->LeftColumnClass ?>"><?php echo $laempresa->description->caption() ?><?php echo ($laempresa->description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laempresa_add->RightColumnClass ?>"><div<?php echo $laempresa->description->cellAttributes() ?>>
<span id="el_laempresa_description">
<textarea data-table="laempresa" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($laempresa->description->getPlaceHolder()) ?>"<?php echo $laempresa->description->editAttributes() ?>><?php echo $laempresa->description->EditValue ?></textarea>
</span>
<?php echo $laempresa->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laempresa->tituloimg->Visible) { // tituloimg ?>
	<div id="r_tituloimg" class="form-group row">
		<label id="elh_laempresa_tituloimg" for="x_tituloimg" class="<?php echo $laempresa_add->LeftColumnClass ?>"><?php echo $laempresa->tituloimg->caption() ?><?php echo ($laempresa->tituloimg->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laempresa_add->RightColumnClass ?>"><div<?php echo $laempresa->tituloimg->cellAttributes() ?>>
<span id="el_laempresa_tituloimg">
<textarea data-table="laempresa" data-field="x_tituloimg" name="x_tituloimg" id="x_tituloimg" cols="35" rows="4" placeholder="<?php echo HtmlEncode($laempresa->tituloimg->getPlaceHolder()) ?>"<?php echo $laempresa->tituloimg->editAttributes() ?>><?php echo $laempresa->tituloimg->EditValue ?></textarea>
</span>
<?php echo $laempresa->tituloimg->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$laempresa_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $laempresa_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $laempresa_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$laempresa_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$laempresa_add->terminate();
?>