<?php

namespace App\Repository;

class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function find($id, $fields)
    {
        return $this->model->select($fields)->find($id);
    }

    public function findValues($map, $valueFields)
    {
        return $this->model->where($map)->value($valueFields);
    }

    public function findFields($map, $fields)
    {
        return $this->model->where($map)->select($fields)->first();
    }

    public function isExists($map)
    {
        return $this->model->where($map)->exists();
    }

    public function insert($data)
    {
        return $this->model->insert($data);
    }

    public function insertGetId($data)
    {
        return $this->model->insertGetId($data);
    }
}
