<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h1>users</h1>

<?php if (session()->get('success')): ?>
    <p class="success"><?= session()->get('success') ?></p>
<?php endif; ?>

<!-- <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">Add Plan</a> -->

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <!-- <th>Actions</th> -->
        </tr>
    </thead>
    <tbody>
        <?php $ctr = 0;  foreach ($users as $plan): $ctr++; ?>
        <tr>
            <td><?= $ctr ?></td>
            <td><?= $plan['name'] ?></td>
            <td><?= $plan['mobile'] ?></td>
            <!-- <td>
                <a href="<?= base_url('admin/users/edit/' . $plan['id']) ?>">Edit</a>
                <a href="<?= base_url('admin/users/delete/' . $plan['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td> -->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>
