<?php

namespace App\Services;

use App\CacheManagers\AccessKeyCache;
use App\Managers\AccessKeyManager;
use App\Repositories\AccessKeyRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    /**
     * @var UserRepository $commentRepository
     */
    private $userRepository;
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

    public function __construct(UserRepository      $userRepository,
                                AccessKeyManager    $accessKeyManager,
                                AccessKeyRepository $accessKeyRepository,
                                AccessKeyCache      $accessKeyCache)
    {
        $this->userRepository = $userRepository;
        $this->accessKeyManager = $accessKeyManager;
        $this->accessKeyRepository = $accessKeyRepository;
        $this->accessKeyCache = $accessKeyCache;
    }

    /**
     * @param array{username:string,phone_number:string} $userData
     * @return string
     * @throws \Exception
     */
    public function register(array $userData): string
    {
        $key = $this->accessKeyManager->generateKey();
        $keyLifetime = $this->accessKeyManager->getKeyLifetime();
        $expired_at = $this->accessKeyManager->getExpiredDateFromNow();
        DB::beginTransaction();
        try {
            $newUser = $this->userRepository->createNewUser($userData);
            $userId = $newUser->id;
            $this->accessKeyRepository->createNewKey($expired_at, $userId, $key);
            DB::commit();
            return $key;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

}
