<!DOCTYPE html>
<html>

<head>
    <title>Webcam Capture</title>
    <script src="<?= base_url('admin'); ?>/js/webcam.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php if (session()->getFlashdata('success')): ?>
    <?= session()->getFlashdata('success'); ?>
    <?php endif ?>
    <h1>Webcam Capture</h1>
    <video id="webcam" autoplay></video>
    <button id="capture">Capture</button>
    <canvas id="canvas" style="display: none;"></canvas>
    <img id="image" style="display: none;">
</body>

</html>