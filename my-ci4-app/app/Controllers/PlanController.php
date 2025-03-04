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

    public function edit($id = null)
    {
        $planModel = new PlanModel();
        $data['plan'] = $planModel->find($id);

        if (!$data['plan']) {
            return redirect()->to('/admin/plans')->with('error', 'Plan not found.');
        }

        return view('admin/plans/edit_plan', $data);
    }

    public function update($id = null)
    {
        $planModel = new PlanModel();

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_of_coins' => 'required',
            'amount' => 'required|numeric',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('error', 'Please check your input.');
        }

        // Update plan details
        $planModel->update($id, [
            'no_of_coins' => $this->request->getPost('no_of_coins'),
            'amount' => $this->request->getPost('amount'),
            // 'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/plans')->with('success', 'Plan updated successfully.');
    } 

    public function editPlan($id = null)
{
    $planModel = new PlanModel();

    // Find the existing plan
    $plan = $planModel->find($id);
    if (!$plan) {
        return $this->failNotFound("Plan with ID $id not found.");
    }

    // Get JSON input
    $data = $this->request->getJSON(true);

    // Validate input
    if (!$this->validate([
        'no_of_coins' => 'required|integer|greater_than[0]',
        'amount' => 'required|decimal|greater_than[0]',
    ])) {
        return $this->failValidationErrors($this->validator->getErrors());
    }

    // Update the plan
    if (!$planModel->update($id, $data)) {
        return $this->failServerError('Failed to update plan.');
    }

    return $this->respond([
        'message' => 'Plan updated successfully.',
        'plan_id' => $id,
    ]);
}

    public function delete($id=null)
    {
        $planModel = new PlanModel();

        // Check if the plan exists
        $plan = $planModel->find($id);

        if (!$plan) {
            return redirect()->to('/admin/plans')->with('error', 'Plan not found.');
        }

        // Delete the plan
       /* if ($planModel->delete($id)) {
            return redirect()->to('/admin/plans')->with('success', 'Plan deleted successfully.');
        } else {
            return redirect()->to('/admin/plans')->with('error', 'Failed to delete the plan.');
        } */ 

         // Set status to 0 instead of deleting
            if ($planModel->update($id, ['status' => 0])) {
                return redirect()->to('/admin/plans')->with('success', 'Plan deactivated successfully.');
            } else {
                return redirect()->to('/admin/plans')->with('error', 'Failed to deactivate the plan.');
            }
    }
}
