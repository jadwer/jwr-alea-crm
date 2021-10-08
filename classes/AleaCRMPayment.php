<?php

namespace JWR\Alea {

    include WP_PLUGIN_DIR . '/jwr-alea-crm/inc/apiRedsys.php';

    class AleaCRMPayment
    {
        const VERSION = "HMAC_SHA256_V1";
        const KC = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
        const ACTION_URL = "https://sis-t.redsys.es:25443/sis/realizarPago";

        private $fuc;
        private $terminal;
        private $moneda;
        private $trans;
        private $url;
        private $urlOKKO;
        private $id;
        private $amount;
        private $description;

        public function __construct()
        {
            $params = func_get_args();
            $num_params = func_num_args();

            if ($num_params == 5) {
                call_user_func_array(array($this, '__construct_data'), $params);
            } else {
                call_user_func_array(array($this, '__construct_void'), $params);
            }
        }


        public function __construct_data($fuc, $terminal, $moneda, $trans, $urlOKKO)
        {
            $this->fuc = $fuc;
            $this->terminal = $terminal;
            $this->moneda = $moneda;
            $this->trans = $trans;
            $this->url = "";
            $this->urlOKKO = $urlOKKO;
            $this->id = 0;
            $this->amount = 0;
            $this->description = '';
        }

        public function __construct_void()
        {
            $this->fuc = '';
            $this->terminal = '';
            $this->moneda = '';
            $this->trans = '';
            $this->url = '';
            $this->urlOKKO = '';
            $this->id = 0;
            $this->amount = 0;
            $this->description = '';
        }

        public function pay_data($id, $amount, $description)
        {
            $this->id = $id;
            $this->amount = $amount;
            $this->description = $description;
        }

        public function request_pay($formData)
        {
            $encoded = $this->configure_request($formData);
?>
            <h2>Estamos procesando tu solicitud. ¡Gracias por confiar en nosotros!</h2>
            <form id="payment_request" name="payment_request" action="<?= SELF::ACTION_URL; ?>" method="POST">
                <input type="hidden" name="Ds_SignatureVersion" value="<?= SELF::VERSION ?>" /></br>
                <input type="hidden" name="Ds_MerchantParameters" value="<?php echo $encoded['params']; ?>" /></br>
                <input type="hidden" name="Ds_Signature" value="<?php echo $encoded['signature']; ?>" /></br>
            </form>
            <script type="text/javascript">
                document.getElementById('payment_request').submit();
            </script>
<?PHP
        }

        private function configure_request($formData)
        {
            $miObj = new \RedsysAPI;

            $miObj->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $this->description);
            $miObj->setParameter("DS_MERCHANT_AMOUNT", $this->amount);
            $miObj->setParameter("DS_MERCHANT_MERCHANTDATA", $formData);
            $miObj->setParameter("DS_MERCHANT_ORDER", ($this->id == 0) ? time() : $this->id);

            $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $this->fuc);
            $miObj->setParameter("DS_MERCHANT_CURRENCY", $this->moneda);
            $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $this->trans);
            $miObj->setParameter("DS_MERCHANT_TERMINAL", $this->terminal);
            $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $this->url);
            $miObj->setParameter("DS_MERCHANT_URLOK", $this->urlOKKO);
            $miObj->setParameter("DS_MERCHANT_URLKO", $this->urlOKKO);

            $encoded = array(
                'request' => '',
                'params' => $miObj->createMerchantParameters(),
                'signature' => $miObj->createMerchantSignature(SELF::KC)
            );
            return $encoded;
        }

        public function get_response()
        {
            $miObj = new \RedsysAPI;

            $response = array(
                'decodec' => '',
                'firma' => '',
                'OK' => null
            );
            if (!empty($_POST)) { //URL DE RESP. ONLINE

                $datos = $_POST["Ds_MerchantParameters"];
                $signatureRecibida = $_POST["Ds_Signature"];


                $response['decodec'] = json_decode($miObj->decodeMerchantParameters($datos), true);
                $response['firma'] = $miObj->createMerchantSignatureNotif(SELF::KC, $datos);
            } else {
                if (!empty($_GET)) { //URL DE RESP. ONLINE
                    $datos = $_GET["Ds_MerchantParameters"];
                    $signatureRecibida = $_GET["Ds_Signature"];


                    $response['decodec'] = json_decode($miObj->decodeMerchantParameters($datos), true);

                    $response['firma'] = $miObj->createMerchantSignatureNotif(SELF::KC, $datos);
                }
                if ($response['firma'] === $signatureRecibida) {
                    $response['OK'] = true;
                } else {
                    $response['OK'] = false;
                }
            }
            return $response;
        }
    } // EOC
} // namespace
