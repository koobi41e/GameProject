<?php
/**
 * Created by PhpStorm.
 * User: josesalinas
 * Date: 2/6/17
 * Time: 9:35 AM
 */
// Variables to tune the retry logic.
$connectionTimeoutSeconds = 30;  // Default of 15 seconds is too short over the Internet, sometimes.
$maxCountTriesConnectAndQuery = 3;  // You can adjust the various retry count values.
$secondsBetweenRetries = 4;  // Simple retry strategy.
$errNo = 0;
$serverName = "tcp:gaminggroup.database.windows.net,1433";
$connectionOptions = array("Database"=>"***",
    "Uid"=>"***", "PWD"=>"***", "LoginTimeout" => $connectionTimeoutSeconds);
$conn;
$errorArr = array();
$name = $_GET['name'];
echo $name;
for ($cc = 1; $cc <= $maxCountTriesConnectAndQuery; $cc++)
{
    $errorArr = array();
    $ctr = 0;
    // [A.2] Connect, which proceeds to issue a query command.
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if($conn == true)
    {
        echo "Connection was established";
        echo "<br>";

        $tsql = "SELECT * FROM Scores";
        $getProducts = sqlsrv_query($conn, $tsql);
        if ($getProducts == FALSE)
        {
            die(FormatErrors(sqlsrv_errors()));
        }
        $productCount = 0;
        $ctr = 0;
        $counter = 0;
        while( $row = sqlsrv_fetch_array( $getProducts, SQLSRV_FETCH_ASSOC ))
        {
            print_r($row);
        }
        sqlsrv_free_stmt($getProducts);
        break;
    }
    // Adds any the error codes from the SQL Exception to an array.
    else {
        if( ($errors = sqlsrv_errors() ) != null)
        {
            foreach( $errors as $error )
            {
                $errorArr[$ctr] = $error['code'];
                $ctr = $ctr + 1;
            }
        }
        $isTransientError = TRUE;
        // [A.4] Check whether sqlExc.Number is on the whitelist of transients.
        $isTransientError = IsTransientStatic($errorArr);
        if ($isTransientError == TRUE)  // Is a static persistent error...
        {
            echo("Persistent error suffered, SqlException.Number==". $errorArr[0].". Program Will terminate.");
            echo "<br>";
            // [A.5] Either the connection attempt or the query command attempt suffered a persistent SqlException.
            // Break the loop, let the hopeless program end.
            exit(0);
        }
        // [A.6] The SqlException identified a transient error from an attempt to issue a query command.
        // So let this method reloop and try again. However, we recommend that the new query
        // attempt should start at the beginning and establish a new connection.
        if ($cc >= $maxCountTriesConnectAndQuery)
        {
            echo "Transient errors suffered in too many retries - " . $cc ." Program will terminate.";
            echo "<br>";
            exit(0);
        }
        echo("Transient error encountered.  SqlException.Number==". $errorArr[0]. " . Program might retry by itself.");
        echo "<br>";
        echo $cc . " Attempts so far. Might retry.";
        echo "<br>";
        // A very simple retry strategy, a brief pause before looping. This could be changed to exponential if you want.
        sleep(1*$secondsBetweenRetries);
    }
    // [A.3] All has gone well, so let the program end.
}
function IsTransientStatic($errorArr) {
    $arrayOfTransientErrorNumber = array(4060, 10928, 10929, 40197, 40501, 40613);
    $result = array_intersect($arrayOfTransientErrorNumber, $errorArr);
    $count = count($result);
    if($count >= 0) //change to > 0 later.
        return TRUE;
}
?>
