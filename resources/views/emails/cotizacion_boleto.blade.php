<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>

<div style="width:100%;" align="center">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" style="background-color:#004C64;border-radius:10px;" bgcolor="#004C64;">
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20" align="left" valign="top" bgcolor="#007CA3" style="background-color:#007CA3;">&nbsp;</td>
            <td align="center" valign="top" bgcolor="#007CA3" style="background-color:#007CA3; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;"><br>
              <br>
            <br>
            <div style="color:#00acac; font-family:Georgia, Times New Roman, Times, serif; font-size:24px;">
              <img width="100" src="{{ url('img/wanai.png') }}">
            </div><br>
<br>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="middle"><div style="background: #00cd00 no-repeat scroll center;height:.05em;"></div></td>
                  </tr>
                  <tr>
                    <td height="65" align="center" valign="middle"><div style="color:#FFFFFF; font-size:28px; font-family:Arial, Helvetica, sans-serif;">BOLETO</div></td>
                  </tr>
                  <tr>
                    <td align="center" valign="middle"><div style="background: #00cd00 no-repeat scroll center;height:.05em;"></div></td>
                  </tr>
                </table>
                <br>
                <br>
<div style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:16px;"><b>
Adulto</b><br>
  {{$costo_adulto}} Bs<br><br>
       </div>
<br>
<div style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:16px;"><b>
Infante</b><br>
  {{$costo_infante}} Bs<br><br>
       </div>
<br>
<div style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:16px;"><b>
Bebe</b><br>
  {{$costo_bebe}} Bs<br><br>
       </div>
<br>

<div style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;"><b>{{$boleto->getAerolinea()}}</b> <br>
  Origen: {{$boleto->getOrigen()}} <br>
  Destino: {{$boleto->getOrigen()}} <br>
  Fecha Salida: {{$boleto->fecha_salida_boleto}}<br>
  Catidad Boletos: {{$cantidad}}</div>
<br>
<br>
<br>
<br>
<br></td>
            <td width="20" align="left" valign="top" bgcolor="#007CA3" style="background-color:#007CA3;">&nbsp;</td>
          </tr>
        </table>
    </td>
  </tr>
</table>

</div>

</body>
</html>
