<?php

namespace App\Services;

use App\CacheManagers\AccessKeyCache;
use App\Managers\AccessKeyManager;
use App\Models\AccessKey;
use App\Repositories\AccessKeyRepository;

class AccessKeyService
{
    /**
     * @var AccessKeyManager $accessKeyManager
     */
    private $accessKeyManager;

    /**
     * @var AccessKeyRepository $accessKeyRepository
     */
    private $accessKeyRepository;
    /**
     * @var AccessKeyCache $accessKeyCache
     */
    private $accessKeyCache;

    public function __construct(AccessKeyManager    $accessKeyManager,
                                AccessKeyRepository $accessKeyRepository,
                                AccessKeyCache      $accessKeyCache)
    {
        $this->accessKeyManager = $accessKeyManager;
        $this->accessKeyRepository = $accessKeyRepository;
        $this->accessKeyCache = $accessKeyCache;
    }

    /**
     * @param string $key
     * @return AccessKey
     */
    public function show(string $key): AccessKey
    {
        if ($this->accessKeyCache->hasKey($key)) {
            /**
             * @var AccessKey $cacheKeyModel
             */
            $cacheKeyModel = $this->accessKeyCache->getKey($key);
            return $cacheKeyModel;
        }
        $keyModel = $this->accessKeyRepository->getKeyModel($key);
        if ($keyModel) {
            throw new \Exception('Key error');
        }
        $isKeyAlive = $this->accessKeyManager->isKeyAlive($keyModel);
        if (!$isKeyAlive) {
            return throw new \Exception('Key error');
        }
        $this->accessKeyCache->putKey($key, $keyModel,
            $this->accessKeyManager->remainingLifeTime($keyModel->expired_at));
        return $keyModel;
    }


    /**
     * @param string $key
     * @return string
     * @throws \Exception
     */
    public
    function update(string $key): string
    {
        $newKey = $this->accessKeyManager->generateKey();
        $expired_at = $this->accessKeyManager->getExpiredDateFromNow();
        $isUpdated = $this->accessKeyRepository->updateKey($expired_at, $key, $newKey);
        if (!$isUpdated) {
            throw new \Exception("Key not updated");
        }
        $this->accessKeyCache->deleteKey($key);
        return $newKey;
    }

    /**
     * @param string $key
     * @return bool
     */
    public
    function delete(string $key): bool
    {
        $this->accessKeyCache->deleteKey($key);
        $isDelete = $this->accessKeyRepository->deleteKey($key);
        if (!$isDelete) {
            throw new \Exception('Key not delete');
        }
        return $isDelete;
    }
}
