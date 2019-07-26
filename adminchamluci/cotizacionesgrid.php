<?php
namespace PHPMaker2019\project1;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($cotizaciones_grid))
	$cotizaciones_grid = new cotizaciones_grid();

// Run the page
$cotizaciones_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cotizaciones_grid->Page_Render();
?>
<?php if (!$cotizaciones->isExport()) { ?>
<script>

// Form object
var fcotizacionesgrid = new ew.Form("fcotizacionesgrid", "grid");
fcotizacionesgrid.formKeyCountName = '<?php echo $cotizaciones_grid->FormKeyCountName ?>';

// Validate form
fcotizacionesgrid.validate = function() {
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
		<?php if ($cotizaciones_grid->titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->titulo->caption(), $cotizaciones->titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cotizaciones_grid->img->Required) { ?>
			felm = this.getElements("x" + infix + "_img");
			elm = this.getElements("fn_x" + infix + "_img");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->img->caption(), $cotizaciones->img->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cotizaciones_grid->cantidad->Required) { ?>
			elm = this.getElements("x" + infix + "_cantidad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->cantidad->caption(), $cotizaciones->cantidad->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cotizaciones_grid->codigo->Required) { ?>
			elm = this.getElements("x" + infix + "_codigo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cotizaciones->codigo->caption(), $cotizaciones->codigo->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcotizacionesgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "titulo", false)) return false;
	if (ew.valueChanged(fobj, infix, "img", false)) return false;
	if (ew.valueChanged(fobj, infix, "cantidad", false)) return false;
	if (ew.valueChanged(fobj, infix, "codigo", false)) return false;
	return true;
}

// Form_CustomValidate event
fcotizacionesgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcotizacionesgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$cotizaciones_grid->renderOtherOptions();
?>
<?php $cotizaciones_grid->showPageHeader(); ?>
<?php
$cotizaciones_grid->showMessage();
?>
<?php if ($cotizaciones_grid->TotalRecs > 0 || $cotizaciones->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cotizaciones_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cotizaciones">
<?php if ($cotizaciones_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $cotizaciones_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcotizacionesgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_cotizaciones" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_cotizacionesgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cotizaciones_grid->RowType = ROWTYPE_HEADER;

// Render list options
$cotizaciones_grid->renderListOptions();

// Render list options (header, left)
$cotizaciones_grid->ListOptions->render("header", "left");
?>
<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $cotizaciones->titulo->headerCellClass() ?>"><div id="elh_cotizaciones_titulo" class="cotizaciones_titulo"><div class="ew-table-header-caption"><?php echo $cotizaciones->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $cotizaciones->titulo->headerCellClass() ?>"><div><div id="elh_cotizaciones_titulo" class="cotizaciones_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->titulo->caption() ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cotizaciones->img->Visible) { // img ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->img) == "") { ?>
		<th data-name="img" class="<?php echo $cotizaciones->img->headerCellClass() ?>"><div id="elh_cotizaciones_img" class="cotizaciones_img"><div class="ew-table-header-caption"><?php echo $cotizaciones->img->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img" class="<?php echo $cotizaciones->img->headerCellClass() ?>"><div><div id="elh_cotizaciones_img" class="cotizaciones_img">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->img->caption() ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->img->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->img->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->cantidad) == "") { ?>
		<th data-name="cantidad" class="<?php echo $cotizaciones->cantidad->headerCellClass() ?>"><div id="elh_cotizaciones_cantidad" class="cotizaciones_cantidad"><div class="ew-table-header-caption"><?php echo $cotizaciones->cantidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad" class="<?php echo $cotizaciones->cantidad->headerCellClass() ?>"><div><div id="elh_cotizaciones_cantidad" class="cotizaciones_cantidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->cantidad->caption() ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->cantidad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->cantidad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->codigo) == "") { ?>
		<th data-name="codigo" class="<?php echo $cotizaciones->codigo->headerCellClass() ?>"><div id="elh_cotizaciones_codigo" class="cotizaciones_codigo"><div class="ew-table-header-caption"><?php echo $cotizaciones->codigo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo" class="<?php echo $cotizaciones->codigo->headerCellClass() ?>"><div><div id="elh_cotizaciones_codigo" class="cotizaciones_codigo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->codigo->caption() ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->codigo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->codigo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cotizaciones_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cotizaciones_grid->StartRec = 1;
$cotizaciones_grid->StopRec = $cotizaciones_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $cotizaciones_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($cotizaciones_grid->FormKeyCountName) && ($cotizaciones->isGridAdd() || $cotizaciones->isGridEdit() || $cotizaciones->isConfirm())) {
		$cotizaciones_grid->KeyCount = $CurrentForm->getValue($cotizaciones_grid->FormKeyCountName);
		$cotizaciones_grid->StopRec = $cotizaciones_grid->StartRec + $cotizaciones_grid->KeyCount - 1;
	}
}
$cotizaciones_grid->RecCnt = $cotizaciones_grid->StartRec - 1;
if ($cotizaciones_grid->Recordset && !$cotizaciones_grid->Recordset->EOF) {
	$cotizaciones_grid->Recordset->moveFirst();
	$selectLimit = $cotizaciones_grid->UseSelectLimit;
	if (!$selectLimit && $cotizaciones_grid->StartRec > 1)
		$cotizaciones_grid->Recordset->move($cotizaciones_grid->StartRec - 1);
} elseif (!$cotizaciones->AllowAddDeleteRow && $cotizaciones_grid->StopRec == 0) {
	$cotizaciones_grid->StopRec = $cotizaciones->GridAddRowCount;
}

// Initialize aggregate
$cotizaciones->RowType = ROWTYPE_AGGREGATEINIT;
$cotizaciones->resetAttributes();
$cotizaciones_grid->renderRow();
if ($cotizaciones->isGridAdd())
	$cotizaciones_grid->RowIndex = 0;
if ($cotizaciones->isGridEdit())
	$cotizaciones_grid->RowIndex = 0;
while ($cotizaciones_grid->RecCnt < $cotizaciones_grid->StopRec) {
	$cotizaciones_grid->RecCnt++;
	if ($cotizaciones_grid->RecCnt >= $cotizaciones_grid->StartRec) {
		$cotizaciones_grid->RowCnt++;
		if ($cotizaciones->isGridAdd() || $cotizaciones->isGridEdit() || $cotizaciones->isConfirm()) {
			$cotizaciones_grid->RowIndex++;
			$CurrentForm->Index = $cotizaciones_grid->RowIndex;
			if ($CurrentForm->hasValue($cotizaciones_grid->FormActionName) && $cotizaciones_grid->EventCancelled)
				$cotizaciones_grid->RowAction = strval($CurrentForm->getValue($cotizaciones_grid->FormActionName));
			elseif ($cotizaciones->isGridAdd())
				$cotizaciones_grid->RowAction = "insert";
			else
				$cotizaciones_grid->RowAction = "";
		}

		// Set up key count
		$cotizaciones_grid->KeyCount = $cotizaciones_grid->RowIndex;

		// Init row class and style
		$cotizaciones->resetAttributes();
		$cotizaciones->CssClass = "";
		if ($cotizaciones->isGridAdd()) {
			if ($cotizaciones->CurrentMode == "copy") {
				$cotizaciones_grid->loadRowValues($cotizaciones_grid->Recordset); // Load row values
				$cotizaciones_grid->setRecordKey($cotizaciones_grid->RowOldKey, $cotizaciones_grid->Recordset); // Set old record key
			} else {
				$cotizaciones_grid->loadRowValues(); // Load default values
				$cotizaciones_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cotizaciones_grid->loadRowValues($cotizaciones_grid->Recordset); // Load row values
		}
		$cotizaciones->RowType = ROWTYPE_VIEW; // Render view
		if ($cotizaciones->isGridAdd()) // Grid add
			$cotizaciones->RowType = ROWTYPE_ADD; // Render add
		if ($cotizaciones->isGridAdd() && $cotizaciones->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$cotizaciones_grid->restoreCurrentRowFormValues($cotizaciones_grid->RowIndex); // Restore form values
		if ($cotizaciones->isGridEdit()) { // Grid edit
			if ($cotizaciones->EventCancelled)
				$cotizaciones_grid->restoreCurrentRowFormValues($cotizaciones_grid->RowIndex); // Restore form values
			if ($cotizaciones_grid->RowAction == "insert")
				$cotizaciones->RowType = ROWTYPE_ADD; // Render add
			else
				$cotizaciones->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($cotizaciones->isGridEdit() && ($cotizaciones->RowType == ROWTYPE_EDIT || $cotizaciones->RowType == ROWTYPE_ADD) && $cotizaciones->EventCancelled) // Update failed
			$cotizaciones_grid->restoreCurrentRowFormValues($cotizaciones_grid->RowIndex); // Restore form values
		if ($cotizaciones->RowType == ROWTYPE_EDIT) // Edit row
			$cotizaciones_grid->EditRowCnt++;
		if ($cotizaciones->isConfirm()) // Confirm row
			$cotizaciones_grid->restoreCurrentRowFormValues($cotizaciones_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cotizaciones->RowAttrs = array_merge($cotizaciones->RowAttrs, array('data-rowindex'=>$cotizaciones_grid->RowCnt, 'id'=>'r' . $cotizaciones_grid->RowCnt . '_cotizaciones', 'data-rowtype'=>$cotizaciones->RowType));

		// Render row
		$cotizaciones_grid->renderRow();

		// Render list options
		$cotizaciones_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cotizaciones_grid->RowAction <> "delete" && $cotizaciones_grid->RowAction <> "insertdelete" && !($cotizaciones_grid->RowAction == "insert" && $cotizaciones->isConfirm() && $cotizaciones_grid->emptyRow())) {
?>
	<tr<?php echo $cotizaciones->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cotizaciones_grid->ListOptions->render("body", "left", $cotizaciones_grid->RowCnt);
?>
	<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
		<td data-name="titulo"<?php echo $cotizaciones->titulo->cellAttributes() ?>>
<?php if ($cotizaciones->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_titulo" class="form-group cotizaciones_titulo">
<input type="text" data-table="cotizaciones" data-field="x_titulo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->titulo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->titulo->EditValue ?>"<?php echo $cotizaciones->titulo->editAttributes() ?>>
</span>
<input type="hidden" data-table="cotizaciones" data-field="x_titulo" name="o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($cotizaciones->titulo->OldValue) ?>">
<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_titulo" class="form-group cotizaciones_titulo">
<input type="text" data-table="cotizaciones" data-field="x_titulo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->titulo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->titulo->EditValue ?>"<?php echo $cotizaciones->titulo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_titulo" class="cotizaciones_titulo">
<span<?php echo $cotizaciones->titulo->viewAttributes() ?>>
<?php echo $cotizaciones->titulo->getViewValue() ?></span>
</span>
<?php if (!$cotizaciones->isConfirm()) { ?>
<input type="hidden" data-table="cotizaciones" data-field="x_titulo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($cotizaciones->titulo->FormValue) ?>">
<input type="hidden" data-table="cotizaciones" data-field="x_titulo" name="o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($cotizaciones->titulo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cotizaciones" data-field="x_titulo" name="fcotizacionesgrid$x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="fcotizacionesgrid$x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($cotizaciones->titulo->FormValue) ?>">
<input type="hidden" data-table="cotizaciones" data-field="x_titulo" name="fcotizacionesgrid$o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="fcotizacionesgrid$o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($cotizaciones->titulo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cotizaciones" data-field="x_id" name="x<?php echo $cotizaciones_grid->RowIndex ?>_id" id="x<?php echo $cotizaciones_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cotizaciones->id->CurrentValue) ?>">
<input type="hidden" data-table="cotizaciones" data-field="x_id" name="o<?php echo $cotizaciones_grid->RowIndex ?>_id" id="o<?php echo $cotizaciones_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cotizaciones->id->OldValue) ?>">
<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_EDIT || $cotizaciones->CurrentMode == "edit") { ?>
<input type="hidden" data-table="cotizaciones" data-field="x_id" name="x<?php echo $cotizaciones_grid->RowIndex ?>_id" id="x<?php echo $cotizaciones_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cotizaciones->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($cotizaciones->img->Visible) { // img ?>
		<td data-name="img"<?php echo $cotizaciones->img->cellAttributes() ?>>
<?php if ($cotizaciones_grid->RowAction == "insert") { // Add record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_img" class="form-group cotizaciones_img">
<div id="fd_x<?php echo $cotizaciones_grid->RowIndex ?>_img">
<span title="<?php echo $cotizaciones->img->title() ? $cotizaciones->img->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($cotizaciones->img->ReadOnly || $cotizaciones->img->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cotizaciones" data-field="x_img" name="x<?php echo $cotizaciones_grid->RowIndex ?>_img" id="x<?php echo $cotizaciones_grid->RowIndex ?>_img"<?php echo $cotizaciones->img->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fn_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="0">
<input type="hidden" name="fs_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fs_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="255">
<input type="hidden" name="fx_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fx_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fm_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cotizaciones_grid->RowIndex ?>_img" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cotizaciones" data-field="x_img" name="o<?php echo $cotizaciones_grid->RowIndex ?>_img" id="o<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo HtmlEncode($cotizaciones->img->OldValue) ?>">
<?php } elseif ($cotizaciones->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_img" class="cotizaciones_img">
<span>
<?php echo GetFileViewTag($cotizaciones->img, $cotizaciones->img->getViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_img" class="form-group cotizaciones_img">
<div id="fd_x<?php echo $cotizaciones_grid->RowIndex ?>_img">
<span title="<?php echo $cotizaciones->img->title() ? $cotizaciones->img->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($cotizaciones->img->ReadOnly || $cotizaciones->img->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cotizaciones" data-field="x_img" name="x<?php echo $cotizaciones_grid->RowIndex ?>_img" id="x<?php echo $cotizaciones_grid->RowIndex ?>_img"<?php echo $cotizaciones->img->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fn_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fs_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="255">
<input type="hidden" name="fx_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fx_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fm_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cotizaciones_grid->RowIndex ?>_img" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
		<td data-name="cantidad"<?php echo $cotizaciones->cantidad->cellAttributes() ?>>
<?php if ($cotizaciones->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_cantidad" class="form-group cotizaciones_cantidad">
<input type="text" data-table="cotizaciones" data-field="x_cantidad" name="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->cantidad->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->cantidad->EditValue ?>"<?php echo $cotizaciones->cantidad->editAttributes() ?>>
</span>
<input type="hidden" data-table="cotizaciones" data-field="x_cantidad" name="o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" value="<?php echo HtmlEncode($cotizaciones->cantidad->OldValue) ?>">
<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_cantidad" class="form-group cotizaciones_cantidad">
<input type="text" data-table="cotizaciones" data-field="x_cantidad" name="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->cantidad->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->cantidad->EditValue ?>"<?php echo $cotizaciones->cantidad->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_cantidad" class="cotizaciones_cantidad">
<span<?php echo $cotizaciones->cantidad->viewAttributes() ?>>
<?php echo $cotizaciones->cantidad->getViewValue() ?></span>
</span>
<?php if (!$cotizaciones->isConfirm()) { ?>
<input type="hidden" data-table="cotizaciones" data-field="x_cantidad" name="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" value="<?php echo HtmlEncode($cotizaciones->cantidad->FormValue) ?>">
<input type="hidden" data-table="cotizaciones" data-field="x_cantidad" name="o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" value="<?php echo HtmlEncode($cotizaciones->cantidad->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cotizaciones" data-field="x_cantidad" name="fcotizacionesgrid$x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="fcotizacionesgrid$x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" value="<?php echo HtmlEncode($cotizaciones->cantidad->FormValue) ?>">
<input type="hidden" data-table="cotizaciones" data-field="x_cantidad" name="fcotizacionesgrid$o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="fcotizacionesgrid$o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" value="<?php echo HtmlEncode($cotizaciones->cantidad->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $cotizaciones->codigo->cellAttributes() ?>>
<?php if ($cotizaciones->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($cotizaciones->codigo->getSessionValue() <> "") { ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_codigo" class="form-group cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cotizaciones->codigo->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_codigo" class="form-group cotizaciones_codigo">
<input type="text" data-table="cotizaciones" data-field="x_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->codigo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->codigo->EditValue ?>"<?php echo $cotizaciones->codigo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cotizaciones" data-field="x_codigo" name="o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->OldValue) ?>">
<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cotizaciones->codigo->getSessionValue() <> "") { ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_codigo" class="form-group cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cotizaciones->codigo->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_codigo" class="form-group cotizaciones_codigo">
<input type="text" data-table="cotizaciones" data-field="x_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->codigo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->codigo->EditValue ?>"<?php echo $cotizaciones->codigo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cotizaciones->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cotizaciones_grid->RowCnt ?>_cotizaciones_codigo" class="cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<?php echo $cotizaciones->codigo->getViewValue() ?></span>
</span>
<?php if (!$cotizaciones->isConfirm()) { ?>
<input type="hidden" data-table="cotizaciones" data-field="x_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->FormValue) ?>">
<input type="hidden" data-table="cotizaciones" data-field="x_codigo" name="o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cotizaciones" data-field="x_codigo" name="fcotizacionesgrid$x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="fcotizacionesgrid$x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->FormValue) ?>">
<input type="hidden" data-table="cotizaciones" data-field="x_codigo" name="fcotizacionesgrid$o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="fcotizacionesgrid$o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cotizaciones_grid->ListOptions->render("body", "right", $cotizaciones_grid->RowCnt);
?>
	</tr>
<?php if ($cotizaciones->RowType == ROWTYPE_ADD || $cotizaciones->RowType == ROWTYPE_EDIT) { ?>
<script>
fcotizacionesgrid.updateLists(<?php echo $cotizaciones_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$cotizaciones->isGridAdd() || $cotizaciones->CurrentMode == "copy")
		if (!$cotizaciones_grid->Recordset->EOF)
			$cotizaciones_grid->Recordset->moveNext();
}
?>
<?php
	if ($cotizaciones->CurrentMode == "add" || $cotizaciones->CurrentMode == "copy" || $cotizaciones->CurrentMode == "edit") {
		$cotizaciones_grid->RowIndex = '$rowindex$';
		$cotizaciones_grid->loadRowValues();

		// Set row properties
		$cotizaciones->resetAttributes();
		$cotizaciones->RowAttrs = array_merge($cotizaciones->RowAttrs, array('data-rowindex'=>$cotizaciones_grid->RowIndex, 'id'=>'r0_cotizaciones', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($cotizaciones->RowAttrs["class"], "ew-template");
		$cotizaciones->RowType = ROWTYPE_ADD;

		// Render row
		$cotizaciones_grid->renderRow();

		// Render list options
		$cotizaciones_grid->renderListOptions();
		$cotizaciones_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cotizaciones->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cotizaciones_grid->ListOptions->render("body", "left", $cotizaciones_grid->RowIndex);
?>
	<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
		<td data-name="titulo">
<?php if (!$cotizaciones->isConfirm()) { ?>
<span id="el$rowindex$_cotizaciones_titulo" class="form-group cotizaciones_titulo">
<input type="text" data-table="cotizaciones" data-field="x_titulo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->titulo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->titulo->EditValue ?>"<?php echo $cotizaciones->titulo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cotizaciones_titulo" class="form-group cotizaciones_titulo">
<span<?php echo $cotizaciones->titulo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cotizaciones->titulo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cotizaciones" data-field="x_titulo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($cotizaciones->titulo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cotizaciones" data-field="x_titulo" name="o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" id="o<?php echo $cotizaciones_grid->RowIndex ?>_titulo" value="<?php echo HtmlEncode($cotizaciones->titulo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cotizaciones->img->Visible) { // img ?>
		<td data-name="img">
<span id="el$rowindex$_cotizaciones_img" class="form-group cotizaciones_img">
<div id="fd_x<?php echo $cotizaciones_grid->RowIndex ?>_img">
<span title="<?php echo $cotizaciones->img->title() ? $cotizaciones->img->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($cotizaciones->img->ReadOnly || $cotizaciones->img->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="cotizaciones" data-field="x_img" name="x<?php echo $cotizaciones_grid->RowIndex ?>_img" id="x<?php echo $cotizaciones_grid->RowIndex ?>_img"<?php echo $cotizaciones->img->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fn_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fa_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="0">
<input type="hidden" name="fs_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fs_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="255">
<input type="hidden" name="fx_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fx_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $cotizaciones_grid->RowIndex ?>_img" id= "fm_x<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo $cotizaciones->img->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $cotizaciones_grid->RowIndex ?>_img" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="cotizaciones" data-field="x_img" name="o<?php echo $cotizaciones_grid->RowIndex ?>_img" id="o<?php echo $cotizaciones_grid->RowIndex ?>_img" value="<?php echo HtmlEncode($cotizaciones->img->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
		<td data-name="cantidad">
<?php if (!$cotizaciones->isConfirm()) { ?>
<span id="el$rowindex$_cotizaciones_cantidad" class="form-group cotizaciones_cantidad">
<input type="text" data-table="cotizaciones" data-field="x_cantidad" name="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->cantidad->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->cantidad->EditValue ?>"<?php echo $cotizaciones->cantidad->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cotizaciones_cantidad" class="form-group cotizaciones_cantidad">
<span<?php echo $cotizaciones->cantidad->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cotizaciones->cantidad->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cotizaciones" data-field="x_cantidad" name="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="x<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" value="<?php echo HtmlEncode($cotizaciones->cantidad->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cotizaciones" data-field="x_cantidad" name="o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" id="o<?php echo $cotizaciones_grid->RowIndex ?>_cantidad" value="<?php echo HtmlEncode($cotizaciones->cantidad->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
		<td data-name="codigo">
<?php if (!$cotizaciones->isConfirm()) { ?>
<?php if ($cotizaciones->codigo->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cotizaciones_codigo" class="form-group cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cotizaciones->codigo->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cotizaciones_codigo" class="form-group cotizaciones_codigo">
<input type="text" data-table="cotizaciones" data-field="x_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cotizaciones->codigo->getPlaceHolder()) ?>" value="<?php echo $cotizaciones->codigo->EditValue ?>"<?php echo $cotizaciones->codigo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cotizaciones_codigo" class="form-group cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cotizaciones->codigo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cotizaciones" data-field="x_codigo" name="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="x<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cotizaciones" data-field="x_codigo" name="o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" id="o<?php echo $cotizaciones_grid->RowIndex ?>_codigo" value="<?php echo HtmlEncode($cotizaciones->codigo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cotizaciones_grid->ListOptions->render("body", "right", $cotizaciones_grid->RowIndex);
?>
<script>
fcotizacionesgrid.updateLists(<?php echo $cotizaciones_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($cotizaciones->CurrentMode == "add" || $cotizaciones->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $cotizaciones_grid->FormKeyCountName ?>" id="<?php echo $cotizaciones_grid->FormKeyCountName ?>" value="<?php echo $cotizaciones_grid->KeyCount ?>">
<?php echo $cotizaciones_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cotizaciones->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $cotizaciones_grid->FormKeyCountName ?>" id="<?php echo $cotizaciones_grid->FormKeyCountName ?>" value="<?php echo $cotizaciones_grid->KeyCount ?>">
<?php echo $cotizaciones_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cotizaciones->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcotizacionesgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($cotizaciones_grid->Recordset)
	$cotizaciones_grid->Recordset->Close();
?>
</div>
<?php if ($cotizaciones_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $cotizaciones_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cotizaciones_grid->TotalRecs == 0 && !$cotizaciones->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cotizaciones_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cotizaciones_grid->terminate();
?>