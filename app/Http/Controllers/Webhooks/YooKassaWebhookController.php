<?php

namespace App\Http\Controllers\Webhooks;

use App\Domain\Payments\Actions\HandleYooKassaWebhookAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class YooKassaWebhookController extends Controller
{
    public function __invoke(Request $request, HandleYooKassaWebhookAction $handleWebhook): JsonResponse
    {
        $handleWebhook->execute($request->all());

        return response()->json(['ok' => true]);
    }
}
