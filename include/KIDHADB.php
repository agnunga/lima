<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author Daniel
 */
if (!class_exists('Database_Class')) {

    class Database_Class {

        private $_connection;

        /**
         * Creating the constructor to establish the connection to the database...
         */
        public function __construct() {
            define("HOST", 'localhost');
            define("USER", 'root');
            define("PASS", 'password');
            define("DATABASE", 'cms');

            $mysqli = new mysqli(HOST, USER, PASS, DATABASE);
            if ($mysqli->connect_errno) {
                printf("Connectio to the database failed %s\n", $mysqli->connect_errno);
                exit();
            }

            $this->_connection = $mysqli;
        }

        /**
         * 
         * @param type $query
         * @return type
         * function to  run insert query for inserting data into the database
         */
        public function insert($query, $a_param_type, $param_value) {

            $a_params = array();
            $param_type = '';
            $n = count($a_param_type);
            if ($n > 0) {
                for ($i = 0; $i < $n; $i++) {
                    $param_type .= $a_param_type[$i];
                }

                /* with call_user_func_array, array params must be passed by reference */
                $a_params[] = & $param_type;

                for ($i = 0; $i < $n; $i++) {
                    /* with call_user_func_array, array params must be passed by reference */
                    $a_params[] = & $param_value[$i];
                }
            }
            /* Prepare statement */
            $stmt = $this->_connection->prepare($query);
            if ($stmt === false) {
                trigger_error('Wrong SQL: ' . $stmt . ' Error: ' . $this->_connection->errno . ' ' . $this->_connection->error, E_USER_ERROR);
            }

            /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
            if ($n > 0) {
                call_user_func_array(array($stmt, 'bind_param'), $a_params);
            }

            /* Execute statement */
            $result = $stmt->execute();

            return $result;
        }

        /**
         * 
         * @param type $query
         * @return type
         * function to  run update query for udating data  in the database
         */
        public function update($query, $a_param_type, $param_value) {
            $a_params = array();
            $param_type = '';
            $n = count($a_param_type);
            if ($n > 0) {
                for ($i = 0; $i < $n; $i++) {
                    $param_type .= $a_param_type[$i];
                }

                /* with call_user_func_array, array params must be passed by reference */
                $a_params[] = & $param_type;

                for ($i = 0; $i < $n; $i++) {
                    /* with call_user_func_array, array params must be passed by reference */
                    $a_params[] = & $param_value[$i];
                }
            }
            /* Prepare statement */
            $stmt = $this->_connection->prepare($query);
            if ($stmt === false) {
                trigger_error('Wrong SQL: ' . $stmt . ' Error: ' . $this->_connection->errno . ' ' . $this->_connection->error, E_USER_ERROR);
            }

            /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
            if ($n > 0) {
                call_user_func_array(array($stmt, 'bind_param'), $a_params);
            }

            /* Execute statement */
            $result = $stmt->execute();

            return $result;
        }

        /**
         * 
         * @param type $query
         * @return type
         * function to  run select query for selecting  from  the database
         */
        public function select($query, $a_param_type, $param_value) {
            $parameters = array();
            $results = array();

            $a_params = array();
            $param_type = '';
            $n = count($a_param_type);
            if ($n > 0) {
                for ($i = 0; $i < $n; $i++) {
                    $param_type .= $a_param_type[$i];
                }

                /* with call_user_func_array, array params must be passed by reference */
                $a_params[] = & $param_type;

                for ($i = 0; $i < $n; $i++) {
                    /* with call_user_func_array, array params must be passed by reference */
                    $a_params[] = & $param_value[$i];
                }
            }
            /* Prepare statement */
            $stmt = $this->_connection->prepare($query);
            if ($stmt === false) {
                trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_connection->errno . ' ' . $this->_connection->error, E_USER_ERROR);
            }

            /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
            if ($n > 0) {
                call_user_func_array(array($stmt, 'bind_param'), $a_params);
            }

            $stmt->execute();

            //Dynamically get the field names for binding the results...
            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }

            call_user_func_array(array($stmt, 'bind_result'), $parameters);

            if (!$stmt) {
                return FALSE;
            }

            while ($stmt->fetch()) {
                $x = array();
                foreach ($row as $key => $value) {
                    $x[$key] = $value;
                }
                $results[] = $x;
            }

            return $results;
        }

        /**
         * Declaring default clone to prevent cloning of the database object..
         */
        private function __clone() {
            
        }

    }

}
/**
 * Creating an instance of the databse class to be returned by the class
 */
//$db = new Database_Class();
