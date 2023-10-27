<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class WebcamController extends BaseController
{
    public function index()
    {
        return view('webcam');
    }

    public function capture()
    {

        if (!empty($imageData)) {
            $imageData = $this->request->getFile('imageData'); // Ambil data gambar dari POST request
            $imageData = str_replace('data:image/png;base64,', '', $imageData); // Hapus header gambar
            $imageData = base64_decode($imageData); // Decode data gambar

            $imageName = 'webcam_image_' . date('YmdHis') . '.png'; // Nama file gambar yang akan disimpan

            // Simpan gambar ke direktori yang sesuai
            $imagePath = LOKASI_UPLOAD . $imageName;
            // file_put_contents($imagePath, $imageData);
            $imageData->move(LOKASI_UPLOAD . $imageName);
            // Lakukan apa yang Anda butuhkan dengan gambar ini, misalnya, menyimpan path ke database, dll.
        }
        // if (file_put_contents($imagePath, $imageData)) {
        //     return $this->response->setJSON(['success' => true, 'message' => 'Gambar berhasil disimpan.']);
        // } else {
        //     return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan gambar.']);
        // }


        // return redirect()->to('/webcam')->with('success', 'Gambar berhasil disimpan.');
    }
}