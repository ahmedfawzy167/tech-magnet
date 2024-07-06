<?php

namespace App\Traits;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

trait MeetingZoomTrait
{
   
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
        ])->post($url,[
            'grant_type' => 'client_credentials',
            'account_id' => $accountId,
        ]);
    
        $responseData = $response->json();
    
        if ($response->successful()) {
            return $responseData['access_token'];
        } else {
            // Log or print the entire response for debugging purposes.
            Log::error('Zoom OAuth Token Response: ' . json_encode($responseData));
            return null;
        }
    }


    public function createZoomMeeting($request)
    {
        $accessToken = $this->generateZoomAccessToken();
        
         $meeting = Zoom::createMeeting([
              "topic" => $request->topic,
              "agenda" => $request->description,
              "type" => 2,
              "duration" => 60,
              "start_time" => $request->start_date,
              "timezone" => 'Africa/Cairo',
              "password" => $request->password,
              "pre_schedule" => false,  
              'settings' => [
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => false,
                'waiting_room' => false,
                'audio' => 'both',
                'auto_recording' => 'none',
                'approval_type' => 0,
            ],
        ]);

       $url = 'https://api.zoom.us/v2/users/me/meetings';

        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url,$meeting);

        $responseData = $response->json();

        if ($response->successful()) {
           return $responseData;
         
        } else {
            Log::error('Zoom Create Meeting Response: ' . json_encode($responseData));
        }

    }

       


      

}

