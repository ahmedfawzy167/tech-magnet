<?php

namespace App\Http\Controllers\Admin;

use OpenAI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $apiKey = config("app.api_key");

        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $request->message],
                    ],
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}", $data);

        if ($response->successful()) {
            $result = $response->json();
            return response()->json($result);
        }

        return response()->json(['error' => 'Failed to Communicate With Google Gemini API', 'details' => $response->body()], $response->status());
    }
}
