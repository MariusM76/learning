<?php

abstract class Base
{
    private $id;

    /**
     * @param $id
     */

    public function __construct($id=null)
    {
        if ($id) {
            $tableName = static::getTableName();
            $sql = "SELECT * FROM $tableName WHERE id = '$id' LIMIT 1;";
            $data = query($sql);

            $this->id = $id;
            if (count($data) > 0) {
                $this->fromArray($data[0]);
            }
        }
    }


    public function fromArray($data)
    {
        foreach ($data as $attrName =>$attrValue){
                $this->$attrName = $attrValue;
        }
    }

    public static abstract function getTableName();

    protected function insert($tableName,$data){
        unset($data['id']);
        global $mysql;
        $columns = [];
        $values = [];
        foreach ($data as $key => $value){
            if(!is_null($value)){
                $columns[] = $key;
                $values[] = $value;
            }
        }
        $columnsStr = implode('`, `',$columns);
        $valauesStr = implode("', '", $values);


        $sql = "INSERT INTO $tableName (`$columnsStr`) VALUES ('$valauesStr');";

        $query = mysqli_query($mysql,$sql);

        if ($query===false){
            die('Error on: '.$sql);
        }

        $this->id = mysqli_insert_id($mysql);
    }

    public function delete(){
        $id = $this->id;
        $tableName = $this->getTableName();
        global $mysql;
        $sql = "DELETE FROM $tableName WHERE `id` = $id;";
        return query($sql);

    }

    protected function update($id){
        $id = $this->id;
        $tableName = $this->getTableName();
        $data = get_object_vars($this);
        $sets = [];
        foreach ($data as $key => $value){
            if(!is_null($value)){
            $sets[] = "`$key`='$value'";
            }
        }
        $setsStr = implode(',',$sets);
        $sql = "UPDATE $tableName SET $setsStr WHERE id=$id;" ;
        global $mysql;
        $query = mysqli_query($mysql,$sql);
        if ($query===false){
            die('Error on: '.$sql);
        }
    }

    public function save()
    {
        if ($this->id>0) {
            $this->update($this->id);
        } else {
            $tableName = $this->getTableName();
            $data = get_object_vars($this);
            $this->insert($tableName,$data);
        }
    }

    public static function findBy ($column, $columnValue){
        $tableName = static ::getTableName();
        $sql    = "SELECT * FROM $tableName WHERE $column = '$columnValue';";
        $data = query($sql);
        $objList = [];
        foreach ($data as $item){
            $objList[] = static::ObjFromArray($item);

        }
        if (isset($objList)) {
            return $objList;
        } else {
            return false;
        }
    }

    public static function findByColumn ($column){
        $tableName = static ::getTableName();
        $sql    = "SELECT * FROM $tableName WHERE $column ;";
        $result = query($sql);
        if (isset($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public static function findOneBY($column, $columnValue){
        $tableName = static ::getTableName();
        $sql =  "SELECT * FROM $tableName WHERE $column = '$columnValue' LIMIT 1;";
        $result = query($sql);
        if (isset($result[0])) {
            return static::ObjFromArray($result[0]);
        } else {
            return false;
        }
    }

    private static function ObjFromArray($array)
    {
        $className = static::class;
        $object = new $className();
        $object->fromArray($array);
        return $object;
    }

    public static function find($id){
        $tableName = static ::getTableName();
        $sql =  "SELECT * FROM $tableName WHERE id = '$id' LIMIT 1;";
        $result = query($sql);
        if (isset($result[0])) {
            return static::ObjFromArray($result[0]);
        } else {
            return false;
        }
    }

    public static function findAll() {
        $tableName = static::getTableName();
        global $mysql;
        $sql = "SELECT * FROM $tableName;";
        $query = mysqli_query($mysql, $sql);

        $data = mysqli_fetch_all($query,MYSQLI_ASSOC);

        $objList = [];
        foreach ($data as $item){
            $objList[] = static::ObjFromArray($item);
        }
        return $objList;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}