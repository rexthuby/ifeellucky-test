<?php

namespace App\Services;

use App\Games\LuckyGame;
use App\Models\GameResult;
use App\Repositories\AccessKeyRepository;
use App\Repositories\GameResultRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class LuckGameService
{
    /**
     * @var GameResultRepository $gameHistoryRepository
     */
    private $gameHistoryRepository;

    /**
     * @var AccessKeyRepository $accessKeyRepository
     */
    private $accessKeyRepository;

    public function __construct(GameResultRepository $gameHistoryRepository, AccessKeyRepository $accessKeyRepository)
    {
        $this->gameHistoryRepository = $gameHistoryRepository;
        $this->accessKeyRepository = $accessKeyRepository;
    }

    /**
     * @param string $key
     * @return Collection
     */
    public function index(string $key): Collection
    {
        $accessKey = $this->accessKeyRepository->getKeyModel($key);
        $userId = $accessKey->user_id;
        return Cache::rememberForever('last_games_user_id:' . $userId, function ()use($userId) {
            return $this->gameHistoryRepository->getLastResult($userId);
        });
    }


    /**
     * @param string $key
     * @return GameResult
     */
    public function play(string $key): GameResult
    {
        $winning_amount = LuckyGame::play();
        $keyModel = $this->accessKeyRepository->getKeyModel($key);
        $userId = $keyModel->user_id;
        $result = $this->gameHistoryRepository->setResult($userId, $winning_amount);
        Cache::forget('last_games_user_id:' . $userId);
        return $result;
    }
}
