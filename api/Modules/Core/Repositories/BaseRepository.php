<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository {
    protected Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection {
        return $this->model->all();
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate(int $perPage) {
        return $this->model->paginate($perPage);
    }

    /**
     * @param array $arrParams
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $arrParams): Model {
        $model = $this->model->newInstance();

        $model->fill($arrParams);
        $model->save();

        return $model;
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function destroy(int $id) {
        return $this->find($id)->delete();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id): ?Model {
        return $this->model->find($id);
    }

    public function update(Model $model, array $arrParams): Model {
        $model->fill($arrParams);
        $model->save();

        return $model;
    }
}
