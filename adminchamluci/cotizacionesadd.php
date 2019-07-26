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
$cotizaciones_add = new cotizaciones_add();

// Run the page
$cotizaciones_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cotizaciones_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcotizacionesadd = currentForm = new ew.Form("fcotizacionesadd", "add");

// Validate form
fcotizacionesadd.validate = function() {
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
		<?php if ($cotizaciones_add->titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->titulo->caption(), $cotizaciones->titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cotizaciones_add->img->Required) { ?>
			felm = this.getElements("x" + infix + "_img");
			elm = this.getElements("fn_x" + infix + "_img");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->img->caption(), $cotizaciones->img->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cotizaciones_add->cantidad->Required) { ?>
			elm = this.getElements("x" + infix + "_cantidad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->cantidad->caption(), $cotizaciones->cantidad->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cotizaciones_add->codigo->Required) { ?>
			elm = this.getElements("x" + infix + "_codigo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->codigo->caption(), $cotizaciones->codigo->RequiredErrorMessage)) ?>");
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
fcotizacionesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcotizacionesadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cotizaciones_add->showPageHeader(); ?>
<?php
$cotizaciones_add->showMessage();
?>
<form name="fcotizacionesadd" id="fcotizacionesadd" class="<?php echo $cotizaciones_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cotizaciones_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cotizaciones_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cotizaciones">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$cotizaciones_add->IsModal ?>">
<?php if ($cotizaciones->getCurrentMasterTable() == "clientes") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="clientes">
<input type="hidden" name="fk_codigo" value="<?php echo $cotizaciones->codigo->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_cotizaciones_titulo" for="x_titulo" class="<?php echo $cotizaciones_add->LeftColumnClass ?>"><?php echo $cotizaciones->titulo->caption() ?><?php echo ($cotizaciones->titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cotizaciones_add->RightColumnClass ?>"><div<?php echo $cotizaciones->titulo->cellAttributes() ?>>
<span id="el_cotizaciones_titulo">
<input type="text" data-table="cotizaciones" data-field="x_titulo" name="x_titulo" id="x_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->titulo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->titulo->EditValue ?>"<?php echo $cotizaciones->titulo->editAttributes() ?>>
</span>
<?php echo $cotizaciones->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cotizaciones->img->Visible) { // img ?>
	<div id="r_img" class="form-group row">
		<label id="elh_cotizaciones_img" class="<?php echo $cotizaciones_add->LeftColumnClass ?>"><?php echo $cotizaciones->img->caption() ?><?php echo ($cotizaciones->img->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cotizaciones_add->RightColumnClass ?>"><div<?php echo $cotizaciones->img->cellAttributes() ?>>
<span id="el_cotizaciones_img">
<div id="fd_x_img">
<span title="<?php echo $cotizaciones->img->title() ? $cotizaciones->img->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($cotizaciones->img->ReadOnly || $cotizaciones->img->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cotizaciones" data-field="x_img" name="x_img" id="x_img"<?php echo $cotizaciones->img->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img" id= "fn_x_img" value="<?php echo $cotizaciones->img->Upload->FileName ?>">
<input type="hidden" name="fa_x_img" id= "fa_x_img" value="0">
<input type="hidden" name="fs_x_img" id= "fs_x_img" value="255">
<input type="hidden" name="fx_x_img" id= "fx_x_img" value="<?php echo $cotizaciones->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img" id= "fm_x_img" value="<?php echo $cotizaciones->img->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $cotizaciones->img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
	<div id="r_cantidad" class="form-group row">
		<label id="elh_cotizaciones_cantidad" for="x_cantidad" class="<?php echo $cotizaciones_add->LeftColumnClass ?>"><?php echo $cotizaciones->cantidad->caption() ?><?php echo ($cotizaciones->cantidad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cotizaciones_add->RightColumnClass ?>"><div<?php echo $cotizaciones->cantidad->cellAttributes() ?>>
<span id="el_cotizaciones_cantidad">
<input type="text" data-table="cotizaciones" data-field="x_cantidad" name="x_cantidad" id="x_cantidad" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->cantidad->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->cantidad->EditValue ?>"<?php echo $cotizaciones->cantidad->editAttributes() ?>>
</span>
<?php echo $cotizaciones->cantidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
	<div id="r_codigo" class="form-group row">
		<label id="elh_cotizaciones_codigo" for="x_codigo" class="<?php echo $cotizaciones_add->LeftColumnClass ?>"><?php echo $cotizaciones->codigo->caption() ?><?php echo ($cotizaciones->codigo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cotizaciones_add->RightColumnClass ?>"><div<?php echo $cotizaciones->codigo->cellAttributes() ?>>
<?php if ($cotizaciones->codigo->getSessionValue() <> "") { ?>
<span id="el_cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cotizaciones->codigo->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_codigo" name="x_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cotizaciones_codigo">
<input type="text" data-table="cotizaciones" data-field="x_codigo" name="x_codigo" id="x_codigo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->codigo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->codigo->EditValue ?>"<?php echo $cotizaciones->codigo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $cotizaciones->codigo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cotizaciones_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cotizaciones_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cotizaciones_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cotizaciones_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cotizaciones_add->terminate();
?>