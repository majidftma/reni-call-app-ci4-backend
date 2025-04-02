<?php

namespace App\Controllers;

use App\Models\LanguageModel;
use CodeIgniter\RESTful\ResourceController;

class LanguageController extends ResourceController
{
    protected $modelName = 'App\Models\LanguageModel';
    protected $format    = 'json';

    // POST: Add a new language
    public function create()
    {
        $data = $this->request->getJSON(true); // Get JSON input as an associative array

        if (!$this->validate([
            'name' => 'required|string',
            'language_code' => 'required|string|max_length[10]',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $id = $this->model->insert($data);
        if ($id) {
            return $this->respondCreated(['id' => $id, 'message' => 'Language created successfully']);
        }

        return $this->fail('Failed to create language', 500);
    }

    // GET: Fetch all languages
    public function index()
    {
        $languages = $this->model->findAll();
        return $this->respond($languages);
    }

    // GET: Fetch language by ID
    public function show($id = null)
    {
        $language = $this->model->find($id);
        if ($language) {
            return $this->respond($language);
        }

        return $this->failNotFound('Language not found');
    }
}
