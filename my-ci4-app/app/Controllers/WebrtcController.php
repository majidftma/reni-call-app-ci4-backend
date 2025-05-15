<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class WebrtcController extends ResourceController
{
    protected $format = 'json';

    private static $peerData = [];

    public function sendSignal()
    {
        $input = $this->request->getJSON(true);
        $type = $input['type'];
        $payload = $input['data'];

        // Store or broadcast (for simplicity, store in memory)
        self::$peerData[$type] = $payload;

        return $this->respond(['status' => 'signal stored']);
    }

    public function getSignal($type)
    {
        if (isset(self::$peerData[$type])) {
            return $this->respond(['data' => self::$peerData[$type]]);
        } else {
            return $this->failNotFound("No signal found for type: $type");
        }
    }
}
