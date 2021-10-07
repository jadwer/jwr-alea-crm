<?php
$logo = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $logo , 'full' );
$image_url = (isset($image[0]))? $image[0] : "" ;
?>
<div id="DivIdToPrint<?= $customer_invoice->getid();?>" style="display:none">

<div style="width:100%;max-width:700px;text-align:justify;color:#000;margin-top:20px;font-size:14px">

   <div style="margin-bottom:50px;text-align:left">
      <img src="<?=$image_url;?>" width="150px">
   </div>
   <div style="margin-bottom:10px;text-align:right"><span style="font-size:18px">ALEA Consulta dietética</span><br>
      Astudillo Cabo C.B.<br>
      CIF: E37444429<br>
      Plaza Gabriel y Galán, 1, 1º Izda<br>
      37005 Salamanca</div>
   <table style="width:100%;max-width:700px;border:solid 1px #000066" cellpadding="5" border="1">
      <tbody>
         <tr>
            <td>Nº Factura</td>
            <td colspan="3"><?=$customer_invoice->getReferencia();?></td>
         </tr>
         <tr>
            <td>Fecha de Factura</td>
            <td colspan="3"><?=$customer_invoice->getFecha();?></td>
         </tr>
         <tr>
            <td>Concepto de Factura</td>
            <td colspan="3"><?=$customer_invoice->getConcepto();?></td>
         </tr>
         <tr>
            <td colspan="4" style="background-color:#000066"></td>
         </tr>
         <tr>
            <td>Nombre y apellidos</td>
            <td colspan="3"><?=$customer_invoice->getNombre()." ".$customer_invoice->getApellidos();?></td>
         </tr>
         <tr>
            <td>NIF</td>
            <td colspan="3"><?=$customer_invoice->getNif();?></td>
         </tr>
         <tr>
            <td>Dirección</td>
            <td colspan="3"><?=$customer_invoice->getDireccion();?></td>
         </tr>
         <tr>
            <td colspan="4" style="background-color:#000066"></td>
         </tr>
         <tr style="text-align:center">
            <td></td>
            <td>Precio ( € )</td>
            <td>IVA 0%</td>
            <td>Total ( € )</td>
         </tr>
         <tr style="text-align:center">
            <td></td>
            <td><?=$customer_invoice->getPrecio();?></td>
            <td><?=$customer_invoice->getIVA();?></td>
            <td><?=$customer_invoice->getTotal();?></td>
         </tr>
      </tbody>
   </table>
   <div style="margin-top:150px;font-size:9px">La información incluida en este e-mail es confidencial, siendo para uso exclusivo del destinatario arriba mencionado. Si Usted lee este mensaje y no es el destinatario indicado, le informamos de que está totalmente
      prohibida cualquier utilización, divulgación, distribución y/o reproducción de esta comunicación sin autorización expresa del remitente. Si ha recibido este mensaje por error, le rogamos nos lo notifique inmediatamente por esta misma vía y proceda a su eliminación.
      De acuerdo con lo establecido en la normativa vigente en materia de Protección de Datos de carácter personal, le informamos que ASTUDILLO CABO, C.B (ALEA CONSULTA DIETÉTICA) es el responsable del tratamiento de sus datos de carácter personal con la finalidad
      de gestionar los servicios y compromisos derivados de la relación contractual. La legitimación de este tratamiento de datos reside en la ejecución de un contrato de prestación de servicios, el consentimiento del interesado y el cumplimiento de una obligación
      legal. Los datos no serán cedidos a terceros, salvo obligación legal. Tiene derecho a acceder, rectificar y suprimir los datos, así como otros derechos reconocidos, tal y como se explica en nuestra Política de Privacidad que encontrará en
      <a href="https://www.aleaconsultadietetica.com/" title="ALEA CONSULTA DIETÉTICA" rel="noreferrer noreferrer" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.aleaconsultadietetica.com/&amp;source=gmail&amp;ust=1605983039370000&amp;usg=AOvVaw0BgOyT1pJLf_KJEuDhttGR">
         www.aleaconsultadietetica.com</a>
   </div>
</div>


</div>
<?php ?>
