<?php

namespace App\Controllers;

use Razorpay\Api\Api;
use CodeIgniter\RESTful\ResourceController;

class PaymentController extends ResourceController
{
    private $api_key = 'rzp_test_nilQIDKD7V7AeE'; // Replace with your Razorpay API Key
    private $api_secret = 'tu0diuMBbb3IW6dQ25K7KGnf'; // Replace with your Razorpay Secret Key

    public function createOrder()
    {
        $data = $this->request->getJSON(true); // Get JSON input as an associative array
        
        if (!$this->validate([
            'user_id' => 'required|integer',
            'amount' => 'required|numeric|max_length[10]',
        ])) {
    
        return $this->failValidationErrors($this->validator->getErrors());
    }
    
        try {
            // Initialize Razorpay API
            $api = new Api($this->api_key, $this->api_secret);

            // Create an order
            $orderData = [
                'receipt'         => 'order_rcptid_' . time(),
                'amount'          => $data['amount'] * 100, // Amount in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // Auto-capture payment
            ];

            $order = $api->order->create($orderData);

            return $this->respond([
                'order_id' => $order['id'],
                'amount' => $data['amount'],
                'user_id' => $data['user_id'],
                'status' => 'Order Created'
            ], 200);
        } catch (\Exception $e) {

            return $this->fail($e->getMessage(), 500);
        }
    }

    public function verifyPayment()
    {
        $data = $this->request->getJSON(true); // Get JSON input as an associative array

        if (!$this->validate([
                'razorpay_signature' => 'required',
                'razorpay_payment_id' => 'required',
                'razorpay_order_id' => 'required',
                'user_id' => 'required|integer',
                'amount' => 'required|numeric|max_length[10]',
            ], $data)) {
        
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        // Access validated data
        $signature = $data['razorpay_signature'];
        $paymentId = $data['razorpay_payment_id'];
        $orderId = $data['razorpay_order_id'];
        $userId = $data['user_id'];
        $amount = $data['amount'];
        
        try {
            $api = new Api($this->api_key, $this->api_secret);

            // Verify payment signature
            $attributes = [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];
            $api->utility->verifyPaymentSignature($attributes);

            // Store transaction details in the database
            $db = \Config\Database::connect();
            $builder = $db->table('transactions');

            $data = [
                'user_id' => $userId,
                'order_id' => $orderId,
                'payment_id' => $paymentId,
                'amount' => $amount / 100, // Convert to original value (paise to INR)
                'currency' => 'INR',
                'status' => 'SUCCESS',
            ];

            $builder->insert($data);

            return $this->respond(['status' => 'Payment Verified', 'transaction_id' => $db->insertID()], 200);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

}
