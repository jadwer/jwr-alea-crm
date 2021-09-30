<?php

namespace JWR;
include_once "AleaModel.php";
use JWR\AleaModel;

class ALeaAPI
{

    /**
     * Register the routes for the objects of the controller.
     */
    public function register_routes()
    {
        $namespace = "alea-crm";

        register_rest_route(
            $namespace,
            'request/(?P<id>\d+)',
            array(
                'methods' => 'GET',
                'callback' => array($this, 'get_clients'),
                'permission_callback' => '__return_true'
            )
        );
        register_rest_route(
            $namespace,
            'request-detail',
            array(
                'methods' => 'GET',
                'callback' => array($this, 'get_clients'),
                'permission_callback' => '__return_true'
            )
        );
    }

    function get_clients($data)
    {
        $response = new AleaModel();
        return wp_send_json(rest_ensure_response($response->getAllCustomers()));
//        return wp_send_json(rest_ensure_response('Hello World! This is my first REST API: ' . $data['id']));
    }
}
