{include file='header'}
{if $canEditRecruitment|isset}
	<p class="error">{lang}wcf.global.error.permissionDenied{/lang}</p>
{else}

<div class="mainHeadline">
	<img {if $userID|isset}id="userEdit{@$userID}" {/if}src="../icon/wgrMain.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wcf.acp.menu.link.content.wgr.manage{/lang}</h2>
	</div>
</div>

{if $saved|isset}
	<p class="success">{lang}wcf.acp.user.option.edit.success{/lang}</p>
{/if}
{if $error|isset}
	<p class="error">{lang}wcf.global.form.error{/lang}</p>
{/if}


<form enctype="multipart/form-data" method="post" action="index.php?form=WGR&amp;packageID={@PACKAGE_ID}&amp;s={@SID}">

	<fieldset>
		<legend>{lang}wbb.portal.box.wgr.title{/lang}</legend>
		<p class="description">{lang}wcf.acp.option.category.portal.wgrbox.description{/lang}</p>
		<div id="members_list_users_per_pageDiv" class="formElement">
		</div>
		<div id="portal_wgr_offlineDiv" class="formCheckBox formElement"> 
			<div class="formField"> 
				<label for="portal_wgr_offline"><input id="portal_wgr_offline" type="checkbox" name="option_on[portal_wgr_offline]" value="1" {if $options.portal_wgr_offline.option_onoff == 1}checked="checked" {/if}/> {lang}wcf.acp.option.portal_wgr_offline{/lang}</label> 
			</div>		
			<div class="formFieldDesc hidden" id="portal_wgr_offlineHelpMessage"> 
				<p>{lang}wcf.acp.option.portal_wgr_offline.description{/lang}</p> 
			</div> 
		</div>
	<script type="text/javascript"> 
		//<![CDATA[
			inlineHelp.register('portal_wgr_offline');
		//]]>
	</script> 
	
	<div id="portal_wgr_woskillsDiv" class="formCheckBox formElement">
		<div class="formField">
			<label for="portal_wgr_woskills"><input id="portal_wgr_woskills" type="checkbox" name="option_on[portal_wgr_woskills]" value="1" {if $options.portal_wgr_woskills.option_onoff == 1}checked="checked" {/if}/> {lang}wcf.acp.option.portal_wgr_woskills{/lang}</label>
		</div>
	</div>

	
	<div id="portal_wgr_clcolorDiv" class="formCheckBox formElement">
		<div class="formField">
			<label for="portal_wgr_clcolor"><input id="portal_wgr_clcolor" type="checkbox" name="option_on[portal_wgr_clcolor]" value="1" {if $options.portal_wgr_clcolor.option_onoff == 1}checked="checked" {/if}/> {lang}wcf.acp.option.portal_wgr_clcolor{/lang}</label> 
		</div> 		
	</div>
	
	<div id="portal_wgr_detailDiv" class="formCheckBox formElement">
		<div class="formField">
			<label for="portal_wgr_detail"><input id="portal_wgr_detail" type="checkbox" name="option_on[portal_wgr_detail]" value="1" {if $options.portal_wgr_detail.option_onoff == 1}checked="checked" {/if}/> {lang}wcf.acp.option.portal_wgr_detail{/lang}</label> 
		</div>
		<div class="formFieldDesc hidden" id="portal_wgr_detailHelpMessage"> 
			<p>{lang}wcf.acp.option.portal_wgr_detail.description{/lang}</p> 
		</div>
	</div>
	<script type="text/javascript"> 
		//<![CDATA[
			inlineHelp.register('portal_wgr_detail');
		//]]>
	</script>

	<div id="portal_wgr_heDiv" class="formCheckBox formElement"> 
		<div class="formField"> 
			<label for="portal_wgr_he"><input id="portal_wgr_he" type="checkbox" name="option_on[portal_wgr_he]" value="1" {if $options.portal_wgr_he.option_onoff == 1}checked="checked" {/if}/> {lang}wcf.acp.option.portal_wgr_he{/lang}</label> 
		</div> 
	</div>
	
	<div id="portal_wgr_taDiv" class="formCheckBox formElement"> 
		<div class="formField"> 
			<label for="portal_wgr_ta"><input id="portal_wgr_ta" type="checkbox" name="option_on[portal_wgr_ta]" value="1" {if $options.portal_wgr_ta.option_onoff == 1}checked="checked" {/if}/> {lang}wcf.acp.option.portal_wgr_ta{/lang}</label> 
		</div> 		
	</div>
	
	<div id="portal_wgr_ccolorDiv" class="formCheckBox formElement"> 
		<div class="formField"> 
			<label for="portal_wgr_ccolor"><input id="portal_wgr_ccolor" type="checkbox" name="option_on[portal_wgr_ccolor]" value="1" {if $options.portal_wgr_ccolor.option_onoff == 1}checked="checked" {/if}/> {lang}wcf.acp.option.portal_wgr_ccolor{/lang}</label> 
		</div>
	</div>
	
	<div id="portal_wgr_ucolorDiv" class="formElement{if $error|isset} formError{/if}"> 
		<div class="formFieldLabel"> 
			<label for="portal_wgr_ucolor"></label> 
		</div>
		<div class="formField{if $error|isset} formError{/if}"> 
			<input id="portal_wgr_ucolor" type="text" class="inputText" name="option_color[portal_wgr_ucolor]" value="{if $options.portal_wgr_ucolor.option_color|isset}{$options.portal_wgr_ucolor.option_color}{/if}" maxlength="7" />
			{if $error|isset}<p class="innerError">{lang}wcf.user.option.error.validationFailed{/lang}</p>{/if}		
		</div>
		<div class="formFieldDesc hidden" id="portal_wgr_ucolorHelpMessage"> 
			<p>{lang}wcf.acp.option.portal_wgr_ucolor.description{/lang}</p> 
		</div>
	</div> 
	
	<script type="text/javascript"> 
		//<![CDATA[
			inlineHelp.register('portal_wgr_ucolor');
		//]]>
	</script>

	
{if $debug == true}
<pre>
Debugtable:

