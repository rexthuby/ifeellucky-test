<?php

namespace App\Managers;

use App\CacheManagers\AccessKeyCache;
use App\Models\AccessKey;
use App\Repositories\AccessKeyRepository;
use Carbon\Carbon;

class AccessKeyManager
{
    /**
     * @var int $keyLifetime 7 days in seconds
     */
    private $keyLifetime = 604800;

    /**
     * @var AccessKeyCache $accessKeyCache
     */
    private $accessKeyCache;
    /**
     * @var AccessKeyRepository $accessKeyRepository
     */
    private $accessKeyRepository;

    public function __construct(AccessKeyCache $accessKeyCache, AccessKeyRepository $accessKeyRepository,)
    {
        $this->accessKeyCache = $accessKeyCache;
        $this->accessKeyRepository = $accessKeyRepository;
    }

    public function generateKey(): string
    {
        return md5(rand()) . uniqid();
    }

    /**
     * @return Carbon
     */
    public function getExpiredDateFromNow(): Carbon
    {
        return \Illuminate\Support\Carbon::now()->addSeconds($this->keyLifetime);
    }

    public function getKeyLifetime(): int
    {
        return $this->keyLifetime;
    }


    public function isKeyAlive(AccessKey|string $key): bool
    {
        if ($key instanceof AccessKey) {
            return $this->cacheModelResult($key);
        }

        if ($this->accessKeyCache->hasKey($key)) {
            /**
             * @var AccessKey $cacheKeyModel
             */
            $cacheKeyModel = $this->accessKeyCache->getKey($key);
            return $this->getResult($cacheKeyModel);
        }

        $keyModel = $this->accessKeyRepository->getKeyModel($key);
        if (!$keyModel) {
            return false;
        }

        return $this->cacheModelResult($keyModel);

    }

    private function cacheModelResult(AccessKey $key)
    {
        if ($this->getResult($key)) {
            $this->accessKeyCache->putKey($key->key, $key, $this->remainingLifeTime($key->expired_at));
            return true;
        }
        return false;
    }

    private function getResult(AccessKey $model): bool
    {
        $expiredAtString = $model->expired_at;
        $carbonExpiredAt = $this->expiredStringToCarbon($expiredAtString); //err
        return $this->compareExpiredAndNow($carbonExpiredAt);
    }

    private function compareExpiredAndNow(Carbon $expired_date): bool
    {
        $now = Carbon::now();
        $result = $expired_date->greaterThan($now);
        return $result;
    }

    public function remainingLifeTime(Carbon|string $expiredAt): int
    {
        if ($expiredAt instanceof Carbon) {
            /**
             * @var Carbon $expiredAt
             */
            return $expiredAt->diffInSeconds();
        }
        $expiredAt = $this->expiredStringToCarbon($expiredAt);
        return $expiredAt->diffInSeconds();
    }

    public function expiredStringToCarbon(string $expiredAt): Carbon
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $expiredAt);
    }
}
