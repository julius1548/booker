<?php

namespace Bookkeeper\Interface\Contracts\Abstracts;

abstract class Factory
{
    protected Model $model;

    public function __construct(protected ?array $data = [])
    {
        $this->setModel();
    }

    abstract function modelClass(): string;

    protected function setModel(): void
    {
        $this->model = new ($this->modelClass());
    }

    public function make(array $data)
    {
        return $this->model->forceFill($data); //TODO
    }
}
