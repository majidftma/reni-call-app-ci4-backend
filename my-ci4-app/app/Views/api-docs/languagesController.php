<?= $this->extend('api-docs/layouts/main') ?>


<?= $this->section('content') ?>


    <div class="container">
        <h1>LanguageController API Documentation</h1>
        <p>This API provides endpoints for managing languages.</p>

        <h2>1. Create a Language</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>POST /language</code><br>
            <strong>Description:</strong> Adds a new language.<br>
            <strong>Request Body:</strong>
            <pre>{
    "name": "English",
    "language_code": "en"
}</pre>
            <strong>Response:</strong>
            <pre>{
    "id": 1,
    "message": "Language created successfully"
}</pre>
        </div>

        <h2>2. Fetch All Languages</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>GET /language</code><br>
            <strong>Description:</strong> Retrieves all languages.<br>
            <strong>Response:</strong>
            <pre>[
    {
        "id": 1,
        "name": "English",
        "language_code": "en"
    }
]</pre>
        </div>

        <h2>3. Fetch Language by ID</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>GET /language/{id}</code><br>
            <strong>Description:</strong> Retrieves a language by its ID.<br>
            <strong>Response:</strong>
            <pre>{
    "id": 1,
    "name": "English",
    "language_code": "en"
}</pre>
            <strong>Error Response:</strong>
            <pre>{
    "error": "Language not found"
}</pre>
        </div>
    </div>

    <?= $this->endSection() ?>

