<?= $this->extend('api-docs/layouts/main') ?>

<?= $this->section('content') ?>
<h1>PlanController API Documentation</h1>
<p>The <strong>PlanController</strong> provides APIs to manage plans, available under the base route <code>/api/plans</code>. The responses are in JSON format.</p>

<hr>

<h2>Endpoints</h2>

<h3>1. Create a Plan</h3>
<p><strong>Endpoint:</strong> <code>POST /api/plans</code></p>
<p><strong>Description:</strong> Creates a new plan in the system.</p>
<p><strong>Request Body:</strong></p>
<pre><code>{
  "no_of_coins": "integer (required, greater_than: 0)",
  "amount": "decimal (required, greater_than: 0)"
}</code></pre>
<p><strong>Response:</strong></p>
<pre><code>{
  "message": "Plan created successfully.",
  "plan_id": "integer"
}</code></pre>
<p><strong>Errors:</strong></p>
<ul>
    <li><code>400 Bad Request</code> - Validation errors</li>
    <li><code>500 Internal Server Error</code> - Failed to create the plan</li>
</ul>

<hr>

<h3>2. Get All Plans</h3>
<p><strong>Endpoint:</strong> <code>GET /api/plans</code></p>
<p><strong>Description:</strong> Retrieves all plans in the system.</p>
<p><strong>Response:</strong></p>
<pre><code>[
  {
    "id": "integer",
    "no_of_coins": "integer",
    "amount": "decimal"
  },
  ...
]</code></pre>
<p><strong>Errors:</strong></p>
<ul>
    <li><code>404 Not Found</code> - No plans found</li>
</ul>

<hr>

<h3>3. Get Plan by ID</h3>
<p><strong>Endpoint:</strong> <code>GET /api/plans/{id}</code></p>
<p><strong>Description:</strong> Retrieves a specific plan by its ID.</p>
<p><strong>Path Parameter:</strong></p>
<ul>
    <li><code>id</code> - <em>integer</em> (required)</li>
</ul>
<p><strong>Response:</strong></p>
<pre><code>{
  "id": "integer",
  "no_of_coins": "integer",
  "amount": "decimal"
}</code></pre>
<p><strong>Errors:</strong></p>
<ul>
    <li><code>404 Not Found</code> - Plan with the given ID not found</li>
</ul>

<hr>

<h2>Notes</h2>
<ul>
    <li>Each plan requires a valid number of coins (<code>no_of_coins</code>) and an amount (<code>amount</code>).</li>
    <li>The API enforces strict validation rules for all input data.</li>
</ul>

<?= $this->endSection() ?>
