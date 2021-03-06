<?php

namespace JWR\Alea {

    // require_once "Utils.php";

    use JWR\Alea\Utils;

    /**
     * This is a general Model class
     */
    abstract class JwRObject
    {

        const TABLE_NAME = SELF::TABLE_NAME;
        const NUM_FIELDS = SELF::NUM_FIELDS;

        /**
         * Constructor: Defines the type of subconstructor will be used to create the customer
         * 
         * @param mixed
         */
        public function __construct()
        {
            $params = func_get_args();
            $num_params = func_num_args();

            if ($num_params == 1) {
                call_user_func_array(array($this, '__construct_array'), $params);
            } else if ($num_params == static::NUM_FIELDS) {
                call_user_func_array(array($this, '__construct_data'), $params);
            } else {
                call_user_func_array(array($this, '__construct_void'), $params);
            }
        }


        // Methods of use

        /**
         * 
         */

        /**
         * Convert the object to an associative array
         */

        public function getJoinedObjectsPaged($table1, $table2, $selected, $on1, $on2, $orderBy = null, $page, $rows)
        {
            $field = (isset($orderBy['field'])) ? Utils::escape($orderBy['field']) : 'id';
            $order = (isset($orderBy['order'])) ? Utils::escape($orderBy['order']) : 'DESC';
            global $wpdb;
            $page = ($page - 1) * $rows;
            $table_name1 = $wpdb->prefix . $table1;
            $table_name2 = $wpdb->prefix . $table2;

            $query = "SELECT {$selected} FROM {$table_name1} 
            INNER JOIN {$table_name2} 
            ON {$table_name1}.{$on1} = {$table_name2}.{$on2}
            ORDER BY {$field} {$order}
            limit {$page},{$rows};";

            $result = $wpdb->get_results($query, ARRAY_A);

            return $result;
        }

        protected static function getPaginatorPeriodData($table, $filter, $field, $startDate, $endDate, $limit)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT COUNT(*) as total 
                FROM {$table_name}
                WHERE ({$filter['field']} = {$filter['value']}) 
                AND ({$field} BETWEEN '{$startDate}' AND '{$endDate}');";

            $count = $wpdb->get_results($query)[0]->total;
            $numPags = $count / $limit;

            $data = array(
                'total' => $count,
                'num_pags' => ceil($numPags)
            );
            return $data;
        }

        protected static function getPaginatorData($table, $where, $limit)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT COUNT(*) as total 
                FROM {$table_name}
                {$where};";

            $count = $wpdb->get_results($query)[0]->total;
            $numPags = $count / $limit;

