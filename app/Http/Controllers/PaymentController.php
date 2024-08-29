<?php

namespace App\Http\Controllers;

use App\Dtos\CheckoutRequestDto;
use App\Http\Requests\payment\CheckoutRequest;
use App\Services\PaymentService;
use App\Services\ProductService;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private PaymentService $paymentService
    ) {
    }
    public function checkout(CheckoutRequest $request)
    {
        try {
            $data = $request->validated();
            $product = $this->productService->getById($data['product_id']);

            $this->paymentService->createOrder($data['product_id'], $data['quantity']);
            
            $response = Http::withBasicAuth('af3f4b0e-47fb-470f-b899-2e95ca45bb80', 'klarna_test_api_OXRQcGtaRi1SOHZQWkxHMGQ4ITclIXVxTk4kTmUjRkQsYWYzZjRiMGUtNDdmYi00NzBmLWI4OTktMmU5NWNhNDViYjgwLDEseXE2czVhRFYraDBPdGQ4ajJoazJrWW5hcXVtUFhsWmdQc0RMQktwd0w0dz0')
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Klarna-Partner', 'string')
                ->withBody(json_encode($data))
                ->post($api);
            info("Order created", [
                $response->json(),
            ]);
            return $this->json($response->json(), $response->status());
        } catch (Exception $e) {
            return $this->json(
                null,
                Response::HTTP_BAD_REQUEST,
                $e->getMessage()
            );
        }
    }

    public function handleWebhook(Request $request)
    {
        // Log that a webhook has been received
        info("Webhook received");

        // Log the raw content of the webhook
        info("Raw data", [$request->getContent(), $request->all(), $request->getPayload(), $request->headers]);

        // If you want to parse the JSON payload and log it
        $data = $request->json()->all();
        info("Parsed data", [$data]);

        // Return a 200 OK response to acknowledge the webhook
        return response()->json(null, Response::HTTP_OK);
    }
}
