{include file="documentHeader"}

<head>
	<title>{lang}wbb.index.BossSurvey.title{/lang} - {PAGE_TITLE}</title>
	{include file='headInclude'}
	<meta name="generator" content="world of warcraft boss-survey by Kiv" />
</head>
<body>
{include file='header' sandbox=false}
<div id="main">
	<div class="mainHeadline">
		<img src="{@RELATIVE_WCF_DIR}icon/bosssurveyMain.png" alt="" />
		<div class="headlineContainer">
			<span style="color: #999; font-size: 7pt;">World of Warcraft: Wrath of the Lich King</span>
			<h2>{lang}wbb.index.BossSurvey.title{/lang}</h2>
		</div>
	</div>
	{if $instances|count > 0}
	{foreach from=$instances item=instance}
		<div class="border">
			<div class="containerHead">
				<h3 style="font-weight: bold;">{@$instance.bsi_name}</h3>
			</div>
		</div>
		<div class="border borderMarginRemove">
		<table class="tableList">
			<thead>
				<tr class="tableHead">
					<th colspan="2" class="columnTopic">
						<div style="height: 15px;">{lang}wbb.index.BossSurvey.enemy{/lang}</div>
					</th>
					<th class="columnReplies">
						<div style="height: 15px;">{lang}wbb.index.BossSurvey.progress{/lang}</div>
					</th>
					<th class="columnReplies">
						<div style="height: 15px;">{lang}wbb.index.BossSurvey.killdate{/lang}</div>
					</th>
				</tr>
			</thead>
			<tbody>
			{if $mobs|count > 0}
			{foreach from=$mobs item=mob}				
				{if $mob.bsm_instance == $instance.bsi_id}
				<tr class="container-1" {if $mob.bsm_progress < 100} style="color: #333;" {/if}>		
					<td class="columnIcon">
						<img src="{@RELATIVE_WCF_DIR}{@$mob.bsm_icon_path}" alt="" />
					</td>
					<td class="columnTopic">
						<div class="topic">						
							<p>
								<span style="font-size: 14px; font-weight: bold; float: left;"><strong>{@$mob.bsm_name}</strong></span>	
								{if $mob.bsm_info_url != ''}<a href="{@$mob.bsm_info_url}" target="_blank"><img src="icon/goToLastPostS.png" style="float: right;" alt="{lang}wbb.index.BossSurvey.newslink.title{/lang}" title="{lang}wbb.index.BossSurvey.newslink.title{/lang}" /></a>{/if}
							</p>
						</div>
						<p style="color: #999; font-size: 9px; {if $mob.bsm_progress < 100} color: #333; {/if}">{@$mob.bsm_desc}</p>
					</td>
					<td class="columnReplies">{if $mob.bsm_progress > 0}<div class="containerHead" style="width: {@$mob.bsm_progress}px; margin: 0; padding: 0; height: 10px; font-size: 8px; margin: auto; border: 1px solid #000;">{@$mob.bsm_progress}%</div>{/if}</td>
					<td class="columnReplies">{if $mob.bsm_killdate > 0}{@$mob.conv_killdate}{/if}</td>
				</tr>	
				{/if}
			{/foreach}
			{/if}
			</tbody>
		</table>
	</div>
	
	<br/>
	{/foreach}
	{/if}
	<br/>
	<div class="border infoBox">
		<div class="container-1" style="text-align: center; font-size: 9px;">
			&copy;2009 by <strong>Kiv</strong> | <a href="http://www.guilded.eu" target="_blank">www.guilded.eu</a> | Ulduar added by <strong>r15ch13</strong> | <a href="http://www.mein-project.de" target="_blank">www.mein-project.de</a>
		</div>
	</div>

</div>
{include file='footer' sandbox=false}

</body>
</html>