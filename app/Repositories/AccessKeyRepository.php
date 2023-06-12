<?php

namespace App\Repositories;


use App\Models\AccessKey as Model;
use Carbon\Carbon;

class AccessKeyRepository extends CoreRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @return Model
     */
    public function createNewKey(Carbon $expired_at, string $userId, string $accessKey): Model
    {
        /**
         * @var Model $model
         */
        $model = $this->getStartCondition()->create([
            'key' => $accessKey,
            'user_id' => $userId,
            'expired_at' => $expired_at->toDateTimeString()
        ]);
        return $model;
    }

    /**
     * @param string $key
     * @return Model
     */
    public function getKeyModel(string $key): Model|null
    {
        /**
         * @var Model $result
         */
        $result = $this->getStartCondition()->with('user')->where('key', '=', $key)->first();
        return $result;
    }

    /**
     * @param Carbon $expired_at
     * @param string $oldKey
     * @param string $newKey
     * @return bool|int
     */
    public function updateKey(Carbon $expired_at, string $oldKey, string $newKey)
    {
        return $this->getStartCondition()->where('key', '=', $oldKey)
            ->update(['expired_at' => $expired_at->toDateTimeString(), 'key' => $newKey]);
    }

    /**
     * @param string $key
     * @return bool|int|mixed|null
     */
    public function deleteKey(string $key): bool
    {
        return (bool)$this->getStartCondition()->where('key', '=', $key)->delete();
    }
}
