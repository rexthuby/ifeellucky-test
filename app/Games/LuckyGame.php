<?php

namespace App\Games;

class LuckyGame
{
    public static function play(): int
    {
        $randomNumber = random_int(1, 1000);

        if ($randomNumber % 2 === 0) {
            return 0;
        }
        if ($randomNumber > 900) {
            return $randomNumber * 0.7;
        }
        if ($randomNumber > 600) {
            return $randomNumber * 0.5;
        }
        if ($randomNumber > 300) {
            return $randomNumber * 0.3;
        }
        return $randomNumber * 0.1;
    }
}