name 		short	color		o1	o2	o3	s1	s2	s3	
{foreach from=$classes item=val key=key}
{$val.class_name}	{$val.class_short}	{$val.class_color}		{$val.class_onoff_1}	{$val.class_onoff_2}	{$val.class_onoff_3}	{$val.class_skill_1}	{$val.class_skill_2}	{$val.class_skill_3}	
{/foreach}


name			onoff		color	
{foreach from=$options item=val key=key}
{$val.option_name}	{$val.option_onoff}	{$val.option_color}	
{/foreach}


</pre>
{/if}


{foreach from=$classes item=val key=key}
	{assign var=class_name value=$val.class_name}

<!-- {$val.class_short}.{lang}wcf.acp.option.{$val.class_name}{/lang}.{$val.class_name} -->	
		<div id="portal_wgr" class="formCheckboxes formGroup">
			<div class="formGroupLabel"><label>&nbsp;</label></div>
				<script type="text/javascript">
				//<![CDATA[	
					onloadEvents.push(function() { if (!true) enableOptions('{$val.class_name}_s1','{$val.class_name}_s2','{$val.class_name}_s3') + disableOptions(); else enableOptions() + disableOptions('portal_wgr_{$val}_s1','portal_wgr_{$val}_s2','portal_wgr_{$val}_s3');; });
				//]]>
				</script> 
				
				<fieldset>
					<legend style="color: {$val.class_color}; background-color: #f2f6fa; border: 1px solid #8da4b7;"><img src="../icon/wow/{$val.class_short}/class.png" alt="{$val}" title="{lang}wcf.acp.option.{$val.class_name}{/lang}" width="16" height="16" /> {lang}wcf.acp.option.{$val.class_name}{/lang}</legend>
					<div class="formField">
						<ul class="formOptionsLong">
							<li>
								<label id="{$val.class_name}_c1Div"><input id="{$val.class_name}_b" type="checkbox" name="classes_on[{$val.class_name}][s1]" value="1" onclick="if (this.checked) enableOptions('{$val.class_name}_s1') + disableOptions(); else enableOptions() + disableOptions('{$val.class_name}_s1');" {if $val.class_onoff_1 == 1}checked="checked" {/if}/></label>								
								<label id="{$val.class_name}_s1Div">
									<select name="classes_skill[{$val.class_name}][s1]" id="{$val.class_name}_s1">
										{section name=i loop=11}
											<option value="{$i}"{if $val.class_skill_1|isset}{if $val.class_skill_1 == $i} selected="selected"{/if}{/if}>{if $i == 0}--{else}{$i}{/if}</option>
										{/section}
									</select>
								</label>							
								<label><img src="../icon/wow/{$val.class_short}/1.gif" alt="{$val.class_short}" title="{lang}wcf.acp.option.{$val.class_name}_s1{/lang}" width="16" height="16" /> {lang}wcf.acp.option.{$val.class_name}_s1{/lang}</label>
							</li>
							<li>
								<label id="{$val.class_name}_c2Div"><input id="{$val.class_name}_b" type="checkbox" name="classes_on[{$val.class_name}][s2]" value="1" onclick="if (this.checked) enableOptions('{$val.class_name}_s2') + disableOptions(); else enableOptions() + disableOptions('{$val.class_name}_s2');" {if $val.class_onoff_2 == 1}checked="checked" {/if}/></label>
								<label id="{$val.class_name}_s2Div">
									<select name="classes_skill[{$val.class_name}][s2]" id="{$val.class_name}_s2">
										{section name=i loop=11}
											<option value="{$i}"{if $val.class_skill_2|isset}{if $val.class_skill_2 == $i} selected="selected"{/if}{/if}>{if $i == 0}--{else}{$i}{/if}</option>
										{/section}
									</select>
								</label>
								<label><img src="../icon/wow/{$val.class_short}/2.gif" alt="{$val.class_short}" title="{lang}wcf.acp.option.{$val.class_name}_s2{/lang}" width="16" height="16" /> {lang}wcf.acp.option.{$val.class_name}_s2{/lang}</label>
							</li>
							<li>
								<label id="{$val.class_name}_c3Div"><input id="{$val.class_name}_b" type="checkbox" name="classes_on[{$val.class_name}][s3]" value="1" onclick="if (this.checked) enableOptions('{$val.class_name}_s3') + disableOptions(); else enableOptions() + disableOptions('{$val.class_name}_s3');" {if $val.class_onoff_3 == 1}checked="checked" {/if}/></label>
								<label id="{$val.class_name}_s3Div">
									<select name="classes_skill[{$val.class_name}][s3]" id="{$val.class_name}_s3">
										{section name=i loop=11}
											<option value="{$i}"{if $val.class_skill_3|isset}{if $val.class_skill_3 == $i} selected="selected"{/if}{/if}>{if $i == 0}--{else}{$i}{/if}</option>
										{/section}
									</select>
								</label>
								<label><img src="../icon/wow/{$val.class_short}/3.gif" alt="{$val.class_short}" title="{lang}wcf.acp.option.{$val.class_name}_s3{/lang}" width="16" height="16" /> {lang}wcf.acp.option.{$val.class_name}_s3{/lang}</label>
							</li>
						</ul>
					</div>						
				</fieldset>				
		</div>
<!-- /{$val.class_short}.{lang}wcf.acp.option.{$val.class_name}{/lang}.{$val.class_name} -->
{/foreach}
		
	</fieldset>

	<div class="formSubmit">
		<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
		<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
		<input type="hidden" name="packageID" value="{@PACKAGE_ID}" />
		{@SID_INPUT_TAG}
	 </div>
 </form>
	
{/if}
{include file='footer'}