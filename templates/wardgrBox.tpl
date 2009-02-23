		<div class="border" id="box{$boxID}">
			<div class="containerHead">
				<div class="containerIcon">
						<a href="javascript: void(0)" onclick="openList('wardgrbox', true)">
									<img src="{@RELATIVE_WCF_DIR}icon/minusS.png" id="wardgrboxImage" alt="" /></a>
							</div>
				<div class="containerContent"><span>{lang}wbb.portal.box.wardgr.title2{/lang}</span>
				</div>
						 </div>
			<div class="container-1" id="wardgrbox">
					<div class="containerContent">
                     <div align="right">
                     <table class="tableList">





            {if PORTAL_WARDGR_OFFLINE == false}{lang}wbb.portal.box.wardgr.message{/lang}{else}



              {foreach from=$item.class item=c}
                {if $item.onoff.$c == true}
                  <tr><td align="right" class="smallFont">{lang}wcf.acp.option.portal_wardgr_{$c}{/lang} <img src="icon/ward/{$c}/class.png" alt="{$c}" title="{lang}wcf.acp.option.portal_wardgr_{$c}{/lang}" width="16" height="16" /></td>
                  {if PORTAL_WARDGR_WOSKILLS == true}</tr>{else}<td class="smallFont">
                    {if $item.$c|isset}
                      {if $item.$c.0 == 0}
                        <img src="icon/ward/{$c}/1.png" alt="{$c}" title="{lang}wcf.acp.option.portal_wardgr_{$c}_s1{/lang}" width="16" height="16" /><img src="icon/ward/{$c}/2.png" alt="{$c}" title="{lang}wcf.acp.option.portal_wardgr_{$c}_s2{/lang}" width="16" height="16" /><img src="icon/ward/{$c}/3.png" alt="{$c}" title="{lang}wcf.acp.option.portal_wardgr_{$c}_s3{/lang}" width="16" height="16" />
                      {else}
                        {foreach from=$item.$c item=i}<img src="icon/ward/{$c}/{$i}.png" alt="{$c}" title="{lang}wcf.acp.option.portal_wardgr_{$c}_s{$i}{/lang}" width="16" height="16" />{/foreach}
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
		initList('wardgrbox', {@$item.Status});
		//]]>
		</script>