            $data = array(
                'total' => $count,
                'num_pags' => ceil($numPags)
            );
            return $data;
        }

        protected function getYears($table)
        {
            global $wpdb;
            $table_name1 = $wpdb->prefix . $table;

            $query = "SELECT DISTINCT(YEAR(fecha)) as `year` 
                        FROM jwr_alea_facturas 
                        WHERE YEAR(fecha)>2000  
                        ORDER BY (YEAR(fecha)) DESC 
                        LIMIT 100;";
            $result = $wpdb->get_results($query);

            return $result;
        }

        public function getJoinedObjectsByParamPaged($table1, $table2, $selected, $on1, $on2, $param, $orderBy = null)
        {
            $field = (isset($orderBy['field'])) ? Utils::escape($orderBy['field']) : 'id';
            $order = (isset($orderBy['order'])) ? Utils::escape($orderBy['order']) : 'DESC';
            $field_filter = (isset($param['field'])) ? Utils::escape($param['field']) : 'id';
            $value_filter = (isset($param['value'])) ? Utils::escape($param['value']) : 'id';

            global $wpdb;
            $table_name1 = $wpdb->prefix . $table1;
            $table_name2 = $wpdb->prefix . $table2;

            $query = "SELECT {$selected} FROM {$table_name1} 
            INNER JOIN {$table_name2} 
            ON {$table_name1}.{$on1} = {$table_name2}.{$on2}
            WHERE {$field_filter} = {$value_filter}
            ORDER BY {$field} {$order};";

            $result = $wpdb->get_results($query, ARRAY_A);

            return $result;
        }

        protected function getFirstObjectFiltered($table, $filter = array('field' => 'id', 'value' => '1'), $field = "id", $order = "DESC"){
            global $wpdb;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT * FROM {$table_name}
            WHERE {$filter['field']} = {$filter['value']}
            ORDER BY {$field} $order
            LIMIT 1";
            $result = $wpdb->get_results($query, ARRAY_A);
            return (isset($result[0])) ? $result[0] : array();
        }

        public function getObjectsPaged($table, $orderBy = null, $page, $rows)
        {
            $field = (isset($orderBy['field'])) ? Utils::escape($orderBy['field']) : 'id';
            $order = (isset($orderBy['order'])) ? Utils::escape($orderBy['order']) : 'DESC';
            global $wpdb;
            $page = ($page - 1) * $rows;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT * FROM {$table_name} 
            ORDER BY {$field} {$order}
            LIMIT {$page},{$rows};";
            $result = $wpdb->get_results($query, ARRAY_A);

            return $result;
        }

        public function getObjectById($table, $id)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . $table;
            $query = $wpdb->prepare("SELECT * FROM {$table_name} WHERE id= %d LIMIT 1", $id);
            $result = $wpdb->get_results($query, ARRAY_A);
            return (isset($result[0])) ? $result[0] : array();
        }
        public function getObjectsByField($table, $field, $value)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT * FROM {$table_name} WHERE {$field} = '{$value}';";
            $result = $wpdb->get_results($query, ARRAY_A);
            return $result;
        }
        public function getSumDataByPeriodFiltered($table, $sum, $field, $startDate, $endDate, $filter, $value)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . $table;

            $query = "SELECT SUM({$sum}) as sum FROM $table_name
                WHERE ({$filter} = {$value}) 
                AND ({$field} BETWEEN '{$startDate}' AND '{$endDate}');";
            $result = $wpdb->get_results($query);

            return $result[0]->sum;
        }
        public function getObjectsBetweenDates($table, $field, $startDate, $endDate)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT * FROM {$table_name}
            WHERE ({$field} BETWEEN '{$startDate}' AND '{$endDate}') 
            ORDER BY id DESC;";
            $result = $wpdb->get_results($query, ARRAY_A);


            return $result;
        }
        public function getObjectsBetweenDatesFiltered($table, $field, $startDate, $endDate, $filter, $value)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT * FROM {$table_name} 
            WHERE ({$filter} = {$value}) 
            AND ({$field} BETWEEN '{$startDate}' AND '{$endDate}') 
            ORDER BY id DESC;";
            $result = $wpdb->get_results($query, ARRAY_A);

            return $result;
        }
        public function getObjectsBetweenDatesFilteredPaged($table, $field, $startDate, $endDate, $filter, $value, $page, $rows)
        {
            global $wpdb;
            $page = ($page - 1) * $rows;
            $table_name = $wpdb->prefix . $table;
            $query = "SELECT * FROM {$table_name} 
            WHERE ({$filter} = {$value}) 
            AND ({$field} BETWEEN '{$startDate}' AND '{$endDate}')
            ORDER BY id DESC
            LIMIT {$page},{$rows};";
            $result = $wpdb->get_results($query, ARRAY_A);

            return $result;
        }
        abstract public function toArray();

        abstract public function save();

        protected function setObject($data, $table)
        {
            global $wpdb;

            $table_name = $wpdb->prefix . $table;
            if (isset($data['id']) && $data["id"] == null) {
                unset($data["id"]);
            }
            $wpdb->replace($table_name, $data);
            // echo $wpdb->last_query;
            // echo $wpdb->last_error;
            return $wpdb->insert_id;
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
    } // EOC
}// namespace
