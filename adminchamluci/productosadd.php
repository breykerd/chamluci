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
$productos_add = new productos_add();

// Run the page
$productos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$productos_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fproductosadd = currentForm = new ew.Form("fproductosadd", "add");

// Validate form
fproductosadd.validate = function() {
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
		<?php if ($productos_add->titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->titulo->caption(), $productos->titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->detalle->Required) { ?>
			elm = this.getElements("x" + infix + "_detalle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->detalle->caption(), $productos->detalle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img1->Required) { ?>
			felm = this.getElements("x" + infix + "_img1");
			elm = this.getElements("fn_x" + infix + "_img1");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img1->caption(), $productos->img1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img2->Required) { ?>
			felm = this.getElements("x" + infix + "_img2");
			elm = this.getElements("fn_x" + infix + "_img2");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img2->caption(), $productos->img2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img3->Required) { ?>
			felm = this.getElements("x" + infix + "_img3");
			elm = this.getElements("fn_x" + infix + "_img3");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img3->caption(), $productos->img3->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img4->Required) { ?>
			felm = this.getElements("x" + infix + "_img4");
			elm = this.getElements("fn_x" + infix + "_img4");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img4->caption(), $productos->img4->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img5->Required) { ?>
			felm = this.getElements("x" + infix + "_img5");
			elm = this.getElements("fn_x" + infix + "_img5");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img5->caption(), $productos->img5->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img6->Required) { ?>
			felm = this.getElements("x" + infix + "_img6");
			elm = this.getElements("fn_x" + infix + "_img6");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img6->caption(), $productos->img6->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img7->Required) { ?>
			felm = this.getElements("x" + infix + "_img7");
			elm = this.getElements("fn_x" + infix + "_img7");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img7->caption(), $productos->img7->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img8->Required) { ?>
			felm = this.getElements("x" + infix + "_img8");
			elm = this.getElements("fn_x" + infix + "_img8");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img8->caption(), $productos->img8->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img9->Required) { ?>
			felm = this.getElements("x" + infix + "_img9");
			elm = this.getElements("fn_x" + infix + "_img9");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img9->caption(), $productos->img9->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->destacado_inicio->Required) { ?>
			elm = this.getElements("x" + infix + "_destacado_inicio");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->destacado_inicio->caption(), $productos->destacado_inicio->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->destacado_footer->Required) { ?>
			elm = this.getElements("x" + infix + "_destacado_footer");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->destacado_footer->caption(), $productos->destacado_footer->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->destacado_productos->Required) { ?>
			elm = this.getElements("x" + infix + "_destacado_productos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->destacado_productos->caption(), $productos->destacado_productos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->id_cate->Required) { ?>
			elm = this.getElements("x" + infix + "_id_cate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->id_cate->caption(), $productos->id_cate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->ficha_tecnica->Required) { ?>
			felm = this.getElements("x" + infix + "_ficha_tecnica");
			elm = this.getElements("fn_x" + infix + "_ficha_tecnica");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->ficha_tecnica->caption(), $productos->ficha_tecnica->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->img_principal->Required) { ?>
			elm = this.getElements("x" + infix + "_img_principal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->img_principal->caption(), $productos->img_principal->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->url->Required) { ?>
			elm = this.getElements("x" + infix + "_url");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->url->caption(), $productos->url->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->keywords->Required) { ?>
			elm = this.getElements("x" + infix + "_keywords");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->keywords->caption(), $productos->keywords->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->description->caption(), $productos->description->RequiredErrorMessage)) ?>");
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
fproductosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductosadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductosadd.lists["x_destacado_inicio"] = <?php echo $productos_add->destacado_inicio->Lookup->toClientList() ?>;
fproductosadd.lists["x_destacado_inicio"].options = <?php echo JsonEncode($productos_add->destacado_inicio->options(FALSE, TRUE)) ?>;
fproductosadd.lists["x_destacado_footer"] = <?php echo $productos_add->destacado_footer->Lookup->toClientList() ?>;
fproductosadd.lists["x_destacado_footer"].options = <?php echo JsonEncode($productos_add->destacado_footer->options(FALSE, TRUE)) ?>;
fproductosadd.lists["x_destacado_productos"] = <?php echo $productos_add->destacado_productos->Lookup->toClientList() ?>;
fproductosadd.lists["x_destacado_productos"].options = <?php echo JsonEncode($productos_add->destacado_productos->options(FALSE, TRUE)) ?>;
fproductosadd.lists["x_id_cate"] = <?php echo $productos_add->id_cate->Lookup->toClientList() ?>;
fproductosadd.lists["x_id_cate"].options = <?php echo JsonEncode($productos_add->id_cate->lookupOptions()) ?>;
fproductosadd.lists["x_img_principal"] = <?php echo $productos_add->img_principal->Lookup->toClientList() ?>;
fproductosadd.lists["x_img_principal"].options = <?php echo JsonEncode($productos_add->img_principal->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $productos_add->showPageHeader(); ?>
<?php
$productos_add->showMessage();
?>
<form name="fproductosadd" id="fproductosadd" class="<?php echo $productos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($productos_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $productos_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="productos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$productos_add->IsModal ?>">
<?php if ($productos->getCurrentMasterTable() == "categorias") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="categorias">
<input type="hidden" name="fk_id" value="<?php echo $productos->id_cate->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($productos->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_productos_titulo" for="x_titulo" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->titulo->caption() ?><?php echo ($productos->titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->titulo->cellAttributes() ?>>
<span id="el_productos_titulo">
<input type="text" data-table="productos" data-field="x_titulo" name="x_titulo" id="x_titulo" size="70" maxlength="255" placeholder="<?php echo HtmlEncode($productos->titulo->getPlaceHolder()) ?>" value="<?php echo $productos->titulo->EditValue ?>"<?php echo $productos->titulo->editAttributes() ?>>
</span>
<?php echo $productos->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->detalle->Visible) { // detalle ?>
	<div id="r_detalle" class="form-group row">
		<label id="elh_productos_detalle" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->detalle->caption() ?><?php echo ($productos->detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->detalle->cellAttributes() ?>>
<span id="el_productos_detalle">
<?php AppendClass($productos->detalle->EditAttrs["class"], "editor"); ?>
<textarea data-table="productos" data-field="x_detalle" name="x_detalle" id="x_detalle" cols="300" rows="6" placeholder="<?php echo HtmlEncode($productos->detalle->getPlaceHolder()) ?>"<?php echo $productos->detalle->editAttributes() ?>><?php echo $productos->detalle->EditValue ?></textarea>
<script>
ew.createEditor("fproductosadd", "x_detalle", 300, 6, <?php echo ($productos->detalle->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $productos->detalle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img1->Visible) { // img1 ?>
	<div id="r_img1" class="form-group row">
		<label id="elh_productos_img1" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img1->caption() ?><?php echo ($productos->img1->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img1->cellAttributes() ?>>
<span id="el_productos_img1">
<div id="fd_x_img1">
<span title="<?php echo $productos->img1->title() ? $productos->img1->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img1->ReadOnly || $productos->img1->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img1" name="x_img1" id="x_img1"<?php echo $productos->img1->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img1" id= "fn_x_img1" value="<?php echo $productos->img1->Upload->FileName ?>">
<input type="hidden" name="fa_x_img1" id= "fa_x_img1" value="0">
<input type="hidden" name="fs_x_img1" id= "fs_x_img1" value="255">
<input type="hidden" name="fx_x_img1" id= "fx_x_img1" value="<?php echo $productos->img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img1" id= "fm_x_img1" value="<?php echo $productos->img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img2->Visible) { // img2 ?>
	<div id="r_img2" class="form-group row">
		<label id="elh_productos_img2" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img2->caption() ?><?php echo ($productos->img2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img2->cellAttributes() ?>>
<span id="el_productos_img2">
<div id="fd_x_img2">
<span title="<?php echo $productos->img2->title() ? $productos->img2->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img2->ReadOnly || $productos->img2->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img2" name="x_img2" id="x_img2"<?php echo $productos->img2->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img2" id= "fn_x_img2" value="<?php echo $productos->img2->Upload->FileName ?>">
<input type="hidden" name="fa_x_img2" id= "fa_x_img2" value="0">
<input type="hidden" name="fs_x_img2" id= "fs_x_img2" value="255">
<input type="hidden" name="fx_x_img2" id= "fx_x_img2" value="<?php echo $productos->img2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img2" id= "fm_x_img2" value="<?php echo $productos->img2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img3->Visible) { // img3 ?>
	<div id="r_img3" class="form-group row">
		<label id="elh_productos_img3" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img3->caption() ?><?php echo ($productos->img3->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img3->cellAttributes() ?>>
<span id="el_productos_img3">
<div id="fd_x_img3">
<span title="<?php echo $productos->img3->title() ? $productos->img3->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img3->ReadOnly || $productos->img3->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img3" name="x_img3" id="x_img3"<?php echo $productos->img3->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img3" id= "fn_x_img3" value="<?php echo $productos->img3->Upload->FileName ?>">
<input type="hidden" name="fa_x_img3" id= "fa_x_img3" value="0">
<input type="hidden" name="fs_x_img3" id= "fs_x_img3" value="255">
<input type="hidden" name="fx_x_img3" id= "fx_x_img3" value="<?php echo $productos->img3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img3" id= "fm_x_img3" value="<?php echo $productos->img3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img4->Visible) { // img4 ?>
	<div id="r_img4" class="form-group row">
		<label id="elh_productos_img4" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img4->caption() ?><?php echo ($productos->img4->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img4->cellAttributes() ?>>
<span id="el_productos_img4">
<div id="fd_x_img4">
<span title="<?php echo $productos->img4->title() ? $productos->img4->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img4->ReadOnly || $productos->img4->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img4" name="x_img4" id="x_img4"<?php echo $productos->img4->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img4" id= "fn_x_img4" value="<?php echo $productos->img4->Upload->FileName ?>">
<input type="hidden" name="fa_x_img4" id= "fa_x_img4" value="0">
<input type="hidden" name="fs_x_img4" id= "fs_x_img4" value="255">
<input type="hidden" name="fx_x_img4" id= "fx_x_img4" value="<?php echo $productos->img4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img4" id= "fm_x_img4" value="<?php echo $productos->img4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img5->Visible) { // img5 ?>
	<div id="r_img5" class="form-group row">
		<label id="elh_productos_img5" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img5->caption() ?><?php echo ($productos->img5->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img5->cellAttributes() ?>>
<span id="el_productos_img5">
<div id="fd_x_img5">
<span title="<?php echo $productos->img5->title() ? $productos->img5->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img5->ReadOnly || $productos->img5->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img5" name="x_img5" id="x_img5"<?php echo $productos->img5->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img5" id= "fn_x_img5" value="<?php echo $productos->img5->Upload->FileName ?>">
<input type="hidden" name="fa_x_img5" id= "fa_x_img5" value="0">
<input type="hidden" name="fs_x_img5" id= "fs_x_img5" value="255">
<input type="hidden" name="fx_x_img5" id= "fx_x_img5" value="<?php echo $productos->img5->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img5" id= "fm_x_img5" value="<?php echo $productos->img5->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img5" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img5->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img6->Visible) { // img6 ?>
	<div id="r_img6" class="form-group row">
		<label id="elh_productos_img6" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img6->caption() ?><?php echo ($productos->img6->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img6->cellAttributes() ?>>
<span id="el_productos_img6">
<div id="fd_x_img6">
<span title="<?php echo $productos->img6->title() ? $productos->img6->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img6->ReadOnly || $productos->img6->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img6" name="x_img6" id="x_img6"<?php echo $productos->img6->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img6" id= "fn_x_img6" value="<?php echo $productos->img6->Upload->FileName ?>">
<input type="hidden" name="fa_x_img6" id= "fa_x_img6" value="0">
<input type="hidden" name="fs_x_img6" id= "fs_x_img6" value="255">
<input type="hidden" name="fx_x_img6" id= "fx_x_img6" value="<?php echo $productos->img6->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img6" id= "fm_x_img6" value="<?php echo $productos->img6->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img6" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img6->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img7->Visible) { // img7 ?>
	<div id="r_img7" class="form-group row">
		<label id="elh_productos_img7" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img7->caption() ?><?php echo ($productos->img7->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img7->cellAttributes() ?>>
<span id="el_productos_img7">
<div id="fd_x_img7">
<span title="<?php echo $productos->img7->title() ? $productos->img7->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img7->ReadOnly || $productos->img7->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img7" name="x_img7" id="x_img7"<?php echo $productos->img7->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img7" id= "fn_x_img7" value="<?php echo $productos->img7->Upload->FileName ?>">
<input type="hidden" name="fa_x_img7" id= "fa_x_img7" value="0">
<input type="hidden" name="fs_x_img7" id= "fs_x_img7" value="255">
<input type="hidden" name="fx_x_img7" id= "fx_x_img7" value="<?php echo $productos->img7->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img7" id= "fm_x_img7" value="<?php echo $productos->img7->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img7" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img7->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img8->Visible) { // img8 ?>
	<div id="r_img8" class="form-group row">
		<label id="elh_productos_img8" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img8->caption() ?><?php echo ($productos->img8->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img8->cellAttributes() ?>>
<span id="el_productos_img8">
<div id="fd_x_img8">
<span title="<?php echo $productos->img8->title() ? $productos->img8->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img8->ReadOnly || $productos->img8->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img8" name="x_img8" id="x_img8"<?php echo $productos->img8->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img8" id= "fn_x_img8" value="<?php echo $productos->img8->Upload->FileName ?>">
<input type="hidden" name="fa_x_img8" id= "fa_x_img8" value="0">
<input type="hidden" name="fs_x_img8" id= "fs_x_img8" value="255">
<input type="hidden" name="fx_x_img8" id= "fx_x_img8" value="<?php echo $productos->img8->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img8" id= "fm_x_img8" value="<?php echo $productos->img8->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img8" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img8->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img9->Visible) { // img9 ?>
	<div id="r_img9" class="form-group row">
		<label id="elh_productos_img9" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img9->caption() ?><?php echo ($productos->img9->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img9->cellAttributes() ?>>
<span id="el_productos_img9">
<div id="fd_x_img9">
<span title="<?php echo $productos->img9->title() ? $productos->img9->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img9->ReadOnly || $productos->img9->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img9" name="x_img9" id="x_img9"<?php echo $productos->img9->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_img9" id= "fn_x_img9" value="<?php echo $productos->img9->Upload->FileName ?>">
<input type="hidden" name="fa_x_img9" id= "fa_x_img9" value="0">
<input type="hidden" name="fs_x_img9" id= "fs_x_img9" value="255">
<input type="hidden" name="fx_x_img9" id= "fx_x_img9" value="<?php echo $productos->img9->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_img9" id= "fm_x_img9" value="<?php echo $productos->img9->UploadMaxFileSize ?>">
</div>
<table id="ft_x_img9" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->img9->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
	<div id="r_destacado_inicio" class="form-group row">
		<label id="elh_productos_destacado_inicio" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->destacado_inicio->caption() ?><?php echo ($productos->destacado_inicio->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->destacado_inicio->cellAttributes() ?>>
<span id="el_productos_destacado_inicio">
<div id="tp_x_destacado_inicio" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_inicio" data-value-separator="<?php echo $productos->destacado_inicio->displayValueSeparatorAttribute() ?>" name="x_destacado_inicio" id="x_destacado_inicio" value="{value}"<?php echo $productos->destacado_inicio->editAttributes() ?>></div>
<div id="dsl_x_destacado_inicio" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_inicio->radioButtonListHtml(FALSE, "x_destacado_inicio") ?>
</div></div>
</span>
<?php echo $productos->destacado_inicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
	<div id="r_destacado_footer" class="form-group row">
		<label id="elh_productos_destacado_footer" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->destacado_footer->caption() ?><?php echo ($productos->destacado_footer->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->destacado_footer->cellAttributes() ?>>
<span id="el_productos_destacado_footer">
<div id="tp_x_destacado_footer" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_footer" data-value-separator="<?php echo $productos->destacado_footer->displayValueSeparatorAttribute() ?>" name="x_destacado_footer" id="x_destacado_footer" value="{value}"<?php echo $productos->destacado_footer->editAttributes() ?>></div>
<div id="dsl_x_destacado_footer" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_footer->radioButtonListHtml(FALSE, "x_destacado_footer") ?>
</div></div>
</span>
<?php echo $productos->destacado_footer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
	<div id="r_destacado_productos" class="form-group row">
		<label id="elh_productos_destacado_productos" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->destacado_productos->caption() ?><?php echo ($productos->destacado_productos->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->destacado_productos->cellAttributes() ?>>
<span id="el_productos_destacado_productos">
<div id="tp_x_destacado_productos" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_productos" data-value-separator="<?php echo $productos->destacado_productos->displayValueSeparatorAttribute() ?>" name="x_destacado_productos" id="x_destacado_productos" value="{value}"<?php echo $productos->destacado_productos->editAttributes() ?>></div>
<div id="dsl_x_destacado_productos" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_productos->radioButtonListHtml(FALSE, "x_destacado_productos") ?>
</div></div>
</span>
<?php echo $productos->destacado_productos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->id_cate->Visible) { // id_cate ?>
	<div id="r_id_cate" class="form-group row">
		<label id="elh_productos_id_cate" for="x_id_cate" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->id_cate->caption() ?><?php echo ($productos->id_cate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->id_cate->cellAttributes() ?>>
<?php if ($productos->id_cate->getSessionValue() <> "") { ?>
<span id="el_productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->id_cate->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_id_cate" name="x_id_cate" value="<?php echo HtmlEncode($productos->id_cate->CurrentValue) ?>">
<?php } else { ?>
<span id="el_productos_id_cate">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="productos" data-field="x_id_cate" data-value-separator="<?php echo $productos->id_cate->displayValueSeparatorAttribute() ?>" id="x_id_cate" name="x_id_cate"<?php echo $productos->id_cate->editAttributes() ?>>
		<?php echo $productos->id_cate->selectOptionListHtml("x_id_cate") ?>
	</select>
</div>
<?php echo $productos->id_cate->Lookup->getParamTag("p_x_id_cate") ?>
</span>
<?php } ?>
<?php echo $productos->id_cate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->ficha_tecnica->Visible) { // ficha_tecnica ?>
	<div id="r_ficha_tecnica" class="form-group row">
		<label id="elh_productos_ficha_tecnica" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->ficha_tecnica->caption() ?><?php echo ($productos->ficha_tecnica->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->ficha_tecnica->cellAttributes() ?>>
<span id="el_productos_ficha_tecnica">
<div id="fd_x_ficha_tecnica">
<span title="<?php echo $productos->ficha_tecnica->title() ? $productos->ficha_tecnica->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->ficha_tecnica->ReadOnly || $productos->ficha_tecnica->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_ficha_tecnica" name="x_ficha_tecnica" id="x_ficha_tecnica"<?php echo $productos->ficha_tecnica->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_ficha_tecnica" id= "fn_x_ficha_tecnica" value="<?php echo $productos->ficha_tecnica->Upload->FileName ?>">
<input type="hidden" name="fa_x_ficha_tecnica" id= "fa_x_ficha_tecnica" value="0">
<input type="hidden" name="fs_x_ficha_tecnica" id= "fs_x_ficha_tecnica" value="255">
<input type="hidden" name="fx_x_ficha_tecnica" id= "fx_x_ficha_tecnica" value="<?php echo $productos->ficha_tecnica->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ficha_tecnica" id= "fm_x_ficha_tecnica" value="<?php echo $productos->ficha_tecnica->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ficha_tecnica" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $productos->ficha_tecnica->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->img_principal->Visible) { // img_principal ?>
	<div id="r_img_principal" class="form-group row">
		<label id="elh_productos_img_principal" for="x_img_principal" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->img_principal->caption() ?><?php echo ($productos->img_principal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->img_principal->cellAttributes() ?>>
<span id="el_productos_img_principal">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="productos" data-field="x_img_principal" data-value-separator="<?php echo $productos->img_principal->displayValueSeparatorAttribute() ?>" id="x_img_principal" name="x_img_principal"<?php echo $productos->img_principal->editAttributes() ?>>
		<?php echo $productos->img_principal->selectOptionListHtml("x_img_principal") ?>
	</select>
</div>
</span>
<?php echo $productos->img_principal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->url->Visible) { // url ?>
	<div id="r_url" class="form-group row">
		<label id="elh_productos_url" for="x_url" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->url->caption() ?><?php echo ($productos->url->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->url->cellAttributes() ?>>
<span id="el_productos_url">
<input type="text" data-table="productos" data-field="x_url" name="x_url" id="x_url" size="60" maxlength="255" placeholder="<?php echo HtmlEncode($productos->url->getPlaceHolder()) ?>" value="<?php echo $productos->url->EditValue ?>"<?php echo $productos->url->editAttributes() ?>>
</span>
<?php echo $productos->url->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->keywords->Visible) { // keywords ?>
	<div id="r_keywords" class="form-group row">
		<label id="elh_productos_keywords" for="x_keywords" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->keywords->caption() ?><?php echo ($productos->keywords->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->keywords->cellAttributes() ?>>
<span id="el_productos_keywords">
<textarea data-table="productos" data-field="x_keywords" name="x_keywords" id="x_keywords" cols="35" rows="4" placeholder="<?php echo HtmlEncode($productos->keywords->getPlaceHolder()) ?>"<?php echo $productos->keywords->editAttributes() ?>><?php echo $productos->keywords->EditValue ?></textarea>
</span>
<?php echo $productos->keywords->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($productos->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_productos_description" for="x_description" class="<?php echo $productos_add->LeftColumnClass ?>"><?php echo $productos->description->caption() ?><?php echo ($productos->description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $productos_add->RightColumnClass ?>"><div<?php echo $productos->description->cellAttributes() ?>>
<span id="el_productos_description">
<textarea data-table="productos" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($productos->description->getPlaceHolder()) ?>"<?php echo $productos->description->editAttributes() ?>><?php echo $productos->description->EditValue ?></textarea>
</span>
<?php echo $productos->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$productos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $productos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $productos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$productos_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$productos_add->terminate();
?>