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
    echo "you have called table operation (create)";
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
    echo "you have finished calling table operation (create)";
}


//inserting values
if($tableOperation == "makePlayer")
{
    echo "you have called table operation (makePlayer)";
    //it should auto increment and have a null value for team.
    $makeCmd = "INSERT into [dbo].[leaderboards] values ($name,0,0,0)";
    $makePlayer = sqlsrv_query($conn, $makeCmd);
    echo "you have finished calling table operation (makePlayer)";
}

if($tableOperation == "updateKill")
{
    //$tableOperation = ""
}

//delete table
if($tableOperation == "delete")
{
    echo "you have called table operation (delete)";
    $deleteCmd = "Drop Table [dbo].[leaderboards]";
    $delete = sqlsrv_query($conn,$deleteCmd);
    echo "you have finished calling table operation (delete)";
}


