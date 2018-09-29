<?php

class ChatController
{
    private $configs;
    public function __construct($configs)
    {
        $this->configs = $configs;
    }

    public function addMsg($message)
    {
        $msg = htmlspecialchars($message, ENT_QUOTES);
        $name = $_SESSION['login'];
        $userId = $_SESSION['id'];
        $Db = new Db($this->configs);
        $db = $Db->getConnection();
        $sql = 'INSERT INTO messages (userName, msgText, userId) '
                . 'VALUES (:userName, :msgText, :userId)';

        $result = $db->prepare($sql);
        $result->bindParam(':userName', $name, PDO::PARAM_STR);
        $result->bindParam(':msgText', $msg, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        return $result->execute();
    }

    public function getMsg($lastId) {
        $DB = new Db($this->configs);
        $db = $DB->getConnection();
        if (empty($lastId)) {
            $lastId = 0;
        }
        $sql = 'SELECT * FROM messages WHERE `msgTime` >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR) AND `msgId` > ?';
        $result = $db->prepare($sql);
        return $result->execute(array($lastId)) ? $result->fetchAll() : false;
    }
}
