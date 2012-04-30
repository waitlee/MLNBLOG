<?php

namespace MLNPHP\ORM\Adapter\Abstraction;

use \MLNPHP\MLNPHP;
/**
 * 数据库适配器基类
 * 
 * @package MLNPHP
 */
abstract class AdapterBase
{
    protected $connect;
    protected $conf;
    protected $lastQuery;
    protected $tables;

    /**
     * 获取数据库适配器的实例
     * 
     * @param string $dbConfig 数据库配置点名称
     * 
     * @return Mixed
     */
    public static function getInstance($dbConfigName)
    {
        static $instance = array();

        if (isset($instance[$dbConfigName])) {
            $instance[$dbConfigName] = new self($dbConfigName);
        }

        return $instance[$dbConfigName];
    }

    private function __construct($dbConfigName)
    {
        $application = MLNPHP::getApplication();
        $this->conf = $application->conf->db[$dbConfigName];
        $this->connect = $this->conn();
        $this->selectDb();
        $this->tables = $this->getTables();
    }

    /**
     * 连接数据库
     * 
     * @return void
     */
    abstract protected function conn();

    /**
     * 选取数据库
     * 
     * @return void
     */
    abstract protected function selectDb();

    /**
     * 获取数据库中的表
     * 
     * @return ArrayAccess
     */
    abstract protected function getTables();

    /**
     * 数据库的Query方法
     * 
     * @param string $sql SQL语句
     * 
     * @return mixed
     */
    abstract protected function query($sql);

    /**
     * 数据库的Fetch方法
     * 
     * @return ArrayAccess
     */
    abstract protected function fetch();    

    /**
     * 备份数据库
     * 
     * @return void
     */
    abstract protected function backupDb();

}