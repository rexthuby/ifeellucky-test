<?php

namespace Database\Factories;

use App\Games\LuckyGame;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameResult>
 */
class GameResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = FactoryHelper::getRandomModelId(User::class);
        $winning_amount = LuckyGame::play();
        return [
            'user_id' => $user_id,
            'winning_amount' => $winning_amount
        ];
    }
}
