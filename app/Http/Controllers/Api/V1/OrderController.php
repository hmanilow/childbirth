<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Courses\Models\Course;
use App\Domain\Orders\Actions\CreateOrderAction;
use App\Domain\Orders\DTO\CreateOrderData;
use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Actions\CreatePaymentAction;
use App\Domain\Payments\Actions\InitiateYooKassaPaymentAction;
use App\Http\Requests\CheckoutCourseRequest;
use App\Http\Resources\V1\OrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    public function store(
        CheckoutCourseRequest $request,
        CreateOrderAction $createOrder,
        CreatePaymentAction $createPayment,
        InitiateYooKassaPaymentAction $initiatePayment,
    ): JsonResponse {
        $validated = $request->validated();
        $request->validate(['course_id' => ['required', 'integer', 'exists:courses,id']]);

        $course = Course::query()->published()->whereKey($request->integer('course_id'))->firstOrFail();

        $order = $createOrder->execute(new CreateOrderData(
            course: $course,
            user: $request->user(),
            customerName: $validated['name'],
            customerPhone: $validated['phone'],
            customerEmail: $validated['email'] ?? null,
            metadata: $validated,
        ));

        $payment = $initiatePayment->execute($createPayment->execute($order));

        return response()->json([
            'data' => [
                'order' => new OrderResource($order->load('items')),
                'confirmation_url' => $payment->confirmation_url,
            ],
        ], 201);
    }

    public function show(Request $request, Order $order): OrderResource
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        return new OrderResource($order->load('items'));
    }
}
