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
$blog_list = new blog_list();

// Run the page
$blog_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$blog_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$blog->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fbloglist = currentForm = new ew.Form("fbloglist", "list");
fbloglist.formKeyCountName = '<?php echo $blog_list->FormKeyCountName ?>';

// Form_CustomValidate event
fbloglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbloglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fbloglistsrch = currentSearchForm = new ew.Form("fbloglistsrch");

// Filters
fbloglistsrch.filterList = <?php echo $blog_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$blog->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($blog_list->TotalRecs > 0 && $blog_list->ExportOptions->visible()) { ?>
<?php $blog_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($blog_list->ImportOptions->visible()) { ?>
<?php $blog_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($blog_list->SearchOptions->visible()) { ?>
<?php $blog_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($blog_list->FilterOptions->visible()) { ?>
<?php $blog_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$blog_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$blog->isExport() && !$blog->CurrentAction) { ?>
<form name="fbloglistsrch" id="fbloglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($blog_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fbloglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="blog">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($blog_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($blog_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $blog_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($blog_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($blog_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($blog_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($blog_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $blog_list->showPageHeader(); ?>
<?php
$blog_list->showMessage();
?>
<?php if ($blog_list->TotalRecs > 0 || $blog->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($blog_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> blog">
<?php if (!$blog->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$blog->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($blog_list->Pager)) $blog_list->Pager = new PrevNextPager($blog_list->StartRec, $blog_list->DisplayRecs, $blog_list->TotalRecs, $blog_list->AutoHidePager) ?>
<?php if ($blog_list->Pager->RecordCount > 0 && $blog_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($blog_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($blog_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $blog_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($blog_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($blog_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $blog_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($blog_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $blog_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $blog_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $blog_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $blog_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbloglist" id="fbloglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($blog_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $blog_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="blog">
<div id="gmp_blog" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($blog_list->TotalRecs > 0 || $blog->isGridEdit()) { ?>
<table id="tbl_bloglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$blog_list->RowType = ROWTYPE_HEADER;

// Render list options
$blog_list->renderListOptions();

// Render list options (header, left)
$blog_list->ListOptions->render("header", "left");
?>
<?php if ($blog->img->Visible) { // img ?>
	<?php if ($blog->sortUrl($blog->img) == "") { ?>
		<th data-name="img" class="<?php echo $blog->img->headerCellClass() ?>"><div id="elh_blog_img" class="blog_img"><div class="ew-table-header-caption"><?php echo $blog->img->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img" class="<?php echo $blog->img->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $blog->SortUrl($blog->img) ?>',2);"><div id="elh_blog_img" class="blog_img">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $blog->img->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($blog->img->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($blog->img->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($blog->titulo->Visible) { // titulo ?>
	<?php if ($blog->sortUrl($blog->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $blog->titulo->headerCellClass() ?>"><div id="elh_blog_titulo" class="blog_titulo"><div class="ew-table-header-caption"><?php echo $blog->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $blog->titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $blog->SortUrl($blog->titulo) ?>',2);"><div id="elh_blog_titulo" class="blog_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $blog->titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($blog->titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($blog->titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$blog_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($blog->ExportAll && $blog->isExport()) {
	$blog_list->StopRec = $blog_list->TotalRecs;
} else {

	// Set the last record to display
	if ($blog_list->TotalRecs > $blog_list->StartRec + $blog_list->DisplayRecs - 1)
		$blog_list->StopRec = $blog_list->StartRec + $blog_list->DisplayRecs - 1;
	else
		$blog_list->StopRec = $blog_list->TotalRecs;
}
$blog_list->RecCnt = $blog_list->StartRec - 1;
if ($blog_list->Recordset && !$blog_list->Recordset->EOF) {
	$blog_list->Recordset->moveFirst();
	$selectLimit = $blog_list->UseSelectLimit;
	if (!$selectLimit && $blog_list->StartRec > 1)
		$blog_list->Recordset->move($blog_list->StartRec - 1);
} elseif (!$blog->AllowAddDeleteRow && $blog_list->StopRec == 0) {
	$blog_list->StopRec = $blog->GridAddRowCount;
}

// Initialize aggregate
$blog->RowType = ROWTYPE_AGGREGATEINIT;
$blog->resetAttributes();
$blog_list->renderRow();
while ($blog_list->RecCnt < $blog_list->StopRec) {
	$blog_list->RecCnt++;
	if ($blog_list->RecCnt >= $blog_list->StartRec) {
		$blog_list->RowCnt++;

		// Set up key count
		$blog_list->KeyCount = $blog_list->RowIndex;

		// Init row class and style
		$blog->resetAttributes();
		$blog->CssClass = "";
		if ($blog->isGridAdd()) {
		} else {
			$blog_list->loadRowValues($blog_list->Recordset); // Load row values
		}
		$blog->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$blog->RowAttrs = array_merge($blog->RowAttrs, array('data-rowindex'=>$blog_list->RowCnt, 'id'=>'r' . $blog_list->RowCnt . '_blog', 'data-rowtype'=>$blog->RowType));

		// Render row
		$blog_list->renderRow();

		// Render list options
		$blog_list->renderListOptions();
?>
	<tr<?php echo $blog->rowAttributes() ?>>
<?php

// Render list options (body, left)
$blog_list->ListOptions->render("body", "left", $blog_list->RowCnt);
?>
	<?php if ($blog->img->Visible) { // img ?>
		<td data-name="img"<?php echo $blog->img->cellAttributes() ?>>
<span id="el<?php echo $blog_list->RowCnt ?>_blog_img" class="blog_img">
<span>
<?php echo GetFileViewTag($blog->img, $blog->img->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($blog->titulo->Visible) { // titulo ?>
		<td data-name="titulo"<?php echo $blog->titulo->cellAttributes() ?>>
<span id="el<?php echo $blog_list->RowCnt ?>_blog_titulo" class="blog_titulo">
<span<?php echo $blog->titulo->viewAttributes() ?>>
<?php echo $blog->titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$blog_list->ListOptions->render("body", "right", $blog_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$blog->isGridAdd())
		$blog_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$blog->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($blog_list->Recordset)
	$blog_list->Recordset->Close();
?>
<?php if (!$blog->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$blog->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($blog_list->Pager)) $blog_list->Pager = new PrevNextPager($blog_list->StartRec, $blog_list->DisplayRecs, $blog_list->TotalRecs, $blog_list->AutoHidePager) ?>
<?php if ($blog_list->Pager->RecordCount > 0 && $blog_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($blog_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($blog_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $blog_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($blog_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($blog_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $blog_list->pageUrl() ?>start=<?php echo $blog_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $blog_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($blog_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $blog_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $blog_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $blog_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $blog_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($blog_list->TotalRecs == 0 && !$blog->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $blog_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$blog_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$blog->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$blog_list->terminate();
?>