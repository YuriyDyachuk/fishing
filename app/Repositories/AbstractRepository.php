<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    public int $perPage = 9;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->model = app()->make($this->model());
    }

    abstract public function model(): string;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if (isset($this->query)) {
            return $this->query;
        }

        return $this->model->newQuery();
    }

    public function loadMore(): int
    {
        return $this->perPage;
    }
}