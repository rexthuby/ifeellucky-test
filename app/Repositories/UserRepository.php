<?php

namespace App\Repositories;


use App\Models\User as Model;

class UserRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param array{username:string, phone_number:string} $userData
     * @return Model
     */
    public function createNewUser(array $userData): Model
    {
        /**
         * @var Model $model
         */
        $model = $this->getStartCondition()->create($userData);
        return $model;
    }
}
