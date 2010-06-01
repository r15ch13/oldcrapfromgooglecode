{config_load file=standard.conf section="setup"}
{include file="header.tpl" title=header}

<p><b>Letzte &Auml;nderung / Last change: [{$lastupdate}]{if $smarty.session.loggedin} [<a href="./?p=logout" class="none">logout</a>]{/if}</b></p>

{if $igb}[Found a bug? Contact me via <a href="evemailto:r15ch13" subject="MinCalc Bugreport" message="">EVE-MAIL</a>]<br /><br />{/if}

<form action="./" method="post">
<table border="1" cellpadding="1" cellspacing="0" style="border-color:#444444;letter-spacing:1px;" width="750px">


{foreach from=$MarketGroups item=mg name=marketgroup}
{assign var=MarketGroupId value=$mg->DatabaseId()}
{assign var=gid value=$smarty.session.gid}

	{if $MarketGroupId == $gid}
		<tr>
			<td bgcolor="#151515" colspan="5" style="text-align:center; color:#fff;">
				<a href="?g={$mg->DatabaseId()}" class="none"><b>{$mg->Name()}</b></a>
			</td>
		</tr>
		<tr>
			<td class="header" width="260px">mineral</td>
			<td class="header" width="120px">input quantity</td>
			<td class="header" width="110px">quantity</td>
			<td class="header" width="110px">price per</td>
			<td class="header" width="150px">subtotal</td>
		</tr>

		{foreach from=$mg->Types() item=ty name=type}
			{assign var=DatabaseId value=$ty->DatabaseId()}
			{assign var=Name value=$ty->Name()}
			{assign var=Price value=$ty->Price()}
			<tr>
				{if $igb}
					<td valign="middle"><a href="showinfo:{$ty->DatabaseId()}" class="none"><img src="typeicon:{$ty->DatabaseId()}" width="16" height="16"> {$Name|truncate:30:"...":true}</a></td>
				{else}
					<td valign="middle"><span title="{$Name}"><img style="margin: 0px; padding: 0px;" src="{$eveIconPath}icon{$ty->Icon()}.png" width="{$eveIconSize}" height="{$eveIconSize}" alt="{$DatabaseId}" title="{$Name}" /> {$Name|truncate:25:"...":true}</span></td>
				{/if}

				{if $smarty.session.type.$DatabaseId}
					<td align="center" valign="middle"><span title="{$Name}"><input type="text" name="{$DatabaseId}" size="15" maxlength="15" value="{$smarty.session.type.$DatabaseId.quantity}" /></span></td>
					<td align="right" valign="middle"><span title="{$Name}">{$smarty.session.type.$DatabaseId.quantityFormated}</span></td>
					<td align="right" valign="middle"><span title="{$Name}"><a href="{$ty->PriceChart()}" rel="lightbox" title="the last 15 price changes for {$ty->Name()}" style="color: #000000;">{$Price|string_format:"%.2f"} ISK</a></span></td>
					<td align="right" valign="middle"><span title="{$Name}">{$smarty.session.type.$DatabaseId.resultFormated} ISK</span></td>
				{else}
					<td align="center" valign="middle"><span title="{$Name}"><input type="text" name="{$DatabaseId}" size="15" maxlength="15" value="" /></span></td>
					<td align="right" valign="middle">&nbsp;</td>
					{if $igb}
						<td align="right" valign="middle"><span title="{$Name}">a{$Price|string_format:"%.2f"} ISK</span></td>
					{else}
						<td align="right" valign="middle"><span title="{$Name}"><a href="{$ty->PriceChart()}" rel="lightbox" title="the last 15 price changes for {$ty->Name()}" style="color: #000000;">{$Price|string_format:"%.2f"} ISK</a></span></td>
					{/if}
					<td align="right" valign="middle"><span title="{$Name}">0.00 ISK</span></td>
				{/if}

				</tr>
		{/foreach}

		<tr><td colspan="5" align="right" valign="middle">
			{if $smarty.session.subtotalFormated.$MarketGroupId}
				{$smarty.session.subtotalFormated.$MarketGroupId}
			{else}
				0.00
			{/if}
		ISK</td></tr>

	{else}
		<tr>
			<td bgcolor="#151515" colspan="4" style="text-align:center; color:#fff;">
				<a href="?g={$mg->DatabaseId()}" class="none"><b>{$mg->Name()}</b></a>
			</td>
			<td bgcolor="#151515" align="right" valign="middle" style="text-align:right; color:#fff;">
				{if $smarty.session.subtotalFormated.$MarketGroupId} {$smarty.session.subtotalFormated.$MarketGroupId} {else} 0.00 {/if} ISK
			</td>
		</tr>
	{/if}


{/foreach}



<tr>
	<td colspan="3"></td>
	<td style="text-align:right;">+ Contract:</td>
	<td style="text-align:right;">10,000.00 ISK</td>
</tr>
<tr>
	<td colspan="3" class="total"></td>
	<td class="total"><b>Total:</b></td>
	<td class="total"><b>{$total} ISK</b></td>
</tr>
<tr>
	{if $igb}
		<td width="260px" bgcolor="#444444">&nbsp;</td>
	{else}
		<td width="260px" bgcolor="#444444" style="text-align: center; font-size: 0.7em">[<a href="?p=xml" class="none">Pricelist as XML</a>]</td>
	{/if}
	<td bgcolor="#444444" style="text-align:center;"><input type="submit" value="calculate" /></td>
	<td bgcolor="#444444">&nbsp;</td>
	{if $igb}
		<td bgcolor="#444444">&nbsp;</td>
	{else}
		<td bgcolor="#444444" style="text-align:center;">[<a class="none" href="?p=login">Price Editor</a>]</td>
	{/if}
	<td bgcolor="#444444">&nbsp;</td>
</tr>

</table>
</form>



<table border="1" cellpadding="1" cellspacing="0" style="border-color:#444444;letter-spacing:1px;" width="750px">
	<tr>
		<td width="260px" style="text-align:center;">Links: <a href="http://eve.grismar.net/ore/">Ore Chart</a>, <a href="http://eve.grismar.net/ore/ice.php">ICE Chart</a></td>
		<td bgcolor="#444444" width="120px" style="text-align:center;"><form action="?p=reset" method="post" style="margin:0px;"><input type="submit" name="reset" value="reset" /></form></td>
		<td colspan="3" width="370px">Die Werte bitte ohne tausender Trennzeichen eingeben.</td>
	</tr>
</table>
{include file="footer.tpl" title=footer}