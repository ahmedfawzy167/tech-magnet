<?php

namespace App\Http\Controllers\Admin;

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
                        ['text' => $request->message ?? ''],
                    ],
                ],
            ],
        ];

        try {
            $modelsResp = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get("https://generativelanguage.googleapis.com/v1/models?key={$apiKey}");
        } catch (\Exception $e) {
           return response()->json([
                'error' => 'Failed to fetch models list: ' . $e->getMessage(),
            ], 500);
        }

        if (! $modelsResp->successful()) {
            return response()->json(['error' => 'Failed to fetch models list: ' . $modelsResp->body()], 500);
        }

        $modelsJson = $modelsResp->json();
        $models = $modelsJson['models'] ?? [];

        $selectedModelName = null;
        foreach ($models as $m) {
            $name = $m['name'] ?? ($m['model'] ?? null);
            if (!empty($m['supportedMethods']) && is_array($m['supportedMethods'])) {
                if (in_array('generateContent', $m['supportedMethods'])) {
                    $selectedModelName = $name;
                    break;
                }
            }

            if (strpos(json_encode($m), 'generateContent') !== false) {
                $selectedModelName = $name;
                break;
            }
        }

        if (! $selectedModelName && isset($models[0]['name'])) {
            $selectedModelName = $models[0]['name'];
        }

        if (! $selectedModelName) {
            return response()->json(['error' => 'No available model found that supports generateContent. Call ListModels and pick a model that supports generateContent.','models_list' => $modelsJson], 500);
        }

        $postUrl = "https://generativelanguage.googleapis.com/v1/{$selectedModelName}:generateContent?key={$apiKey}";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($postUrl, $data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate content: ' . $e->getMessage(),
            ], 500);
        }

        if ($response->successful()) {
            return response()->json($response->json());
        }
    }
}