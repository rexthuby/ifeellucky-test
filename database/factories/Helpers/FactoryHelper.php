<?php

namespace Database\Factories\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class FactoryHelper
{
    /**
     * If model don't have items, use model factory to generate 1.
     * Be careful with recursion !
     *
     * @param string|HasFactory $model
     * @return int
     */
    public static function getRandomModelId(string $model): int
    {
        /**
         * @var $model Model
         * @var $allModelRecords Collection
         */
        $allModelRecords = $model::select()->toBase()->get();

        $collectionAmount = $allModelRecords->count();
        if ($collectionAmount === 0) {
            return $model::factory()->create()->id;
        }
        /**
         * @var $randModel Model
         */
        $randModel = $allModelRecords->all()[rand(0, $collectionAmount - 1)];
        return $randModel->id;
    }
}

