<?php
namespace PHPMaker2019\project1;
?>
<?php if ($categorias->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_categoriasmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($categorias->img_header->Visible) { // img_header ?>
		<tr id="r_img_header">
			<td class="<?php echo $categorias->TableLeftColumnClass ?>"><?php echo $categorias->img_header->caption() ?></td>
			<td<?php echo $categorias->img_header->cellAttributes() ?>>
<span id="el_categorias_img_header">
<span>
<?php echo GetFileViewTag($categorias->img_header, $categorias->img_header->getViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($categorias->titulo->Visible) { // titulo ?>
		<tr id="r_titulo">
			<td class="<?php echo $categorias->TableLeftColumnClass ?>"><?php echo $categorias->titulo->caption() ?></td>
			<td<?php echo $categorias->titulo->cellAttributes() ?>>
<span id="el_categorias_titulo">
<span<?php echo $categorias->titulo->viewAttributes() ?>>
<?php echo $categorias->titulo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>