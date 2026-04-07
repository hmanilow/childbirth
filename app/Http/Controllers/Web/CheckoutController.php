<?php

namespace App\Http\Controllers\Web;

use App\Domain\Courses\Models\Course;
use App\Domain\Orders\Actions\CreateOrderAction;
use App\Domain\Orders\DTO\CreateOrderData;
use App\Domain\Payments\Actions\CreatePaymentAction;
use App\Domain\Payments\Actions\InitiateYooKassaPaymentAction;
use App\Http\Requests\CheckoutCourseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class CheckoutController extends Controller
{
    public function store(
        CheckoutCourseRequest $request,
        Course $course,
        CreateOrderAction $createOrder,
        CreatePaymentAction $createPayment,
        InitiateYooKassaPaymentAction $initiatePayment,
    ): RedirectResponse {
        $validated = $request->validated();

        $order = $createOrder->execute(new CreateOrderData(
            course: $course,
            user: $request->user(),
            customerName: $validated['name'],
            customerPhone: $validated['phone'],
            customerEmail: $validated['email'] ?? null,
            metadata: $validated,
        ));

        $payment = $initiatePayment->execute($createPayment->execute($order));

        return redirect()->away($payment->confirmation_url);
    }

    public function return(): RedirectResponse
    {
        return redirect()->route('student.courses')->with('status', 'Если оплата прошла успешно, доступ появится после подтверждения платежа.');
    }
}
