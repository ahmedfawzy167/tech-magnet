<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

trait ZoomMeeting
{
    /**
     * Generate Zoom Access Token.
     */

    public function generateZoomAccessToken()
    {
        $apiKey = env('ZOOM_CLIENT_ID');
        $apiSecret = env('ZOOM_CLIENT_SECRET');
        $accountId = env('ZOOM_ACCOUNT_ID');

        $base64Credentials = base64_encode("$apiKey:$apiSecret");

        $url = 'https://zoom.us/oauth/token?grant_type=account_credentials&account_id=' .  $accountId;

        $response = Http::withHeaders([
            'Authorization' => "Basic $base64Credentials",
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->post($url, [
            'grant_type' => 'client_credentials',
            'account_id' => $accountId,
        ]);

        $responseData = $response->json();

        if ($response->successful()) {
            return $responseData['access_token'];
        } else {
            Log::error('Zoom OAuth Token Response: ' . json_encode($responseData));
            return null;
        }
    }

    /**
     * Create a Zoom Meeting.
     */
    public function createMeeting($request)
    {
        $accessToken = $this->generateZoomAccessToken();

        $meetingData = [
            "topic" => $request->topic,
            "agenda" => $request->description,
            "type" => 2,
            "duration" => 60,
            "start_time" => $request->start_date,
            "timezone" => 'Africa/Cairo',
            "password" => $request->password,
            "settings" => [
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => false,
                'waiting_room' => false,
                'audio' => 'both',
                'auto_recording' => 'none',
                'approval_type' => 0,
            ],
        ];

        $url = 'https://api.zoom.us/v2/users/me/meetings';

        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, $meetingData);

        $responseData = $response->json();

        if ($response->successful()) {
            return $responseData;
        } else {
            Log::error('Zoom Create Meeting Response: ' . json_encode($responseData));
            throw new \Exception('Failed to create meeting: ' . ($responseData['message'] ?? 'Unknown error'));
        }
    }

    /**
     * Fetch All Zoom Meetings.
     */
    public function getAllMeetings()
    {
        $accessToken = $this->generateZoomAccessToken();
        if (!$accessToken) {
            return ['success' => false, 'message' => 'Failed to Generate Access Token.'];
        }

        $url = 'https://api.zoom.us/v2/users/me/meetings';

        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type'  => 'application/json',
        ])->get($url);

        $responseData = $response->json();

        if ($response->successful()) {
            return [
                'success' => true,
                'data'    => $responseData['meetings'],
            ];
        } else {
            Log::error('Zoom Get All Meetings Response: ' . json_encode($responseData));
            return [
                'success' => false,
                'message' => 'Failed to Fetch Meetings!',
            ];
        }
    }

    /**
     * Update Zoom Meeting.
     */

    public function updateMeeting($meetingId, $request)
    {
        $accessToken = $this->generateZoomAccessToken();

        $meetingData = [
            "topic" => $request->topic,
            "agenda" => $request->description,
            "type" => 2,
            "duration" => 60,
            "start_time" => $request->start_date,
            "timezone" => 'Africa/Cairo',
            "password" => $request->password,
            "settings" => [
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => false,
                'waiting_room' => false,
                'audio' => 'both',
                'auto_recording' => 'none',
                'approval_type' => 0,
            ],
        ];

        $url = "https://api.zoom.us/v2/meetings/{$meetingId}";

        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->patch($url, $meetingData);

        $responseData = $response->json();

        if ($response->successful()) {
            return $responseData;
        } else {
            Log::error('Zoom Update Meeting Response: ' . json_encode($responseData));
            throw new \Exception('Failed to Update Meeting: ' . ($responseData['message'] ?? 'Unknown error'));
        }
    }


    /**
     * Delete Zoom Meeting.
     */
    public function deleteMeeting($meetingId)
    {
        $accessToken = $this->generateZoomAccessToken();
        if (!$accessToken) {
            return ['success' => false, 'message' => 'Failed to Generate Access Token.'];
        }
        $url = "https://api.zoom.us/v2/meetings/{$meetingId}";

        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type'  => 'application/json',
        ])->delete($url);

        if ($response->successful()) {
            return ['success' => true];
        } else {
            $responseData = $response->json();
            Log::error('Zoom Delete Meeting Response: ' . json_encode($responseData));
            return ['success' => false, 'message' => $responseData['message'] ?? 'Failed to Delete Zoom Meeting.'];
        }
    }

    /**
     * Get a Meeting.
     */
    public function getMeetingById($meetingId)
    {
        $accessToken = $this->generateZoomAccessToken();

        $url = "https://api.zoom.us/v2/meetings/{$meetingId}";

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $accessToken",
                'Accept' => 'application/json',
            ])->get($url);

            $responseData = $response->json();

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $responseData,
                ];
            } else {
                Log::error('Zoom Get Meeting Response: ' . json_encode($responseData));
                return [
                    'success' => false,
                    'message' => 'Failed to Retrieve Meeting. ' . ($responseData['message'] ?? 'Unknown error'),
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to Retrieve Meeting. ' . $e->getMessage(),
            ];
        }
    }
}
