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
$correos_edit = new correos_edit();

// Run the page
$correos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$correos_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcorreosedit = currentForm = new ew.Form("fcorreosedit", "edit");

// Validate form
fcorreosedit.validate = function() {
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
		<?php if ($correos_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->id->caption(), $correos->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($correos_edit->nombre->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->nombre->caption(), $correos->nombre->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($correos_edit->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->correo->caption(), $correos->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($correos_edit->hora->Required) { ?>
			elm = this.getElements("x" + infix + "_hora");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->hora->caption(), $correos->hora->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_hora");
			if (elm && !ew.checkTime(elm.value))
				return this.onError(elm, "<?php echo JsEncode($correos->hora->errorMessage()) ?>");
		<?php if ($correos_edit->fecha->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->fecha->caption(), $correos->fecha->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($correos->fecha->errorMessage()) ?>");

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
fcorreosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcorreosedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $correos_edit->showPageHeader(); ?>
<?php
$correos_edit->showMessage();
?>
<form name="fcorreosedit" id="fcorreosedit" class="<?php echo $correos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($correos_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $correos_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="correos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$correos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($correos->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_correos_id" class="<?php echo $correos_edit->LeftColumnClass ?>"><?php echo $correos->id->caption() ?><?php echo ($correos->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_edit->RightColumnClass ?>"><div<?php echo $correos->id->cellAttributes() ?>>
<span id="el_correos_id">
<span<?php echo $correos->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($correos->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="correos" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($correos->id->CurrentValue) ?>">
<?php echo $correos->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($correos->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_correos_nombre" for="x_nombre" class="<?php echo $correos_edit->LeftColumnClass ?>"><?php echo $correos->nombre->caption() ?><?php echo ($correos->nombre->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_edit->RightColumnClass ?>"><div<?php echo $correos->nombre->cellAttributes() ?>>
<span id="el_correos_nombre">
<input type="text" data-table="correos" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($correos->nombre->getPlaceHolder()) ?>" value="<?php echo $correos->nombre->EditValue ?>"<?php echo $correos->nombre->editAttributes() ?>>
</span>
<?php echo $correos->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($correos->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_correos_correo" for="x_correo" class="<?php echo $correos_edit->LeftColumnClass ?>"><?php echo $correos->correo->caption() ?><?php echo ($correos->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_edit->RightColumnClass ?>"><div<?php echo $correos->correo->cellAttributes() ?>>
<span id="el_correos_correo">
<input type="text" data-table="correos" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($correos->correo->getPlaceHolder()) ?>" value="<?php echo $correos->correo->EditValue ?>"<?php echo $correos->correo->editAttributes() ?>>
</span>
<?php echo $correos->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($correos->hora->Visible) { // hora ?>
	<div id="r_hora" class="form-group row">
		<label id="elh_correos_hora" for="x_hora" class="<?php echo $correos_edit->LeftColumnClass ?>"><?php echo $correos->hora->caption() ?><?php echo ($correos->hora->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_edit->RightColumnClass ?>"><div<?php echo $correos->hora->cellAttributes() ?>>
<span id="el_correos_hora">
<input type="text" data-table="correos" data-field="x_hora" name="x_hora" id="x_hora" placeholder="<?php echo HtmlEncode($correos->hora->getPlaceHolder()) ?>" value="<?php echo $correos->hora->EditValue ?>"<?php echo $correos->hora->editAttributes() ?>>
</span>
<?php echo $correos->hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($correos->fecha->Visible) { // fecha ?>
	<div id="r_fecha" class="form-group row">
		<label id="elh_correos_fecha" for="x_fecha" class="<?php echo $correos_edit->LeftColumnClass ?>"><?php echo $correos->fecha->caption() ?><?php echo ($correos->fecha->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_edit->RightColumnClass ?>"><div<?php echo $correos->fecha->cellAttributes() ?>>
<span id="el_correos_fecha">
<input type="text" data-table="correos" data-field="x_fecha" name="x_fecha" id="x_fecha" placeholder="<?php echo HtmlEncode($correos->fecha->getPlaceHolder()) ?>" value="<?php echo $correos->fecha->EditValue ?>"<?php echo $correos->fecha->editAttributes() ?>>
<?php if (!$correos->fecha->ReadOnly && !$correos->fecha->Disabled && !isset($correos->fecha->EditAttrs["readonly"]) && !isset($correos->fecha->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fcorreosedit", "x_fecha", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $correos->fecha->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$correos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $correos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $correos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$correos_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$correos_edit->terminate();
?>