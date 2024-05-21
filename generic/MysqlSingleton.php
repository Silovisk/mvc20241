<?php

namespace generic;

use PDO;

class MysqlSingleton
{
    private static $instance = null;

    private $conexaoPDO = null;
    private $dsn = "mysql:host=localhost;dbname=ifood";
    private $username = "root";
    private $password = "";

    private function __construct()
    {



        if ($this->conexaoPDO == null) {

            $this->conexaoPDO = new PDO($this->dsn, $this->username, $this->password);
            $this->conexaoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
    public static function getInstance()
    {

        if (self::$instance == null) {
            self::$instance = new MysqlSingleton();
        }
        
        return self::$instance;
    }

    public function executar($sql, $param = array())
    {
        if ($this->conexaoPDO != null) {
            $sth = $this->conexaoPDO->prepare($sql);
            foreach ($param as $key => &$value) {
                $sth->bindParam($key, $value, PDO::PARAM_STR);
            }
            $sth->execute();
            if (strpos($sql, 'INSERT') === 0) {
                return $this->conexaoPDO->lastInsertId();
            } elseif (strpos($sql, 'UPDATE') === 0 || strpos($sql, 'DELETE') === 0) {
                return $sth->rowCount();
            } else {
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
}
