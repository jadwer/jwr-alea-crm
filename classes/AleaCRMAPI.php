<?php
// add_action('rest_api_init', 'alea_crm_request_route');

// function alea_crm_request_route()
// {
//     register_rest_route(
//         'alea-crm',
//         'request',
//         array(
//             'methods' => 'GET',
//             'callback' => 'get_clients',
//         )
//     );
// }

// function get_clients()
// {
//     return wp_send_json(rest_ensure_response('Hello World! This is my first REST API'));
// }

namespace JWR;


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
        return wp_send_json(rest_ensure_response('Hello World! This is my first REST API: '. $data['id']));
    }
}
