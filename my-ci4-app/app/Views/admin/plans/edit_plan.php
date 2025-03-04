<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h2>Edit Plan</h2>

    <?php if (session()->has('error')): ?>
        <p style="color: red;"><?= session('error') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('admin/plans/update/' . $plan['id']) ?>" method="post">
        <?= csrf_field() ?>

        <label for="name">Name:</label>
        <input type="text" name="no_of_coins" id="name" value="<?= esc($plan['no_of_coins']) ?>" required>

        <label for="price">Price:</label>
        <input type="text" name="amount" id="price" value="<?= esc($plan['amount']) ?>" required>

        <!-- <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="1" <?= ($plan['status'] == 1) ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= ($plan['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
        </select> -->

        <button type="submit">Update</button>
    </form>


<?= $this->endSection() ?>
