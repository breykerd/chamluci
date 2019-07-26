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
$header_list = new header_list();

// Run the page
$header_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$header_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$header->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fheaderlist = currentForm = new ew.Form("fheaderlist", "list");
fheaderlist.formKeyCountName = '<?php echo $header_list->FormKeyCountName ?>';

// Form_CustomValidate event
fheaderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fheaderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fheaderlistsrch = currentSearchForm = new ew.Form("fheaderlistsrch");

// Filters
fheaderlistsrch.filterList = <?php echo $header_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$header->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($header_list->TotalRecs > 0 && $header_list->ExportOptions->visible()) { ?>
<?php $header_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($header_list->ImportOptions->visible()) { ?>
<?php $header_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($header_list->SearchOptions->visible()) { ?>
<?php $header_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($header_list->FilterOptions->visible()) { ?>
<?php $header_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$header_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$header->isExport() && !$header->CurrentAction) { ?>
<form name="fheaderlistsrch" id="fheaderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($header_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fheaderlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="header">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($header_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($header_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $header_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($header_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($header_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($header_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($header_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $header_list->showPageHeader(); ?>
<?php
$header_list->showMessage();
?>
<?php if ($header_list->TotalRecs > 0 || $header->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($header_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> header">
<?php if (!$header->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$header->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($header_list->Pager)) $header_list->Pager = new PrevNextPager($header_list->StartRec, $header_list->DisplayRecs, $header_list->TotalRecs, $header_list->AutoHidePager) ?>
<?php if ($header_list->Pager->RecordCount > 0 && $header_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($header_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($header_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $header_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($header_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($header_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $header_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($header_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $header_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $header_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $header_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $header_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fheaderlist" id="fheaderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($header_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $header_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="header">
<div id="gmp_header" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($header_list->TotalRecs > 0 || $header->isGridEdit()) { ?>
<table id="tbl_headerlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$header_list->RowType = ROWTYPE_HEADER;

// Render list options
$header_list->renderListOptions();

// Render list options (header, left)
$header_list->ListOptions->render("header", "left");
?>
<?php if ($header->img_empresa->Visible) { // img_empresa ?>
	<?php if ($header->sortUrl($header->img_empresa) == "") { ?>
		<th data-name="img_empresa" class="<?php echo $header->img_empresa->headerCellClass() ?>"><div id="elh_header_img_empresa" class="header_img_empresa"><div class="ew-table-header-caption"><?php echo $header->img_empresa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img_empresa" class="<?php echo $header->img_empresa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $header->SortUrl($header->img_empresa) ?>',2);"><div id="elh_header_img_empresa" class="header_img_empresa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $header->img_empresa->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($header->img_empresa->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($header->img_empresa->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($header->img_blog->Visible) { // img_blog ?>
	<?php if ($header->sortUrl($header->img_blog) == "") { ?>
		<th data-name="img_blog" class="<?php echo $header->img_blog->headerCellClass() ?>"><div id="elh_header_img_blog" class="header_img_blog"><div class="ew-table-header-caption"><?php echo $header->img_blog->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img_blog" class="<?php echo $header->img_blog->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $header->SortUrl($header->img_blog) ?>',2);"><div id="elh_header_img_blog" class="header_img_blog">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $header->img_blog->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($header->img_blog->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($header->img_blog->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($header->img_contacto->Visible) { // img_contacto ?>
	<?php if ($header->sortUrl($header->img_contacto) == "") { ?>
		<th data-name="img_contacto" class="<?php echo $header->img_contacto->headerCellClass() ?>"><div id="elh_header_img_contacto" class="header_img_contacto"><div class="ew-table-header-caption"><?php echo $header->img_contacto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img_contacto" class="<?php echo $header->img_contacto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $header->SortUrl($header->img_contacto) ?>',2);"><div id="elh_header_img_contacto" class="header_img_contacto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $header->img_contacto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($header->img_contacto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($header->img_contacto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($header->img_pasarela->Visible) { // img_pasarela ?>
	<?php if ($header->sortUrl($header->img_pasarela) == "") { ?>
		<th data-name="img_pasarela" class="<?php echo $header->img_pasarela->headerCellClass() ?>"><div id="elh_header_img_pasarela" class="header_img_pasarela"><div class="ew-table-header-caption"><?php echo $header->img_pasarela->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img_pasarela" class="<?php echo $header->img_pasarela->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $header->SortUrl($header->img_pasarela) ?>',2);"><div id="elh_header_img_pasarela" class="header_img_pasarela">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $header->img_pasarela->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($header->img_pasarela->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($header->img_pasarela->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$header_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($header->ExportAll && $header->isExport()) {
	$header_list->StopRec = $header_list->TotalRecs;
} else {

	// Set the last record to display
	if ($header_list->TotalRecs > $header_list->StartRec + $header_list->DisplayRecs - 1)
		$header_list->StopRec = $header_list->StartRec + $header_list->DisplayRecs - 1;
	else
		$header_list->StopRec = $header_list->TotalRecs;
}
$header_list->RecCnt = $header_list->StartRec - 1;
if ($header_list->Recordset && !$header_list->Recordset->EOF) {
	$header_list->Recordset->moveFirst();
	$selectLimit = $header_list->UseSelectLimit;
	if (!$selectLimit && $header_list->StartRec > 1)
		$header_list->Recordset->move($header_list->StartRec - 1);
} elseif (!$header->AllowAddDeleteRow && $header_list->StopRec == 0) {
	$header_list->StopRec = $header->GridAddRowCount;
}

// Initialize aggregate
$header->RowType = ROWTYPE_AGGREGATEINIT;
$header->resetAttributes();
$header_list->renderRow();
while ($header_list->RecCnt < $header_list->StopRec) {
	$header_list->RecCnt++;
	if ($header_list->RecCnt >= $header_list->StartRec) {
		$header_list->RowCnt++;

		// Set up key count
		$header_list->KeyCount = $header_list->RowIndex;

		// Init row class and style
		$header->resetAttributes();
		$header->CssClass = "";
		if ($header->isGridAdd()) {
		} else {
			$header_list->loadRowValues($header_list->Recordset); // Load row values
		}
		$header->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$header->RowAttrs = array_merge($header->RowAttrs, array('data-rowindex'=>$header_list->RowCnt, 'id'=>'r' . $header_list->RowCnt . '_header', 'data-rowtype'=>$header->RowType));

		// Render row
		$header_list->renderRow();

		// Render list options
		$header_list->renderListOptions();
?>
	<tr<?php echo $header->rowAttributes() ?>>
<?php

// Render list options (body, left)
$header_list->ListOptions->render("body", "left", $header_list->RowCnt);
?>
	<?php if ($header->img_empresa->Visible) { // img_empresa ?>
		<td data-name="img_empresa"<?php echo $header->img_empresa->cellAttributes() ?>>
<span id="el<?php echo $header_list->RowCnt ?>_header_img_empresa" class="header_img_empresa">
<span>
<?php echo GetFileViewTag($header->img_empresa, $header->img_empresa->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($header->img_blog->Visible) { // img_blog ?>
		<td data-name="img_blog"<?php echo $header->img_blog->cellAttributes() ?>>
<span id="el<?php echo $header_list->RowCnt ?>_header_img_blog" class="header_img_blog">
<span>
<?php echo GetFileViewTag($header->img_blog, $header->img_blog->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($header->img_contacto->Visible) { // img_contacto ?>
		<td data-name="img_contacto"<?php echo $header->img_contacto->cellAttributes() ?>>
<span id="el<?php echo $header_list->RowCnt ?>_header_img_contacto" class="header_img_contacto">
<span>
<?php echo GetFileViewTag($header->img_contacto, $header->img_contacto->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($header->img_pasarela->Visible) { // img_pasarela ?>
		<td data-name="img_pasarela"<?php echo $header->img_pasarela->cellAttributes() ?>>
<span id="el<?php echo $header_list->RowCnt ?>_header_img_pasarela" class="header_img_pasarela">
<span>
<?php echo GetFileViewTag($header->img_pasarela, $header->img_pasarela->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$header_list->ListOptions->render("body", "right", $header_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$header->isGridAdd())
		$header_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$header->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($header_list->Recordset)
	$header_list->Recordset->Close();
?>
<?php if (!$header->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$header->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($header_list->Pager)) $header_list->Pager = new PrevNextPager($header_list->StartRec, $header_list->DisplayRecs, $header_list->TotalRecs, $header_list->AutoHidePager) ?>
<?php if ($header_list->Pager->RecordCount > 0 && $header_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($header_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($header_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $header_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($header_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($header_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $header_list->pageUrl() ?>start=<?php echo $header_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $header_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($header_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $header_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $header_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $header_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $header_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($header_list->TotalRecs == 0 && !$header->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $header_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$header_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$header->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$header_list->terminate();
?>