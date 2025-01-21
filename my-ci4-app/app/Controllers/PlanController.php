<?php

namespace App\Controllers;

use App\Models\PlanModel;
use CodeIgniter\RESTful\ResourceController;

class PlanController extends ResourceController
{
    protected $format = 'json';

    public function createPlan()
    {
        $planModel = new PlanModel();

        // Get JSON input
        $data = $this->request->getJSON(true);

        // Validate input
        if (!$this->validate([
            'no_of_coins' => 'required|integer|greater_than[0]',
            'amount' => 'required|decimal|greater_than[0]',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Insert plan into the database
        $planId = $planModel->insert($data);
        if (!$planId) {
            return $this->failServerError('Failed to create plan.');
        }

        return $this->respondCreated([
            'message' => 'Plan created successfully.',
            'plan_id' => $planId,
        ]);
    }

    public function getPlans()
    {
        $planModel = new PlanModel();
        $plans = $planModel->findAll();

        if (!$plans) {
            return $this->failNotFound('No plans found.');
        }

        return $this->respond($plans);
    }

    public function getPlanById($id = null)
    {
        $planModel = new PlanModel();
        $plan = $planModel->find($id);

        if (!$plan) {
            return $this->failNotFound("Plan with ID $id not found.");
        }

        return $this->respond($plan);
    }
}
