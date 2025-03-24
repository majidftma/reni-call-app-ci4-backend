<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserTokenModel;
use App\Models\UserModel;
use App\Models\TelecallerModel;
use App\Models\LanguageModel;

class TelecallerController extends ResourceController
{

    protected $walletModel;
    protected $userModel;
    protected $telecallerModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->languageModel = new LanguageModel();
        $this->telecallerModel = new TelecallerModel();



    }
    public function createTelecaller()
    {
        $data = [
            'mobile' => $this->request->getVar('mobile'),
            'name' => $this->request->getVar('name'),
            'gender' => $this->request->getVar('gender'),
            'accountnumber' => $this->request->getVar('accountnumber'),
            'ifsc' => $this->request->getVar('ifsc'),
            'preferred_language' => $this->request->getVar('preferred_language'),
        ];

        if ($this->telecallerModel->insert($data)) {
            return $this->respondCreated(['message' => 'Telecaller created successfully']);
        } else {
            return $this->fail('Failed to create telecaller');
        }
    }

    public function getAllTelecallers()
    {
        $telecallers = $this->telecallerModel->findAll();
        return $this->respond($telecallers);
    }

}