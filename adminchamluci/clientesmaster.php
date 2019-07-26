<?php
namespace PHPMaker2019\project1;
?>
<?php if ($clientes->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_clientesmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($clientes->ruc->Visible) { // ruc ?>
		<tr id="r_ruc">
			<td class="<?php echo $clientes->TableLeftColumnClass ?>"><?php echo $clientes->ruc->caption() ?></td>
			<td<?php echo $clientes->ruc->cellAttributes() ?>>
<span id="el_clientes_ruc">
<span<?php echo $clientes->ruc->viewAttributes() ?>>
<?php echo $clientes->ruc->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($clientes->nom->Visible) { // nom ?>
		<tr id="r_nom">
			<td class="<?php echo $clientes->TableLeftColumnClass ?>"><?php echo $clientes->nom->caption() ?></td>
			<td<?php echo $clientes->nom->cellAttributes() ?>>
<span id="el_clientes_nom">
<span<?php echo $clientes->nom->viewAttributes() ?>>
<?php echo $clientes->nom->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($clientes->tel->Visible) { // tel ?>
		<tr id="r_tel">
			<td class="<?php echo $clientes->TableLeftColumnClass ?>"><?php echo $clientes->tel->caption() ?></td>
			<td<?php echo $clientes->tel->cellAttributes() ?>>
<span id="el_clientes_tel">
<span<?php echo $clientes->tel->viewAttributes() ?>>
<?php echo $clientes->tel->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($clientes->cor->Visible) { // cor ?>
		<tr id="r_cor">
			<td class="<?php echo $clientes->TableLeftColumnClass ?>"><?php echo $clientes->cor->caption() ?></td>
			<td<?php echo $clientes->cor->cellAttributes() ?>>
<span id="el_clientes_cor">
<span<?php echo $clientes->cor->viewAttributes() ?>>
<?php echo $clientes->cor->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($clientes->codigo->Visible) { // codigo ?>
		<tr id="r_codigo">
			<td class="<?php echo $clientes->TableLeftColumnClass ?>"><?php echo $clientes->codigo->caption() ?></td>
			<td<?php echo $clientes->codigo->cellAttributes() ?>>
<span id="el_clientes_codigo">
<span<?php echo $clientes->codigo->viewAttributes() ?>>
<?php echo $clientes->codigo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($clientes->hora->Visible) { // hora ?>
		<tr id="r_hora">
			<td class="<?php echo $clientes->TableLeftColumnClass ?>"><?php echo $clientes->hora->caption() ?></td>
			<td<?php echo $clientes->hora->cellAttributes() ?>>
<span id="el_clientes_hora">
<span<?php echo $clientes->hora->viewAttributes() ?>>
<?php echo $clientes->hora->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($clientes->fecha->Visible) { // fecha ?>
		<tr id="r_fecha">
			<td class="<?php echo $clientes->TableLeftColumnClass ?>"><?php echo $clientes->fecha->caption() ?></td>
			<td<?php echo $clientes->fecha->cellAttributes() ?>>
<span id="el_clientes_fecha">
<span<?php echo $clientes->fecha->viewAttributes() ?>>
<?php echo $clientes->fecha->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>