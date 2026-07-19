<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WhatsAppController extends Controller
{
    /**
     * Verify webhook (Meta sends GET request first).
     */
    public function verify(Request $request)
    {
        if (
            $request->hub_mode === 'subscribe' &&
            $request->hub_verify_token === env('WHATSAPP_VERIFY_TOKEN')
        ) {
            return response($request->hub_challenge, 200);
        }

        return response('Forbidden', 403);
    }

    /**
     * Receive incoming WhatsApp messages (Meta sends POST JSON).
     */
    public function receive(Request $request)
    {
        Log::info('Incoming WhatsApp', $request->all());

        // Extract message text safely
        $entry = $request->input('entry.0.changes.0.value.messages.0', []);
        $from = $entry['from'] ?? null;
        $text = $entry['text']['body'] ?? '';

        if ($from && $text) {
            $reply = $this->processMessage($text);

            // Send reply back via Graph API
            $this->sendWhatsAppMessage($from, $reply);
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Process user message and decide reply.
     */
    private function processMessage(string $message): string
    {
        $msg = strtolower(trim($message));

        return match ($msg) {
            'hi', 'hello', 'hey' => "👋 Hello! Welcome to CampusStay.",
            'help' => "Available commands:\nLISTINGS\nDETAILS {id}\nCONTACT {id}\nSEARCH {keyword}",
            'menu' => "1. About\n2. Contact\n3. Services",
            'about' => "I'm your Laravel WhatsApp Bot.",
            default => "I didn't understand that.\nType *help* for options.",
        };
    }

    /**
     * Send outbound WhatsApp message via Meta Graph API.
     */
    private function sendWhatsAppMessage(string $to, string $body): void
    {
        Http::withToken(env('WHATSAPP_TOKEN'))
            ->post(
                "https://graph.facebook.com/v23.0/" .
                env('WHATSAPP_PHONE_NUMBER_ID') .
                "/messages",
                [
                    "messaging_product" => "whatsapp",
                    "to" => $to,
                    "type" => "text",
                    "text" => [
                        "body" => $body
                    ]
                ]
            );
    }
}
