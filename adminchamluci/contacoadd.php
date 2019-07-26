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
$contaco_add = new contaco_add();

// Run the page
$contaco_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contaco_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcontacoadd = currentForm = new ew.Form("fcontacoadd", "add");

// Validate form
fcontacoadd.validate = function() {
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
		<?php if ($contaco_add->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->correo->caption(), $contaco->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->direccion->Required) { ?>
			elm = this.getElements("x" + infix + "_direccion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->direccion->caption(), $contaco->direccion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->tel1->Required) { ?>
			elm = this.getElements("x" + infix + "_tel1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->tel1->caption(), $contaco->tel1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->tel2->Required) { ?>
			elm = this.getElements("x" + infix + "_tel2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->tel2->caption(), $contaco->tel2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->tel3->Required) { ?>
			elm = this.getElements("x" + infix + "_tel3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->tel3->caption(), $contaco->tel3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->tel4->Required) { ?>
			elm = this.getElements("x" + infix + "_tel4");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->tel4->caption(), $contaco->tel4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->tel5->Required) { ?>
			elm = this.getElements("x" + infix + "_tel5");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->tel5->caption(), $contaco->tel5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->horario->Required) { ?>
			elm = this.getElements("x" + infix + "_horario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->horario->caption(), $contaco->horario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->img_bcp->Required) { ?>
			felm = this.getElements("x" + infix + "_img_bcp");
			elm = this.getElements("fn_x" + infix + "_img_bcp");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $contaco->img_bcp->caption(), $contaco->img_bcp->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->t_bcp1->Required) { ?>
			elm = this.getElements("x" + infix + "_t_bcp1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->t_bcp1->caption(), $contaco->t_bcp1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->t_bcp2->Required) { ?>
			elm = this.getElements("x" + infix + "_t_bcp2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->t_bcp2->caption(), $contaco->t_bcp2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->t_bcp3->Required) { ?>
			elm = this.getElements("x" + infix + "_t_bcp3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->t_bcp3->caption(), $contaco->t_bcp3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->img_bbva->Required) { ?>
			felm = this.getElements("x" + infix + "_img_bbva");
			elm = this.getElements("fn_x" + infix + "_img_bbva");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $contaco->img_bbva->caption(), $contaco->img_bbva->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->t_bbva_1->Required) { ?>
			elm = this.getElements("x" + infix + "_t_bbva_1");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->t_bbva_1->caption(), $contaco->t_bbva_1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->t_bbva_2->Required) { ?>
			elm = this.getElements("x" + infix + "_t_bbva_2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->t_bbva_2->caption(), $contaco->t_bbva_2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->t_bbva_3->Required) { ?>
			elm = this.getElements("x" + infix + "_t_bbva_3");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->t_bbva_3->caption(), $contaco->t_bbva_3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->fa->Required) { ?>
			elm = this.getElements("x" + infix + "_fa");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->fa->caption(), $contaco->fa->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->tw->Required) { ?>
			elm = this.getElements("x" + infix + "_tw");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->tw->caption(), $contaco->tw->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->in->Required) { ?>
			elm = this.getElements("x" + infix + "_in");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->in->caption(), $contaco->in->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->go->Required) { ?>
			elm = this.getElements("x" + infix + "_go");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->go->caption(), $contaco->go->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->you->Required) { ?>
			elm = this.getElements("x" + infix + "_you");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->you->caption(), $contaco->you->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->correo_formulario->Required) { ?>
			elm = this.getElements("x" + infix + "_correo_formulario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->correo_formulario->caption(), $contaco->correo_formulario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->keywords->Required) { ?>
			elm = this.getElements("x" + infix + "_keywords");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->keywords->caption(), $contaco->keywords->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contaco_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contaco->description->caption(), $contaco->description->RequiredErrorMessage)) ?>");
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
fcontacoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontacoadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contaco_add->showPageHeader(); ?>
<?php
$contaco_add->showMessage();
?>
<form name="fcontacoadd" id="fcontacoadd" class="<?php echo $contaco_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contaco_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contaco_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contaco">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contaco_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contaco->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_contaco_correo" for="x_correo" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->correo->caption() ?><?php echo ($contaco->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->correo->cellAttributes() ?>>
<span id="el_contaco_correo">
<input type="text" data-table="contaco" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->correo->getPlaceHolder()) ?>" value="<?php echo $contaco->correo->EditValue ?>"<?php echo $contaco->correo->editAttributes() ?>>
</span>
<?php echo $contaco->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->direccion->Visible) { // direccion ?>
	<div id="r_direccion" class="form-group row">
		<label id="elh_contaco_direccion" for="x_direccion" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->direccion->caption() ?><?php echo ($contaco->direccion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->direccion->cellAttributes() ?>>
<span id="el_contaco_direccion">
<input type="text" data-table="contaco" data-field="x_direccion" name="x_direccion" id="x_direccion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->direccion->getPlaceHolder()) ?>" value="<?php echo $contaco->direccion->EditValue ?>"<?php echo $contaco->direccion->editAttributes() ?>>
</span>
<?php echo $contaco->direccion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->tel1->Visible) { // tel1 ?>
	<div id="r_tel1" class="form-group row">
		<label id="elh_contaco_tel1" for="x_tel1" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->tel1->caption() ?><?php echo ($contaco->tel1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->tel1->cellAttributes() ?>>
<span id="el_contaco_tel1">
<input type="text" data-table="contaco" data-field="x_tel1" name="x_tel1" id="x_tel1" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->tel1->getPlaceHolder()) ?>" value="<?php echo $contaco->tel1->EditValue ?>"<?php echo $contaco->tel1->editAttributes() ?>>
</span>
<?php echo $contaco->tel1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->tel2->Visible) { // tel2 ?>
	<div id="r_tel2" class="form-group row">
		<label id="elh_contaco_tel2" for="x_tel2" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->tel2->caption() ?><?php echo ($contaco->tel2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->tel2->cellAttributes() ?>>
<span id="el_contaco_tel2">
<input type="text" data-table="contaco" data-field="x_tel2" name="x_tel2" id="x_tel2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->tel2->getPlaceHolder()) ?>" value="<?php echo $contaco->tel2->EditValue ?>"<?php echo $contaco->tel2->editAttributes() ?>>
</span>
<?php echo $contaco->tel2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->tel3->Visible) { // tel3 ?>
	<div id="r_tel3" class="form-group row">
		<label id="elh_contaco_tel3" for="x_tel3" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->tel3->caption() ?><?php echo ($contaco->tel3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->tel3->cellAttributes() ?>>
<span id="el_contaco_tel3">
<input type="text" data-table="contaco" data-field="x_tel3" name="x_tel3" id="x_tel3" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->tel3->getPlaceHolder()) ?>" value="<?php echo $contaco->tel3->EditValue ?>"<?php echo $contaco->tel3->editAttributes() ?>>
</span>
<?php echo $contaco->tel3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->tel4->Visible) { // tel4 ?>
	<div id="r_tel4" class="form-group row">
		<label id="elh_contaco_tel4" for="x_tel4" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->tel4->caption() ?><?php echo ($contaco->tel4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->tel4->cellAttributes() ?>>
<span id="el_contaco_tel4">
<input type="text" data-table="contaco" data-field="x_tel4" name="x_tel4" id="x_tel4" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->tel4->getPlaceHolder()) ?>" value="<?php echo $contaco->tel4->EditValue ?>"<?php echo $contaco->tel4->editAttributes() ?>>
</span>
<?php echo $contaco->tel4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->tel5->Visible) { // tel5 ?>
	<div id="r_tel5" class="form-group row">
		<label id="elh_contaco_tel5" for="x_tel5" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->tel5->caption() ?><?php echo ($contaco->tel5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->tel5->cellAttributes() ?>>
<span id="el_contaco_tel5">
<input type="text" data-table="contaco" data-field="x_tel5" name="x_tel5" id="x_tel5" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->tel5->getPlaceHolder()) ?>" value="<?php echo $contaco->tel5->EditValue ?>"<?php echo $contaco->tel5->editAttributes() ?>>
</span>
<?php echo $contaco->tel5->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->horario->Visible) { // horario ?>
	<div id="r_horario" class="form-group row">
		<label id="elh_contaco_horario" for="x_horario" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->horario->caption() ?><?php echo ($contaco->horario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->horario->cellAttributes() ?>>
<span id="el_contaco_horario">
<input type="text" data-table="contaco" data-field="x_horario" name="x_horario" id="x_horario" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->horario->getPlaceHolder()) ?>" value="<?php echo $contaco->horario->EditValue ?>"<?php echo $contaco->horario->editAttributes() ?>>
</span>
<?php echo $contaco->horario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->img_bcp->Visible) { // img_bcp ?>
	<div id="r_img_bcp" class="form-group row">
		<label id="elh_contaco_img_bcp" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->img_bcp->caption() ?><?php echo ($contaco->img_bcp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->img_bcp->cellAttributes() ?>>
<span id="el_contaco_img_bcp">
<div id="fd_x_img_bcp">
<span title="<?php echo $contaco->img_bcp->title() ? $contaco->img_bcp->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($contaco->img_bcp->ReadOnly || $contaco->img_bcp->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="contaco" data-field="x_img_bcp" name="x_img_bcp" id="x_img_bcp"<?php echo $contaco->img_bcp->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_bcp" id= "fn_x_img_bcp" value="<?php echo $contaco->img_bcp->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_bcp" id= "fa_x_img_bcp" value="0">
<input type="hidden" name="fs_x_img_bcp" id= "fs_x_img_bcp" value="255">
<input type="hidden" name="fx_x_img_bcp" id= "fx_x_img_bcp" value="<?php echo $contaco->img_bcp->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_bcp" id= "fm_x_img_bcp" value="<?php echo $contaco->img_bcp->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_bcp" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $contaco->img_bcp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->t_bcp1->Visible) { // t_bcp1 ?>
	<div id="r_t_bcp1" class="form-group row">
		<label id="elh_contaco_t_bcp1" for="x_t_bcp1" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->t_bcp1->caption() ?><?php echo ($contaco->t_bcp1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->t_bcp1->cellAttributes() ?>>
<span id="el_contaco_t_bcp1">
<input type="text" data-table="contaco" data-field="x_t_bcp1" name="x_t_bcp1" id="x_t_bcp1" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->t_bcp1->getPlaceHolder()) ?>" value="<?php echo $contaco->t_bcp1->EditValue ?>"<?php echo $contaco->t_bcp1->editAttributes() ?>>
</span>
<?php echo $contaco->t_bcp1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->t_bcp2->Visible) { // t_bcp2 ?>
	<div id="r_t_bcp2" class="form-group row">
		<label id="elh_contaco_t_bcp2" for="x_t_bcp2" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->t_bcp2->caption() ?><?php echo ($contaco->t_bcp2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->t_bcp2->cellAttributes() ?>>
<span id="el_contaco_t_bcp2">
<input type="text" data-table="contaco" data-field="x_t_bcp2" name="x_t_bcp2" id="x_t_bcp2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->t_bcp2->getPlaceHolder()) ?>" value="<?php echo $contaco->t_bcp2->EditValue ?>"<?php echo $contaco->t_bcp2->editAttributes() ?>>
</span>
<?php echo $contaco->t_bcp2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->t_bcp3->Visible) { // t_bcp3 ?>
	<div id="r_t_bcp3" class="form-group row">
		<label id="elh_contaco_t_bcp3" for="x_t_bcp3" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->t_bcp3->caption() ?><?php echo ($contaco->t_bcp3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->t_bcp3->cellAttributes() ?>>
<span id="el_contaco_t_bcp3">
<input type="text" data-table="contaco" data-field="x_t_bcp3" name="x_t_bcp3" id="x_t_bcp3" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->t_bcp3->getPlaceHolder()) ?>" value="<?php echo $contaco->t_bcp3->EditValue ?>"<?php echo $contaco->t_bcp3->editAttributes() ?>>
</span>
<?php echo $contaco->t_bcp3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->img_bbva->Visible) { // img_bbva ?>
	<div id="r_img_bbva" class="form-group row">
		<label id="elh_contaco_img_bbva" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->img_bbva->caption() ?><?php echo ($contaco->img_bbva->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->img_bbva->cellAttributes() ?>>
<span id="el_contaco_img_bbva">
<div id="fd_x_img_bbva">
<span title="<?php echo $contaco->img_bbva->title() ? $contaco->img_bbva->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($contaco->img_bbva->ReadOnly || $contaco->img_bbva->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="contaco" data-field="x_img_bbva" name="x_img_bbva" id="x_img_bbva"<?php echo $contaco->img_bbva->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img_bbva" id= "fn_x_img_bbva" value="<?php echo $contaco->img_bbva->Upload->FileName ?>">
<input type="hidden" name="fa_x_img_bbva" id= "fa_x_img_bbva" value="0">
<input type="hidden" name="fs_x_img_bbva" id= "fs_x_img_bbva" value="255">
<input type="hidden" name="fx_x_img_bbva" id= "fx_x_img_bbva" value="<?php echo $contaco->img_bbva->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img_bbva" id= "fm_x_img_bbva" value="<?php echo $contaco->img_bbva->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img_bbva" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $contaco->img_bbva->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->t_bbva_1->Visible) { // t_bbva_1 ?>
	<div id="r_t_bbva_1" class="form-group row">
		<label id="elh_contaco_t_bbva_1" for="x_t_bbva_1" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->t_bbva_1->caption() ?><?php echo ($contaco->t_bbva_1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->t_bbva_1->cellAttributes() ?>>
<span id="el_contaco_t_bbva_1">
<input type="text" data-table="contaco" data-field="x_t_bbva_1" name="x_t_bbva_1" id="x_t_bbva_1" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->t_bbva_1->getPlaceHolder()) ?>" value="<?php echo $contaco->t_bbva_1->EditValue ?>"<?php echo $contaco->t_bbva_1->editAttributes() ?>>
</span>
<?php echo $contaco->t_bbva_1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->t_bbva_2->Visible) { // t_bbva_2 ?>
	<div id="r_t_bbva_2" class="form-group row">
		<label id="elh_contaco_t_bbva_2" for="x_t_bbva_2" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->t_bbva_2->caption() ?><?php echo ($contaco->t_bbva_2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->t_bbva_2->cellAttributes() ?>>
<span id="el_contaco_t_bbva_2">
<input type="text" data-table="contaco" data-field="x_t_bbva_2" name="x_t_bbva_2" id="x_t_bbva_2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->t_bbva_2->getPlaceHolder()) ?>" value="<?php echo $contaco->t_bbva_2->EditValue ?>"<?php echo $contaco->t_bbva_2->editAttributes() ?>>
</span>
<?php echo $contaco->t_bbva_2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->t_bbva_3->Visible) { // t_bbva_3 ?>
	<div id="r_t_bbva_3" class="form-group row">
		<label id="elh_contaco_t_bbva_3" for="x_t_bbva_3" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->t_bbva_3->caption() ?><?php echo ($contaco->t_bbva_3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->t_bbva_3->cellAttributes() ?>>
<span id="el_contaco_t_bbva_3">
<input type="text" data-table="contaco" data-field="x_t_bbva_3" name="x_t_bbva_3" id="x_t_bbva_3" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->t_bbva_3->getPlaceHolder()) ?>" value="<?php echo $contaco->t_bbva_3->EditValue ?>"<?php echo $contaco->t_bbva_3->editAttributes() ?>>
</span>
<?php echo $contaco->t_bbva_3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->fa->Visible) { // fa ?>
	<div id="r_fa" class="form-group row">
		<label id="elh_contaco_fa" for="x_fa" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->fa->caption() ?><?php echo ($contaco->fa->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->fa->cellAttributes() ?>>
<span id="el_contaco_fa">
<input type="text" data-table="contaco" data-field="x_fa" name="x_fa" id="x_fa" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->fa->getPlaceHolder()) ?>" value="<?php echo $contaco->fa->EditValue ?>"<?php echo $contaco->fa->editAttributes() ?>>
</span>
<?php echo $contaco->fa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->tw->Visible) { // tw ?>
	<div id="r_tw" class="form-group row">
		<label id="elh_contaco_tw" for="x_tw" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->tw->caption() ?><?php echo ($contaco->tw->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->tw->cellAttributes() ?>>
<span id="el_contaco_tw">
<input type="text" data-table="contaco" data-field="x_tw" name="x_tw" id="x_tw" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->tw->getPlaceHolder()) ?>" value="<?php echo $contaco->tw->EditValue ?>"<?php echo $contaco->tw->editAttributes() ?>>
</span>
<?php echo $contaco->tw->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->in->Visible) { // in ?>
	<div id="r_in" class="form-group row">
		<label id="elh_contaco_in" for="x_in" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->in->caption() ?><?php echo ($contaco->in->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->in->cellAttributes() ?>>
<span id="el_contaco_in">
<input type="text" data-table="contaco" data-field="x_in" name="x_in" id="x_in" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->in->getPlaceHolder()) ?>" value="<?php echo $contaco->in->EditValue ?>"<?php echo $contaco->in->editAttributes() ?>>
</span>
<?php echo $contaco->in->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->go->Visible) { // go ?>
	<div id="r_go" class="form-group row">
		<label id="elh_contaco_go" for="x_go" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->go->caption() ?><?php echo ($contaco->go->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->go->cellAttributes() ?>>
<span id="el_contaco_go">
<input type="text" data-table="contaco" data-field="x_go" name="x_go" id="x_go" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->go->getPlaceHolder()) ?>" value="<?php echo $contaco->go->EditValue ?>"<?php echo $contaco->go->editAttributes() ?>>
</span>
<?php echo $contaco->go->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->you->Visible) { // you ?>
	<div id="r_you" class="form-group row">
		<label id="elh_contaco_you" for="x_you" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->you->caption() ?><?php echo ($contaco->you->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->you->cellAttributes() ?>>
<span id="el_contaco_you">
<input type="text" data-table="contaco" data-field="x_you" name="x_you" id="x_you" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->you->getPlaceHolder()) ?>" value="<?php echo $contaco->you->EditValue ?>"<?php echo $contaco->you->editAttributes() ?>>
</span>
<?php echo $contaco->you->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->correo_formulario->Visible) { // correo_formulario ?>
	<div id="r_correo_formulario" class="form-group row">
		<label id="elh_contaco_correo_formulario" for="x_correo_formulario" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->correo_formulario->caption() ?><?php echo ($contaco->correo_formulario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->correo_formulario->cellAttributes() ?>>
<span id="el_contaco_correo_formulario">
<input type="text" data-table="contaco" data-field="x_correo_formulario" name="x_correo_formulario" id="x_correo_formulario" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contaco->correo_formulario->getPlaceHolder()) ?>" value="<?php echo $contaco->correo_formulario->EditValue ?>"<?php echo $contaco->correo_formulario->editAttributes() ?>>
</span>
<?php echo $contaco->correo_formulario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->keywords->Visible) { // keywords ?>
	<div id="r_keywords" class="form-group row">
		<label id="elh_contaco_keywords" for="x_keywords" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->keywords->caption() ?><?php echo ($contaco->keywords->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->keywords->cellAttributes() ?>>
<span id="el_contaco_keywords">
<textarea data-table="contaco" data-field="x_keywords" name="x_keywords" id="x_keywords" cols="35" rows="4" placeholder="<?php echo HtmlEncode($contaco->keywords->getPlaceHolder()) ?>"<?php echo $contaco->keywords->editAttributes() ?>><?php echo $contaco->keywords->EditValue ?></textarea>
</span>
<?php echo $contaco->keywords->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contaco->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_contaco_description" for="x_description" class="<?php echo $contaco_add->LeftColumnClass ?>"><?php echo $contaco->description->caption() ?><?php echo ($contaco->description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contaco_add->RightColumnClass ?>"><div<?php echo $contaco->description->cellAttributes() ?>>
<span id="el_contaco_description">
<textarea data-table="contaco" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($contaco->description->getPlaceHolder()) ?>"<?php echo $contaco->description->editAttributes() ?>><?php echo $contaco->description->EditValue ?></textarea>
</span>
<?php echo $contaco->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contaco_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contaco_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contaco_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contaco_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contaco_add->terminate();
?>