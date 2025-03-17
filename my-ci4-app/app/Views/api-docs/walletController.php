

<?= $this->extend('api-docs/layouts/main') ?>

<?= $this->section('content') ?>


<div class="container">
        <h1>WalletController API Documentation</h1>
        <p>This API provides endpoints for managing user wallets, including balance retrieval, crediting, and debiting.</p>

        <h2>1. Get Wallet Balance</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>GET /api/wallet/balance/{user_id}</code><br>
            <strong>Description:</strong> Retrieves the wallet balance for a specific user.<br>
            <strong>Response:</strong>
            <pre>{
    "balance": 150.00
}</pre>
        </div>

        <h2>2. Credit Wallet</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>POST /api/wallet/credit</code><br>
            <strong>Description:</strong> Adds a specified amount to the user's wallet balance.<br>
            <strong>Request Parameters:</strong>
            <pre>{
    "user_id": 1,
    "amount": 50.00
}</pre>
            <strong>Response:</strong>
            <pre>{
    "message": "Wallet credited successfully",
    "balance": 200.00
}</pre>
        </div>

        <h2>3. Debit Wallet</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>POST /api/wallet/debit</code><br>
            <strong>Description:</strong> Deducts a specified amount from the user's wallet balance if sufficient funds are available.<br>
            <strong>Request Parameters:</strong>
            <pre>{
    "user_id": 1,
    "amount": 30.00
}</pre>
            <strong>Response:</strong>
            <pre>{
    "message": "Wallet debited successfully",
    "balance": 120.00
}</pre>
        </div>
    </div>

    <?= $this->endSection() ?>
