<?php

namespace JWR {

    require_once "Utils.php";

    use JWR\Utils;

    /**
     * This is a general Model class
     */
    abstract class JwRObject
    {

        /**
         * Constructor: Defines the type of subconstructor will be used to create the customer
         * 
         * @param mixed
         */
        abstract public function __construct();


        // Methods of use

        /**
         * 
         */
        abstract public function save();

        protected function setObject($table)
        {
            global $wpdb;

            $table_name = $wpdb->prefix . $table;
            $data = get_object_vars($this);
            if ($data["id"] == null) {
                unset($data["id"]);
            }
            $wpdb->insert($table_name, $data);
            echo $wpdb->insert_id;
        }


        // Getters and Setters
        // subconstructors

        /**
         * Create a new customer object from an array with params
         * 
         * @param array 
         * 
         */
        abstract protected function __construct_array($data);

        /**
         * Create a new customer object from an params
         * 
         * @param mixed 
         * 
         */
        abstract protected function __construct_data();


        /**
         * Create a new void customer object
         * 
         * @param array 
         * 
         */
        abstract protected function __construct_void();



        /**
         * Create and migrate the table alea_clientes for the customers data
         */
        public static function createTable($table, $query)
        {
            global $wpdb;

            $table_name = $wpdb->prefix . $table;

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                $wpdb->query($query);
            }
        }

        public static function migrateTable($newTable, $database, $oldTable)
        {
            global $wpdb;

            $table_name = $wpdb->prefix . $newTable;

            if ($wpdb->get_var("SHOW TABLES LIKE '" . $oldTable . "'") == $oldTable) {

                $query = "INSERT INTO $table_name SELECT * FROM `" . $database . "`.`" . $oldTable . "`;";
                $wpdb->query($query);
            }
        }

        public static function deleteTable($table)
        {
            global $wpdb;

            $table_name = $wpdb->prefix . $table;
            $query = "DROP TABLE {$table_name};";
            $wpdb->query($query);
        }
    }
}