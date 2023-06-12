<?php

namespace App\CacheManagers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AccessKeyCache
{
    private $baseKey = 'access_key';

    public function getKey(string $key): Model
    {
        return Cache::get($this->baseKey . '_key:' . $key);
    }

    public function putKey(string $key, Model $model, int|null $expiredAt = null): bool
    {
        return Cache::put($this->baseKey . '_key:' . $key, $model, $expiredAt);
    }

    public function hasKey($key): bool
    {
        return Cache::has($this->baseKey . '_key:' . $key);
    }

    public function deleteKey(string $key): bool
    {
        return Cache::delete($this->baseKey . '_key:' . $key);
    }
}
