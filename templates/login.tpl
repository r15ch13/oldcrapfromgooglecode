{config_load file=standard.conf section="setup"}
{include file="header.tpl" title=header}

<p><b>[<a href="./" class="none">back</a>]</b></p>
<form action="./?p=login" method="post">
<table border="0" cellpadding="1" cellspacing="0" style="border-color:#444444;letter-spacing:1px;">
	<tr>
		<td>Username:</td>
		<td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td style="color: red;" colspan="2">{if $denied}<b>permission denied</b>{/if} <input type="submit" value="login" style="float: right;" /></td>
	</tr>
</table>
</form>


{include file="footer.tpl" title=footer}