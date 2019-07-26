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
$categorias_list = new categorias_list();

// Run the page
$categorias_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorias_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$categorias->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcategoriaslist = currentForm = new ew.Form("fcategoriaslist", "list");
fcategoriaslist.formKeyCountName = '<?php echo $categorias_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcategoriaslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriaslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcategoriaslistsrch = currentSearchForm = new ew.Form("fcategoriaslistsrch");

// Filters
fcategoriaslistsrch.filterList = <?php echo $categorias_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$categorias->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($categorias_list->TotalRecs > 0 && $categorias_list->ExportOptions->visible()) { ?>
<?php $categorias_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($categorias_list->ImportOptions->visible()) { ?>
<?php $categorias_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($categorias_list->SearchOptions->visible()) { ?>
<?php $categorias_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($categorias_list->FilterOptions->visible()) { ?>
<?php $categorias_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$categorias_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$categorias->isExport() && !$categorias->CurrentAction) { ?>
<form name="fcategoriaslistsrch" id="fcategoriaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($categorias_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcategoriaslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="categorias">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($categorias_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($categorias_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $categorias_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($categorias_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($categorias_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($categorias_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($categorias_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $categorias_list->showPageHeader(); ?>
<?php
$categorias_list->showMessage();
?>
<?php if ($categorias_list->TotalRecs > 0 || $categorias->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($categorias_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> categorias">
<?php if (!$categorias->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$categorias->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categorias_list->Pager)) $categorias_list->Pager = new PrevNextPager($categorias_list->StartRec, $categorias_list->DisplayRecs, $categorias_list->TotalRecs, $categorias_list->AutoHidePager) ?>
<?php if ($categorias_list->Pager->RecordCount > 0 && $categorias_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categorias_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categorias_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categorias_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categorias_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categorias_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categorias_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($categorias_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $categorias_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $categorias_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $categorias_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $categorias_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcategoriaslist" id="fcategoriaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorias_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorias_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorias">
<div id="gmp_categorias" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($categorias_list->TotalRecs > 0 || $categorias->isGridEdit()) { ?>
<table id="tbl_categoriaslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$categorias_list->RowType = ROWTYPE_HEADER;

// Render list options
$categorias_list->renderListOptions();

// Render list options (header, left)
$categorias_list->ListOptions->render("header", "left");
?>
<?php if ($categorias->img_header->Visible) { // img_header ?>
	<?php if ($categorias->sortUrl($categorias->img_header) == "") { ?>
		<th data-name="img_header" class="<?php echo $categorias->img_header->headerCellClass() ?>"><div id="elh_categorias_img_header" class="categorias_img_header"><div class="ew-table-header-caption"><?php echo $categorias->img_header->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img_header" class="<?php echo $categorias->img_header->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $categorias->SortUrl($categorias->img_header) ?>',2);"><div id="elh_categorias_img_header" class="categorias_img_header">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categorias->img_header->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($categorias->img_header->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($categorias->img_header->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categorias->titulo->Visible) { // titulo ?>
	<?php if ($categorias->sortUrl($categorias->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $categorias->titulo->headerCellClass() ?>"><div id="elh_categorias_titulo" class="categorias_titulo"><div class="ew-table-header-caption"><?php echo $categorias->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $categorias->titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $categorias->SortUrl($categorias->titulo) ?>',2);"><div id="elh_categorias_titulo" class="categorias_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categorias->titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($categorias->titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($categorias->titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$categorias_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($categorias->ExportAll && $categorias->isExport()) {
	$categorias_list->StopRec = $categorias_list->TotalRecs;
} else {

	// Set the last record to display
	if ($categorias_list->TotalRecs > $categorias_list->StartRec + $categorias_list->DisplayRecs - 1)
		$categorias_list->StopRec = $categorias_list->StartRec + $categorias_list->DisplayRecs - 1;
	else
		$categorias_list->StopRec = $categorias_list->TotalRecs;
}
$categorias_list->RecCnt = $categorias_list->StartRec - 1;
if ($categorias_list->Recordset && !$categorias_list->Recordset->EOF) {
	$categorias_list->Recordset->moveFirst();
	$selectLimit = $categorias_list->UseSelectLimit;
	if (!$selectLimit && $categorias_list->StartRec > 1)
		$categorias_list->Recordset->move($categorias_list->StartRec - 1);
} elseif (!$categorias->AllowAddDeleteRow && $categorias_list->StopRec == 0) {
	$categorias_list->StopRec = $categorias->GridAddRowCount;
}

// Initialize aggregate
$categorias->RowType = ROWTYPE_AGGREGATEINIT;
$categorias->resetAttributes();
$categorias_list->renderRow();
while ($categorias_list->RecCnt < $categorias_list->StopRec) {
	$categorias_list->RecCnt++;
	if ($categorias_list->RecCnt >= $categorias_list->StartRec) {
		$categorias_list->RowCnt++;

		// Set up key count
		$categorias_list->KeyCount = $categorias_list->RowIndex;

		// Init row class and style
		$categorias->resetAttributes();
		$categorias->CssClass = "";
		if ($categorias->isGridAdd()) {
		} else {
			$categorias_list->loadRowValues($categorias_list->Recordset); // Load row values
		}
		$categorias->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$categorias->RowAttrs = array_merge($categorias->RowAttrs, array('data-rowindex'=>$categorias_list->RowCnt, 'id'=>'r' . $categorias_list->RowCnt . '_categorias', 'data-rowtype'=>$categorias->RowType));

		// Render row
		$categorias_list->renderRow();

		// Render list options
		$categorias_list->renderListOptions();
?>
	<tr<?php echo $categorias->rowAttributes() ?>>
<?php

// Render list options (body, left)
$categorias_list->ListOptions->render("body", "left", $categorias_list->RowCnt);
?>
	<?php if ($categorias->img_header->Visible) { // img_header ?>
		<td data-name="img_header"<?php echo $categorias->img_header->cellAttributes() ?>>
<span id="el<?php echo $categorias_list->RowCnt ?>_categorias_img_header" class="categorias_img_header">
<span>
<?php echo GetFileViewTag($categorias->img_header, $categorias->img_header->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($categorias->titulo->Visible) { // titulo ?>
		<td data-name="titulo"<?php echo $categorias->titulo->cellAttributes() ?>>
<span id="el<?php echo $categorias_list->RowCnt ?>_categorias_titulo" class="categorias_titulo">
<span<?php echo $categorias->titulo->viewAttributes() ?>>
<?php echo $categorias->titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$categorias_list->ListOptions->render("body", "right", $categorias_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$categorias->isGridAdd())
		$categorias_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$categorias->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($categorias_list->Recordset)
	$categorias_list->Recordset->Close();
?>
<?php if (!$categorias->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$categorias->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categorias_list->Pager)) $categorias_list->Pager = new PrevNextPager($categorias_list->StartRec, $categorias_list->DisplayRecs, $categorias_list->TotalRecs, $categorias_list->AutoHidePager) ?>
<?php if ($categorias_list->Pager->RecordCount > 0 && $categorias_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categorias_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categorias_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categorias_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categorias_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categorias_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categorias_list->pageUrl() ?>start=<?php echo $categorias_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categorias_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($categorias_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $categorias_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $categorias_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $categorias_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $categorias_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($categorias_list->TotalRecs == 0 && !$categorias->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $categorias_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$categorias_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$categorias->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$categorias_list->terminate();
?>