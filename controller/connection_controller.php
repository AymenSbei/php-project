<?php

class ConnectionController
{
    public function __construct()
    {
        require_once "../model/user.php";
        require_once "../model/book.php";
    }
    public function connect(){
        $conn = mysqli_connect("localhost", "root", "") or die("error");
        mysqli_select_db($conn, "bookvendors");
        return $conn;
    }

    function exec($args){
        $res = mysqli_query($this->connect(), $args);
        return $res;
    }

    public function insert($table, $colonnes, $valeurs){
        $req = "INSERT INTO " . $table . "(" . $colonnes . ") VALUES (" . $valeurs . ")";
        return $this->exec($req);
    }

    public function select ($fields="*", $table, $conditions, $options=array()){
            $req = "SELECT ". $fields. " FROM ". $table;
            if ($conditions != "") $req.=" WHERE ". $conditions;
            if (isset($options["order_by"])) $req.= " ORDER BY ". $options["order_by"];
            if(isset($options["group_by"])) $req.= " GROUP BY ". $options["group_by"];
            if(isset($options["limit_start"])) $req.= " LIMIT START ". $options["limit_start"];
            if(isset($options["limit"])) $req.= " LIMIT ". $options["limit"];


            return $this->exec($req);

        }

        public function delete($table, $conditions="", $limit="")
        {
            $req="";
            if (!empty($conditions)) $req = "WHERE ". $conditions;
            if (!empty($limit)) $req = "LIMIT ". $limit;

            $req = "DELETE FROM ". $table. " ". $req;

            return $this -> exec($req);
        }

        public function update($table, $colonnes, $valeurs, $condition)
        {
            $req="UPDATE ". $table;

            if(sizeof($colonnes)>0 && sizeof($valeurs)>0) {
                $val="";
                for($i=0; $i<sizeOf($colonnes); $i++) {
                    $val.=$colonnes[$i]."='".$valeurs[$i]."'";
                    if($i<sizeof($colonnes)-1) $val.=", ";
                    
                }
                $req.= " SET ".$val. " where ".$condition;
            }

            return $this->exec($req);
        }
}