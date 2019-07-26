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
$clientes_list = new clientes_list();

// Run the page
$clientes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$clientes->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fclienteslist = currentForm = new ew.Form("fclienteslist", "list");
fclienteslist.formKeyCountName = '<?php echo $clientes_list->FormKeyCountName ?>';

// Form_CustomValidate event
fclienteslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fclienteslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fclienteslistsrch = currentSearchForm = new ew.Form("fclienteslistsrch");

// Filters
fclienteslistsrch.filterList = <?php echo $clientes_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$clientes->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($clientes_list->TotalRecs > 0 && $clientes_list->ExportOptions->visible()) { ?>
<?php $clientes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($clientes_list->ImportOptions->visible()) { ?>
<?php $clientes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($clientes_list->SearchOptions->visible()) { ?>
<?php $clientes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($clientes_list->FilterOptions->visible()) { ?>
<?php $clientes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$clientes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$clientes->isExport() && !$clientes->CurrentAction) { ?>
<form name="fclienteslistsrch" id="fclienteslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($clientes_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fclienteslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="clientes">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($clientes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($clientes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $clientes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $clientes_list->showPageHeader(); ?>
<?php
$clientes_list->showMessage();
?>
<?php if ($clientes_list->TotalRecs > 0 || $clientes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($clientes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> clientes">
<?php if (!$clientes->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$clientes->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($clientes_list->Pager)) $clientes_list->Pager = new PrevNextPager($clientes_list->StartRec, $clientes_list->DisplayRecs, $clientes_list->TotalRecs, $clientes_list->AutoHidePager) ?>
<?php if ($clientes_list->Pager->RecordCount > 0 && $clientes_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($clientes_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($clientes_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $clientes_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($clientes_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($clientes_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $clientes_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($clientes_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $clientes_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $clientes_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $clientes_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $clientes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fclienteslist" id="fclienteslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($clientes_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $clientes_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<div id="gmp_clientes" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($clientes_list->TotalRecs > 0 || $clientes->isGridEdit()) { ?>
<table id="tbl_clienteslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$clientes_list->RowType = ROWTYPE_HEADER;

// Render list options
$clientes_list->renderListOptions();

// Render list options (header, left)
$clientes_list->ListOptions->render("header", "left");
?>
<?php if ($clientes->ruc->Visible) { // ruc ?>
	<?php if ($clientes->sortUrl($clientes->ruc) == "") { ?>
		<th data-name="ruc" class="<?php echo $clientes->ruc->headerCellClass() ?>"><div id="elh_clientes_ruc" class="clientes_ruc"><div class="ew-table-header-caption"><?php echo $clientes->ruc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ruc" class="<?php echo $clientes->ruc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $clientes->SortUrl($clientes->ruc) ?>',2);"><div id="elh_clientes_ruc" class="clientes_ruc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes->ruc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes->ruc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($clientes->ruc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes->nom->Visible) { // nom ?>
	<?php if ($clientes->sortUrl($clientes->nom) == "") { ?>
		<th data-name="nom" class="<?php echo $clientes->nom->headerCellClass() ?>"><div id="elh_clientes_nom" class="clientes_nom"><div class="ew-table-header-caption"><?php echo $clientes->nom->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nom" class="<?php echo $clientes->nom->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $clientes->SortUrl($clientes->nom) ?>',2);"><div id="elh_clientes_nom" class="clientes_nom">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes->nom->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes->nom->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($clientes->nom->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes->tel->Visible) { // tel ?>
	<?php if ($clientes->sortUrl($clientes->tel) == "") { ?>
		<th data-name="tel" class="<?php echo $clientes->tel->headerCellClass() ?>"><div id="elh_clientes_tel" class="clientes_tel"><div class="ew-table-header-caption"><?php echo $clientes->tel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tel" class="<?php echo $clientes->tel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $clientes->SortUrl($clientes->tel) ?>',2);"><div id="elh_clientes_tel" class="clientes_tel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes->tel->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes->tel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($clientes->tel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes->cor->Visible) { // cor ?>
	<?php if ($clientes->sortUrl($clientes->cor) == "") { ?>
		<th data-name="cor" class="<?php echo $clientes->cor->headerCellClass() ?>"><div id="elh_clientes_cor" class="clientes_cor"><div class="ew-table-header-caption"><?php echo $clientes->cor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cor" class="<?php echo $clientes->cor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $clientes->SortUrl($clientes->cor) ?>',2);"><div id="elh_clientes_cor" class="clientes_cor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes->cor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes->cor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($clientes->cor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes->codigo->Visible) { // codigo ?>
	<?php if ($clientes->sortUrl($clientes->codigo) == "") { ?>
		<th data-name="codigo" class="<?php echo $clientes->codigo->headerCellClass() ?>"><div id="elh_clientes_codigo" class="clientes_codigo"><div class="ew-table-header-caption"><?php echo $clientes->codigo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo" class="<?php echo $clientes->codigo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $clientes->SortUrl($clientes->codigo) ?>',2);"><div id="elh_clientes_codigo" class="clientes_codigo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes->codigo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes->codigo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($clientes->codigo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes->hora->Visible) { // hora ?>
	<?php if ($clientes->sortUrl($clientes->hora) == "") { ?>
		<th data-name="hora" class="<?php echo $clientes->hora->headerCellClass() ?>"><div id="elh_clientes_hora" class="clientes_hora"><div class="ew-table-header-caption"><?php echo $clientes->hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hora" class="<?php echo $clientes->hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $clientes->SortUrl($clientes->hora) ?>',2);"><div id="elh_clientes_hora" class="clientes_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes->hora->caption() ?></span><span class="ew-table-header-sort"><?php if ($clientes->hora->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($clientes->hora->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes->fecha->Visible) { // fecha ?>
	<?php if ($clientes->sortUrl($clientes->fecha) == "") { ?>
		<th data-name="fecha" class="<?php echo $clientes->fecha->headerCellClass() ?>"><div id="elh_clientes_fecha" class="clientes_fecha"><div class="ew-table-header-caption"><?php echo $clientes->fecha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha" class="<?php echo $clientes->fecha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $clientes->SortUrl($clientes->fecha) ?>',2);"><div id="elh_clientes_fecha" class="clientes_fecha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes->fecha->caption() ?></span><span class="ew-table-header-sort"><?php if ($clientes->fecha->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($clientes->fecha->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$clientes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($clientes->ExportAll && $clientes->isExport()) {
	$clientes_list->StopRec = $clientes_list->TotalRecs;
} else {

	// Set the last record to display
	if ($clientes_list->TotalRecs > $clientes_list->StartRec + $clientes_list->DisplayRecs - 1)
		$clientes_list->StopRec = $clientes_list->StartRec + $clientes_list->DisplayRecs - 1;
	else
		$clientes_list->StopRec = $clientes_list->TotalRecs;
}
$clientes_list->RecCnt = $clientes_list->StartRec - 1;
if ($clientes_list->Recordset && !$clientes_list->Recordset->EOF) {
	$clientes_list->Recordset->moveFirst();
	$selectLimit = $clientes_list->UseSelectLimit;
	if (!$selectLimit && $clientes_list->StartRec > 1)
		$clientes_list->Recordset->move($clientes_list->StartRec - 1);
} elseif (!$clientes->AllowAddDeleteRow && $clientes_list->StopRec == 0) {
	$clientes_list->StopRec = $clientes->GridAddRowCount;
}

// Initialize aggregate
$clientes->RowType = ROWTYPE_AGGREGATEINIT;
$clientes->resetAttributes();
$clientes_list->renderRow();
while ($clientes_list->RecCnt < $clientes_list->StopRec) {
	$clientes_list->RecCnt++;
	if ($clientes_list->RecCnt >= $clientes_list->StartRec) {
		$clientes_list->RowCnt++;

		// Set up key count
		$clientes_list->KeyCount = $clientes_list->RowIndex;

		// Init row class and style
		$clientes->resetAttributes();
		$clientes->CssClass = "";
		if ($clientes->isGridAdd()) {
		} else {
			$clientes_list->loadRowValues($clientes_list->Recordset); // Load row values
		}
		$clientes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$clientes->RowAttrs = array_merge($clientes->RowAttrs, array('data-rowindex'=>$clientes_list->RowCnt, 'id'=>'r' . $clientes_list->RowCnt . '_clientes', 'data-rowtype'=>$clientes->RowType));

		// Render row
		$clientes_list->renderRow();

		// Render list options
		$clientes_list->renderListOptions();
?>
	<tr<?php echo $clientes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$clientes_list->ListOptions->render("body", "left", $clientes_list->RowCnt);
?>
	<?php if ($clientes->ruc->Visible) { // ruc ?>
		<td data-name="ruc"<?php echo $clientes->ruc->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCnt ?>_clientes_ruc" class="clientes_ruc">
<span<?php echo $clientes->ruc->viewAttributes() ?>>
<?php echo $clientes->ruc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes->nom->Visible) { // nom ?>
		<td data-name="nom"<?php echo $clientes->nom->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCnt ?>_clientes_nom" class="clientes_nom">
<span<?php echo $clientes->nom->viewAttributes() ?>>
<?php echo $clientes->nom->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes->tel->Visible) { // tel ?>
		<td data-name="tel"<?php echo $clientes->tel->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCnt ?>_clientes_tel" class="clientes_tel">
<span<?php echo $clientes->tel->viewAttributes() ?>>
<?php echo $clientes->tel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes->cor->Visible) { // cor ?>
		<td data-name="cor"<?php echo $clientes->cor->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCnt ?>_clientes_cor" class="clientes_cor">
<span<?php echo $clientes->cor->viewAttributes() ?>>
<?php echo $clientes->cor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $clientes->codigo->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCnt ?>_clientes_codigo" class="clientes_codigo">
<span<?php echo $clientes->codigo->viewAttributes() ?>>
<?php echo $clientes->codigo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes->hora->Visible) { // hora ?>
		<td data-name="hora"<?php echo $clientes->hora->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCnt ?>_clientes_hora" class="clientes_hora">
<span<?php echo $clientes->hora->viewAttributes() ?>>
<?php echo $clientes->hora->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes->fecha->Visible) { // fecha ?>
		<td data-name="fecha"<?php echo $clientes->fecha->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCnt ?>_clientes_fecha" class="clientes_fecha">
<span<?php echo $clientes->fecha->viewAttributes() ?>>
<?php echo $clientes->fecha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$clientes_list->ListOptions->render("body", "right", $clientes_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$clientes->isGridAdd())
		$clientes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$clientes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($clientes_list->Recordset)
	$clientes_list->Recordset->Close();
?>
<?php if (!$clientes->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$clientes->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($clientes_list->Pager)) $clientes_list->Pager = new PrevNextPager($clientes_list->StartRec, $clientes_list->DisplayRecs, $clientes_list->TotalRecs, $clientes_list->AutoHidePager) ?>
<?php if ($clientes_list->Pager->RecordCount > 0 && $clientes_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($clientes_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($clientes_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $clientes_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($clientes_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($clientes_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $clientes_list->pageUrl() ?>start=<?php echo $clientes_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $clientes_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($clientes_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $clientes_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $clientes_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $clientes_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $clientes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($clientes_list->TotalRecs == 0 && !$clientes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $clientes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$clientes_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$clientes->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$clientes_list->terminate();
?>