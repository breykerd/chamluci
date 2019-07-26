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
$correos_add = new correos_add();

// Run the page
$correos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$correos_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcorreosadd = currentForm = new ew.Form("fcorreosadd", "add");

// Validate form
fcorreosadd.validate = function() {
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
		<?php if ($correos_add->nombre->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->nombre->caption(), $correos->nombre->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($correos_add->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->correo->caption(), $correos->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($correos_add->hora->Required) { ?>
			elm = this.getElements("x" + infix + "_hora");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $correos->hora->caption(), $correos->hora->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_hora");
			if (elm && !ew.checkTime(elm.value))
				return this.onError(elm, "<?php echo JsEncode($correos->hora->errorMessage()) ?>");
		<?php if ($correos_add->fecha->Required) { ?>
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
fcorreosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcorreosadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $correos_add->showPageHeader(); ?>
<?php
$correos_add->showMessage();
?>
<form name="fcorreosadd" id="fcorreosadd" class="<?php echo $correos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($correos_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $correos_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="correos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$correos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($correos->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_correos_nombre" for="x_nombre" class="<?php echo $correos_add->LeftColumnClass ?>"><?php echo $correos->nombre->caption() ?><?php echo ($correos->nombre->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_add->RightColumnClass ?>"><div<?php echo $correos->nombre->cellAttributes() ?>>
<span id="el_correos_nombre">
<input type="text" data-table="correos" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($correos->nombre->getPlaceHolder()) ?>" value="<?php echo $correos->nombre->EditValue ?>"<?php echo $correos->nombre->editAttributes() ?>>
</span>
<?php echo $correos->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($correos->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_correos_correo" for="x_correo" class="<?php echo $correos_add->LeftColumnClass ?>"><?php echo $correos->correo->caption() ?><?php echo ($correos->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_add->RightColumnClass ?>"><div<?php echo $correos->correo->cellAttributes() ?>>
<span id="el_correos_correo">
<input type="text" data-table="correos" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($correos->correo->getPlaceHolder()) ?>" value="<?php echo $correos->correo->EditValue ?>"<?php echo $correos->correo->editAttributes() ?>>
</span>
<?php echo $correos->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($correos->hora->Visible) { // hora ?>
	<div id="r_hora" class="form-group row">
		<label id="elh_correos_hora" for="x_hora" class="<?php echo $correos_add->LeftColumnClass ?>"><?php echo $correos->hora->caption() ?><?php echo ($correos->hora->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_add->RightColumnClass ?>"><div<?php echo $correos->hora->cellAttributes() ?>>
<span id="el_correos_hora">
<input type="text" data-table="correos" data-field="x_hora" name="x_hora" id="x_hora" placeholder="<?php echo HtmlEncode($correos->hora->getPlaceHolder()) ?>" value="<?php echo $correos->hora->EditValue ?>"<?php echo $correos->hora->editAttributes() ?>>
</span>
<?php echo $correos->hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($correos->fecha->Visible) { // fecha ?>
	<div id="r_fecha" class="form-group row">
		<label id="elh_correos_fecha" for="x_fecha" class="<?php echo $correos_add->LeftColumnClass ?>"><?php echo $correos->fecha->caption() ?><?php echo ($correos->fecha->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $correos_add->RightColumnClass ?>"><div<?php echo $correos->fecha->cellAttributes() ?>>
<span id="el_correos_fecha">
<input type="text" data-table="correos" data-field="x_fecha" name="x_fecha" id="x_fecha" placeholder="<?php echo HtmlEncode($correos->fecha->getPlaceHolder()) ?>" value="<?php echo $correos->fecha->EditValue ?>"<?php echo $correos->fecha->editAttributes() ?>>
<?php if (!$correos->fecha->ReadOnly && !$correos->fecha->Disabled && !isset($correos->fecha->EditAttrs["readonly"]) && !isset($correos->fecha->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fcorreosadd", "x_fecha", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $correos->fecha->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$correos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $correos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $correos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$correos_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$correos_add->terminate();
?>