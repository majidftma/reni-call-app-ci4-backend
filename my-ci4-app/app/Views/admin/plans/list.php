<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h1>Plans</h1>

<?php if (session()->get('success')): ?>
    <p class="success"><?= session()->get('success') ?></p>
<?php endif; ?>

<a href="<?= base_url('admin/plans/create') ?>" class="btn btn-primary">Add Plan</a>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Price</th>
            <th>Duration (days)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plans as $plan): ?>
        <tr>
            <td><?= $plan['id'] ?></td>
            <td><?= $plan['amount'] ?></td>
            <td><?= $plan['no_of_coins'] ?></td>
            <td>
                <a href="<?= base_url('admin/plans/edit/' . $plan['id']) ?>">Edit</a>
                <a href="<?= base_url('admin/plans/delete/' . $plan['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>
