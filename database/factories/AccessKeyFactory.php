<?php

namespace Database\Factories;

use App\CacheManagers\AccessKeyCache;
use App\Managers\AccessKeyManager;
use App\Models\User;
use App\Repositories\AccessKeyRepository;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameResult>
 */
class AccessKeyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $manager = new AccessKeyManager(new AccessKeyCache(), new AccessKeyRepository());
        $key = $manager->generateKey();
        $expired_at = $manager->getExpiredDateFromNow();
        $user_id = FactoryHelper::getRandomModelId(User::class);
        return [
            'key' => $key,
            'expired_at' => $expired_at,
            'user_id' => $user_id
        ];
    }
}
