		<div class="border" id="box{$boxID}">
			<div class="containerHead">
				<div class="containerIcon">
						<a href="javascript: void(0)" onclick="openList('warogrbox', true)">
									<img src="{@RELATIVE_WCF_DIR}icon/minusS.png" id="warogrboxImage" alt="" /></a>
							</div>
				<div class="containerContent"><span>{lang}wbb.portal.box.warogr.title2{/lang}</span>
				</div>
						 </div>
			<div class="container-1" id="warogrbox">
					<div class="containerContent">
                     <div align="right">
                     <table class="tableList">





            {if PORTAL_WAROGR_OFFLINE == false}{lang}wbb.portal.box.warogr.message{/lang}{else}



              {foreach from=$item.class item=c}
                {if $item.onoff.$c == true}
                  <tr><td align="right" class="smallFont">{lang}wcf.acp.option.portal_warogr_{$c}{/lang} <img src="icon/waro/{$c}/class.png" alt="{$c}" title="{lang}wcf.acp.option.portal_warogr_{$c}{/lang}" width="16" height="16" /></td>
                  {if PORTAL_WAROGR_WOSKILLS == true}</tr>{else}<td class="smallFont">
                    {if $item.$c|isset}
                      {if $item.$c.0 == 0}
                        <img src="icon/waro/{$c}/1.png" alt="{$c}" title="{lang}wcf.acp.option.portal_warogr_{$c}_s1{/lang}" width="16" height="16" /><img src="icon/waro/{$c}/2.png" alt="{$c}" title="{lang}wcf.acp.option.portal_warogr_{$c}_s2{/lang}" width="16" height="16" /><img src="icon/waro/{$c}/3.png" alt="{$c}" title="{lang}wcf.acp.option.portal_warogr_{$c}_s3{/lang}" width="16" height="16" />
                      {else}
                        {foreach from=$item.$c item=i}<img src="icon/waro/{$c}/{$i}.png" alt="{$c}" title="{lang}wcf.acp.option.portal_warogr_{$c}_s{$i}{/lang}" width="16" height="16" />{/foreach}
                      {/if}
                    {/if}</td></tr>
                  {/if}
                {/if}
              {/foreach}

            {/if}




                     </table>
                     </div>
							</div>
						</div>
				</div>
				<script type="text/javascript">
		//<![CDATA[
		initList('warogrbox', {@$item.Status});
		//]]>
		</script>