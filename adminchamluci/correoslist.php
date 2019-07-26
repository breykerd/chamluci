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
$correos_list = new correos_list();

// Run the page
$correos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$correos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$correos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcorreoslist = currentForm = new ew.Form("fcorreoslist", "list");
fcorreoslist.formKeyCountName = '<?php echo $correos_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcorreoslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcorreoslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcorreoslistsrch = currentSearchForm = new ew.Form("fcorreoslistsrch");

// Filters
fcorreoslistsrch.filterList = <?php echo $correos_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$correos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($correos_list->TotalRecs > 0 && $correos_list->ExportOptions->visible()) { ?>
<?php $correos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($correos_list->ImportOptions->visible()) { ?>
<?php $correos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($correos_list->SearchOptions->visible()) { ?>
<?php $correos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($correos_list->FilterOptions->visible()) { ?>
<?php $correos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$correos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$correos->isExport() && !$correos->CurrentAction) { ?>
<form name="fcorreoslistsrch" id="fcorreoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($correos_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcorreoslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="correos">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($correos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($correos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $correos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($correos_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($correos_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($correos_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($correos_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $correos_list->showPageHeader(); ?>
<?php
$correos_list->showMessage();
?>
<?php if ($correos_list->TotalRecs > 0 || $correos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($correos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> correos">
<?php if (!$correos->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$correos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($correos_list->Pager)) $correos_list->Pager = new PrevNextPager($correos_list->StartRec, $correos_list->DisplayRecs, $correos_list->TotalRecs, $correos_list->AutoHidePager) ?>
<?php if ($correos_list->Pager->RecordCount > 0 && $correos_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($correos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($correos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $correos_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($correos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($correos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $correos_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($correos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $correos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $correos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $correos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $correos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcorreoslist" id="fcorreoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($correos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $correos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="correos">
<div id="gmp_correos" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($correos_list->TotalRecs > 0 || $correos->isGridEdit()) { ?>
<table id="tbl_correoslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$correos_list->RowType = ROWTYPE_HEADER;

// Render list options
$correos_list->renderListOptions();

// Render list options (header, left)
$correos_list->ListOptions->render("header", "left");
?>
<?php if ($correos->nombre->Visible) { // nombre ?>
	<?php if ($correos->sortUrl($correos->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $correos->nombre->headerCellClass() ?>"><div id="elh_correos_nombre" class="correos_nombre"><div class="ew-table-header-caption"><?php echo $correos->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $correos->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $correos->SortUrl($correos->nombre) ?>',2);"><div id="elh_correos_nombre" class="correos_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $correos->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($correos->nombre->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($correos->nombre->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($correos->correo->Visible) { // correo ?>
	<?php if ($correos->sortUrl($correos->correo) == "") { ?>
		<th data-name="correo" class="<?php echo $correos->correo->headerCellClass() ?>"><div id="elh_correos_correo" class="correos_correo"><div class="ew-table-header-caption"><?php echo $correos->correo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo" class="<?php echo $correos->correo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $correos->SortUrl($correos->correo) ?>',2);"><div id="elh_correos_correo" class="correos_correo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $correos->correo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($correos->correo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($correos->correo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($correos->hora->Visible) { // hora ?>
	<?php if ($correos->sortUrl($correos->hora) == "") { ?>
		<th data-name="hora" class="<?php echo $correos->hora->headerCellClass() ?>"><div id="elh_correos_hora" class="correos_hora"><div class="ew-table-header-caption"><?php echo $correos->hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hora" class="<?php echo $correos->hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $correos->SortUrl($correos->hora) ?>',2);"><div id="elh_correos_hora" class="correos_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $correos->hora->caption() ?></span><span class="ew-table-header-sort"><?php if ($correos->hora->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($correos->hora->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($correos->fecha->Visible) { // fecha ?>
	<?php if ($correos->sortUrl($correos->fecha) == "") { ?>
		<th data-name="fecha" class="<?php echo $correos->fecha->headerCellClass() ?>"><div id="elh_correos_fecha" class="correos_fecha"><div class="ew-table-header-caption"><?php echo $correos->fecha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha" class="<?php echo $correos->fecha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $correos->SortUrl($correos->fecha) ?>',2);"><div id="elh_correos_fecha" class="correos_fecha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $correos->fecha->caption() ?></span><span class="ew-table-header-sort"><?php if ($correos->fecha->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($correos->fecha->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$correos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($correos->ExportAll && $correos->isExport()) {
	$correos_list->StopRec = $correos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($correos_list->TotalRecs > $correos_list->StartRec + $correos_list->DisplayRecs - 1)
		$correos_list->StopRec = $correos_list->StartRec + $correos_list->DisplayRecs - 1;
	else
		$correos_list->StopRec = $correos_list->TotalRecs;
}
$correos_list->RecCnt = $correos_list->StartRec - 1;
if ($correos_list->Recordset && !$correos_list->Recordset->EOF) {
	$correos_list->Recordset->moveFirst();
	$selectLimit = $correos_list->UseSelectLimit;
	if (!$selectLimit && $correos_list->StartRec > 1)
		$correos_list->Recordset->move($correos_list->StartRec - 1);
} elseif (!$correos->AllowAddDeleteRow && $correos_list->StopRec == 0) {
	$correos_list->StopRec = $correos->GridAddRowCount;
}

// Initialize aggregate
$correos->RowType = ROWTYPE_AGGREGATEINIT;
$correos->resetAttributes();
$correos_list->renderRow();
while ($correos_list->RecCnt < $correos_list->StopRec) {
	$correos_list->RecCnt++;
	if ($correos_list->RecCnt >= $correos_list->StartRec) {
		$correos_list->RowCnt++;

		// Set up key count
		$correos_list->KeyCount = $correos_list->RowIndex;

		// Init row class and style
		$correos->resetAttributes();
		$correos->CssClass = "";
		if ($correos->isGridAdd()) {
		} else {
			$correos_list->loadRowValues($correos_list->Recordset); // Load row values
		}
		$correos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$correos->RowAttrs = array_merge($correos->RowAttrs, array('data-rowindex'=>$correos_list->RowCnt, 'id'=>'r' . $correos_list->RowCnt . '_correos', 'data-rowtype'=>$correos->RowType));

		// Render row
		$correos_list->renderRow();

		// Render list options
		$correos_list->renderListOptions();
?>
	<tr<?php echo $correos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$correos_list->ListOptions->render("body", "left", $correos_list->RowCnt);
?>
	<?php if ($correos->nombre->Visible) { // nombre ?>
		<td data-name="nombre"<?php echo $correos->nombre->cellAttributes() ?>>
<span id="el<?php echo $correos_list->RowCnt ?>_correos_nombre" class="correos_nombre">
<span<?php echo $correos->nombre->viewAttributes() ?>>
<?php echo $correos->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($correos->correo->Visible) { // correo ?>
		<td data-name="correo"<?php echo $correos->correo->cellAttributes() ?>>
<span id="el<?php echo $correos_list->RowCnt ?>_correos_correo" class="correos_correo">
<span<?php echo $correos->correo->viewAttributes() ?>>
<?php echo $correos->correo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($correos->hora->Visible) { // hora ?>
		<td data-name="hora"<?php echo $correos->hora->cellAttributes() ?>>
<span id="el<?php echo $correos_list->RowCnt ?>_correos_hora" class="correos_hora">
<span<?php echo $correos->hora->viewAttributes() ?>>
<?php echo $correos->hora->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($correos->fecha->Visible) { // fecha ?>
		<td data-name="fecha"<?php echo $correos->fecha->cellAttributes() ?>>
<span id="el<?php echo $correos_list->RowCnt ?>_correos_fecha" class="correos_fecha">
<span<?php echo $correos->fecha->viewAttributes() ?>>
<?php echo $correos->fecha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$correos_list->ListOptions->render("body", "right", $correos_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$correos->isGridAdd())
		$correos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$correos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($correos_list->Recordset)
	$correos_list->Recordset->Close();
?>
<?php if (!$correos->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$correos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($correos_list->Pager)) $correos_list->Pager = new PrevNextPager($correos_list->StartRec, $correos_list->DisplayRecs, $correos_list->TotalRecs, $correos_list->AutoHidePager) ?>
<?php if ($correos_list->Pager->RecordCount > 0 && $correos_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($correos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($correos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $correos_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($correos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($correos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $correos_list->pageUrl() ?>start=<?php echo $correos_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $correos_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($correos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $correos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $correos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $correos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $correos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($correos_list->TotalRecs == 0 && !$correos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $correos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$correos_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$correos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$correos_list->terminate();
?>