<?= $this->extend('api-docs/layouts/main') ?>


<?= $this->section('content') ?>



<div class="container">
        <h2>Telecaller API Documentation</h2>
        
        <h3>1. Create Telecaller</h3>
        <p><strong>Endpoint:</strong> <code>POST /api/telecaller/create</code></p>
        <p><strong>Description:</strong> Creates a new telecaller with the provided details.</p>
        <h4>Request Parameters</h4>
        <table>
            <tr>
                <th>Parameter</th>
                <th>Type</th>
                <th>Required</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>mobile</td>
                <td>String</td>
                <td>Yes</td>
                <td>Mobile number of the telecaller</td>
            </tr>
            <tr>
                <td>name</td>
                <td>String</td>
                <td>Yes</td>
                <td>Name of the telecaller</td>
            </tr>
            <tr>
                <td>gender</td>
                <td>String</td>
                <td>No</td>
                <td>Gender of the telecaller</td>
            </tr>
            <tr>
                <td>accountnumber</td>
                <td>String</td>
                <td>No</td>
                <td>Bank account number</td>
            </tr>
            <tr>
                <td>ifsc</td>
                <td>String</td>
                <td>No</td>
                <td>IFSC code of the telecaller’s bank</td>
            </tr>
            <tr>
                <td>preferred_language</td>
                <td>String</td>
                <td>No</td>
                <td>Preferred language</td>
            </tr>
        </table>
        
        <h4>Response (Success - 201 Created)</h4>
        <pre>{ "message": "Telecaller created successfully" }</pre>

        <h4>Response (Error - 400 Bad Request)</h4>
        <pre>{ "status": 400, "error": "Failed to create telecaller" }</pre>

        <h3>2. Get All Telecallers</h3>
        <p><strong>Endpoint:</strong> <code>GET /api/telecaller/all</code></p>
        <p><strong>Description:</strong> Fetches all telecallers from the database.</p>
        
        <h4>Response (Success - 200 OK)</h4>
        <pre>
        [
            {
                "id": 1,
                "mobile": "9876543210",
                "name": "John Doe",
                "gender": "Male",
                "accountnumber": "123456789",
                "ifsc": "ABC123456",
                "preferred_language": "English"
            },
            {
                "id": 2,
                "mobile": "9876543211",
                "name": "Jane Doe",
                "gender": "Female",
                "accountnumber": "987654321",
                "ifsc": "XYZ987654",
                "preferred_language": "Hindi"
            }
        ]
        </pre>
    </div>

    <?= $this->endSection() ?>

