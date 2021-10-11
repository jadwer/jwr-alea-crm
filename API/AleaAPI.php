<?php

namespace JWR\Alea {

    //    include_once "AleaModel.php";

    use JWR\Alea\AleaModel;

    class ALeaAPI
    {
        public function __construct()
        {
            // var_dump('Success!');
        }

        /**
         * Register the routes for the objects of the controller.
         */
        public function register_routes()
        {
            $namespace = "alea-crm";

            // Endpoint to get all the customers info
            register_rest_route(
                $namespace,
                'customer/',
                array(
                    'methods' => 'GET',
                    'callback' => array($this, 'get_customersData'),
                    'permission_callback' => '__return_true'
                )
            );
            // Endpoint to get one customer info
            register_rest_route(
                $namespace,
                'customer/(?P<id>\d+)',
                array(
                    'methods' => 'GET',
                    'callback' => array($this, 'get_customersData'),
                    'permission_callback' => '__return_true'
                )
            );
            // to get a range starting from an specific result, with pagination porpouse
            register_rest_route(
                $namespace,
                'customer/(?P<start>\d+)/(?P<offset>\d+)',
                array(
                    'methods' => 'GET',
                    'callback' => array($this, 'get_customersData'),
                    'permission_callback' => '__return_true'
                )
            );
            // get the diet and info from an specific customer
            register_rest_route(
                $namespace,
                'customer-detail',
                array(
                    'methods' => 'GET',
                    'callback' => array($this, 'get_customersData'),
                    'permission_callback' => '__return_true'
                )
            );
            // get the diet and info from an specific customer
            register_rest_route(
                $namespace,
                'request-detail',
                array(
                    'methods' => 'POST',
                    'callback' => array($this, 'set_customer'),
                    'permission_callback' => '__return_true'
                )
            );

            // get the diet and info from an specific customer
            register_rest_route(
                $namespace,
                'send-status',
                array(
                    'methods' => 'POST',
                    'callback' => array($this, 'set_status'),
                    'permission_callback' => '__return_true'
                )
            );
        }

        function get_customersData(\WP_REST_Request $request)
        {
            $response = new AleaModel();
            if (empty($request->get_params())) {
                return wp_send_json(rest_ensure_response($response->getAllCustomers()));
            } else if ($request->get_param("id") != null) {
                return wp_send_json(rest_ensure_response($response->getCustomerData($request->get_param("id"))));
            } else if ($request->get_param("start") != null && $request->get_param("offset") != null) {
                return wp_send_json(rest_ensure_response($response->getCustomers($request->get_param('start'), $request->get_param('offset'))));
            }
        }
        function set_status(\WP_REST_Request $request)
        {
            $diet = new Dieta;
            if ($request->get_param("diet_id") != null) {
                $id = $request->get_param("diet_id");
                $dieta = $diet->getDietaById($id);
                if ($dieta->getEnviado() == 0) {
                    $diet->setEnviado(1);
                    $diet->save();
                }
                    return wp_send_json(rest_ensure_response(array('status' => $diet->getEnviado())));
            }
        }
    } // EOC

} // namespace
