<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h2>Settings</h2>

    <?php if (session()->has('error')): ?>
        <p style="color: red;"><?= session('error') ?></p>
    <?php endif; ?>

 


<?= $this->endSection() ?>
