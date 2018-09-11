<?php

class ChatController
{

    static function addMsg($message)
    {
        $msg = htmlspecialchars($message, ENT_QUOTES);
        $name = $_SESSION['login'];
        $db = Db::getConnection();
        $sql = 'INSERT INTO messages (name, msg) '
                . 'VALUES (:name, :msg)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':msg', $msg, PDO::PARAM_STR);
    }

    static function getMsg()
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM messages WHERE `time` >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR)';
        $result = $db->prepare($sql);
        $result->execute();
        return $result->fetchAll();
    }
}
