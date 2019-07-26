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
$productos_list = new productos_list();

// Run the page
$productos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$productos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$productos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproductoslist = currentForm = new ew.Form("fproductoslist", "list");
fproductoslist.formKeyCountName = '<?php echo $productos_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproductoslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductoslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fproductoslist.lists["x_destacado_inicio"] = <?php echo $productos_list->destacado_inicio->Lookup->toClientList() ?>;
fproductoslist.lists["x_destacado_inicio"].options = <?php echo JsonEncode($productos_list->destacado_inicio->options(FALSE, TRUE)) ?>;
fproductoslist.lists["x_destacado_footer"] = <?php echo $productos_list->destacado_footer->Lookup->toClientList() ?>;
fproductoslist.lists["x_destacado_footer"].options = <?php echo JsonEncode($productos_list->destacado_footer->options(FALSE, TRUE)) ?>;
fproductoslist.lists["x_destacado_productos"] = <?php echo $productos_list->destacado_productos->Lookup->toClientList() ?>;
fproductoslist.lists["x_destacado_productos"].options = <?php echo JsonEncode($productos_list->destacado_productos->options(FALSE, TRUE)) ?>;
fproductoslist.lists["x_id_cate"] = <?php echo $productos_list->id_cate->Lookup->toClientList() ?>;
fproductoslist.lists["x_id_cate"].options = <?php echo JsonEncode($productos_list->id_cate->lookupOptions()) ?>;

// Form object for search
var fproductoslistsrch = currentSearchForm = new ew.Form("fproductoslistsrch");

