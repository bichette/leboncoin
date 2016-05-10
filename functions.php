<?php

//connexion à la BDD et écriture ds fichier de log

function connectDB() {
    mysql_connect('127.0.0.1', 'root', '');
    mysql_select_db('leboncoin');

    mysql_set_charset('UTF-8');
    mysql_query('SET NAMES "UTF8"');
}

function closeDB() {
    mysql_close();
}

function connectDB_PDO() {
    $aOptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"');
    $oPDO = new PDO('mysql:host=127.0.0.1;dbname=leboncoin;charset=utf8', 'root', '', $aOptions);
    return $oPDO;
}

function closeDB_PDO() {
    // nothing to do
}

function logIP() {
    $sDir = 'log/';
    $sDayFile = date('Y-m-d') . '.log';
    $sLine = date('Y-m-d H:i:s') . '#' . $_SERVER['REMOTE_ADDR'] . "\n";

    if (!file_exists($sDir)) {
        mkdir($sDir);
    }

    $oH = fopen($sDir . $sDayFile, 'a+');
    fwrite($oH, $sLine);
    fclose($oH);

    // Version raccourcie :
    //file_put_contents($sDir.$sDayFile, $sLine, FILE_APPEND);
}

?>
