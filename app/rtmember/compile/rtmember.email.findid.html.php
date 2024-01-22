<?php /* Template_ 2.2.8 2023/07/18 23:05:11 /home/admin2.co.kr/arim/app/rtmember/template/rtmember.email.findid.html 000002272 */ ?>
<meta charset="utf-8" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#1cbdb4">
<tbody>
<tr>
	<td style="padding: 45px 0 30px 0;">
		<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
		<tbody>
		<tr>
			<td  align="center" valign="top" style="font-family: Gulim, dotum, Helvetica, Arial, sans-serif; color:#fff; letter-spacing:-1px; "><h1>아이디찾기</h1></td>
		</tr>
		<tr>
			<td style="color:#FFF; text-align:center; padding-bottom:10px"><h3><?php echo $TPL_VAR["회원명"]?>님의 가입된 아이디는 <span style="font-weight:bold;">(<?php echo $TPL_VAR["아이디"]?>)입니다.</span></h3></td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f7f5f8">
<tbody>
<tr>
	<td style="padding: 50px 0 100px 0;">
		<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
		<tbody>
		<tr>
			<td width="500" align="center" valign="top" style="font-family: Gulim, dotum, Helvetica, Arial, sans-serif; color:#333; letter-spacing:-1px; ">안녕하세요. <?php echo $TPL_VAR["사이트명"]?> 고객센터 입니다.<br /><br />앞으로도 많은 관심 부탁드립니다.<br />감사합니다.<br /><br /><span style="font-weight:bold; font-size:18px; line-height:180% ">[문의사항]</span><br />서비스 이용에 문의가 있으신 경우 <a href="#none"><?php echo $TPL_VAR["이메일"]?></a>로 보내주시면 순차적으로 처리해드리겠습니다.</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#35393d">
<tbody>
<tr>
	<td style="padding: 30px 0 30px 0; text-align:center; color:#fff">본 메일은 <?php echo $TPL_VAR["사이트명"]?> 고객님께 발송되는 메일입니다.<br />수신을 원하지 않으시면 <a href="<?php echo $TPL_VAR["수신거부링크"]?>" target="_blank" style="color:#e9960c; text-decoration:none;">수신거부</a> 버튼을 눌러 주시기 바랍니다</td>
</tr>
</tbody>
</table>