<?php

/* * ************************************************************************
 *
 * Title:         'DBWrapper' (DBWrapper.class.php)
 * Description:   This class provide a connection handling via PDO to
 * a MySQL database with execution of all SQL commands.
 *
 * *********************************************************************** */

class DBWrapper {

    //-------------------------------------------------------------------------
    // Constructor
    //-------------------------------------------------------------------------
    public function DBWrapper() {
        // Include 'Config File'
        require_once UTIL . "ConfigReader.php";

        $configReader = new ConfigReader();
        $dbArr = $configReader->getDBConfig();
        $logPath = $configReader->getLogConfig();

        // Configure PDO attributes
        $this->confPDO = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Causes an exception to be thrown
            PDO::ATTR_PERSISTENT => false, // With TRUE persistent connection activated (connection not closed when script ends)
                //PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true    // With TRUE the buffered versions of the MySQL API will be used
        );

        // Establish connection
        try {
            $this->dbc = new PDO("mysql:host=$dbArr[URL];dbname=$dbArr[SCHEMA]", $dbArr['USER'], $dbArr['CRED'], $this->confPDO);
        } catch (PDOException $errMsg) {   // Error handling
            trigger_error($errMsg->getMessage() . ",E_USER_ERROR");
            exit(1);
            return false;
        }
    }

    //-------------------------------------------------------------------------
    // Exec
    //-------------------------------------------------------------------------
    // @param   $sql      [String => SQL statement]
    // @param   $params   [Array  => Parameter and values]
    public function exec($sql, array $params = array()) {
        // Check SQL
        try {
            $this->stmt = NULL;
            // Prepares SQL

            $this->stmt = $this->dbc->prepare($sql);
            // Bind (Function 'bind')
            if (count($params) > 0) {
                foreach ($params as $k => $v) {
                    $this->bind($k, $v);
                }
            }
            // Execute SQL
            // die();
            return $this->stmt->execute();
        } catch (PDOException $errMsg_) {
            throw $errMsg_;
        }
    }

    //-------------------------------------------------------------------------
    // Bind
    //-------------------------------------------------------------------------
    // @param   $param   [String => Parameter]
    // @param   $value   [Array  => Value]
    // @param   $type    [Array  => Type of the value]
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                // Boolen parameter
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                // Integer parameter
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                // Null parameter
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                // String parameter
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //-------------------------------------------------------------------------
    // Single value / row [SELECT]
    //-------------------------------------------------------------------------
    // @return   $result   [Value or Row => Result of select statement]
    public function single() {
        // Return result
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->closeStmt();
        return $row;
    }

    //-------------------------------------------------------------------------
    // Result set [SELECT]
    //-------------------------------------------------------------------------
    // @return   $result   [Array => Result of select statement]
    public function resultset() {
        // Return result
        $row = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->closeStmt();

        return $row;
    }

    //-------------------------------------------------------------------------
    // Row count
    //-------------------------------------------------------------------------
    // @return   $rows   [Integer => Number of rows in the result]
    public function rowCount() {
        // Return row count
        return $this->stmt->rowCount();
    }

    public function begin_Transaction() {
        $this->dbc->beginTransaction();
    }

    public function commit() {
        $this->dbc->commit();
    }

    public function rollback() {
        $this->dbc->rollback();
    }

    //-------------------------------------------------------------------------
    // Close statement object after every run
    //-------------------------------------------------------------------------
    // @return   Returns TRUE on success or FALSE on failure.
    public function closeStmt() {
        // Returns TRUE on success or FALSE on failure.
        return $this->stmt->closeCursor();
    }

}

// End class
?>
