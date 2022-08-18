<?php

namespace r567tw\phpmvc;

abstract class DBModel extends Model
{
    abstract static public function table_name(): string;
    abstract public function attributes(): array;
    abstract static public function primaryKey(): string;

    public function save()
    {
        $tableName = $this->table_name();
        $attributes = $this->attributes();
        $attributes_string = implode(',',$attributes);
        $params_string = implode(',', array_map(fn($attr) => ":$attr", $attributes));

        $stat = self::prepare("INSERT INTO {$tableName}($attributes_string) VALUES ($params_string)");
        foreach ($attributes as $attribute) {
            $stat->bindValue(":{$attribute}", $this->{$attribute});
        }
        $stat->execute();
        return true;

    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne(array $where)
    {
        $tableName = static::table_name();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $stat = self::prepare("SELECT * FROM {$tableName} where $sql");
        foreach ($where as $key=>$value) {
            $stat->bindValue(":$key", $value);
        }
        $stat->execute();
        return $stat->fetchObject(static::class);
    }
}
