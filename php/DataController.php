<?php
/*echo "file_exists1=".file_exists('./DevExtreme/LoadHelper.php');
echo "file_exists2=".file_exists('../DevExtreme/LoadHelper.php');
echo "file_exists3=".file_exists('/../DevExtreme/LoadHelper.php');
echo "file_exists4=".file_exists('./../DevExtreme/LoadHelper.php');
echo "file_exists5=".file_exists('../../DevExtreme/LoadHelper.php');*/
    if(file_exists('../DevExtreme/LoadHelper.php')) require_once("../DevExtreme/LoadHelper.php");
spl_autoload_register(array("DevExtreme\LoadHelper", "LoadModule"));


use DevExtreme\DbSet;
use DevExtreme\DataSourceLoader;

class DataController {
    private $dbSet;
    public function __construct() {
        //TODO: use your database credentials
        $mySQL = new mysqli("localhost","player","111111","test");
        $mySQL->set_charset("utf8");
        $this->dbSet = new DbSet($mySQL, "players");
    }
    public function FillDbIfEmpty() {
        if ($this->dbSet->GetCount() == 0) {
            $curDateString = "2013-1-1";
            for ($i = 1; $i <= 10000; $i++) {
                $curDT = new DateTime($curDateString);
                $curDT->add(new DateInterval("P".strval(rand(1, 1500))."D"));
                $item = array(
                    "last_name" => "Фамилия_".strval(rand(1, 100)),
                    "name" => "Имя_".strval(rand(1, 30)),
                    "m_name" => "Отчество_".strval(rand(1, 50)),
                    "birthday" => $curDT->format("Y-m-d"),
                    "code" => "Код_".strval(rand(1, 50))
                );
                $this->dbSet->Insert($item);
            }
        }
    }
    public function Get($params) {

        $result = DataSourceLoader::Load($this->dbSet, $params);
        if (!isset($result)) {
            $result = $this->dbSet->GetLastError();
        }
        return $result;
    }
    public function Post($values) {
        $result = $this->dbSet->Insert($values);
        if (!isset($result)) {
            $result = $this->dbSet->GetLastError();
        }
        return $result;
    }
    public function Put($key, $values) {
        $result = NULL;
        if (isset($key) && isset($values) && is_array($values)) {
            if (!is_array($key)) {
                $keyVal = $key;
                $key = array();
                $key["ID"] = $keyVal;
            }
            $result = $this->dbSet->Update($key, $values);
            if (!isset($result)) {
                $result = $this->dbSet->GetLastError();
            }
        }
        else {
            throw new Exeption("Invalid params");
        }
        return $result;
    }
    public function Delete($key) {
        $result = NULL;
        if (isset($key)) {
            if (!is_array($key)) {
                $keyVal = $key;
                $key = array();
                $key["ID"] = $keyVal;
            }
            $result = $this->dbSet->Delete($key);
            if (!isset($result)) {
                $result = $this->dbSet->GetLastError();
            }
        }
        else {
            throw new Exeption("Invalid params");
        }
        return $result;
    }
}
