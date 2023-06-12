<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralAccessKeyRequest;
use App\Http\Resources\GameResultResource;
use App\Repositories\GameResultRepository;
use App\Services\LuckGameService;

class GameController extends Controller
{
    /**
     * @var LuckGameService $luckService
     */
    private $luckService;

    public function __construct(LuckGameService $luckService)
    {
        $this->luckService = $luckService;
    }

    public function index(GeneralAccessKeyRequest $request)
    {
        $validData = $request->validated();
        $histories = $this->luckService->index($validData['key']);
        return GameResultResource::collection($histories);
    }

    public function luckyGame(GeneralAccessKeyRequest $request)
    {
        $validData = $request->validated();
        $history = $this->luckService->play($validData['key']);
        return new GameResultResource($history);
    }
}
