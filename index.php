<?php
/**
 * Created by PhpStorm.
 * User: Jose Salinas
 * Date: 2/6/17
 * Time: 6:09 PM
 */

//Connection to DB
$server = "tcp:gaminggroup.database.windows.net,1433";
$connectionTimeoutSeconds = 30;
$connectionOptions = array("Database"=>"Game", "Uid"=>"salinasj14", "PWD"=>"Eastcarolina14", "LoginTimeout" => $connectionTimeoutSeconds);
$conn = sqlsrv_connect($server,$connectionOptions);

//Strings to access from client side
$name = $_GET['name'];
$kills = $_GET['kills'];
$deaths = $_GET['deaths'];
$score = $_GET['score'];
$team = $_GET['team'];
$tableOperation = $_GET['operation'];

//testing to see if DB is connected
if($conn != true)
{
    echo "did not make a connection";
}
//else
//{
  //  echo "connected to my DB";
   // echo "<br>";
//}

//creating the table

//if($tableOperation == 'create')
//{
    //echo "you have called table operation and create";
    //echo "<br>";
    $createCmd = "CREATE TABLE [dbo].[leaderboards]
    (
	  [Id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY, 
      [Name] VARCHAR(50) NOT NULL, 
      [Kills] INT NOT NULL, 
      [Deaths] INT NOT NULL, 
      [Scores] INT NOT NULL, 
      [Team] INT
    )";
    $create = sqlsrv_query($conn, $createCmd);
   //echo "you have finished calling table operation (create)";
//}

// Koobi's code'
/*
$stmt = "select * from [dbo].[leaderboards]";
$result = sqlsrv_query($conn, $stmt);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
{
    //print_r($row);
    //echo"<br />";
    //print "<tr>\n";
    echo "<br>";
    echo $row['Name'].", ".$row['Kills'].", ".$row['Deaths'].", ".$row['Scores'].", ".$row['Team']."<br />";
    echo "<br>";
}
*/

// My code

$tsql = "SELECT * FROM leaderboards";
$getProducts = sqlsrv_query($conn, $tsql);
if ($getProducts == FALSE)
{
    die(FormatErrors(sqlsrv_errors()));
}
$productCount = 0;
$ctr = 0;
$counter = 0;
/*
    echo "<br>";
    echo "Id Name Kills Deaths Scores Team ";
    "<br />";
    echo "<br>";
*/
while( $row = sqlsrv_fetch_array( $getProducts, SQLSRV_FETCH_ASSOC ))
{
    echo "Name"."=".$row['Name']."|"."Kills"."=".$row['Kills']."|"
        ."Deaths"."=".$row['Deaths']."|"."Scores"."=".$row['Scores']."|"."Team". "=".$row['Team'].";";
}


/*
// Code for Earl
$tsql = "SELECT * FROM leaderboards";
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
*/

//inserting values
if($tableOperation == "makePlayer")
{
    echo "you have called table operation (makePlayer)";
    //it should auto increment and have a null value for team.
    $makeCmd = "INSERT into [dbo].[leaderboards] values ('$name',0,0,0,null)";
    $makePlayer = sqlsrv_query($conn, $makeCmd);
    echo "you have finished calling table operation (makePlayer) \n";
    echo "name is $name";
}

//removing a player from the database

if($tableOperation == "deletePlayer")
{
    echo "about to check delete player";
    echo "<br>";
    echo "you have called table operation (deletePlayer)";
    $deletePlayerCmd = "DELETE from [dbo].[leaderboards] where name = '$name'";
    $deletePlayer = sqlsrv_query($conn, $deletePlayerCmd);
    echo "you have finished calling table operation (deletePlayer) \n";
}

//update the kill in the table
if($tableOperation == "updateKill")
{
    echo "you have called table operation (updateKill)";
    $killCmd = "UPDATE [dbo].[leaderboards] set Kills = Kills+1 where Name = '$name'";
    $updateKill = sqlsrv_query($conn,$killCmd);
    echo "you have finished calling  table operation (updatingKill)";
}

//updating the death in the table
if($tableOperation == "updateDeath")
{
    echo "you have called table operation (updateDeath)";
    $deathCmd = "UPDATE [dbo].[leaderboards] set Deaths = Deaths+1 where Name = '$name'";
    $updateDeath = sqlsrv_query($conn,$deathCmd);
    echo "you have finished calling  table operation (updatingDeath)";
}

//incrementing the score
if($tableOperation == "incScores")
{
    echo "you have called table operation (incScores)";
    $incCmd = "UPDATE [dbo].[leaderboards] set Scores = Scores+1 where Name = '$name'";
    $incScores = sqlsrv_query($conn,$incCmd);
    echo "you have finished calling  table operation (incScores)";
}

//setting teams
if($tableOperation == "setTeam")
{
    echo "you have called table operation (setTeam)";
    echo "team is $team \n";
    if($team == 1)
    {
        echo "you entered in setTeam 2!!!";
        $set = "UPDATE [dbo].[leaderboards] set Team = 1 where Name = '$name'";
        echo "<br>";
    }
    else if($team == 2)
    {
        echo "you entered in setTeam 2!!!";
        $set = "UPDATE [dbo].[leaderboards] set Team = 2 where Name = '$name'";
        echo "<br>";
    }
    $setTeam = sqlsrv_query($conn,$set);
    echo "you have finished calling  table operation (setTeam)";
    echo "<br>";
}

//delete table
if($tableOperation == "deleteTable")
{
    echo "you have called table operation (delete)";
    $deleteCmd = "Drop Table [dbo].[leaderboards]";
    $delete = sqlsrv_query($conn,$deleteCmd);
    echo "you have finished calling table operation (delete)";
}



