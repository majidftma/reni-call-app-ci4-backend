<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class OtpController extends BaseController
{
    use ResponseTrait;

    private $apiKey = '90e61fc5-d55a-11ef-8b17-0200cd936042'; // Replace with your 2Factor API Key
    private $baseUrl = 'https://2factor.in/API/V1';

    // Function to send OTP
    public function sendOtp()
    {
        $phone = $this->request->getVar('phone'); // Get phone number from the request
        $template = 'network1'; // Template name as per 2Factor settings

        if (!$phone) {
            return $this->fail('Phone number is required', 400);
        }

        $url = "{$this->baseUrl}/{$this->apiKey}/SMS/{$phone}/AUTOGEN2/{$template}";

        // Make the API request
        $response = service('curlrequest')->request('GET', $url);

        $data = json_decode($response->getBody(), true);

        if (isset($data['Status']) && $data['Status'] === 'Success') {
            return $this->respond([
                'message' => 'OTP sent successfully.',
                'details' => $data,
            ]);
        }

        return $this->fail('Failed to send OTP', 500);
    }

    // Function to verify OTP
    public function verifyOtp()
    {
        $sessionId = $this->request->getVar('session_id'); // Get session_id from the request
        $otp = $this->request->getVar('otp'); // Get OTP from the request

        if (!$sessionId || !$otp) {
            return $this->fail('Session ID and OTP are required', 400);
        }

        $url = "{$this->baseUrl}/{$this->apiKey}/SMS/VERIFY/{$sessionId}/{$otp}";

        // Make the API request
        $response = service('curlrequest')->request('GET', $url);

        $data = json_decode($response->getBody(), true);

        if (isset($data['Status']) && $data['Status'] === 'Success') {
            return $this->respond([
                'message' => 'OTP verified successfully.',
                'details' => $data,
            ]);
        }

        return $this->fail('Failed to verify OTP', 401);
    }
}
