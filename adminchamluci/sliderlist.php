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
$slider_list = new slider_list();

// Run the page
$slider_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slider_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$slider->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fsliderlist = currentForm = new ew.Form("fsliderlist", "list");
fsliderlist.formKeyCountName = '<?php echo $slider_list->FormKeyCountName ?>';

// Form_CustomValidate event
fsliderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsliderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fsliderlistsrch = currentSearchForm = new ew.Form("fsliderlistsrch");

// Filters
fsliderlistsrch.filterList = <?php echo $slider_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$slider->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($slider_list->TotalRecs > 0 && $slider_list->ExportOptions->visible()) { ?>
<?php $slider_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($slider_list->ImportOptions->visible()) { ?>
<?php $slider_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($slider_list->SearchOptions->visible()) { ?>
<?php $slider_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($slider_list->FilterOptions->visible()) { ?>
<?php $slider_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$slider_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$slider->isExport() && !$slider->CurrentAction) { ?>
<form name="fsliderlistsrch" id="fsliderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($slider_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fsliderlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="slider">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($slider_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($slider_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $slider_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($slider_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($slider_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($slider_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($slider_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $slider_list->showPageHeader(); ?>
<?php
$slider_list->showMessage();
?>
<?php if ($slider_list->TotalRecs > 0 || $slider->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($slider_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> slider">
<?php if (!$slider->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$slider->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($slider_list->Pager)) $slider_list->Pager = new PrevNextPager($slider_list->StartRec, $slider_list->DisplayRecs, $slider_list->TotalRecs, $slider_list->AutoHidePager) ?>
<?php if ($slider_list->Pager->RecordCount > 0 && $slider_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($slider_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($slider_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $slider_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($slider_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($slider_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $slider_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($slider_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $slider_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $slider_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $slider_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $slider_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsliderlist" id="fsliderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slider_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slider_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slider">
<div id="gmp_slider" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($slider_list->TotalRecs > 0 || $slider->isGridEdit()) { ?>
<table id="tbl_sliderlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$slider_list->RowType = ROWTYPE_HEADER;

// Render list options
$slider_list->renderListOptions();

// Render list options (header, left)
$slider_list->ListOptions->render("header", "left");
?>
<?php if ($slider->img->Visible) { // img ?>
	<?php if ($slider->sortUrl($slider->img) == "") { ?>
		<th data-name="img" class="<?php echo $slider->img->headerCellClass() ?>"><div id="elh_slider_img" class="slider_img"><div class="ew-table-header-caption"><?php echo $slider->img->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img" class="<?php echo $slider->img->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slider->SortUrl($slider->img) ?>',2);"><div id="elh_slider_img" class="slider_img">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slider->img->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($slider->img->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slider->img->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($slider->t1->Visible) { // t1 ?>
	<?php if ($slider->sortUrl($slider->t1) == "") { ?>
		<th data-name="t1" class="<?php echo $slider->t1->headerCellClass() ?>"><div id="elh_slider_t1" class="slider_t1"><div class="ew-table-header-caption"><?php echo $slider->t1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="t1" class="<?php echo $slider->t1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slider->SortUrl($slider->t1) ?>',2);"><div id="elh_slider_t1" class="slider_t1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slider->t1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($slider->t1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slider->t1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($slider->t2->Visible) { // t2 ?>
	<?php if ($slider->sortUrl($slider->t2) == "") { ?>
		<th data-name="t2" class="<?php echo $slider->t2->headerCellClass() ?>"><div id="elh_slider_t2" class="slider_t2"><div class="ew-table-header-caption"><?php echo $slider->t2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="t2" class="<?php echo $slider->t2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slider->SortUrl($slider->t2) ?>',2);"><div id="elh_slider_t2" class="slider_t2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slider->t2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($slider->t2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slider->t2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$slider_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($slider->ExportAll && $slider->isExport()) {
	$slider_list->StopRec = $slider_list->TotalRecs;
} else {

	// Set the last record to display
	if ($slider_list->TotalRecs > $slider_list->StartRec + $slider_list->DisplayRecs - 1)
		$slider_list->StopRec = $slider_list->StartRec + $slider_list->DisplayRecs - 1;
	else
		$slider_list->StopRec = $slider_list->TotalRecs;
}
$slider_list->RecCnt = $slider_list->StartRec - 1;
if ($slider_list->Recordset && !$slider_list->Recordset->EOF) {
	$slider_list->Recordset->moveFirst();
	$selectLimit = $slider_list->UseSelectLimit;
	if (!$selectLimit && $slider_list->StartRec > 1)
		$slider_list->Recordset->move($slider_list->StartRec - 1);
} elseif (!$slider->AllowAddDeleteRow && $slider_list->StopRec == 0) {
	$slider_list->StopRec = $slider->GridAddRowCount;
}

// Initialize aggregate
$slider->RowType = ROWTYPE_AGGREGATEINIT;
$slider->resetAttributes();
$slider_list->renderRow();
while ($slider_list->RecCnt < $slider_list->StopRec) {
	$slider_list->RecCnt++;
	if ($slider_list->RecCnt >= $slider_list->StartRec) {
		$slider_list->RowCnt++;

		// Set up key count
		$slider_list->KeyCount = $slider_list->RowIndex;

		// Init row class and style
		$slider->resetAttributes();
		$slider->CssClass = "";
		if ($slider->isGridAdd()) {
		} else {
			$slider_list->loadRowValues($slider_list->Recordset); // Load row values
		}
		$slider->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$slider->RowAttrs = array_merge($slider->RowAttrs, array('data-rowindex'=>$slider_list->RowCnt, 'id'=>'r' . $slider_list->RowCnt . '_slider', 'data-rowtype'=>$slider->RowType));

		// Render row
		$slider_list->renderRow();

		// Render list options
		$slider_list->renderListOptions();
?>
	<tr<?php echo $slider->rowAttributes() ?>>
<?php

// Render list options (body, left)
$slider_list->ListOptions->render("body", "left", $slider_list->RowCnt);
?>
	<?php if ($slider->img->Visible) { // img ?>
		<td data-name="img"<?php echo $slider->img->cellAttributes() ?>>
<span id="el<?php echo $slider_list->RowCnt ?>_slider_img" class="slider_img">
<span>
<?php echo GetFileViewTag($slider->img, $slider->img->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($slider->t1->Visible) { // t1 ?>
		<td data-name="t1"<?php echo $slider->t1->cellAttributes() ?>>
<span id="el<?php echo $slider_list->RowCnt ?>_slider_t1" class="slider_t1">
<span<?php echo $slider->t1->viewAttributes() ?>>
<?php echo $slider->t1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($slider->t2->Visible) { // t2 ?>
		<td data-name="t2"<?php echo $slider->t2->cellAttributes() ?>>
<span id="el<?php echo $slider_list->RowCnt ?>_slider_t2" class="slider_t2">
<span<?php echo $slider->t2->viewAttributes() ?>>
<?php echo $slider->t2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$slider_list->ListOptions->render("body", "right", $slider_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$slider->isGridAdd())
		$slider_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$slider->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($slider_list->Recordset)
	$slider_list->Recordset->Close();
?>
<?php if (!$slider->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$slider->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($slider_list->Pager)) $slider_list->Pager = new PrevNextPager($slider_list->StartRec, $slider_list->DisplayRecs, $slider_list->TotalRecs, $slider_list->AutoHidePager) ?>
<?php if ($slider_list->Pager->RecordCount > 0 && $slider_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($slider_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($slider_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $slider_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($slider_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($slider_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $slider_list->pageUrl() ?>start=<?php echo $slider_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $slider_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($slider_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $slider_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $slider_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $slider_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $slider_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($slider_list->TotalRecs == 0 && !$slider->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $slider_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$slider_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$slider->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$slider_list->terminate();
?>