<?php

namespace App\Repositories;


use App\Models\GameResult as Model;
use Illuminate\Database\Eloquent\Collection;

class GameResultRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param string $userId
     * @param int $winningAmount
     * @return Model
     */
    public function setResult(string $userId, int $winningAmount): Model
    {
        /**
         * @var Model $result
         */
        $result = $this->getStartCondition()
            ->where('user_id', '=', $userId)
            ->create(['user_id' => $userId, 'winning_amount' => $winningAmount]);

        return $result;
    }

    /**
     * @param string $userId
     * @param int $gameAmount
     * @return Collection
     */
    public function getLastResult(string $userId, int $gameAmount = 3): Collection
    {
        $result = $this->getStartCondition()
            ->orderBy('created_at', 'desc')
            ->where('user_id', '=', $userId)
            ->limit($gameAmount)
            ->get();

        return $result;
    }
}
