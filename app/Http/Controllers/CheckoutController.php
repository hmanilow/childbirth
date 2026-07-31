<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Domain\Courses\Models\Course;
use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Actions\CreateOrderAction;
use App\Domain\Payments\Actions\InitiateYooKassaPaymentAction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show(Course $course): View|RedirectResponse
    {
        if (auth()->user()->hasAccessToCourse($course->id)) {
            return redirect()->route('account.course.show', $course->slug)
                ->with('info', 'У вас уже есть доступ к этому курсу.');
        }

        return view('checkout.show', compact('course'));
    }

    public function create(
        Request $request,
        Course $course,
        CreateOrderAction $createOrder,
        InitiateYooKassaPaymentAction $initiatePayment
    ): RedirectResponse {
        $request->validate([
            'privacy_consent' => ['required', 'accepted'],
            'offer_accepted' => ['required', 'accepted'],
        ], [
            'privacy_consent.accepted' => 'Для оформления необходимо дать согласие на обработку персональных данных.',
            'offer_accepted.accepted' => 'Для оформления необходимо принять условия Договора-оферты.',
        ]);

        if (auth()->user()->hasAccessToCourse($course->id)) {
            return redirect()->route('account.course.show', $course->slug);
        }

        $order   = $createOrder->execute(auth()->user(), $course);
        $payment = $initiatePayment->execute($order);

        if ($payment->confirmation_url) {
            return redirect()->away($payment->confirmation_url);
        }

        return redirect()->route('checkout.failed', $order->uuid)
            ->with('error', 'Не удалось создать платёж. Попробуйте ещё раз.');
    }

    public function success(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);
        return view('checkout.success', compact('order'));
    }

    public function failed(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);
        return view('checkout.failed', compact('order'));
    }
}
