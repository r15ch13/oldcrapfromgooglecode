		<div class="border" id="box{$boxID}">
			<div class="containerHead">
				<div class="containerIcon">
					<a href="javascript: void(0)" onclick="openList('wgrbox', true)">
					<img src="{@RELATIVE_WCF_DIR}icon/minusS.png" id="wgrboxImage" alt="" /></a>
				</div>
				<div class="containerContent"><span>{lang}wbb.portal.box.wgr.title2{/lang}</span></div>
			</div>
			<div class="container-1" id="wgrbox">
				<div class="containerContent">

<script type="text/javascript">
	function initMyList(listName, status) {
		if (!status) {
			var element = document.getElementById(listName);
			element.style.display = 'none';
			document.getElementById(listName).src = document.getElementById(listName).src;
		}
	}
</script>

<table class="tableList">{if $item.activ == true}{else}{/if}
	{if $item.options.portal_wgr_offline.option_onoff == 0 || $item.activ == false}
		{lang}wbb.portal.box.wgr.message{/lang}
	{else}
	
		{if $item.options.portal_wgr_he.option_onoff == 1}
			<tr>
				<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} {if $item.options.portal_wgr_woskills.option_onoff == 0}colspan="2"{/if}>
					<img src="icon/wow/dr/class.png" alt="dr" title="{lang}wcf.acp.option.portal_wgr_dr{/lang}" width="16" height="16" />
					<img src="icon/wow/pa/class.png" alt="pa" title="{lang}wcf.acp.option.portal_wgr_pa{/lang}" width="16" height="16" />
					<img src="icon/wow/sa/class.png" alt="sa" title="{lang}wcf.acp.option.portal_wgr_sa{/lang}" width="16" height="16" />
					<img src="icon/wow/pr/class.png" alt="pr" title="{lang}wcf.acp.option.portal_wgr_pr{/lang}" width="16" height="16" /><br />
					<img src="icon/wow/dr/3.gif" alt="dr" title="{lang}wcf.acp.option.portal_wgr_dr_s3{/lang}" width="16" height="16" />
					<img src="icon/wow/pa/1.gif" alt="pa" title="{lang}wcf.acp.option.portal_wgr_pa_s1{/lang}" width="16" height="16" />
					<img src="icon/wow/sa/3.gif" alt="sa" title="{lang}wcf.acp.option.portal_wgr_sa_s3{/lang}" width="16" height="16" />
					<img src="icon/wow/pr/2.gif" alt="pr" title="{lang}wcf.acp.option.portal_wgr_pr_s2{/lang}" width="16" height="16" />
				</td>
				<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} align="left" class="smallFont">
					{lang}wcf.acp.option.portal_wgr_he.description{/lang}
				</td>
			</tr>
		{/if}
		
		{if $item.options.portal_wgr_ta.option_onoff == 1}
			<tr>
				<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} {if $item.options.portal_wgr_woskills.option_onoff == 0}colspan="2"{/if}>
					<img src="icon/wow/wa/class.png" alt="wa" title="{lang}wcf.acp.option.portal_wgr_wa{/lang}" width="16" height="16" />
					<img src="icon/wow/pa/class.png" alt="pa" title="{lang}wcf.acp.option.portal_wgr_pa{/lang}" width="16" height="16" />
					<img src="icon/wow/dk/class.png" alt="dk" title="{lang}wcf.acp.option.portal_wgr_dk{/lang}" width="16" height="16" />
					<img src="icon/wow/dr/class.png" alt="dr" title="{lang}wcf.acp.option.portal_wgr_dr{/lang}" width="16" height="16" /><br />
					<img src="icon/wow/wa/3.gif" alt="wa" title="{lang}wcf.acp.option.portal_wgr_wa_s3{/lang}" width="16" height="16" />
					<img src="icon/wow/pa/2.gif" alt="pa" title="{lang}wcf.acp.option.portal_wgr_pa_s2{/lang}" width="16" height="16" />
					<img src="icon/wow/dk/2.gif" alt="dk" title="{lang}wcf.acp.option.portal_wgr_dk_s2{/lang}" width="16" height="16" />
					<img src="icon/wow/dr/2.gif" alt="dr" title="{lang}wcf.acp.option.portal_wgr_dr_s2{/lang}" width="16" height="16" />
				</td>
				<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} align="left" class="smallFont">
					{lang}wcf.acp.option.portal_wgr_ta.description{/lang}
				</td>
			</tr>
		{/if}

		
		
		{foreach from=$item.classes item=val key=key}
			{if $val.class_onoff_1 + $val.class_onoff_2 + $val.class_onoff_3 != 0}
				{if $item.options.portal_wgr_detail.option_onoff == 1}
					<tr onclick="openList('{$val.class_name}', true)" title="{lang}wbb.portal.box.wgr.title3{/lang}" style="cursor: pointer;">
				{else}
					<tr>
				{/if}				
						<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} align="left" class="smallFont">
							<img src="icon/wow/{$val.class_short}/class.png" alt="{$val.class_short}" title="{lang}wcf.acp.option.{$val.class_name}{/lang}" width="16" height="16" />
						</td>
						{if $item.options.portal_wgr_woskills.option_onoff == 0}
						<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} align="left" class="smallFont">
							{if $val.class_onoff_1 == 1}<img src="icon/wow/{$val.class_short}/1.gif" alt="{$val.class_short}" title="{lang}wcf.acp.option.{$val.class_name}_s1{/lang}" width="16" height="16" />{/if}
							{if $val.class_onoff_2 == 1}<img src="icon/wow/{$val.class_short}/2.gif" alt="{$val.class_short}" title="{lang}wcf.acp.option.{$val.class_name}_s2{/lang}" width="16" height="16" />{/if}
							{if $val.class_onoff_3 == 1}<img src="icon/wow/{$val.class_short}/3.gif" alt="{$val.class_short}" title="{lang}wcf.acp.option.{$val.class_name}_s3{/lang}" width="16" height="16" />{/if}		
						</td>
						{/if}
						<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} align="left" class="smallFont">
							<span {if $item.options.portal_wgr_clcolor.option_onoff == 0}style="color:{$val.class_color};"{/if}>
								{lang}wcf.acp.option.{$val.class_name}{/lang}
							</span>
						</td>
					</tr>
				{if $item.options.portal_wgr_detail.option_onoff == 1}
					<tr id="{$val.class_name}" onclick="openList('{$val.class_name}', true)" style="cursor: pointer;">
						<td {if $item.options.portal_wgr_ccolor.option_onoff == 1}style="background-color:{$item.options.portal_wgr_ucolor.option_color};"{/if} align="left" class="smallFont" {if $item.options.portal_wgr_woskills.option_onoff == 0}colspan="3"{else}colspan="2"{/if}>
							{if $val.class_onoff_1 == 1}{if $val.class_skill_1 > 0}{$val.class_skill_1}x {/if}{lang}wcf.acp.option.{$val.class_name}_s1{/lang}<br />{/if}
							{if $val.class_onoff_2 == 1}{if $val.class_skill_2 > 0}{$val.class_skill_2}x {/if}{lang}wcf.acp.option.{$val.class_name}_s2{/lang}<br />{/if}
							{if $val.class_onoff_3 == 1}{if $val.class_skill_3 > 0}{$val.class_skill_3}x {/if}{lang}wcf.acp.option.{$val.class_name}_s3{/lang}<br />{/if}
						</td>
					</tr>
				{/if}
			{/if}
		{/foreach}
		
	{/if}
</table>

		</div>
	</div>
</div>
<script type="text/javascript">
//<![CDATA[
{if $item.options.portal_wgr_detail.option_onoff == 1}
{foreach from=$item.classes item=val key=key}
{if $val.class_onoff_1 + $val.class_onoff_2 + $val.class_onoff_3 != 0}	initMyList('{$val.class_name}', 0);
{/if}
{/foreach}
{/if}
	initList('wgrbox', {@$item.Status});
//]]>
</script>