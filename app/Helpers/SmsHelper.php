<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class SmsHelper
{
    /**
     * Send SMS notification to student
     *
     * @param string $phoneNumber
     * @param string $message
     * @return array
     */
    public static function sendSms($phoneNumber, $message)
    {
        // Validate phone number
        if (empty($phoneNumber) || !preg_match('/^[0-9+\-\s()]+$/', $phoneNumber)) {
            Log::warning('Invalid phone number for SMS', ['phone' => $phoneNumber]);
            return [
                'success' => false,
                'message' => 'Invalid phone number format'
            ];
        }

        // Clean phone number (remove spaces, dashes, parentheses)
        $cleanPhone = preg_replace('/[^0-9+]/', '', $phoneNumber);

        // Ensure phone number starts with country code if not already
        if (!str_starts_with($cleanPhone, '+880') && !str_starts_with($cleanPhone, '880')) {
            if (str_starts_with($cleanPhone, '01')) {
                // For 01XXXXXXXXX format, convert to 8801XXXXXXXXX (replace 01 with 8801)
                $cleanPhone = '8801' . substr($cleanPhone, 2);
            } elseif (str_starts_with($cleanPhone, '1')) {
                $cleanPhone = '880' . $cleanPhone;
            }
        }

        // Remove + if present for API
        $cleanPhone = ltrim($cleanPhone, '+');

        // Additional validation for Bangladesh phone numbers
        // Should be 13 digits starting with 880 after processing
        if (strlen($cleanPhone) !== 13 || !str_starts_with($cleanPhone, '880')) {
            Log::warning('Invalid phone number format after cleaning', [
                'original' => $phoneNumber,
                'cleaned' => $cleanPhone,
                'length' => strlen($cleanPhone)
            ]);
            return [
                'success' => false,
                'message' => 'Invalid phone number format. Must be 11 digits starting with 01 or 13 digits starting with 880.'
            ];
        }

        $api_key = "ltXBwd4xGgNyIK3kzOe5"; // Replace with your actual API key
        $senderid = "8809617622501"; // Replace with your actual Sender ID

        $url = "http://bulksmsbd.net/api/smsapi?api_key=$api_key&type=text&number=$cleanPhone&senderid=$senderid&message=" . urlencode($message);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            Log::error('cURL Error in SMS sending', ['error' => $error, 'phone' => $cleanPhone]);
            return [
                'success' => false,
                'message' => 'cURL Error: ' . $error
            ];
        }

        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        Log::info("SMS API Response", [
            'http_status' => $http_status,
            'response' => $response,
            'phone' => $cleanPhone,
            'message' => $message
        ]);

        if ($http_status !== 200) {
            return [
                'success' => false,
                'message' => "HTTP Error $http_status: $response"
            ];
        }

        return [
            'success' => true,
            'message' => 'SMS sent successfully',
            'response' => $response
        ];
    }

    /**
     * Send application status update SMS
     *
     * @param string $phoneNumber
     * @param string $status
     * @param string $customMessage
     * @return array
     */
    public static function sendApplicationStatusSms($phoneNumber, $status, $customMessage = null)
    {
        $statusMessages = [
            'approved' => 'Your seat application has been approved.',
            'rejected' => 'Your seat application has been rejected.',
            'pending' => 'Your seat application status has been updated.',
            'allocated' => 'Your seat has been allocated successfully.',
            'released' => 'Your seat has been released.'
        ];

        $baseMessage = $customMessage ?? ($statusMessages[$status] ?? 'Your application status has been updated.');
        $message = $baseMessage . ' – NSTU Hall Administration';

        return self::sendSms($phoneNumber, $message);
    }

    /**
     * Send seat assignment SMS
     *
     * @param string $phoneNumber
     * @param string $roomNumber
     * @param string $bedNumber
     * @param string $block
     * @param string $floor
     * @return array
     */
    public static function sendSeatAssignmentSms($phoneNumber, $roomNumber, $bedNumber, $block, $floor)
    {
        $message = "Your seat has been allocated: Room $roomNumber, Bed $bedNumber, Block $block, Floor $floor. – NSTU Hall Administration";

        return self::sendSms($phoneNumber, $message);
    }

    /**
     * Send seat release SMS
     *
     * @param string $phoneNumber
     * @param string $roomNumber
     * @param string $bedNumber
     * @param string $reason
     * @return array
     */
    public static function sendSeatReleaseSms($phoneNumber, $roomNumber, $bedNumber, $reason)
    {
        $message = "Your seat (Room $roomNumber, Bed $bedNumber) has been released. Reason: $reason – NSTU Hall Administration";

        return self::sendSms($phoneNumber, $message);
    }
}
