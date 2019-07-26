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
$laempresa_list = new laempresa_list();

// Run the page
$laempresa_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laempresa_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$laempresa->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var flaempresalist = currentForm = new ew.Form("flaempresalist", "list");
flaempresalist.formKeyCountName = '<?php echo $laempresa_list->FormKeyCountName ?>';

// Form_CustomValidate event
flaempresalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flaempresalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var flaempresalistsrch = currentSearchForm = new ew.Form("flaempresalistsrch");

// Filters
flaempresalistsrch.filterList = <?php echo $laempresa_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$laempresa->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($laempresa_list->TotalRecs > 0 && $laempresa_list->ExportOptions->visible()) { ?>
<?php $laempresa_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($laempresa_list->ImportOptions->visible()) { ?>
<?php $laempresa_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($laempresa_list->SearchOptions->visible()) { ?>
<?php $laempresa_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($laempresa_list->FilterOptions->visible()) { ?>
<?php $laempresa_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$laempresa_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$laempresa->isExport() && !$laempresa->CurrentAction) { ?>
<form name="flaempresalistsrch" id="flaempresalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($laempresa_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="flaempresalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="laempresa">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($laempresa_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($laempresa_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $laempresa_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($laempresa_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($laempresa_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($laempresa_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($laempresa_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $laempresa_list->showPageHeader(); ?>
<?php
$laempresa_list->showMessage();
?>
<?php if ($laempresa_list->TotalRecs > 0 || $laempresa->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($laempresa_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> laempresa">
<?php if (!$laempresa->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$laempresa->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($laempresa_list->Pager)) $laempresa_list->Pager = new PrevNextPager($laempresa_list->StartRec, $laempresa_list->DisplayRecs, $laempresa_list->TotalRecs, $laempresa_list->AutoHidePager) ?>
<?php if ($laempresa_list->Pager->RecordCount > 0 && $laempresa_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($laempresa_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($laempresa_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $laempresa_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($laempresa_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($laempresa_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $laempresa_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($laempresa_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $laempresa_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $laempresa_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $laempresa_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $laempresa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flaempresalist" id="flaempresalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($laempresa_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $laempresa_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laempresa">
<div id="gmp_laempresa" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($laempresa_list->TotalRecs > 0 || $laempresa->isGridEdit()) { ?>
<table id="tbl_laempresalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$laempresa_list->RowType = ROWTYPE_HEADER;

// Render list options
$laempresa_list->renderListOptions();

// Render list options (header, left)
$laempresa_list->ListOptions->render("header", "left");
?>
<?php if ($laempresa->img->Visible) { // img ?>
	<?php if ($laempresa->sortUrl($laempresa->img) == "") { ?>
		<th data-name="img" class="<?php echo $laempresa->img->headerCellClass() ?>"><div id="elh_laempresa_img" class="laempresa_img"><div class="ew-table-header-caption"><?php echo $laempresa->img->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img" class="<?php echo $laempresa->img->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $laempresa->SortUrl($laempresa->img) ?>',2);"><div id="elh_laempresa_img" class="laempresa_img">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laempresa->img->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($laempresa->img->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($laempresa->img->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laempresa->titulo->Visible) { // titulo ?>
	<?php if ($laempresa->sortUrl($laempresa->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $laempresa->titulo->headerCellClass() ?>"><div id="elh_laempresa_titulo" class="laempresa_titulo"><div class="ew-table-header-caption"><?php echo $laempresa->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $laempresa->titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $laempresa->SortUrl($laempresa->titulo) ?>',2);"><div id="elh_laempresa_titulo" class="laempresa_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laempresa->titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($laempresa->titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($laempresa->titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$laempresa_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($laempresa->ExportAll && $laempresa->isExport()) {
	$laempresa_list->StopRec = $laempresa_list->TotalRecs;
} else {

	// Set the last record to display
	if ($laempresa_list->TotalRecs > $laempresa_list->StartRec + $laempresa_list->DisplayRecs - 1)
		$laempresa_list->StopRec = $laempresa_list->StartRec + $laempresa_list->DisplayRecs - 1;
	else
		$laempresa_list->StopRec = $laempresa_list->TotalRecs;
}
$laempresa_list->RecCnt = $laempresa_list->StartRec - 1;
if ($laempresa_list->Recordset && !$laempresa_list->Recordset->EOF) {
	$laempresa_list->Recordset->moveFirst();
	$selectLimit = $laempresa_list->UseSelectLimit;
	if (!$selectLimit && $laempresa_list->StartRec > 1)
		$laempresa_list->Recordset->move($laempresa_list->StartRec - 1);
} elseif (!$laempresa->AllowAddDeleteRow && $laempresa_list->StopRec == 0) {
	$laempresa_list->StopRec = $laempresa->GridAddRowCount;
}

// Initialize aggregate
$laempresa->RowType = ROWTYPE_AGGREGATEINIT;
$laempresa->resetAttributes();
$laempresa_list->renderRow();
while ($laempresa_list->RecCnt < $laempresa_list->StopRec) {
	$laempresa_list->RecCnt++;
	if ($laempresa_list->RecCnt >= $laempresa_list->StartRec) {
		$laempresa_list->RowCnt++;

		// Set up key count
		$laempresa_list->KeyCount = $laempresa_list->RowIndex;

		// Init row class and style
		$laempresa->resetAttributes();
		$laempresa->CssClass = "";
		if ($laempresa->isGridAdd()) {
		} else {
			$laempresa_list->loadRowValues($laempresa_list->Recordset); // Load row values
		}
		$laempresa->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$laempresa->RowAttrs = array_merge($laempresa->RowAttrs, array('data-rowindex'=>$laempresa_list->RowCnt, 'id'=>'r' . $laempresa_list->RowCnt . '_laempresa', 'data-rowtype'=>$laempresa->RowType));

		// Render row
		$laempresa_list->renderRow();

		// Render list options
		$laempresa_list->renderListOptions();
?>
	<tr<?php echo $laempresa->rowAttributes() ?>>
<?php

// Render list options (body, left)
$laempresa_list->ListOptions->render("body", "left", $laempresa_list->RowCnt);
?>
	<?php if ($laempresa->img->Visible) { // img ?>
		<td data-name="img"<?php echo $laempresa->img->cellAttributes() ?>>
<span id="el<?php echo $laempresa_list->RowCnt ?>_laempresa_img" class="laempresa_img">
<span>
<?php echo GetFileViewTag($laempresa->img, $laempresa->img->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($laempresa->titulo->Visible) { // titulo ?>
		<td data-name="titulo"<?php echo $laempresa->titulo->cellAttributes() ?>>
<span id="el<?php echo $laempresa_list->RowCnt ?>_laempresa_titulo" class="laempresa_titulo">
<span<?php echo $laempresa->titulo->viewAttributes() ?>>
<?php echo $laempresa->titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$laempresa_list->ListOptions->render("body", "right", $laempresa_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$laempresa->isGridAdd())
		$laempresa_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$laempresa->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($laempresa_list->Recordset)
	$laempresa_list->Recordset->Close();
?>
<?php if (!$laempresa->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$laempresa->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($laempresa_list->Pager)) $laempresa_list->Pager = new PrevNextPager($laempresa_list->StartRec, $laempresa_list->DisplayRecs, $laempresa_list->TotalRecs, $laempresa_list->AutoHidePager) ?>
<?php if ($laempresa_list->Pager->RecordCount > 0 && $laempresa_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($laempresa_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($laempresa_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $laempresa_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($laempresa_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($laempresa_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $laempresa_list->pageUrl() ?>start=<?php echo $laempresa_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $laempresa_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($laempresa_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $laempresa_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $laempresa_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $laempresa_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $laempresa_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($laempresa_list->TotalRecs == 0 && !$laempresa->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $laempresa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$laempresa_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$laempresa->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$laempresa_list->terminate();
?>