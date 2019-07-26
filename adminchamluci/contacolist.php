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
$contaco_list = new contaco_list();

// Run the page
$contaco_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contaco_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contaco->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcontacolist = currentForm = new ew.Form("fcontacolist", "list");
fcontacolist.formKeyCountName = '<?php echo $contaco_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcontacolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontacolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcontacolistsrch = currentSearchForm = new ew.Form("fcontacolistsrch");

// Filters
fcontacolistsrch.filterList = <?php echo $contaco_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contaco->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contaco_list->TotalRecs > 0 && $contaco_list->ExportOptions->visible()) { ?>
<?php $contaco_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contaco_list->ImportOptions->visible()) { ?>
<?php $contaco_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contaco_list->SearchOptions->visible()) { ?>
<?php $contaco_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contaco_list->FilterOptions->visible()) { ?>
<?php $contaco_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contaco_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contaco->isExport() && !$contaco->CurrentAction) { ?>
<form name="fcontacolistsrch" id="fcontacolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($contaco_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcontacolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contaco">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($contaco_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($contaco_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contaco_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contaco_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contaco_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contaco_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contaco_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $contaco_list->showPageHeader(); ?>
<?php
$contaco_list->showMessage();
?>
<?php if ($contaco_list->TotalRecs > 0 || $contaco->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contaco_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contaco">
<?php if (!$contaco->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contaco->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($contaco_list->Pager)) $contaco_list->Pager = new PrevNextPager($contaco_list->StartRec, $contaco_list->DisplayRecs, $contaco_list->TotalRecs, $contaco_list->AutoHidePager) ?>
<?php if ($contaco_list->Pager->RecordCount > 0 && $contaco_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($contaco_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($contaco_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $contaco_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($contaco_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($contaco_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contaco_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($contaco_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contaco_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contaco_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contaco_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contaco_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontacolist" id="fcontacolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contaco_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contaco_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contaco">
<div id="gmp_contaco" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($contaco_list->TotalRecs > 0 || $contaco->isGridEdit()) { ?>
<table id="tbl_contacolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contaco_list->RowType = ROWTYPE_HEADER;

// Render list options
$contaco_list->renderListOptions();

// Render list options (header, left)
$contaco_list->ListOptions->render("header", "left");
?>
<?php if ($contaco->correo->Visible) { // correo ?>
	<?php if ($contaco->sortUrl($contaco->correo) == "") { ?>
		<th data-name="correo" class="<?php echo $contaco->correo->headerCellClass() ?>"><div id="elh_contaco_correo" class="contaco_correo"><div class="ew-table-header-caption"><?php echo $contaco->correo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo" class="<?php echo $contaco->correo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contaco->SortUrl($contaco->correo) ?>',2);"><div id="elh_contaco_correo" class="contaco_correo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contaco->correo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contaco->correo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contaco->correo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contaco->direccion->Visible) { // direccion ?>
	<?php if ($contaco->sortUrl($contaco->direccion) == "") { ?>
		<th data-name="direccion" class="<?php echo $contaco->direccion->headerCellClass() ?>"><div id="elh_contaco_direccion" class="contaco_direccion"><div class="ew-table-header-caption"><?php echo $contaco->direccion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direccion" class="<?php echo $contaco->direccion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contaco->SortUrl($contaco->direccion) ?>',2);"><div id="elh_contaco_direccion" class="contaco_direccion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contaco->direccion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contaco->direccion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contaco->direccion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contaco->horario->Visible) { // horario ?>
	<?php if ($contaco->sortUrl($contaco->horario) == "") { ?>
		<th data-name="horario" class="<?php echo $contaco->horario->headerCellClass() ?>"><div id="elh_contaco_horario" class="contaco_horario"><div class="ew-table-header-caption"><?php echo $contaco->horario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="horario" class="<?php echo $contaco->horario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contaco->SortUrl($contaco->horario) ?>',2);"><div id="elh_contaco_horario" class="contaco_horario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contaco->horario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contaco->horario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contaco->horario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contaco->img_bcp->Visible) { // img_bcp ?>
	<?php if ($contaco->sortUrl($contaco->img_bcp) == "") { ?>
		<th data-name="img_bcp" class="<?php echo $contaco->img_bcp->headerCellClass() ?>"><div id="elh_contaco_img_bcp" class="contaco_img_bcp"><div class="ew-table-header-caption"><?php echo $contaco->img_bcp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img_bcp" class="<?php echo $contaco->img_bcp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contaco->SortUrl($contaco->img_bcp) ?>',2);"><div id="elh_contaco_img_bcp" class="contaco_img_bcp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contaco->img_bcp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contaco->img_bcp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contaco->img_bcp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contaco->img_bbva->Visible) { // img_bbva ?>
	<?php if ($contaco->sortUrl($contaco->img_bbva) == "") { ?>
		<th data-name="img_bbva" class="<?php echo $contaco->img_bbva->headerCellClass() ?>"><div id="elh_contaco_img_bbva" class="contaco_img_bbva"><div class="ew-table-header-caption"><?php echo $contaco->img_bbva->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img_bbva" class="<?php echo $contaco->img_bbva->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contaco->SortUrl($contaco->img_bbva) ?>',2);"><div id="elh_contaco_img_bbva" class="contaco_img_bbva">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contaco->img_bbva->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contaco->img_bbva->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contaco->img_bbva->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contaco->correo_formulario->Visible) { // correo_formulario ?>
	<?php if ($contaco->sortUrl($contaco->correo_formulario) == "") { ?>
		<th data-name="correo_formulario" class="<?php echo $contaco->correo_formulario->headerCellClass() ?>"><div id="elh_contaco_correo_formulario" class="contaco_correo_formulario"><div class="ew-table-header-caption"><?php echo $contaco->correo_formulario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo_formulario" class="<?php echo $contaco->correo_formulario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contaco->SortUrl($contaco->correo_formulario) ?>',2);"><div id="elh_contaco_correo_formulario" class="contaco_correo_formulario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contaco->correo_formulario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contaco->correo_formulario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contaco->correo_formulario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contaco_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contaco->ExportAll && $contaco->isExport()) {
	$contaco_list->StopRec = $contaco_list->TotalRecs;
} else {

	// Set the last record to display
	if ($contaco_list->TotalRecs > $contaco_list->StartRec + $contaco_list->DisplayRecs - 1)
		$contaco_list->StopRec = $contaco_list->StartRec + $contaco_list->DisplayRecs - 1;
	else
		$contaco_list->StopRec = $contaco_list->TotalRecs;
}
$contaco_list->RecCnt = $contaco_list->StartRec - 1;
if ($contaco_list->Recordset && !$contaco_list->Recordset->EOF) {
	$contaco_list->Recordset->moveFirst();
	$selectLimit = $contaco_list->UseSelectLimit;
	if (!$selectLimit && $contaco_list->StartRec > 1)
		$contaco_list->Recordset->move($contaco_list->StartRec - 1);
} elseif (!$contaco->AllowAddDeleteRow && $contaco_list->StopRec == 0) {
	$contaco_list->StopRec = $contaco->GridAddRowCount;
}

// Initialize aggregate
$contaco->RowType = ROWTYPE_AGGREGATEINIT;
$contaco->resetAttributes();
$contaco_list->renderRow();
while ($contaco_list->RecCnt < $contaco_list->StopRec) {
	$contaco_list->RecCnt++;
	if ($contaco_list->RecCnt >= $contaco_list->StartRec) {
		$contaco_list->RowCnt++;

		// Set up key count
		$contaco_list->KeyCount = $contaco_list->RowIndex;

		// Init row class and style
		$contaco->resetAttributes();
		$contaco->CssClass = "";
		if ($contaco->isGridAdd()) {
		} else {
			$contaco_list->loadRowValues($contaco_list->Recordset); // Load row values
		}
		$contaco->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contaco->RowAttrs = array_merge($contaco->RowAttrs, array('data-rowindex'=>$contaco_list->RowCnt, 'id'=>'r' . $contaco_list->RowCnt . '_contaco', 'data-rowtype'=>$contaco->RowType));

		// Render row
		$contaco_list->renderRow();

		// Render list options
		$contaco_list->renderListOptions();
?>
	<tr<?php echo $contaco->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contaco_list->ListOptions->render("body", "left", $contaco_list->RowCnt);
?>
	<?php if ($contaco->correo->Visible) { // correo ?>
		<td data-name="correo"<?php echo $contaco->correo->cellAttributes() ?>>
<span id="el<?php echo $contaco_list->RowCnt ?>_contaco_correo" class="contaco_correo">
<span<?php echo $contaco->correo->viewAttributes() ?>>
<?php echo $contaco->correo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contaco->direccion->Visible) { // direccion ?>
		<td data-name="direccion"<?php echo $contaco->direccion->cellAttributes() ?>>
<span id="el<?php echo $contaco_list->RowCnt ?>_contaco_direccion" class="contaco_direccion">
<span<?php echo $contaco->direccion->viewAttributes() ?>>
<?php echo $contaco->direccion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contaco->horario->Visible) { // horario ?>
		<td data-name="horario"<?php echo $contaco->horario->cellAttributes() ?>>
<span id="el<?php echo $contaco_list->RowCnt ?>_contaco_horario" class="contaco_horario">
<span<?php echo $contaco->horario->viewAttributes() ?>>
<?php echo $contaco->horario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contaco->img_bcp->Visible) { // img_bcp ?>
		<td data-name="img_bcp"<?php echo $contaco->img_bcp->cellAttributes() ?>>
<span id="el<?php echo $contaco_list->RowCnt ?>_contaco_img_bcp" class="contaco_img_bcp">
<span>
<?php echo GetFileViewTag($contaco->img_bcp, $contaco->img_bcp->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($contaco->img_bbva->Visible) { // img_bbva ?>
		<td data-name="img_bbva"<?php echo $contaco->img_bbva->cellAttributes() ?>>
<span id="el<?php echo $contaco_list->RowCnt ?>_contaco_img_bbva" class="contaco_img_bbva">
<span>
<?php echo GetFileViewTag($contaco->img_bbva, $contaco->img_bbva->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($contaco->correo_formulario->Visible) { // correo_formulario ?>
		<td data-name="correo_formulario"<?php echo $contaco->correo_formulario->cellAttributes() ?>>
<span id="el<?php echo $contaco_list->RowCnt ?>_contaco_correo_formulario" class="contaco_correo_formulario">
<span<?php echo $contaco->correo_formulario->viewAttributes() ?>>
<?php echo $contaco->correo_formulario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contaco_list->ListOptions->render("body", "right", $contaco_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$contaco->isGridAdd())
		$contaco_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$contaco->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contaco_list->Recordset)
	$contaco_list->Recordset->Close();
?>
<?php if (!$contaco->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contaco->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($contaco_list->Pager)) $contaco_list->Pager = new PrevNextPager($contaco_list->StartRec, $contaco_list->DisplayRecs, $contaco_list->TotalRecs, $contaco_list->AutoHidePager) ?>
<?php if ($contaco_list->Pager->RecordCount > 0 && $contaco_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($contaco_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($contaco_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $contaco_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($contaco_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($contaco_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $contaco_list->pageUrl() ?>start=<?php echo $contaco_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contaco_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($contaco_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contaco_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contaco_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contaco_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contaco_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contaco_list->TotalRecs == 0 && !$contaco->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contaco_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contaco_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contaco->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contaco_list->terminate();
?>