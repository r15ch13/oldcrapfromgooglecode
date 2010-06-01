{config_load file=standard.conf section="setup"}
{include file="header.tpl" title=header}

<p><b>Letzte &Auml;nderung / Last change: [{$lastupdate}] [<a href="./" class="none">back</a>] [<a href="./?p=logout" class="none">logout</a>] - [<a href="./?p=update" class="none">update stats</a>]</b> {$updatetime}</p>
<form action="./" method="post">
<table border="1" cellpadding="1" cellspacing="0" style="border-color:#444444;letter-spacing:1px;" width="100%">


{foreach from=$MarketGroups item=mg name=marketgroup}
{assign var=MarketGroupId value=$mg->DatabaseId()}
{assign var=gid value=$smarty.session.gid}
		<tr>
			<td bgcolor="#151515" colspan="13" style="text-align:center; color:#fff;"><b>{$mg->Name()}</b></td>
		</tr>
		<tr>
			<td class="header" width="70px"><span onClick="asd()">mineral</span></td>
			<td class="header" width="70px">price</td>
			<td class="header" width="70px">custom minimum</td>
			<td class="header" width="70px">custom maximum</td>
			<td class="header" width="70px">lower quartile</td>
			<td class="header" width="70px">median</td>
			<td class="header" width="70px">upper quartile</td>
			<td class="header" width="70px">average</td>
			<td class="header" width="70px">real average</td>
			<td class="header" width="70px">standard deviation</td>
			<td class="header" width="70px">minimum</td>
			<td class="header" width="70px">maximum</td>
			<td class="header" width="70px">last change</td>
		</tr>

		{foreach from=$mg->Types() item=ty name=type}
			{assign var=DatabaseId value=$ty->DatabaseId()}
			{assign var=Name value=$ty->Name()}
			{assign var=Price value=$ty->Price()}
			<tr>
				<td valign="middle"><img src="{$eveIconPath}icon{$ty->Icon()}.png" width="{$eveIconSize}" height="{$eveIconSize}" alt="{$DatabaseId}" title="{$Name}" /> {$Name|truncate:30:"...":true}</td>
				<td align="right" valign="middle"><b><span id="price{$DatabaseId}">{$ty->Price()|string_format:"%.2f"}</span></b></td>
				<td align="right" valign="middle"><b><span id="min{$DatabaseId}">{$ty->CustomMinimum()|string_format:"%.2f"}</span></b></td>
				<td align="right" valign="middle"><b><span id="max{$DatabaseId}">{$ty->CustomMaximum()|string_format:"%.2f"}</span></b></td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->LowerQuartile()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->Median()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->UpperQuartile()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->Average()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->RealAverage()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->StandardDeviation()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->Minimum()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->Maximum()|string_format:"%.2f"}</td>
				<td align="right" valign="middle" style="background: #cccccc;">{$ty->Timestamp()|date_format:"%D %T"}</td>
			</tr>
			{literal}
			<script>
				new Ajax.InPlaceEditor($('price{/literal}{$DatabaseId}{literal}'), 'ajax.php?c=price&id={/literal}{$DatabaseId}{literal}', {
					size: 5, submitOnBlur: true, okLink: false, cancelLink: false, textBetweenControls: ' | ', highlightcolor: '#ffa600', highlightendcolor: '#ffffff',
					ajaxOptions: {method: 'get'}
				});
				new Ajax.InPlaceEditor($('min{/literal}{$DatabaseId}{literal}'), 'ajax.php?c=min&id={/literal}{$DatabaseId}{literal}', {
					size: 5, submitOnBlur: true, okLink: false, cancelLink: false, textBetweenControls: ' | ', highlightcolor: '#ffa600', highlightendcolor: '#ffffff',
					ajaxOptions: {method: 'get'}
				});
				new Ajax.InPlaceEditor($('max{/literal}{$DatabaseId}{literal}'), 'ajax.php?c=max&id={/literal}{$DatabaseId}{literal}', {
					size: 5, submitOnBlur: true, okLink: false, cancelLink: false, textBetweenControls: ' | ', highlightcolor: '#ffa600', highlightendcolor: '#ffffff',
					ajaxOptions: {method: 'get'}
				});
			</script>
			{/literal}

		{/foreach}

{/foreach}
</table>
</form>

{include file="footer.tpl" title=footer}