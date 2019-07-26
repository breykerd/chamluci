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
$cotizaciones_list = new cotizaciones_list();

// Run the page
$cotizaciones_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cotizaciones_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cotizaciones->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcotizacioneslist = currentForm = new ew.Form("fcotizacioneslist", "list");
fcotizacioneslist.formKeyCountName = '<?php echo $cotizaciones_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcotizacioneslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcotizacioneslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcotizacioneslistsrch = currentSearchForm = new ew.Form("fcotizacioneslistsrch");

// Filters
fcotizacioneslistsrch.filterList = <?php echo $cotizaciones_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cotizaciones->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cotizaciones_list->TotalRecs > 0 && $cotizaciones_list->ExportOptions->visible()) { ?>
<?php $cotizaciones_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cotizaciones_list->ImportOptions->visible()) { ?>
<?php $cotizaciones_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cotizaciones_list->SearchOptions->visible()) { ?>
<?php $cotizaciones_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cotizaciones_list->FilterOptions->visible()) { ?>
<?php $cotizaciones_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$cotizaciones->isExport() || EXPORT_MASTER_RECORD && $cotizaciones->isExport("print")) { ?>
<?php
if ($cotizaciones_list->DbMasterFilter <> "" && $cotizaciones->getCurrentMasterTable() == "clientes") {
	if ($cotizaciones_list->MasterRecordExists) {
		include_once "clientesmaster.php";
	}
}
?>
<?php } ?>
<?php
$cotizaciones_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cotizaciones->isExport() && !$cotizaciones->CurrentAction) { ?>
<form name="fcotizacioneslistsrch" id="fcotizacioneslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cotizaciones_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcotizacioneslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cotizaciones">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cotizaciones_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cotizaciones_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cotizaciones_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cotizaciones_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cotizaciones_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cotizaciones_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cotizaciones_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $cotizaciones_list->showPageHeader(); ?>
<?php
$cotizaciones_list->showMessage();
?>
<?php if ($cotizaciones_list->TotalRecs > 0 || $cotizaciones->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cotizaciones_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cotizaciones">
<?php if (!$cotizaciones->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cotizaciones->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cotizaciones_list->Pager)) $cotizaciones_list->Pager = new PrevNextPager($cotizaciones_list->StartRec, $cotizaciones_list->DisplayRecs, $cotizaciones_list->TotalRecs, $cotizaciones_list->AutoHidePager) ?>
<?php if ($cotizaciones_list->Pager->RecordCount > 0 && $cotizaciones_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cotizaciones_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cotizaciones_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cotizaciones_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cotizaciones_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cotizaciones_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cotizaciones_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($cotizaciones_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cotizaciones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cotizaciones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cotizaciones_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cotizaciones_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcotizacioneslist" id="fcotizacioneslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cotizaciones_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cotizaciones_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cotizaciones">
<?php if ($cotizaciones->getCurrentMasterTable() == "clientes" && $cotizaciones->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="clientes">
<input type="hidden" name="fk_codigo" value="<?php echo $cotizaciones->codigo->getSessionValue() ?>">
<?php } ?>
<div id="gmp_cotizaciones" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cotizaciones_list->TotalRecs > 0 || $cotizaciones->isGridEdit()) { ?>
<table id="tbl_cotizacioneslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cotizaciones_list->RowType = ROWTYPE_HEADER;

// Render list options
$cotizaciones_list->renderListOptions();

// Render list options (header, left)
$cotizaciones_list->ListOptions->render("header", "left");
?>
<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $cotizaciones->titulo->headerCellClass() ?>"><div id="elh_cotizaciones_titulo" class="cotizaciones_titulo"><div class="ew-table-header-caption"><?php echo $cotizaciones->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $cotizaciones->titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cotizaciones->SortUrl($cotizaciones->titulo) ?>',2);"><div id="elh_cotizaciones_titulo" class="cotizaciones_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cotizaciones->img->Visible) { // img ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->img) == "") { ?>
		<th data-name="img" class="<?php echo $cotizaciones->img->headerCellClass() ?>"><div id="elh_cotizaciones_img" class="cotizaciones_img"><div class="ew-table-header-caption"><?php echo $cotizaciones->img->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img" class="<?php echo $cotizaciones->img->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cotizaciones->SortUrl($cotizaciones->img) ?>',2);"><div id="elh_cotizaciones_img" class="cotizaciones_img">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->img->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->img->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->img->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->cantidad) == "") { ?>
		<th data-name="cantidad" class="<?php echo $cotizaciones->cantidad->headerCellClass() ?>"><div id="elh_cotizaciones_cantidad" class="cotizaciones_cantidad"><div class="ew-table-header-caption"><?php echo $cotizaciones->cantidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad" class="<?php echo $cotizaciones->cantidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cotizaciones->SortUrl($cotizaciones->cantidad) ?>',2);"><div id="elh_cotizaciones_cantidad" class="cotizaciones_cantidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->cantidad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->cantidad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->cantidad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
	<?php if ($cotizaciones->sortUrl($cotizaciones->codigo) == "") { ?>
		<th data-name="codigo" class="<?php echo $cotizaciones->codigo->headerCellClass() ?>"><div id="elh_cotizaciones_codigo" class="cotizaciones_codigo"><div class="ew-table-header-caption"><?php echo $cotizaciones->codigo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo" class="<?php echo $cotizaciones->codigo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cotizaciones->SortUrl($cotizaciones->codigo) ?>',2);"><div id="elh_cotizaciones_codigo" class="cotizaciones_codigo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cotizaciones->codigo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cotizaciones->codigo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cotizaciones->codigo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cotizaciones_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cotizaciones->ExportAll && $cotizaciones->isExport()) {
	$cotizaciones_list->StopRec = $cotizaciones_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cotizaciones_list->TotalRecs > $cotizaciones_list->StartRec + $cotizaciones_list->DisplayRecs - 1)
		$cotizaciones_list->StopRec = $cotizaciones_list->StartRec + $cotizaciones_list->DisplayRecs - 1;
	else
		$cotizaciones_list->StopRec = $cotizaciones_list->TotalRecs;
}
$cotizaciones_list->RecCnt = $cotizaciones_list->StartRec - 1;
if ($cotizaciones_list->Recordset && !$cotizaciones_list->Recordset->EOF) {
	$cotizaciones_list->Recordset->moveFirst();
	$selectLimit = $cotizaciones_list->UseSelectLimit;
	if (!$selectLimit && $cotizaciones_list->StartRec > 1)
		$cotizaciones_list->Recordset->move($cotizaciones_list->StartRec - 1);
} elseif (!$cotizaciones->AllowAddDeleteRow && $cotizaciones_list->StopRec == 0) {
	$cotizaciones_list->StopRec = $cotizaciones->GridAddRowCount;
}

// Initialize aggregate
$cotizaciones->RowType = ROWTYPE_AGGREGATEINIT;
$cotizaciones->resetAttributes();
$cotizaciones_list->renderRow();
while ($cotizaciones_list->RecCnt < $cotizaciones_list->StopRec) {
	$cotizaciones_list->RecCnt++;
	if ($cotizaciones_list->RecCnt >= $cotizaciones_list->StartRec) {
		$cotizaciones_list->RowCnt++;

		// Set up key count
		$cotizaciones_list->KeyCount = $cotizaciones_list->RowIndex;

		// Init row class and style
		$cotizaciones->resetAttributes();
		$cotizaciones->CssClass = "";
		if ($cotizaciones->isGridAdd()) {
		} else {
			$cotizaciones_list->loadRowValues($cotizaciones_list->Recordset); // Load row values
		}
		$cotizaciones->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cotizaciones->RowAttrs = array_merge($cotizaciones->RowAttrs, array('data-rowindex'=>$cotizaciones_list->RowCnt, 'id'=>'r' . $cotizaciones_list->RowCnt . '_cotizaciones', 'data-rowtype'=>$cotizaciones->RowType));

		// Render row
		$cotizaciones_list->renderRow();

		// Render list options
		$cotizaciones_list->renderListOptions();
?>
	<tr<?php echo $cotizaciones->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cotizaciones_list->ListOptions->render("body", "left", $cotizaciones_list->RowCnt);
?>
	<?php if ($cotizaciones->titulo->Visible) { // titulo ?>
		<td data-name="titulo"<?php echo $cotizaciones->titulo->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_list->RowCnt ?>_cotizaciones_titulo" class="cotizaciones_titulo">
<span<?php echo $cotizaciones->titulo->viewAttributes() ?>>
<?php echo $cotizaciones->titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cotizaciones->img->Visible) { // img ?>
		<td data-name="img"<?php echo $cotizaciones->img->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_list->RowCnt ?>_cotizaciones_img" class="cotizaciones_img">
<span>
<?php echo GetFileViewTag($cotizaciones->img, $cotizaciones->img->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($cotizaciones->cantidad->Visible) { // cantidad ?>
		<td data-name="cantidad"<?php echo $cotizaciones->cantidad->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_list->RowCnt ?>_cotizaciones_cantidad" class="cotizaciones_cantidad">
<span<?php echo $cotizaciones->cantidad->viewAttributes() ?>>
<?php echo $cotizaciones->cantidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cotizaciones->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $cotizaciones->codigo->cellAttributes() ?>>
<span id="el<?php echo $cotizaciones_list->RowCnt ?>_cotizaciones_codigo" class="cotizaciones_codigo">
<span<?php echo $cotizaciones->codigo->viewAttributes() ?>>
<?php echo $cotizaciones->codigo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cotizaciones_list->ListOptions->render("body", "right", $cotizaciones_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cotizaciones->isGridAdd())
		$cotizaciones_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cotizaciones->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cotizaciones_list->Recordset)
	$cotizaciones_list->Recordset->Close();
?>
<?php if (!$cotizaciones->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cotizaciones->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cotizaciones_list->Pager)) $cotizaciones_list->Pager = new PrevNextPager($cotizaciones_list->StartRec, $cotizaciones_list->DisplayRecs, $cotizaciones_list->TotalRecs, $cotizaciones_list->AutoHidePager) ?>
<?php if ($cotizaciones_list->Pager->RecordCount > 0 && $cotizaciones_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cotizaciones_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cotizaciones_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cotizaciones_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cotizaciones_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cotizaciones_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cotizaciones_list->pageUrl() ?>start=<?php echo $cotizaciones_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cotizaciones_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($cotizaciones_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cotizaciones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cotizaciones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cotizaciones_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cotizaciones_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cotizaciones_list->TotalRecs == 0 && !$cotizaciones->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cotizaciones_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cotizaciones_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cotizaciones->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cotizaciones_list->terminate();
?>