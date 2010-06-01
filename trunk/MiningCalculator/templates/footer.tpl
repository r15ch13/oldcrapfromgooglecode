<br />
<hr />
<table width="100%">
	<tr>
{if $igb}
	<td width="70%">&copy; {$smarty.now|date_format:"%Y"} by <a href="showinfo:1375//556940515" class="none"> <img src="portrait:556940515" size="18"></a> <a href="evemail:r15ch13">r15ch13</a> (originally coded by <a href="showinfo:1374//295830601" class="none"><img src="portrait:295830601" size="18"></a> <a href="evemail:Heru Samtron">Heru Samtron</a>) - v{#version#}</td>
	<td width="30%" style="text-align:right;">This is a service by [<a href="showinfo:2//1053895912">ARGON</a>] Corp.</td>
{else}
	<td width="70%">&copy; {$smarty.now|date_format:"%Y"} by r15ch13 (originally coded by Heru Samtron) - {$version}</td>	
	<td width="30%" style="text-align:right;">This is a service by [ARGON] Corp.</td>
{/if}
	</tr>
</table>

</body>
</html>