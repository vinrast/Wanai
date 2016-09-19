<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#1a2229 " style="background-color:#1a2229 ;border-radius: 10px;"><br>
    <br>
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top" bgcolor="#1D8888" style="background-color:#ffffff; padding-left:14px; padding-right:14px;  padding-top: 14px; padding-bottom: 14px;
  border-radius: 5px;">
            <br>
            <center><img width="100" src="{{ url('img/wanai.png') }}"></center>
            <br><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" style="padding-right:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#525252;"><div style="font-size:18px; color:#00acac;">Paquete</div>
                      <div style="font-size:28px; color:#525252;">{{$paquete->nombre_paquete}}</div>
                      <div><br>
                         {{$paquete->descripcion_paquete}}
                          <br>
                          <br>
                      </div>
                      <div><h2>Detalle de Cotización</h2></div>

                      <table class="table" style="font-size:14px; color:#525252;">
                        <tbody>
                          <tr>
                            <td>Cantidad de paquetes: </td>
                            <td></td>
                            <td>{{$cantidad}}</td>
                          </tr>
                          <tr>
                            <td>Impuesto por paquete:</td>
                            <td></td>
                            <td>{{$impuesto}} Bs</td>
                          </tr>
                          <tr>
                            <td>Costo de paquete:</td>
                            <td></td>
                            <td>{{$paquete->costo_paquete}} Bs</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </table>
                  
                <td width="246" align="left" valign="top" bgcolor="#ececec" style="background-color:#ececec; padding:7px;"><table width="246" border="0" cellpadding="0" cellspacing="0">
                  </table>
                  <table width="246" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#525252;text-align: center;"><div style="font-size:13px;"><b><br>
                        <h2>Costo Total</h2></b></div>
                        <div><h1 style="color:#525252 ">{{$costo}} Bs</h1>
                        </div></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="top"><div style="margin-top:30px;"></div></td>
      </tr>
        </table></td>
      </tr>
    </table>
    <br>
    <br></td>
  </tr>
</table>
</body>
</html>