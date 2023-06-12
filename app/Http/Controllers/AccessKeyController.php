<?php

namespace App\Http\Controllers;

use App\Enums\FailedMessageEnum;
use App\Enums\SuccessMessageEnum;
use App\Http\Requests\GeneralAccessKeyRequest;
use App\Http\Resources\AccessKeyResource;
use App\Services\AccessKeyService;
use Exception;
use Illuminate\Http\JsonResponse;

class AccessKeyController extends Controller
{
    private $keyAccessService;

    public function __construct(AccessKeyService $keyAccessService)
    {
        $this->keyAccessService = $keyAccessService;
    }

    public function show(GeneralAccessKeyRequest $request)
    {
        $validData = $request->validated();
        $result = $this->keyAccessService->show($validData['key']);
        return new AccessKeyResource($result);
    }

    public function update(GeneralAccessKeyRequest $request): \Illuminate\Http\JsonResponse
    {
        $validData = $request->validated();
        $newKey = $this->keyAccessService->update($validData['key']);
        return response()->json(['key' => $newKey]);
    }

    public function destroy(GeneralAccessKeyRequest $request)
    {
        $validData = $request->validated();
        $isDelete = $this->keyAccessService->delete($validData['key']);
        if ($isDelete) {
            return response()->json(SuccessMessageEnum::Create->resultMessage());
        }
        throw new Exception(FailedMessageEnum::DeleteError->value . ':' . $validData['key']);
    }
}
