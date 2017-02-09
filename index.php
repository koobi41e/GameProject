<?php
/**
 * Created by PhpStorm.
 * User: Ibook
 * Date: 2/6/17
 * Time: 6:09 PM
 */

//Connection to DB
$server = "tcp:gaminggroup.database.windows.net,1433";
$connectionTimeoutSeconds = 30;
$connectionOptions = array("Database"=>"Game", "Uid"=>"salinasj14", "PWD"=>"Eastcarolina14", "LoginTimeout" => $connectionTimeoutSeconds);
//$connectionOptions = array("Database"=>"Game", "Uid"=>"koobi41e", "PWD"=>"Picollo1", "LoginTimeout" => $connectionTimeoutSeconds);
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
    echo "<br>";
}

//creating the table

if($tableOperation == 'create')
{
    echo "you have called table operation and create";
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
    $makeCmd = "INSERT into [dbo].[leaderboards] values ('$name',0,0,0,null)";
    $makePlayer = sqlsrv_query($conn, $makeCmd);
    echo "you have finished calling table operation (makePlayer) \n";
    echo "name is $name";
}

//removing a player from the database
//there is an error somewhere here. It wont go inside the if stmt
echo "about to check delete player";
echo "<br>";
if($tableOperation == "deletePlayer")
{
    echo "you have called table operation (deletePlayer)";
    $deletePlayerCmd = "DELETE from [dbo].[leaderboards] where name = '$name'";
    $deletePlayer = sqlsrv_query($conn, $deletePlayerCmd);
    echo "you have finished calling table operation (deletePlayer) \n";
}

echo "about to check remove player";
echo "<br>";
if($tableOperation == "removePlayer")
{
    echo "you have called table operation (removePlayer)";
    $removeCmd = "DELETE from [dbo].[leaderboards] where name = '$name'";
    $removePlayer = sqlsrv_query($conn,$removeCmd);
    echo "you have finished calling  table operation (removePlayer)";
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
        $set = "UPDATE [dbo].[leaderboards] set Team = 1 where Name = '$name'";
    }
    else if($team == 2)
    {
        echo "you entered in setTeam 2!!!";
        $set = "UPDATE [dbo].[leaderboards] set Team = 2 where Name = '$name'";
    }
    $setTeam = sqlsrv_query($conn,$set);
    echo "you have finished calling  table operation (setTeam)";
}

//delete table
if($tableOperation == "deleteTable")
{
    echo "you have called table operation (delete)";
    $deleteCmd = "Drop Table [dbo].[leaderboards]";
    $delete = sqlsrv_query($conn,$deleteCmd);
    echo "you have finished calling table operation (delete)";
}



