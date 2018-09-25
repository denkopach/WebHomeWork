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
        return $result->execute();
    }

    static function getMsg($lastId) {
        $db = Db::getConnection();
        if (empty($lastId)) {
            $lastId = 0;
        }
        $sql = 'SELECT * FROM messages WHERE `time` >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR) AND `newid` > ?';
        $result = $db->prepare($sql);
        return $result->execute(array($lastId)) ? $result->fetchAll() : false;
    }
}
