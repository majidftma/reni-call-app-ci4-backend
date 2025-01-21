<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h1>Add Plan</h1>

<?php if (session()->get('errors')): ?>
    <ul>
        <?php foreach (session()->get('errors') as $error): ?>
        <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form id="create-plan-form">
        <div>
            <label for="no_of_coins">No. of Coins:</label>
            <input type="number" id="no_of_coins" name="no_of_coins" required>
        </div>
        <div>
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required>
        </div>
        <div>
            <button type="button" id="submit-plan">Create Plan</button>
        </div>
    </form>
    <div id="response-message" style="margin-top: 20px;"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function () {
            $('#submit-plan').click(function () {
                // Gather form data
                const planData = {
                    no_of_coins: $('#no_of_coins').val(),
                    amount: $('#amount').val(),
                };

                // Make AJAX request
                $.ajax({
                    url: '../../api/plans', // API endpoint
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(planData),
                    success: function (response) {
                        // Display success message
                        $('#response-message').html(
                            `<p style="color: green;">${response.message}</p>`
                        );
                        $('#create-plan-form')[0].reset();
                    },
                    error: function (xhr) {
                        // Display error messages
                        let errors = xhr.responseJSON.messages;
                        let errorHtml = '<ul style="color: red;">';
                        for (const key in errors) {
                            errorHtml += `<li>${errors[key]}</li>`;
                        }
                        errorHtml += '</ul>';
                        $('#response-message').html(errorHtml);
                    },
                });
            });
        });
    </script>
<?= $this->endSection() ?>
