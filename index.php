<?php
/**
 * Created by PhpStorm.
 * User: Jose Salinas and Ibook Eyoita and Earl Blizzard
 * Date: 2/6/17
 * Time: 6:09 PM
 */

//Connection to DB
$server = "tcp:koobi.database.windows.net,1433";
$connectionTimeoutSeconds = 30;
$connectionOptions = array("Database"=>"Game", "Uid"=>"koobi41e", "PWD"=>"Picollo1", "LoginTimeout" => $connectionTimeoutSeconds);
$conn = sqlsrv_connect($server,$connectionOptions);

//Strings to access from client side
$name = $_GET['name'];
$kills = $_GET['kills'];
$deaths = $_GET['deaths'];
$score = $_GET['score'];
$team = $_GET['team'];
$tableName = $_GET['TBName'];
$tableOperation = $_GET['operation'];

//testing to see if DB is connected
if($conn != true)
{
    echo "did not make a connection";
}
//else
//{
//    echo "connected to my DB";
//    echo "<br>";
//}

//creating the table
//create tables with TBName=nameOfTable
if($tableOperation == 'create')
{
    echo "you have called table operation and create";
    echo "<br>";
    $createCmd = "CREATE TABLE [dbo].[$tableName]
    (
      [Id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY, 
      [Name] VARCHAR(50) NOT NULL, 
      [Kills] INT NOT NULL, 
      [Deaths] INT NOT NULL, 
      [Scores] INT NOT NULL, 
      [Rounds] INT NOT NULL,
      [Team] INT
    )";
    $create = sqlsrv_query($conn, $createCmd);
    echo "you have finished calling table operation (create)";
}

if($tableOperation == "showData")
{
    $tsql = "SELECT * FROM $tableName";
    $getProducts = sqlsrv_query($conn, $tsql);
    if ($getProducts == FALSE)
    {
        die(FormatErrors(sqlsrv_errors()));
    }
    while( $row = sqlsrv_fetch_array( $getProducts, SQLSRV_FETCH_ASSOC ))
    {
        echo $row['Name']."|".$row['Kills']."|".$row['Deaths']."|".$row['Scores']."|".$row['Rounds']."|".$row['Team'].";";
    }
}

//inserting values
if($tableOperation == "makePlayer")
{
    echo "you have called table operation (makePlayer)";
    //it should auto increment and have a null value for team.
    $makeCmd = "INSERT into [dbo].[$tableName] values ('$name',0,0,0,0,null)";
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
    $deletePlayerCmd = "DELETE from [dbo].[$tableName] where name = '$name'";
    $deletePlayer = sqlsrv_query($conn, $deletePlayerCmd);
    echo "you have finished calling table operation (deletePlayer) \n";
}

//update the kill in the table
if($tableOperation == "updateKill")
{
    echo "you have called table operation (updateKill)";
    $killCmd = "UPDATE [dbo].[$tableName] set Kills = Kills+1 where Name = '$name'";
    $updateKill = sqlsrv_query($conn,$killCmd);
    echo "you have finished calling  table operation (updatingKill)";
}

//updating the death in the table
if($tableOperation == "updateDeath")
{
    echo "you have called table operation (updateDeath)";
    $deathCmd = "UPDATE [dbo].[$tableName] set Deaths = Deaths+1 where Name = '$name'";
    $updateDeath = sqlsrv_query($conn,$deathCmd);
    echo "you have finished calling  table operation (updatingDeath)";
}

//incrementing the score
if($tableOperation == "incScores")
{
    echo "you have called table operation (incScores)";
    $incCmd = "UPDATE [dbo].[$tableName] set Scores = Scores+1 where Name = '$name'";
    $incScores = sqlsrv_query($conn,$incCmd);
    echo "you have finished calling  table operation (incScores)";
}

//updating the score
if($tableOperation == "updateScore")
{
    echo "you have called table operation (updateScore)";
    echo "<br>";
    $updateCmd = "UPDATE [dbo].[$tableName] set Scores = Scores+ $score where Name = '$name'";
    $updateScore = sqlsrv_query($conn,$updateCmd);
    echo "you have finished calling table operation (updateScore)";
}

//set score
if($tableOperation == "setScore")
{
    echo "you have called table operation (setScore)";
    echo "<br>";
    $setScoreCmd = "UPDATE [dbo].[$tableName] set Scores = $score where Name = '$name'";
    $setScore = sqlsrv_query($conn,$setScoreCmd);
    echo "you have finished calling table operation (setScore)";
}

//incrementing the rounds
if($tableOperation == "incRounds")
{
    echo "you have called table operation (incRounds)";
    $incRoundCmd = "UPDATE [dbo].[$tableName] set Rounds = Rounds+1 where Name = '$name'";
    $incRounds = sqlsrv_query($conn,$incRoundCmd);
    echo "you have finished calling  table operation (incRound)";
}

//refresh after rounds
if($tableOperation == "roundRefresh")
{
    echo "you have called table operation (roundRefresh)";
    $roundRefreshCmd = "UPDATE [dbo].[$tableName] set Kills = 0 , Deaths = 0, Scores = 0 where Name = '$name'";
    $roundRefresh = sqlsrv_query($conn,$roundRefreshCmd);
    echo "you have finished calling  table operation (roundRefresh)";
}

//refresh after games
if($tableOperation == "gameRefresh")
{
    echo "you have called table operation (gameRefresh)";
    $gameRefreshCmd = "UPDATE [dbo].[$tableName] set Kills = 0 , Deaths = 0, Scores = 0, Rounds = 0 where Name = '$name'";
    $gameRefresh = sqlsrv_query($conn,$gameRefreshCmd);
    echo "you have finished calling  table operation (gameRefresh)";
}

//setting teams
if($tableOperation == "setTeam")
{
    echo "you have called table operation (setTeam)";
    echo "team is $team \n";
    if($team == 1)
    {
        echo "you entered in setTeam 2!!!";
        $set = "UPDATE [dbo].[$tableName] set Team = 1 where Name = '$name'";
        echo "<br>";
    }
    else if($team == 2)
    {
        echo "you entered in setTeam 2!!!";
        $set = "UPDATE [dbo].[$tableName] set Team = 2 where Name = '$name'";
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
    $deleteCmd = "Drop Table [dbo].[$tableName]";
    $delete = sqlsrv_query($conn,$deleteCmd);
    echo "you have finished calling table operation (delete)";
}

if($tableOperation == "highestScore")
{
    $maxScore = "SELECT Name, Scores FROM $tableName WHERE Scores = (Select max(Scores) From $tableName)";
    $getScore = sqlsrv_query($conn, $maxScore);
    while( $row = sqlsrv_fetch_array( $getScore, SQLSRV_FETCH_ASSOC ))
    {
        echo $row['Name']."|".$row['Scores']."|".";";

    }
}


