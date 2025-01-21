<?= $this->extend('api-docs/layouts/main') ?>

<?= $this->section('content') ?>
<h1>UserController API Documentation</h1>
<p>The <strong>UserController</strong> provides APIs for user management, available under the base route <code>/api/users</code>. The responses are in JSON format.</p>

<hr>

<h2>Endpoints</h2>

<h3>1. Create a User</h3>
<p><strong>Endpoint:</strong> <code>POST /api/users</code></p>
<p><strong>Description:</strong> Creates a new user and initializes a wallet with a default balance of 100.</p>
<p><strong>Request Body:</strong></p>
<pre><code>{
  "name": "string (required, max_length: 255)",
  "mobile": "string (required, max_length: 15, unique)",
  "age": "integer (required, greater_than: 0)",
  "preferred_language": "integer (required, greater_than: 0)"
}</code></pre>
<p><strong>Response:</strong></p>
<pre><code>{
  "message": "User and wallet created successfully.",
  "user_id": "integer"
}</code></pre>
<p><strong>Errors:</strong></p>
<ul>
    <li><code>400 Bad Request</code> - Validation errors</li>
    <li><code>404 Not Found</code> - Invalid preferred_language ID</li>
    <li><code>500 Internal Server Error</code> - User or wallet creation failure</li>
</ul>

<hr>

<h3>2. Get All Users</h3>
<p><strong>Endpoint:</strong> <code>GET /api/users</code></p>
<p><strong>Description:</strong> Retrieves a list of all users, including their preferred language names.</p>
<p><strong>Response:</strong></p>
<pre><code>[
  {
    "id": "integer",
    "name": "string",
    "mobile": "string",
    "age": "integer",
    "preferred_language": "integer",
    "language": "string (name of preferred language)"
  },
  ...
]</code></pre>
<p><strong>Errors:</strong></p>
<ul>
    <li><code>404 Not Found</code> - No users found</li>
</ul>

<hr>

<h3>3. Get User by ID</h3>
<p><strong>Endpoint:</strong> <code>GET /api/users/{id}</code></p>
<p><strong>Description:</strong> Retrieves a single user by their ID, including their preferred language name.</p>
<p><strong>Path Parameter:</strong></p>
<ul>
    <li><code>id</code> - <em>integer</em> (required)</li>
</ul>
<p><strong>Response:</strong></p>
<pre><code>{
  "id": "integer",
  "name": "string",
  "mobile": "string",
  "age": "integer",
  "preferred_language": "integer",
  "language": "string (name of preferred language)"
}</code></pre>
<p><strong>Errors:</strong></p>
<ul>
    <li><code>404 Not Found</code> - User with the given ID not found</li>
</ul>

<hr>

<h2>Notes</h2>
<ul>
    <li>The API enforces strict validation rules for input data.</li>
    <li>The `preferred_language` field corresponds to the `id` in the `LanguageModel`.</li>
    <li>Wallets are automatically initialized for new users with a default balance of 100.</li>
</ul>

<?= $this->endSection() ?>
