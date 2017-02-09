<?php
/**
 * Created by PhpStorm.
 * User: Ibook
 * Date: 2/6/17
 * Time: 6:09 PM
 */

//Connection to DB
$server = "tcp:koobi.database.windows.net,1433";
$connectionTimeoutSeconds = 30;
//$connectionOptions = array("Database"=>"Game", "Uid"=>"salinasj14", "PWD"=>"Eastcarolina14", "LoginTimeout" => $connectionTimeoutSeconds);
$connectionOptions = array("Database"=>"Game", "Uid"=>"koobi41e", "PWD"=>"Picollo1", "LoginTimeout" => $connectionTimeoutSeconds);
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
else
{
    echo "connected to my DB";
}

//creating the table
if($tableOperation == "create")
{
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
}


//inserting values
if($tableOperation == "makePlayer")
{
    //it should auto increment and have a null value for team.
    $makeCmd = "INSERT into [dbo].[leaderboards] values ('$name',0,0,0,null)";
    $makePlayer = sqlsrv_query($conn, $makeCmd);
}

//removing a player from the database
if($tableOperation == "deletePlayer")
{
    $deletePlayerCmd = "DELETE from [dbo].[leaderboards] where name = '$name'";
    $deletePlayer = sqlsrv_query($conn, $deletePlayerCmd);
}

//update the kill in the table
if($tableOperation == "updateKill")
{
    $killCmd = "UPDATE [dbo].[leaderboards] set Kills = Kills+1 where Name = '$name'";
    $updateKill = sqlsrv_query($conn,$killCmd);
}

//updating the death in the table
if($tableOperation == "updateDeath")
{
    $deathCmd = "UPDATE [dbo].[leaderboards] set Deaths = Deaths+1 where Name = '$name'";
    $updateDeath = sqlsrv_query($conn,$deathCmd);
}

//incrementing the score.
if($tableOperation == "incScores")
{
    $incCmd = "UPDATE [dbo].[leaderboards] set Scores = Scores+1 where Name = '$name'";
    $incScores = sqlsrv_query($conn,$incCmd);
}

//setting teams
if($tableOperation == "setTeam")
{
    if($team == 1)
    {
        $set = "UPDATE [dbo].[leaderboards] set Team = 1 where Name = '$name'";
    }
    else if($team == 2)
    {
        $set = "UPDATE [dbo].[leaderboards] set Team = 2 where Name = '$name'";
    }
    $setTeam = sqlsrv_query($conn,$set);
}
//delete table
if($tableOperation == "deleteTable")
{
    $deleteCmd = "Drop Table [dbo].[leaderboards]";
    $delete = sqlsrv_query($conn,$deleteCmd);
}

if($tableOperation == "showRows")
{
    $stmt = "select name,kills,deaths,scores,team from [dbo].[leaderboards]";
    $result = sqlsrv_query($conn, $stmt);
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
    {
        //print_r($row);
        //echo"<br />";
        //print "<tr>\n";
        echo "<br>";
        echo $row['Name'].", ".$row['Kills'].", ".$row['Deaths']. ", ".$row['Scores'].", ".$row['Team'];
        echo "<br>";
    }
    sqlsrv_free_stmt($result);
}

