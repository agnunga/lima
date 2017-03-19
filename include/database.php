<?php

//require_once './config.php';

class MySQLDatabase {

    private $connection;

    public function connect_to_db() {
        $this->connection = new mysqli(SERVER, USER, PWD, MY_DB);
        if (mysqli_connect_errno($this->connection)) {
            echo '<span class="my_error">Connection Failed ' . mysqli_connect_error($this->connection);
        }

        /* echo 'Host INFO' . $this->connection->host_info;
          echo 'Host INFO' . $this->connection->server_info;
          echo 'Host INFO' . $this->connection->server_version;
          echo '</span>'; */

        return $this->connection;
    }

    public function insert($q, $t, $d) {
        $mysqli = $this->connection;

        $params = array();
        $string_type = '';
        $n = count($t);
        if ($n > 0) {
            for ($i = 0; $i < $n; $i++) {
                $string_type.=$t[$i];
            }
            /* with call_user_func_array, array params must be passed by reference */
            $params[] = & $string_type;
            for ($i = 0; $i < $n; $i++) {
                /* with call_user_func_array, array params must be passed by reference */
                $params[] = & $d[$i];
            }
        }
//        echo 'Query...' . $q . '</br>';

        if ($stm = $mysqli->prepare($q)) {
            if ($n > 0) {
                /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
                call_user_func_array(array($stm, 'bind_param'), $params);
            }
        } else {
            trigger_error('FAILED TO PREPARE!!!! Wrong SQL: ' . $q . ' Error: ' . $this->connection->errno . ' ' . $this->connection->error, E_USER_ERROR);
        }
        try {
            $result = $stm->execute();
            if ($mysqli->affected_rows == 1) {
//                echo 'INSERTION SUCCESS';
            } else {
//                echo 'FAILED: ' . 
                echo $mysqli->error;
            }
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage() . ' ' . $mysqli->error;
        }

        return $result;
    }

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
        $stmt = $this->connection->prepare($query);
        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $stmt . ' and ' . $query . ' Error: ' . $this->connection->errno . ' ' . $this->connection->error, E_USER_ERROR);
        }

        /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
        if ($n > 0) {
            call_user_func_array(array($stmt, 'bind_param'), $a_params);
        }

        /* Execute statement */
        $result = $stmt->execute();

        return $result;
    }

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
        $stmt = $this->connection->prepare($query);
        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->connection->errno . ' ' . $this->connection->error, E_USER_ERROR);
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

    public function close_db() {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

}

$db = new MySQLDatabase();
$mysqli = $db->connect_to_db();
//$close_con=$db->close_db();
