<?php
    /**
     * config.php
     * Contains configuration data for the web-playable implementation of the Milles-Bornes card game, including but not
     * limited to SQL connection information, refresh rates, etc.
     */

    define("SQL_SERVER", "localhost"); // the SQL server address
    define("SQL_USER", "mb-game"); // the SQL server username
    define("SQL_PASS", "tbd"); // the SQL server password
    define("SQL_DB", "mille-bornes"); // the SQL server database
    $SQL_CXN = new mysqli(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
    if ($SQL_CXN->connect_errno) {
        // the connection failed
        echo "The connection to the SQL server has failed.";
        exit;
    }

    define("REFRESH_RATE", 2); // the rate at which the game queries the server for updated information, in seconds

?>