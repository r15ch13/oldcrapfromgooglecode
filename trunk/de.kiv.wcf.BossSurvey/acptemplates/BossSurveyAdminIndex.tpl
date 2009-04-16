{include file='header'}

<div class="mainHeadline">
	<img {if $userID|isset}id="userEdit{@$userID}" {/if}src="{@RELATIVE_WCF_DIR}icon/bosssurveyMain.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wcf.acp.menu.link.content.BossSurveyAdmin.manage{/lang}</h2>
	</div>
</div>

{if $saved|isset}
	<p class="success">{lang}wcf.acp.BossSurveyAdmin.manage.success{/lang}</p>	
{/if}

{if $instances|count > 0}
	<form enctype="multipart/form-data" method="post" action="index.php?form=BossSurveyAdmin">
	{foreach from=$instances item=instance}
		<br/>
		<div class="border">
			<div class="containerHead">
				<h3 style="font-weight: bold;">{@$instance.bsi_name}</h3>
			</div>
		</div>
		<div class="border borderMarginRemove">
		<table class="tableList">
			<thead>
				<tr class="tableHead">
					<th class="columnTopic">
						<div style="height: 15px;">{lang}wbb.index.BossSurvey.enemy{/lang}</div>
					</th>
					<th class="columnTopic">
						<div style="height: 15px;">{lang}wbb.index.BossSurvey.progress{/lang}</div>
					</th>
					<th class="columnTopic">
						<div style="height: 15px;">{lang}wbb.index.BossSurvey.date{/lang}</div>
					</th>
					<th class="columnTopic">
						<div style="height: 15px;">{lang}wbb.index.BossSurvey.newslink{/lang}</div>
					</th>
				</tr>
			</thead>
			<tbody>
			{if $mobs|count > 0}
			{foreach from=$mobs item=mob}				
				{if $mob.bsm_instance == $instance.bsi_id}
				<input type="hidden" name="bossSurveyMob_ID[]" value="{$mob.bsm_id}" />
				<tr class="container-1" style="color: #333;">		
					<td class="columnTopic">
						<div class="topic">						
							<p>
								<span style="font-size: 12px; font-weight: bold; float: left; width: 150px;">{@$mob.bsm_name}</span>	
							</p>
						</div>
					</td>
					
					<td class="columnTopic" style="text-align: center;"><input type="text" value="{$mob.bsm_progress}" name="bossSurveyMob_Progress[]" style="width: 30px; padding: 1px;"> %</td>
					<td class="columnTopic" style="text-align: center;"><input type="text" value="{$mob.conv_killdate}" name="bossSurveyMob_Killdate[]" style="width: 100px; padding: 1px;"></td>
					<td class="columnTopic" style="text-align: center;"><input type="text" value="{$mob.bsm_info_url}" name="bossSurveyMob_InfoUrl[]" style="width: 200px; padding: 1px;"></td>
				</tr>	
				{/if}
			{/foreach}
			{/if}
			</tbody>
		</table>
	</div>
	{/foreach}
	<br/>
	<div class="formSubmit">
		<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
		<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
		<input type="hidden" name="packageID" value="{@PACKAGE_ID}" />
 		{@SID_INPUT_TAG}
 	</div>
	</form>
{/if}

{include file='footer'}