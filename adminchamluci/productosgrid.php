<?php
namespace PHPMaker2019\project1;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($productos_grid))
	$productos_grid = new productos_grid();

// Run the page
$productos_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$productos_grid->Page_Render();
?>
<?php if (!$productos->isExport()) { ?>
<script>

// Form object
var fproductosgrid = new ew.Form("fproductosgrid", "grid");
fproductosgrid.formKeyCountName = '<?php echo $productos_grid->FormKeyCountName ?>';

// Validate form
fproductosgrid.validate = function() {
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
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($productos_grid->titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->titulo->caption(), $productos->titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_grid->img1->Required) { ?>
			felm = this.getElements("x" + infix + "_img1");
			elm = this.getElements("fn_x" + infix + "_img1");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $productos->img1->caption(), $productos->img1->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_grid->destacado_inicio->Required) { ?>
			elm = this.getElements("x" + infix + "_destacado_inicio");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->destacado_inicio->caption(), $productos->destacado_inicio->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_grid->destacado_footer->Required) { ?>
			elm = this.getElements("x" + infix + "_destacado_footer");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->destacado_footer->caption(), $productos->destacado_footer->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_grid->destacado_productos->Required) { ?>
			elm = this.getElements("x" + infix + "_destacado_productos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->destacado_productos->caption(), $productos->destacado_productos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($productos_grid->id_cate->Required) { ?>
			elm = this.getElements("x" + infix + "_id_cate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $productos->id_cate->caption(), $productos->id_cate->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fproductosgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "titulo", false)) return false;
	if (ew.valueChanged(fobj, infix, "img1", false)) return false;
	if (ew.valueChanged(fobj, infix, "destacado_inicio", false)) return false;
	if (ew.valueChanged(fobj, infix, "destacado_footer", false)) return false;
	if (ew.valueChanged(fobj, infix, "destacado_productos", false)) return false;
	if (ew.valueChanged(fobj, infix, "id_cate", false)) return false;
	return true;
}

// Form_CustomValidate event
fproductosgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductosgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductosgrid.lists["x_destacado_inicio"] = <?php echo $productos_grid->destacado_inicio->Lookup->toClientList() ?>;
fproductosgrid.lists["x_destacado_inicio"].options = <?php echo JsonEncode($productos_grid->destacado_inicio->options(FALSE, TRUE)) ?>;
fproductosgrid.lists["x_destacado_footer"] = <?php echo $productos_grid->destacado_footer->Lookup->toClientList() ?>;
fproductosgrid.lists["x_destacado_footer"].options = <?php echo JsonEncode($productos_grid->destacado_footer->options(FALSE, TRUE)) ?>;
fproductosgrid.lists["x_destacado_productos"] = <?php echo $productos_grid->destacado_productos->Lookup->toClientList() ?>;
fproductosgrid.lists["x_destacado_productos"].options = <?php echo JsonEncode($productos_grid->destacado_productos->options(FALSE, TRUE)) ?>;
fproductosgrid.lists["x_id_cate"] = <?php echo $productos_grid->id_cate->Lookup->toClientList() ?>;
fproductosgrid.lists["x_id_cate"].options = <?php echo JsonEncode($productos_grid->id_cate->lookupOptions()) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$productos_grid->renderOtherOptions();
?>
<?php $productos_grid->showPageHeader(); ?>
<?php
$productos_grid->showMessage();
?>
<?php if ($productos_grid->TotalRecs > 0 || $productos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($productos_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> productos">
<?php if ($productos_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $productos_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fproductosgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_productos" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_productosgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$productos_grid->RowType = ROWTYPE_HEADER;

// Render list options
$productos_grid->renderListOptions();

// Render list options (header, left)
$productos_grid->ListOptions->render("header", "left");
?>
<?php if ($productos->titulo->Visible) { // titulo ?>
	<?php if ($productos->sortUrl($productos->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $productos->titulo->headerCellClass() ?>"><div id="elh_productos_titulo" class="productos_titulo"><div class="ew-table-header-caption"><?php echo $productos->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $productos->titulo->headerCellClass() ?>"><div><div id="elh_productos_titulo" class="productos_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->titulo->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->img1->Visible) { // img1 ?>
	<?php if ($productos->sortUrl($productos->img1) == "") { ?>
		<th data-name="img1" class="<?php echo $productos->img1->headerCellClass() ?>"><div id="elh_productos_img1" class="productos_img1"><div class="ew-table-header-caption"><?php echo $productos->img1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img1" class="<?php echo $productos->img1->headerCellClass() ?>"><div><div id="elh_productos_img1" class="productos_img1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->img1->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->img1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->img1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
	<?php if ($productos->sortUrl($productos->destacado_inicio) == "") { ?>
		<th data-name="destacado_inicio" class="<?php echo $productos->destacado_inicio->headerCellClass() ?>"><div id="elh_productos_destacado_inicio" class="productos_destacado_inicio"><div class="ew-table-header-caption"><?php echo $productos->destacado_inicio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destacado_inicio" class="<?php echo $productos->destacado_inicio->headerCellClass() ?>"><div><div id="elh_productos_destacado_inicio" class="productos_destacado_inicio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->destacado_inicio->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->destacado_inicio->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->destacado_inicio->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
	<?php if ($productos->sortUrl($productos->destacado_footer) == "") { ?>
		<th data-name="destacado_footer" class="<?php echo $productos->destacado_footer->headerCellClass() ?>"><div id="elh_productos_destacado_footer" class="productos_destacado_footer"><div class="ew-table-header-caption"><?php echo $productos->destacado_footer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destacado_footer" class="<?php echo $productos->destacado_footer->headerCellClass() ?>"><div><div id="elh_productos_destacado_footer" class="productos_destacado_footer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->destacado_footer->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->destacado_footer->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->destacado_footer->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
	<?php if ($productos->sortUrl($productos->destacado_productos) == "") { ?>
		<th data-name="destacado_productos" class="<?php echo $productos->destacado_productos->headerCellClass() ?>"><div id="elh_productos_destacado_productos" class="productos_destacado_productos"><div class="ew-table-header-caption"><?php echo $productos->destacado_productos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destacado_productos" class="<?php echo $productos->destacado_productos->headerCellClass() ?>"><div><div id="elh_productos_destacado_productos" class="productos_destacado_productos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->destacado_productos->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->destacado_productos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->destacado_productos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->id_cate->Visible) { // id_cate ?>
	<?php if ($productos->sortUrl($productos->id_cate) == "") { ?>
		<th data-name="id_cate" class="<?php echo $productos->id_cate->headerCellClass() ?>"><div id="elh_productos_id_cate" class="productos_id_cate"><div class="ew-table-header-caption"><?php echo $productos->id_cate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cate" class="<?php echo $productos->id_cate->headerCellClass() ?>"><div><div id="elh_productos_id_cate" class="productos_id_cate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->id_cate->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->id_cate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->id_cate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$productos_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$productos_grid->StartRec = 1;
$productos_grid->StopRec = $productos_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $productos_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($productos_grid->FormKeyCountName) && ($productos->isGridAdd() || $productos->isGridEdit() || $productos->isConfirm())) {
		$productos_grid->KeyCount = $CurrentForm->getValue($productos_grid->FormKeyCountName);
		$productos_grid->StopRec = $productos_grid->StartRec + $productos_grid->KeyCount - 1;
	}
}
$productos_grid->RecCnt = $productos_grid->StartRec - 1;
if ($productos_grid->Recordset && !$productos_grid->Recordset->EOF) {
	$productos_grid->Recordset->moveFirst();
	$selectLimit = $productos_grid->UseSelectLimit;
	if (!$selectLimit && $productos_grid->StartRec > 1)
		$productos_grid->Recordset->move($productos_grid->StartRec - 1);
} elseif (!$productos->AllowAddDeleteRow && $productos_grid->StopRec == 0) {
	$productos_grid->StopRec = $productos->GridAddRowCount;
}

// Initialize aggregate
$productos->RowType = ROWTYPE_AGGREGATEINIT;
$productos->resetAttributes();
$productos_grid->renderRow();
if ($productos->isGridAdd())
	$productos_grid->RowIndex = 0;
if ($productos->isGridEdit())
	$productos_grid->RowIndex = 0;
while ($productos_grid->RecCnt < $productos_grid->StopRec) {
	$productos_grid->RecCnt++;
	if ($productos_grid->RecCnt >= $productos_grid->StartRec) {
		$productos_grid->RowCnt++;
		if ($productos->isGridAdd() || $productos->isGridEdit() || $productos->isConfirm()) {
			$productos_grid->RowIndex++;
			$CurrentForm->Index = $productos_grid->RowIndex;
			if ($CurrentForm->hasValue($productos_grid->FormActionName) && $productos_grid->EventCancelled)
				$productos_grid->RowAction = strval($CurrentForm->getValue($productos_grid->FormActionName));
			elseif ($productos->isGridAdd())
				$productos_grid->RowAction = "insert";
			else
				$productos_grid->RowAction = "";
		}

		// Set up key count
		$productos_grid->KeyCount = $productos_grid->RowIndex;

		// Init row class and style
		$productos->resetAttributes();
		$productos->CssClass = "";
		if ($productos->isGridAdd()) {
			if ($productos->CurrentMode == "copy") {
				$productos_grid->loadRowValues($productos_grid->Recordset); // Load row values
				$productos_grid->setRecordKey($productos_grid->RowOldKey, $productos_grid->Recordset); // Set old record key
			} else {
				$productos_grid->loadRowValues(); // Load default values
				$productos_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$productos_grid->loadRowValues($productos_grid->Recordset); // Load row values
		}
		$productos->RowType = ROWTYPE_VIEW; // Render view
		if ($productos->isGridAdd()) // Grid add
			$productos->RowType = ROWTYPE_ADD; // Render add
		if ($productos->isGridAdd() && $productos->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$productos_grid->restoreCurrentRowFormValues($productos_grid->RowIndex); // Restore form values
		if ($productos->isGridEdit()) { // Grid edit
			if ($productos->EventCancelled)
				$productos_grid->restoreCurrentRowFormValues($productos_grid->RowIndex); // Restore form values
			if ($productos_grid->RowAction == "insert")
				$productos->RowType = ROWTYPE_ADD; // Render add
			else
				$productos->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($productos->isGridEdit() && ($productos->RowType == ROWTYPE_EDIT || $productos->RowType == ROWTYPE_ADD) && $productos->EventCancelled) // Update failed
			$productos_grid->restoreCurrentRowFormValues($productos_grid->RowIndex); // Restore form values
		if ($productos->RowType == ROWTYPE_EDIT) // Edit row
			$productos_grid->EditRowCnt++;
		if ($productos->isConfirm()) // Confirm row
			$productos_grid->restoreCurrentRowFormValues($productos_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$productos->RowAttrs = array_merge($productos->RowAttrs, array('data-rowindex'=>$productos_grid->RowCnt, 'id'=>'r' . $productos_grid->RowCnt . '_productos', 'data-rowtype'=>$productos->RowType));

		// Render row
		$productos_grid->renderRow();

		// Render list options
		$productos_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($productos_grid->RowAction <> "delete" && $productos_grid->RowAction <> "insertdelete" && !($productos_grid->RowAction == "insert" && $productos->isConfirm() && $productos_grid->emptyRow())) {
?>
	<tr<?php echo $productos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$productos_grid->ListOptions->render("body", "left", $productos_grid->RowCnt);
?>
	<?php if ($productos->titulo->Visible) { // titulo ?>
		<td data-name="titulo"<?php echo $productos->titulo->cellAttributes() ?>>
<?php if ($productos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_titulo" class="form-group productos_titulo">
<input type="text" data-table="productos" data-field="x_titulo" name="x<?php echo $productos_grid->RowIndex ?>_titulo" id="x<?php echo $productos_grid->RowIndex ?>_titulo" size="70" maxlength="255" placeholder="<?php echo HtmlEncode($productos->titulo->getPlaceHolder()) ?>" value="<?php echo $productos->titulo->EditValue ?>"<?php echo $productos->titulo->editAttributes() ?>>
</span>
<input type="hidden" data-table="productos" data-field="x_titulo" name="o<?php echo $productos_grid->RowIndex ?>_titulo" id="o<?php echo $productos_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($productos->titulo->OldValue) ?>">
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_titulo" class="form-group productos_titulo">
<input type="text" data-table="productos" data-field="x_titulo" name="x<?php echo $productos_grid->RowIndex ?>_titulo" id="x<?php echo $productos_grid->RowIndex ?>_titulo" size="70" maxlength="255" placeholder="<?php echo HtmlEncode($productos->titulo->getPlaceHolder()) ?>" value="<?php echo $productos->titulo->EditValue ?>"<?php echo $productos->titulo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_titulo" class="productos_titulo">
<span<?php echo $productos->titulo->viewAttributes() ?>>
<?php echo $productos->titulo->getViewValue() ?></span>
</span>
<?php if (!$productos->isConfirm()) { ?>
<input type="hidden" data-table="productos" data-field="x_titulo" name="x<?php echo $productos_grid->RowIndex ?>_titulo" id="x<?php echo $productos_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($productos->titulo->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_titulo" name="o<?php echo $productos_grid->RowIndex ?>_titulo" id="o<?php echo $productos_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($productos->titulo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="productos" data-field="x_titulo" name="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_titulo" id="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($productos->titulo->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_titulo" name="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_titulo" id="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($productos->titulo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($productos->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="productos" data-field="x_id" name="x<?php echo $productos_grid->RowIndex ?>_id" id="x<?php echo $productos_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($productos->id->CurrentValue) ?>">
<input type="hidden" data-table="productos" data-field="x_id" name="o<?php echo $productos_grid->RowIndex ?>_id" id="o<?php echo $productos_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($productos->id->OldValue) ?>">
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_EDIT || $productos->CurrentMode == "edit") { ?>
<input type="hidden" data-table="productos" data-field="x_id" name="x<?php echo $productos_grid->RowIndex ?>_id" id="x<?php echo $productos_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($productos->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($productos->img1->Visible) { // img1 ?>
		<td data-name="img1"<?php echo $productos->img1->cellAttributes() ?>>
<?php if ($productos_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_productos_img1" class="form-group productos_img1">
<div id="fd_x<?php echo $productos_grid->RowIndex ?>_img1">
<span title="<?php echo $productos->img1->title() ? $productos->img1->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img1->ReadOnly || $productos->img1->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img1" name="x<?php echo $productos_grid->RowIndex ?>_img1" id="x<?php echo $productos_grid->RowIndex ?>_img1"<?php echo $productos->img1->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fn_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fa_x<?php echo $productos_grid->RowIndex ?>_img1" value="0">
<input type="hidden" name="fs_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fs_x<?php echo $productos_grid->RowIndex ?>_img1" value="255">
<input type="hidden" name="fx_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fx_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fm_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $productos_grid->RowIndex ?>_img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="productos" data-field="x_img1" name="o<?php echo $productos_grid->RowIndex ?>_img1" id="o<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo HtmlEncode($productos->img1->OldValue) ?>">
<?php } elseif ($productos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_img1" class="productos_img1">
<span>
<?php echo GetFileViewTag($productos->img1, $productos->img1->getViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_img1" class="form-group productos_img1">
<div id="fd_x<?php echo $productos_grid->RowIndex ?>_img1">
<span title="<?php echo $productos->img1->title() ? $productos->img1->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img1->ReadOnly || $productos->img1->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img1" name="x<?php echo $productos_grid->RowIndex ?>_img1" id="x<?php echo $productos_grid->RowIndex ?>_img1"<?php echo $productos->img1->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fn_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $productos_grid->RowIndex ?>_img1") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fa_x<?php echo $productos_grid->RowIndex ?>_img1" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fa_x<?php echo $productos_grid->RowIndex ?>_img1" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fs_x<?php echo $productos_grid->RowIndex ?>_img1" value="255">
<input type="hidden" name="fx_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fx_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fm_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $productos_grid->RowIndex ?>_img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
		<td data-name="destacado_inicio"<?php echo $productos->destacado_inicio->cellAttributes() ?>>
<?php if ($productos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_inicio" class="form-group productos_destacado_inicio">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_inicio" data-value-separator="<?php echo $productos->destacado_inicio->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="{value}"<?php echo $productos->destacado_inicio->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_inicio->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_inicio") ?>
</div></div>
</span>
<input type="hidden" data-table="productos" data-field="x_destacado_inicio" name="o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="<?php echo HtmlEncode($productos->destacado_inicio->OldValue) ?>">
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_inicio" class="form-group productos_destacado_inicio">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_inicio" data-value-separator="<?php echo $productos->destacado_inicio->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="{value}"<?php echo $productos->destacado_inicio->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_inicio->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_inicio") ?>
</div></div>
</span>
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_inicio" class="productos_destacado_inicio">
<span<?php echo $productos->destacado_inicio->viewAttributes() ?>>
<?php echo $productos->destacado_inicio->getViewValue() ?></span>
</span>
<?php if (!$productos->isConfirm()) { ?>
<input type="hidden" data-table="productos" data-field="x_destacado_inicio" name="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="<?php echo HtmlEncode($productos->destacado_inicio->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_destacado_inicio" name="o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="<?php echo HtmlEncode($productos->destacado_inicio->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="productos" data-field="x_destacado_inicio" name="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="<?php echo HtmlEncode($productos->destacado_inicio->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_destacado_inicio" name="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="<?php echo HtmlEncode($productos->destacado_inicio->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
		<td data-name="destacado_footer"<?php echo $productos->destacado_footer->cellAttributes() ?>>
<?php if ($productos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_footer" class="form-group productos_destacado_footer">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_footer" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_footer" data-value-separator="<?php echo $productos->destacado_footer->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="{value}"<?php echo $productos->destacado_footer->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_footer" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_footer->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_footer") ?>
</div></div>
</span>
<input type="hidden" data-table="productos" data-field="x_destacado_footer" name="o<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="o<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="<?php echo HtmlEncode($productos->destacado_footer->OldValue) ?>">
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_footer" class="form-group productos_destacado_footer">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_footer" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_footer" data-value-separator="<?php echo $productos->destacado_footer->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="{value}"<?php echo $productos->destacado_footer->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_footer" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_footer->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_footer") ?>
</div></div>
</span>
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_footer" class="productos_destacado_footer">
<span<?php echo $productos->destacado_footer->viewAttributes() ?>>
<?php echo $productos->destacado_footer->getViewValue() ?></span>
</span>
<?php if (!$productos->isConfirm()) { ?>
<input type="hidden" data-table="productos" data-field="x_destacado_footer" name="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="<?php echo HtmlEncode($productos->destacado_footer->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_destacado_footer" name="o<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="o<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="<?php echo HtmlEncode($productos->destacado_footer->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="productos" data-field="x_destacado_footer" name="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="<?php echo HtmlEncode($productos->destacado_footer->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_destacado_footer" name="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="<?php echo HtmlEncode($productos->destacado_footer->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
		<td data-name="destacado_productos"<?php echo $productos->destacado_productos->cellAttributes() ?>>
<?php if ($productos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_productos" class="form-group productos_destacado_productos">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_productos" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_productos" data-value-separator="<?php echo $productos->destacado_productos->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="{value}"<?php echo $productos->destacado_productos->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_productos" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_productos->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_productos") ?>
</div></div>
</span>
<input type="hidden" data-table="productos" data-field="x_destacado_productos" name="o<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="o<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="<?php echo HtmlEncode($productos->destacado_productos->OldValue) ?>">
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_productos" class="form-group productos_destacado_productos">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_productos" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_productos" data-value-separator="<?php echo $productos->destacado_productos->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="{value}"<?php echo $productos->destacado_productos->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_productos" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_productos->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_productos") ?>
</div></div>
</span>
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_destacado_productos" class="productos_destacado_productos">
<span<?php echo $productos->destacado_productos->viewAttributes() ?>>
<?php echo $productos->destacado_productos->getViewValue() ?></span>
</span>
<?php if (!$productos->isConfirm()) { ?>
<input type="hidden" data-table="productos" data-field="x_destacado_productos" name="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="<?php echo HtmlEncode($productos->destacado_productos->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_destacado_productos" name="o<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="o<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="<?php echo HtmlEncode($productos->destacado_productos->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="productos" data-field="x_destacado_productos" name="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="<?php echo HtmlEncode($productos->destacado_productos->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_destacado_productos" name="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="<?php echo HtmlEncode($productos->destacado_productos->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($productos->id_cate->Visible) { // id_cate ?>
		<td data-name="id_cate"<?php echo $productos->id_cate->cellAttributes() ?>>
<?php if ($productos->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($productos->id_cate->getSessionValue() <> "") { ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_id_cate" class="form-group productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->id_cate->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_id_cate" class="form-group productos_id_cate">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="productos" data-field="x_id_cate" data-value-separator="<?php echo $productos->id_cate->displayValueSeparatorAttribute() ?>" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate"<?php echo $productos->id_cate->editAttributes() ?>>
		<?php echo $productos->id_cate->selectOptionListHtml("x<?php echo $productos_grid->RowIndex ?>_id_cate") ?>
	</select>
</div>
<?php echo $productos->id_cate->Lookup->getParamTag("p_x" . $productos_grid->RowIndex . "_id_cate") ?>
</span>
<?php } ?>
<input type="hidden" data-table="productos" data-field="x_id_cate" name="o<?php echo $productos_grid->RowIndex ?>_id_cate" id="o<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->OldValue) ?>">
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($productos->id_cate->getSessionValue() <> "") { ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_id_cate" class="form-group productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->id_cate->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_id_cate" class="form-group productos_id_cate">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="productos" data-field="x_id_cate" data-value-separator="<?php echo $productos->id_cate->displayValueSeparatorAttribute() ?>" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate"<?php echo $productos->id_cate->editAttributes() ?>>
		<?php echo $productos->id_cate->selectOptionListHtml("x<?php echo $productos_grid->RowIndex ?>_id_cate") ?>
	</select>
</div>
<?php echo $productos->id_cate->Lookup->getParamTag("p_x" . $productos_grid->RowIndex . "_id_cate") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($productos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $productos_grid->RowCnt ?>_productos_id_cate" class="productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<?php echo $productos->id_cate->getViewValue() ?></span>
</span>
<?php if (!$productos->isConfirm()) { ?>
<input type="hidden" data-table="productos" data-field="x_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_id_cate" name="o<?php echo $productos_grid->RowIndex ?>_id_cate" id="o<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="productos" data-field="x_id_cate" name="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_id_cate" id="fproductosgrid$x<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->FormValue) ?>">
<input type="hidden" data-table="productos" data-field="x_id_cate" name="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_id_cate" id="fproductosgrid$o<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$productos_grid->ListOptions->render("body", "right", $productos_grid->RowCnt);
?>
	</tr>
<?php if ($productos->RowType == ROWTYPE_ADD || $productos->RowType == ROWTYPE_EDIT) { ?>
<script>
fproductosgrid.updateLists(<?php echo $productos_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$productos->isGridAdd() || $productos->CurrentMode == "copy")
		if (!$productos_grid->Recordset->EOF)
			$productos_grid->Recordset->moveNext();
}
?>
<?php
	if ($productos->CurrentMode == "add" || $productos->CurrentMode == "copy" || $productos->CurrentMode == "edit") {
		$productos_grid->RowIndex = '$rowindex$';
		$productos_grid->loadRowValues();

		// Set row properties
		$productos->resetAttributes();
		$productos->RowAttrs = array_merge($productos->RowAttrs, array('data-rowindex'=>$productos_grid->RowIndex, 'id'=>'r0_productos', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($productos->RowAttrs["class"], "ew-template");
		$productos->RowType = ROWTYPE_ADD;

		// Render row
		$productos_grid->renderRow();

		// Render list options
		$productos_grid->renderListOptions();
		$productos_grid->StartRowCnt = 0;
?>
	<tr<?php echo $productos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$productos_grid->ListOptions->render("body", "left", $productos_grid->RowIndex);
?>
	<?php if ($productos->titulo->Visible) { // titulo ?>
		<td data-name="titulo">
<?php if (!$productos->isConfirm()) { ?>
<span id="el$rowindex$_productos_titulo" class="form-group productos_titulo">
<input type="text" data-table="productos" data-field="x_titulo" name="x<?php echo $productos_grid->RowIndex ?>_titulo" id="x<?php echo $productos_grid->RowIndex ?>_titulo" size="70" maxlength="255" placeholder="<?php echo HtmlEncode($productos->titulo->getPlaceHolder()) ?>" value="<?php echo $productos->titulo->EditValue ?>"<?php echo $productos->titulo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_productos_titulo" class="form-group productos_titulo">
<span<?php echo $productos->titulo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->titulo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="productos" data-field="x_titulo" name="x<?php echo $productos_grid->RowIndex ?>_titulo" id="x<?php echo $productos_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($productos->titulo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="productos" data-field="x_titulo" name="o<?php echo $productos_grid->RowIndex ?>_titulo" id="o<?php echo $productos_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($productos->titulo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($productos->img1->Visible) { // img1 ?>
		<td data-name="img1">
<span id="el$rowindex$_productos_img1" class="form-group productos_img1">
<div id="fd_x<?php echo $productos_grid->RowIndex ?>_img1">
<span title="<?php echo $productos->img1->title() ? $productos->img1->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($productos->img1->ReadOnly || $productos->img1->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="productos" data-field="x_img1" name="x<?php echo $productos_grid->RowIndex ?>_img1" id="x<?php echo $productos_grid->RowIndex ?>_img1"<?php echo $productos->img1->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fn_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fa_x<?php echo $productos_grid->RowIndex ?>_img1" value="0">
<input type="hidden" name="fs_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fs_x<?php echo $productos_grid->RowIndex ?>_img1" value="255">
<input type="hidden" name="fx_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fx_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $productos_grid->RowIndex ?>_img1" id= "fm_x<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo $productos->img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $productos_grid->RowIndex ?>_img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="productos" data-field="x_img1" name="o<?php echo $productos_grid->RowIndex ?>_img1" id="o<?php echo $productos_grid->RowIndex ?>_img1" value="<?php echo HtmlEncode($productos->img1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
		<td data-name="destacado_inicio">
<?php if (!$productos->isConfirm()) { ?>
<span id="el$rowindex$_productos_destacado_inicio" class="form-group productos_destacado_inicio">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_inicio" data-value-separator="<?php echo $productos->destacado_inicio->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="{value}"<?php echo $productos->destacado_inicio->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_inicio->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_inicio") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_productos_destacado_inicio" class="form-group productos_destacado_inicio">
<span<?php echo $productos->destacado_inicio->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->destacado_inicio->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="productos" data-field="x_destacado_inicio" name="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="x<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="<?php echo HtmlEncode($productos->destacado_inicio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="productos" data-field="x_destacado_inicio" name="o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" id="o<?php echo $productos_grid->RowIndex ?>_destacado_inicio" value="<?php echo HtmlEncode($productos->destacado_inicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
		<td data-name="destacado_footer">
<?php if (!$productos->isConfirm()) { ?>
<span id="el$rowindex$_productos_destacado_footer" class="form-group productos_destacado_footer">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_footer" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_footer" data-value-separator="<?php echo $productos->destacado_footer->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="{value}"<?php echo $productos->destacado_footer->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_footer" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_footer->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_footer") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_productos_destacado_footer" class="form-group productos_destacado_footer">
<span<?php echo $productos->destacado_footer->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->destacado_footer->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="productos" data-field="x_destacado_footer" name="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="x<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="<?php echo HtmlEncode($productos->destacado_footer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="productos" data-field="x_destacado_footer" name="o<?php echo $productos_grid->RowIndex ?>_destacado_footer" id="o<?php echo $productos_grid->RowIndex ?>_destacado_footer" value="<?php echo HtmlEncode($productos->destacado_footer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
		<td data-name="destacado_productos">
<?php if (!$productos->isConfirm()) { ?>
<span id="el$rowindex$_productos_destacado_productos" class="form-group productos_destacado_productos">
<div id="tp_x<?php echo $productos_grid->RowIndex ?>_destacado_productos" class="ew-template"><input type="radio" class="form-check-input" data-table="productos" data-field="x_destacado_productos" data-value-separator="<?php echo $productos->destacado_productos->displayValueSeparatorAttribute() ?>" name="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="{value}"<?php echo $productos->destacado_productos->editAttributes() ?>></div>
<div id="dsl_x<?php echo $productos_grid->RowIndex ?>_destacado_productos" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $productos->destacado_productos->radioButtonListHtml(FALSE, "x{$productos_grid->RowIndex}_destacado_productos") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_productos_destacado_productos" class="form-group productos_destacado_productos">
<span<?php echo $productos->destacado_productos->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->destacado_productos->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="productos" data-field="x_destacado_productos" name="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="x<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="<?php echo HtmlEncode($productos->destacado_productos->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="productos" data-field="x_destacado_productos" name="o<?php echo $productos_grid->RowIndex ?>_destacado_productos" id="o<?php echo $productos_grid->RowIndex ?>_destacado_productos" value="<?php echo HtmlEncode($productos->destacado_productos->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($productos->id_cate->Visible) { // id_cate ?>
		<td data-name="id_cate">
<?php if (!$productos->isConfirm()) { ?>
<?php if ($productos->id_cate->getSessionValue() <> "") { ?>
<span id="el$rowindex$_productos_id_cate" class="form-group productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->id_cate->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_productos_id_cate" class="form-group productos_id_cate">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="productos" data-field="x_id_cate" data-value-separator="<?php echo $productos->id_cate->displayValueSeparatorAttribute() ?>" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate"<?php echo $productos->id_cate->editAttributes() ?>>
		<?php echo $productos->id_cate->selectOptionListHtml("x<?php echo $productos_grid->RowIndex ?>_id_cate") ?>
	</select>
</div>
<?php echo $productos->id_cate->Lookup->getParamTag("p_x" . $productos_grid->RowIndex . "_id_cate") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_productos_id_cate" class="form-group productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($productos->id_cate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="productos" data-field="x_id_cate" name="x<?php echo $productos_grid->RowIndex ?>_id_cate" id="x<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="productos" data-field="x_id_cate" name="o<?php echo $productos_grid->RowIndex ?>_id_cate" id="o<?php echo $productos_grid->RowIndex ?>_id_cate" value="<?php echo HtmlEncode($productos->id_cate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$productos_grid->ListOptions->render("body", "right", $productos_grid->RowIndex);
?>
<script>
fproductosgrid.updateLists(<?php echo $productos_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($productos->CurrentMode == "add" || $productos->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $productos_grid->FormKeyCountName ?>" id="<?php echo $productos_grid->FormKeyCountName ?>" value="<?php echo $productos_grid->KeyCount ?>">
<?php echo $productos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($productos->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $productos_grid->FormKeyCountName ?>" id="<?php echo $productos_grid->FormKeyCountName ?>" value="<?php echo $productos_grid->KeyCount ?>">
<?php echo $productos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($productos->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fproductosgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($productos_grid->Recordset)
	$productos_grid->Recordset->Close();
?>
</div>
<?php if ($productos_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $productos_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($productos_grid->TotalRecs == 0 && !$productos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $productos_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$productos_grid->terminate();
?>