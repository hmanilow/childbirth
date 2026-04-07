# Payments

YooKassa flow:

1. User clicks "Купить курс".
2. `CreateOrderAction` creates `orders` and `order_items`.
3. `CreatePaymentAction` creates a local `payments` row and moves the order to `awaiting_payment`.
4. `InitiateYooKassaPaymentAction` creates the external YooKassa payment using an idempotence key.
5. YooKassa redirects the user to payment confirmation.
6. `HandleYooKassaWebhookAction` stores the payload in `payment_events` before processing.
7. The webhook action updates provider/internal statuses.
8. `ConfirmOrderPaidAction` marks the order paid.
9. `GrantCourseAccessAction` creates a `course_access_grants` row only if an active grant does not already exist.

Idempotence:

- `payment_events` has a unique `provider + payload_hash`.
- `payments` has a unique `provider + provider_payment_id`.
- Access grants are checked before creation.
- The order paid transition is safe to repeat.

Shared hosting note:

- Do not require a long-running queue worker for payment correctness.
- Webhook processing is synchronous and intentionally small.
- Later reconciliation can be a cron-triggered Artisan command.
