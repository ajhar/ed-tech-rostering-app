<?php

namespace App\Traits;

trait GeneralDatabaseOperation
{
    public static function findById($id, $columns = ['*'])
    {
        return self::findBy(['id' => $id], $columns);
    }

    public static function findBy($conditions, $columns = ['*'])
    {
        return self::where($conditions)
            ->select($columns)
            ->first();
    }

    public static function selectBy($conditions)
    {
        return self::where($conditions)->get();
    }

    public static function selectFirstEntry($conditions = [], $columns = [])
    {
        $rows = self::where($conditions);

        if (!empty($columns)) {
            $rows = $rows->select($columns);
        }

        return $rows->first();
    }

    public static function deleteById($id)
    {
        self::deleteBy(['id' => $id]);
    }

    public static function deleteBy($conditions)
    {
        self::where($conditions)->delete();
    }

    public static function updateById($id, $values)
    {
        self::updateBy(['id' => $id], $values);
    }

    public static function updateBy($conditions, $values)
    {
        self::where($conditions)->update($values);
    }

    public static function getAll($columns = ['*'])
    {
        return self::select($columns)
            ->get();
    }

    public static function getCount($condition = [])
    {
        return self::where($condition)
            ->count();
    }

    public static function isExists($condition)
    {
        return self::where($condition)
            ->exists();
    }

    public function loadFromObject($object): void
    {
        $this->loadFromArray($object->toArray());
    }

    public function loadFromRequest($request): void
    {
        $this->loadFromArray($request->all());
    }

    public function loadFromArray($array): void
    {
        foreach ($array as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->$key = $value;
            }
        }
    }

    public function storeFromRequest($request)
    {
        $model = new self();
        $model->loadFromRequest($request);
        $model->save();
        return $model;
    }
}
