<?php

class ChatController
{
    private $configs;
    public function __construct()
    {
        $this->configs = Configs::getPath();
    }

    public function addMsg($message)
    {
        $msg = htmlspecialchars($message, ENT_QUOTES);
        $userId = $_SESSION['id'];
        $Db = new Db($this->configs);
        $db = $Db->getConnection();
        $sql = 'INSERT INTO messages (msgText, userId) '
                . 'VALUES (:msgText, :userId)';

        $result = $db->prepare($sql);
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
        $sql = 'SELECT * FROM messages LEFT JOIN users USING(`userId`) WHERE `msgTime` >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR) AND `msgId` > ?';
        //$sql = 'SELECT * FROM messages WHERE `msgTime` >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR) AND `msgId` > ?';
        $result = $db->prepare($sql);
//        $result->execute(array($lastId));
//
//        die(var_dump($result->fetchAll()));
        return $result->execute(array($lastId)) ? $result->fetchAll() : false;
    }
}
