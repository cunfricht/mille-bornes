<?php
    /**
     * init-setup.php
     * Contains the initial setup for the Mille-Bornes SQL database.
     * In the event that the table already exists, the script will terminate without reinitializing the database.
     */

    require_once("config.php");
    $checkForTables = $SQL_CXN->query("SHOW TABLES LIKE `games`");
    if($checkForTables->num_rows < 1) {
        echo "The database has already been initialized.";
        exit;
    }

    // creates the table to hold game data
    $createGamesQuery = "CREATE TABLE `games` ("
        . "`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`host_pid` INT(6) UNSIGNED,"
        . "`goal` INT(4) UNSIGNED,"
        . "`active` BIT(1)"
        . ");";
    $createGames = $SQL_CXN->query($createGamesQuery);
    if(!$createGames) {
        echo "There was an error creating the `games` table.\n";
    }

    // creates the table to hold player data
    // `gid` is linked to the `games` table
    $createPlayersQuery = "CREATE TABLE `players` ("
        . "`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`gid` INT(6) UNSIGNED,"
        . "`nickname` VARCHAR(15) NOT NULL DEFAULT 'Anon.',"
        . "`ip` VARCHAR(15) NOT NULL DEFAULT '1.1.1.1',"
        . "`pts` INT(4) UNSIGNED,"
        . "`limit` INT(2) UNSIGNED"
        . ");";
    $createPlayers = $SQL_CXN->query($createPlayersQuery);
    if(!$createPlayers) {
        echo "There was an error creating the `players` table.\n";
    }

    // creates the table to hold card data
    $createCardsQuery = "CREATE TABLE `cards` ("
        . "`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`type` INT(1) UNSIGNED,"
        . "`asset` VARCHAR(20) NOT NULL," // image file for card
        . "`text` VARCHAR(10) NOT NULL,"
        . "`miles` INT(3) UNSIGNED"
        . ");";
    $createCards = $SQL_CXN->query($createCardsQuery);
    if(!$createCards) {
        echo "There was an error creating the `cards` table.\n";
    }

    // creates the table to hold player hand data
    // `pid` links to the `players` table
    // `cid` links to the `cards` table
    $createHandsQuery = "CREATE TABLE `hands` ("
        . "`id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`pid` INT(6) UNSIGNED,"
        . "`cid` INT(6) UNSIGNED"
        . ");";
    $createHands = $SQL_CXN->query($createHandsQuery);
    if(!$createHands) {
        echo "There was an error creating the `hands` table.\n";
    }

    // creates the table to hold game deck data
    // `gid` links to the `games` table
    // `cid` links to the `cards` table
    $createDecksQuery = "CREATE TABLE `decks` ("
        . "`id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`gid` INT(6) UNSIGNED,"
        . "`cid` INT(6) UNSIGNED"
        . ");";
    $createDecks = $SQL_CXN->query($createDecksQuery);
    if(!$createDecks) {
        echo "There was an error creating the `decks` table.\n";
    }

    // creates the table to hold game discard pile data
    // `gid` links to the `games` table
    // `cid` links to the `cards` table
    $createDiscardsQuery = "CREATE TABLE `discards` ("
        . "`id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`gid` INT(6) UNSIGNED,"
        . "`cid` INT(6) UNSIGNED"
        . ");";
    $createDiscards = $SQL_CXN->query($createDiscardsQuery);
    if(!$createDiscards) {
        echo "There was an error creating the `discards` table.\n";
    }

    // creates the table to hold played safeties data
    // `pid` links to the `players` table
    // `cid` links to the `cards` table
    $createSafetiesQuery = "CREATE TABLE `safeties` ("
        . "`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`pid` INT(6) UNSIGNED,"
        . "`cid` INT(6) UNSIGNED"
        . ");";
    $createSafeties = $SQL_CXN->query($createSafetiesQuery);
    if(!$createSafeties) {
        echo "There was an error creating the `safeties` table.\n";
    }

    // creates the table to hold high score data
    $createLeaderboardQuery = "CREATE TABLE `leaderboard` ("
        . "`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
        . "`nickname` VARCHAR(15) NOT NULL,"
        . "`score` INT(4) UNSIGNED"
        . ");";
    $createLeaderboard = $SQL_CXN->query($createLeaderboardQuery);
    if(!$createLeaderboard) {
        echo "There was an error creating the `leaderboard` table.\n";
    }

    echo "\n";
    echo "The database has finished initializing.\n";
?>