// Filters
fproductoslistsrch.filterList = <?php echo $productos_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$productos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($productos_list->TotalRecs > 0 && $productos_list->ExportOptions->visible()) { ?>
<?php $productos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($productos_list->ImportOptions->visible()) { ?>
<?php $productos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($productos_list->SearchOptions->visible()) { ?>
<?php $productos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($productos_list->FilterOptions->visible()) { ?>
<?php $productos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$productos->isExport() || EXPORT_MASTER_RECORD && $productos->isExport("print")) { ?>
<?php
if ($productos_list->DbMasterFilter <> "" && $productos->getCurrentMasterTable() == "categorias") {
	if ($productos_list->MasterRecordExists) {
		include_once "categoriasmaster.php";
	}
}
?>
<?php } ?>
<?php
$productos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$productos->isExport() && !$productos->CurrentAction) { ?>
<form name="fproductoslistsrch" id="fproductoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($productos_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproductoslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="productos">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($productos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($productos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $productos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($productos_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($productos_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($productos_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($productos_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $productos_list->showPageHeader(); ?>
<?php
$productos_list->showMessage();
?>
<?php if ($productos_list->TotalRecs > 0 || $productos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($productos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> productos">
<?php if (!$productos->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$productos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($productos_list->Pager)) $productos_list->Pager = new PrevNextPager($productos_list->StartRec, $productos_list->DisplayRecs, $productos_list->TotalRecs, $productos_list->AutoHidePager) ?>
<?php if ($productos_list->Pager->RecordCount > 0 && $productos_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($productos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($productos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $productos_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($productos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($productos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $productos_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($productos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $productos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $productos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $productos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $productos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproductoslist" id="fproductoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($productos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $productos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="productos">
<?php if ($productos->getCurrentMasterTable() == "categorias" && $productos->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="categorias">
<input type="hidden" name="fk_id" value="<?php echo $productos->id_cate->getSessionValue() ?>">
<?php } ?>
<div id="gmp_productos" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($productos_list->TotalRecs > 0 || $productos->isGridEdit()) { ?>
<table id="tbl_productoslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$productos_list->RowType = ROWTYPE_HEADER;

// Render list options
$productos_list->renderListOptions();

// Render list options (header, left)
$productos_list->ListOptions->render("header", "left");
?>
<?php if ($productos->titulo->Visible) { // titulo ?>
	<?php if ($productos->sortUrl($productos->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $productos->titulo->headerCellClass() ?>"><div id="elh_productos_titulo" class="productos_titulo"><div class="ew-table-header-caption"><?php echo $productos->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $productos->titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $productos->SortUrl($productos->titulo) ?>',2);"><div id="elh_productos_titulo" class="productos_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($productos->titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->img1->Visible) { // img1 ?>
	<?php if ($productos->sortUrl($productos->img1) == "") { ?>
		<th data-name="img1" class="<?php echo $productos->img1->headerCellClass() ?>"><div id="elh_productos_img1" class="productos_img1"><div class="ew-table-header-caption"><?php echo $productos->img1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="img1" class="<?php echo $productos->img1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $productos->SortUrl($productos->img1) ?>',2);"><div id="elh_productos_img1" class="productos_img1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->img1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($productos->img1->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->img1->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
	<?php if ($productos->sortUrl($productos->destacado_inicio) == "") { ?>
		<th data-name="destacado_inicio" class="<?php echo $productos->destacado_inicio->headerCellClass() ?>"><div id="elh_productos_destacado_inicio" class="productos_destacado_inicio"><div class="ew-table-header-caption"><?php echo $productos->destacado_inicio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destacado_inicio" class="<?php echo $productos->destacado_inicio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $productos->SortUrl($productos->destacado_inicio) ?>',2);"><div id="elh_productos_destacado_inicio" class="productos_destacado_inicio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->destacado_inicio->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->destacado_inicio->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->destacado_inicio->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
	<?php if ($productos->sortUrl($productos->destacado_footer) == "") { ?>
		<th data-name="destacado_footer" class="<?php echo $productos->destacado_footer->headerCellClass() ?>"><div id="elh_productos_destacado_footer" class="productos_destacado_footer"><div class="ew-table-header-caption"><?php echo $productos->destacado_footer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destacado_footer" class="<?php echo $productos->destacado_footer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $productos->SortUrl($productos->destacado_footer) ?>',2);"><div id="elh_productos_destacado_footer" class="productos_destacado_footer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->destacado_footer->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->destacado_footer->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->destacado_footer->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
	<?php if ($productos->sortUrl($productos->destacado_productos) == "") { ?>
		<th data-name="destacado_productos" class="<?php echo $productos->destacado_productos->headerCellClass() ?>"><div id="elh_productos_destacado_productos" class="productos_destacado_productos"><div class="ew-table-header-caption"><?php echo $productos->destacado_productos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destacado_productos" class="<?php echo $productos->destacado_productos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $productos->SortUrl($productos->destacado_productos) ?>',2);"><div id="elh_productos_destacado_productos" class="productos_destacado_productos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->destacado_productos->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->destacado_productos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->destacado_productos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($productos->id_cate->Visible) { // id_cate ?>
	<?php if ($productos->sortUrl($productos->id_cate) == "") { ?>
		<th data-name="id_cate" class="<?php echo $productos->id_cate->headerCellClass() ?>"><div id="elh_productos_id_cate" class="productos_id_cate"><div class="ew-table-header-caption"><?php echo $productos->id_cate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cate" class="<?php echo $productos->id_cate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $productos->SortUrl($productos->id_cate) ?>',2);"><div id="elh_productos_id_cate" class="productos_id_cate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $productos->id_cate->caption() ?></span><span class="ew-table-header-sort"><?php if ($productos->id_cate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($productos->id_cate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$productos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($productos->ExportAll && $productos->isExport()) {
	$productos_list->StopRec = $productos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($productos_list->TotalRecs > $productos_list->StartRec + $productos_list->DisplayRecs - 1)
		$productos_list->StopRec = $productos_list->StartRec + $productos_list->DisplayRecs - 1;
	else
		$productos_list->StopRec = $productos_list->TotalRecs;
}
$productos_list->RecCnt = $productos_list->StartRec - 1;
if ($productos_list->Recordset && !$productos_list->Recordset->EOF) {
	$productos_list->Recordset->moveFirst();
	$selectLimit = $productos_list->UseSelectLimit;
	if (!$selectLimit && $productos_list->StartRec > 1)
		$productos_list->Recordset->move($productos_list->StartRec - 1);
} elseif (!$productos->AllowAddDeleteRow && $productos_list->StopRec == 0) {
	$productos_list->StopRec = $productos->GridAddRowCount;
}

// Initialize aggregate
$productos->RowType = ROWTYPE_AGGREGATEINIT;
$productos->resetAttributes();
$productos_list->renderRow();
while ($productos_list->RecCnt < $productos_list->StopRec) {
	$productos_list->RecCnt++;
	if ($productos_list->RecCnt >= $productos_list->StartRec) {
		$productos_list->RowCnt++;

		// Set up key count
		$productos_list->KeyCount = $productos_list->RowIndex;

		// Init row class and style
		$productos->resetAttributes();
		$productos->CssClass = "";
		if ($productos->isGridAdd()) {
		} else {
			$productos_list->loadRowValues($productos_list->Recordset); // Load row values
		}
		$productos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$productos->RowAttrs = array_merge($productos->RowAttrs, array('data-rowindex'=>$productos_list->RowCnt, 'id'=>'r' . $productos_list->RowCnt . '_productos', 'data-rowtype'=>$productos->RowType));

		// Render row
		$productos_list->renderRow();

		// Render list options
		$productos_list->renderListOptions();
?>
	<tr<?php echo $productos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$productos_list->ListOptions->render("body", "left", $productos_list->RowCnt);
?>
	<?php if ($productos->titulo->Visible) { // titulo ?>
		<td data-name="titulo"<?php echo $productos->titulo->cellAttributes() ?>>
<span id="el<?php echo $productos_list->RowCnt ?>_productos_titulo" class="productos_titulo">
<span<?php echo $productos->titulo->viewAttributes() ?>>
<?php echo $productos->titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($productos->img1->Visible) { // img1 ?>
		<td data-name="img1"<?php echo $productos->img1->cellAttributes() ?>>
<span id="el<?php echo $productos_list->RowCnt ?>_productos_img1" class="productos_img1">
<span>
<?php echo GetFileViewTag($productos->img1, $productos->img1->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($productos->destacado_inicio->Visible) { // destacado_inicio ?>
		<td data-name="destacado_inicio"<?php echo $productos->destacado_inicio->cellAttributes() ?>>
<span id="el<?php echo $productos_list->RowCnt ?>_productos_destacado_inicio" class="productos_destacado_inicio">
<span<?php echo $productos->destacado_inicio->viewAttributes() ?>>
<?php echo $productos->destacado_inicio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($productos->destacado_footer->Visible) { // destacado_footer ?>
		<td data-name="destacado_footer"<?php echo $productos->destacado_footer->cellAttributes() ?>>
<span id="el<?php echo $productos_list->RowCnt ?>_productos_destacado_footer" class="productos_destacado_footer">
<span<?php echo $productos->destacado_footer->viewAttributes() ?>>
<?php echo $productos->destacado_footer->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($productos->destacado_productos->Visible) { // destacado_productos ?>
		<td data-name="destacado_productos"<?php echo $productos->destacado_productos->cellAttributes() ?>>
<span id="el<?php echo $productos_list->RowCnt ?>_productos_destacado_productos" class="productos_destacado_productos">
<span<?php echo $productos->destacado_productos->viewAttributes() ?>>
<?php echo $productos->destacado_productos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($productos->id_cate->Visible) { // id_cate ?>
		<td data-name="id_cate"<?php echo $productos->id_cate->cellAttributes() ?>>
<span id="el<?php echo $productos_list->RowCnt ?>_productos_id_cate" class="productos_id_cate">
<span<?php echo $productos->id_cate->viewAttributes() ?>>
<?php echo $productos->id_cate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$productos_list->ListOptions->render("body", "right", $productos_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$productos->isGridAdd())
		$productos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$productos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($productos_list->Recordset)
	$productos_list->Recordset->Close();
?>
<?php if (!$productos->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$productos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($productos_list->Pager)) $productos_list->Pager = new PrevNextPager($productos_list->StartRec, $productos_list->DisplayRecs, $productos_list->TotalRecs, $productos_list->AutoHidePager) ?>
<?php if ($productos_list->Pager->RecordCount > 0 && $productos_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($productos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($productos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $productos_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($productos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($productos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $productos_list->pageUrl() ?>start=<?php echo $productos_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $productos_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($productos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $productos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $productos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $productos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $productos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($productos_list->TotalRecs == 0 && !$productos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $productos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$productos_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$productos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$productos_list->terminate();
?>