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
$usuario_add = new usuario_add();

// Run the page
$usuario_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fusuarioadd = currentForm = new ew.Form("fusuarioadd", "add");

// Validate form
fusuarioadd.validate = function() {
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
		<?php if ($usuario_add->user->Required) { ?>
			elm = this.getElements("x" + infix + "_user");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->user->caption(), $usuario->user->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->clave->Required) { ?>
			elm = this.getElements("x" + infix + "_clave");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->clave->caption(), $usuario->clave->RequiredErrorMessage)) ?>");
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
fusuarioadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $usuario_add->showPageHeader(); ?>
<?php
$usuario_add->showMessage();
?>
<form name="fusuarioadd" id="fusuarioadd" class="<?php echo $usuario_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($usuario->user->Visible) { // user ?>
	<div id="r_user" class="form-group row">
		<label id="elh_usuario_user" for="x_user" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->user->caption() ?><?php echo ($usuario->user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->user->cellAttributes() ?>>
<span id="el_usuario_user">
<input type="text" data-table="usuario" data-field="x_user" name="x_user" id="x_user" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuario->user->getPlaceHolder()) ?>" value="<?php echo $usuario->user->EditValue ?>"<?php echo $usuario->user->editAttributes() ?>>
</span>
<?php echo $usuario->user->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->clave->Visible) { // clave ?>
	<div id="r_clave" class="form-group row">
		<label id="elh_usuario_clave" for="x_clave" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->clave->caption() ?><?php echo ($usuario->clave->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->clave->cellAttributes() ?>>
<span id="el_usuario_clave">
<input type="text" data-table="usuario" data-field="x_clave" name="x_clave" id="x_clave" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuario->clave->getPlaceHolder()) ?>" value="<?php echo $usuario->clave->EditValue ?>"<?php echo $usuario->clave->editAttributes() ?>>
</span>
<?php echo $usuario->clave->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuario_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuario_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuario_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuario_add->terminate();
?>