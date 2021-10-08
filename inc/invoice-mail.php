<?php 
function createBodyMail($customer_invoice){

    $html = '
    <div style="width: 100%; max-width: 700px; text-align: justify; color: #000; margin-top: 50px; font-size: 14px">
        <div style="margin-bottom: 15px">¡Hola, '.$customer_invoice->getNombre().'!</div>
        <div style="margin-bottom: 15px">Te damos la bienvenida a ALEA Consulta dietética en su versión online.</div>
        <div style="margin-bottom: 15px">Al final de este correo encontrarás tu factura de hoy, pero antes queríamos agradecerte la confianza depositada en nosotros :)</div>
        <div style="margin-bottom: 15px">En las próximas horas comenzaremos a trabajar en tu primera dieta y como mucho en tres días laborables la enviaremos a tu email.</div>
        <div style="margin-bottom: 15px">Puedes escribirnos siempre que necesites para preguntarnos tus dudas, será un placer echarte una mano.</div>
        <div style="margin-bottom: 15px">Si tienes tiempo te animamos a visitar <a style="color: #7193c1" href="http://www.elblogdeladietaequilibrada.com/" title="El Blog de la Dieta Equilibrada" target="_blank" rel="noreferrer">nuestro blog</a> de nutrición y recetas: uno de los más completos y visitados en castellano.</div>
        <div style="margin-bottom: 15px">¡Gracias y hasta pronto!</div>
        <div style="margin-bottom: 50px">Saludos de todo el equipo de ALEA.</div>
        <div style="margin-bottom: 15px; text-align: right"><span style="font-size: 18px">ALEA Consulta dietética</span><br>Astudillo Cabo C.B.<br>CIF: E37444429<br>Plaza Gabriel y Galán, 1, 1º Izda<br>37005 Salamanca</div>
        <table border="1" cellpadding="5" style="width: 100%; max-width: 700px; border: solid 1px #000066">
            <tbody>
                <tr>
                    <td>Nº Factura</td>
                    <td colspan="3">'.$customer_invoice->getReferencia().'</td>
                </tr>
                <tr>
                    <td>Fecha de Factura</td>
                    <td colspan="3">'.$customer_invoice->getFecha().'</td>
                </tr>
                <tr>
                    <td>Concepto de Factura</td>
                    <td colspan="3">'.$customer_invoice->getConcepto().'</td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color: #000066"></td>
                </tr>
                <tr>
                    <td>Nombre y apellidos</td>
                    <td colspan="3">'.$customer_invoice->getNombre().''.$customer_invoice->getApellidos().'</td>
                </tr>
                <tr>
                    <td>NIF</td>
                    <td colspan="3">'.$customer_invoice->getNif().'</td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td colspan="3">'.$customer_invoice->getCalle().'</td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color: #000066"></td>
                </tr>
                <tr style="text-align: center">
                    <td>Concepto</td>
                    <td>Precio ( € )</td>
                    <td>IVA 0%</td>
                    <td>Total ( € )</td>
                </tr>
                <tr style="text-align: center">
                    <td>Dieta</td>
                    <td>'.$customer_invoice->getPrecio().'</td>
                    <td>'.$customer_invoice->getIVA().'</td>
                    <td>'.$customer_invoice->getTotal().'</td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top: 100px; font-size: 9px">La información incluida en este e-mail es confidencial, siendo para uso exclusivo del destinatario arriba mencionado. Si Usted lee este mensaje y no es el destinatario indicado, le informamos de que está totalmente prohibida cualquier utilización, divulgación, distribución y/o reproducción de esta comunicación sin autorización expresa del remitente. Si ha recibido este mensaje por error, le rogamos nos lo notifique inmediatamente por esta misma vía y proceda a su eliminación. De acuerdo con lo establecido en la normativa vigente en materia de Protección de Datos de carácter personal, le informamos que ASTUDILLO CABO, C.B (ALEA CONSULTA DIETÉTICA) es el responsable del tratamiento de sus datos de carácter personal con la finalidad de gestionar los servicios y compromisos derivados de la relación contractual. La legitimación de este tratamiento de datos reside en la ejecución de un contrato de prestación de servicios, el consentimiento del interesado y el cumplimiento de una obligación legal. Los datos no serán cedidos a terceros, salvo obligación legal. Tiene derecho a acceder, rectificar y suprimir los datos, así como otros derechos reconocidos, tal y como se explica en nuestra Política de Privacidad que encontrará en <a href="https://www.aleaconsultadietetica.com/" title="ALEA CONSULTA DIETÉTICA" target="_blank" rel="noreferrer">www.aleaconsultadietetica.com</a></div>
    </div>';
    return $html;
};
