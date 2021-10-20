<?php

function connect_to_db()
{
    // $dbn = 'mysql:dbname=horimania;charset=utf8;port=3306;host=localhost';
    // $user = 'root';
    // $pwd = '';

    $dbn = 'mysql:dbname=16b426a124320a52a286b09f2c32fbf0;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
    $user = '16b426a124320a52a286b09f2c32fbf0';
    $pwd = '@Masaki19970709';


    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}

function check_session_id()
{
    if (
        !isset($_SESSION["session_id"]) ||
        $_SESSION["session_id"] != session_id()
    ) {
        header("Location:log_in.php");
    } else {
        session_regenerate_id(true);
        $_SESSION["session_id"] = session_id();
    }
}
