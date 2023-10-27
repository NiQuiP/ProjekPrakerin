<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Webcam Capture</title>
</head>

<body>
    <h1>Webcam Capture</h1>
    <div id="webcam-feed">
        <video id="webcam-video" autoplay></video>
    </div>
    <button id="start-button">Start Webcam</button>
    <button id="capture-button" style="display: none;">Capture</button>
    <img id="captured-image" style="display: none;">
    <button id="save-button" style="display: none;">Save</button>
    <form id="capture-form" style="display: none;">
        <input type="file" name="imageData" id="imageData" hidden>
    </form>
    <div id="message" style="display: none;">
        <p id="success-message" style="color: green;"></p>
        <p id="error-message" style="color: red;"></p>
    </div>

    <script>
        // JavaScript untuk mengambil gambar dari webcam dan mengirimkannya ke server

        // Ambil elemen-elemen DOM yang diperlukan
        const webcamVideo = document.getElementById('webcam-video');
        const startButton = document.getElementById('start-button');
        const captureButton = document.getElementById('capture-button');
        const capturedImage = document.getElementById('captured-image');
        const saveButton = document.getElementById('save-button');
        const captureForm = document.getElementById('capture-form');
        const imageDataInput = document.getElementById('imageData');

        // Variabel untuk menyimpan stream video
        let stream;

        // Handler untuk memulai webcam
        startButton.addEventListener('click', async () => {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                webcamVideo.srcObject = stream;
                startButton.style.display = 'none';
                captureButton.style.display = 'block';
            } catch (error) {
                console.error('Error accessing webcam:', error);
            }
        });

        // Handler untuk mengambil gambar dari webcam
        captureButton.addEventListener('click', () => {
            const canvas = document.createElement('canvas');
            canvas.width = webcamVideo.videoWidth;
            canvas.height = webcamVideo.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(webcamVideo, 0, 0, canvas.width, canvas.height);
            capturedImage.src = canvas.toDataURL('image/png');
            captureButton.style.display = 'none';
            capturedImage.style.display = 'block';
            saveButton.style.display = 'block';
        });

        // Handler untuk menyimpan gambar
        saveButton.addEventListener('click', () => {
            const imageBase64 = capturedImage.src;
            imageDataInput.value = imageBase64;
            captureForm.submit(); // Mengirim data gambar ke server
        });
    </script>
</body>

</html>