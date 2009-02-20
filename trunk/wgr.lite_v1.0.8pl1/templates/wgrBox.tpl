		<div class="border" id="box{$boxID}">
			<div class="containerHead">
				<div class="containerIcon">
						<a href="javascript: void(0)" onclick="openList('wgrbox', true)">
									<img src="{@RELATIVE_WCF_DIR}icon/minusS.png" id="wgrboxImage" alt="" /></a>
							</div>
				<div class="containerContent"><span>{lang}wbb.portal.box.wgr.title2{/lang}</span>
				</div>
						 </div>
			<div class="container-1" id="wgrbox">
					<div class="containerContent">
                     <div align="right">
                     <table class="tableList">





            {if PORTAL_WGR_OFFLINE == false}{lang}wbb.portal.box.wgr.message{/lang}{else}
              {if PORTAL_WGR_HE == true}<tr><td align="right" class="smallFont">{lang}wcf.acp.option.portal_wgr_he{/lang}{if PORTAL_WGR_WOSKILLS == false}</td><td>{/if} <img src="icon/wow/dr/class.png" alt="dr" title="{lang}wcf.acp.option.portal_wgr_dr{/lang}" width="16" height="16" /><img src="icon/wow/pa/class.png" alt="pa" title="{lang}wcf.acp.option.portal_wgr_pa{/lang}" width="16" height="16" /><img src="icon/wow/sa/class.png" alt="sa" title="{lang}wcf.acp.option.portal_wgr_sa{/lang}" width="16" height="16" /><img src="icon/wow/pr/class.png" alt="pr" title="{lang}wcf.acp.option.portal_wgr_pr{/lang}" width="16" height="16" /></td></tr>{/if}
              {if PORTAL_WGR_TA == true}<tr><td align="right" class="smallFont">{lang}wcf.acp.option.portal_wgr_ta{/lang}{if PORTAL_WGR_WOSKILLS == false}</td><td>{/if} <img src="icon/wow/wa/class.png" alt="wa" title="{lang}wcf.acp.option.portal_wgr_wa{/lang}" width="16" height="16" /><img src="icon/wow/dk/class.png" alt="dk" title="{lang}wcf.acp.option.portal_wgr_dk{/lang}" width="16" height="16" /><img src="icon/wow/dr/class.png" alt="dr" title="{lang}wcf.acp.option.portal_wgr_dr{/lang}" width="16" height="16" /></td></tr>{/if}

              {foreach from=$item.class item=c}
                {if $item.onoff.$c == true}
                  <tr><td align="right" class="smallFont"{if PORTAL_WGR_WOSKILLS == true} colspan="2"{/if}>{lang}wcf.acp.option.portal_wgr_{$c}{/lang} <img src="icon/wow/{$c}/class.png" alt="{$c}" title="{lang}wcf.acp.option.portal_wgr_{$c}{/lang}" width="16" height="16" /></td>
                  {if PORTAL_WGR_WOSKILLS == true}</tr>{else}<td>
                    {if $item.$c|isset}
                      {if $item.$c.0 == 0}
                        <img src="icon/wow/{$c}/1.gif" alt="{$c}" title="{lang}wcf.acp.option.portal_wgr_{$c}_s1{/lang}" width="16" height="16" /><img src="icon/wow/{$c}/2.gif" alt="{$c}" title="{lang}wcf.acp.option.portal_wgr_{$c}_s2{/lang}" width="16" height="16" /><img src="icon/wow/{$c}/3.gif" alt="{$c}" title="{lang}wcf.acp.option.portal_wgr_{$c}_s3{/lang}" width="16" height="16" />
                      {else}
                        {foreach from=$item.$c item=i}<img src="icon/wow/{$c}/{$i}.gif" alt="{$c}" title="{lang}wcf.acp.option.portal_wgr_{$c}_s{$i}{/lang}" width="16" height="16" />{/foreach}
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
		initList('wgrbox', {@$item.Status});
		//]]>
		</script>