<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgrammersRequest;
use App\Models\API\Programmers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class ProgrammersController extends Controller
{
    /**
     * Fungsi untuk mendapatkan data yang dibutuhkan
     * dari dalam database tabel programmer
     */
    public function read(ProgrammersRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $query = Programmers::select(
            'email',
            'password',
            'nama_panggilan',
            'nama_lengkap',
            'warna_primary',
            'warna_secondary',
            'foto_utama',
            'foto_tentang',
            'tentang_diri',
            'tentang_skill',
            'tentang_pengalaman',
            'tentang_project',
            'alamat',
            'no_telp',
            'mulai_karir',
            'moto_project',
            'pdf_cv',
        )->where('id_programmers', $data['id_programmers']);
        $programmers = $query->get();

        /**
         * Mengembalikan response setelah data sudah difilter
         * sesuai kebutuhan untuk 
         */
        return response()->json([
            'data' => $programmers
        ])->setStatusCode(200);
    }

    public function create(ProgrammersRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();

        $programmer = new Programmers($data);
        $programmer->save();

        return response()->json([
            'success' => [
                'message' => 'Data programmer telah berhasil dibuat'
            ]
        ])->setStatusCode(200);
    }

    public function update(ProgrammersRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();

        if (!empty($data['foto_utama']) ^ !empty($data['foto_tentang'])) {
            /**
             * 'upload' adalah subfolder tempat gambar akan disimpan
             * di sistem penyimpanan yang Anda konfigurasi
             */
            $gambarIndex = !empty($data['foto_utama']) ? 'foto_utama' : 'foto_tentang';
            $base64Parts = explode(",", $data[$gambarIndex]);
            $base64Image = end($base64Parts);

            $decodedImage = base64_decode($base64Image);

            /**
             * Membuat instance Intervention Image
             * 
             */
            $img = Image::make($decodedImage);

            /**
             * Tentukan ekstensi yang diinginkan
             * (jpg, jpeg, atau png)
             * 
             */
            $extension = 'jpg';

            /**
             * Mengidentifikasi tipe MIME gambar
             * 
             */
            $mime = finfo_buffer(finfo_open(), $decodedImage, FILEINFO_MIME_TYPE);

            /**
             * Jika tipe MIME adalah gambar JPEG, 
             * maka set ekstensi menjadi 'jpg'
             * 
             */
            if ($mime === 'image/jpeg') {
                $extension = 'jpeg';
            }

            /**
             * Jika tipe MIME adalah gambar PNG,
             * maka set ekstensi menjadi 'png'
             * 
             */
            if ($mime === 'image/png') {
                $extension = 'png';
            }

            $namaFile = $data['id_programmers'] . Carbon::now()->format('Y-m-d') . '_' . time() . '.' . $extension;

            /**
             * Simpan gambar ke folder
             * 
             */
            $path = 'images/upload/' . $namaFile;
            $img->save(public_path($path), 80);
            $data[$gambarIndex] = $path;

        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        /**
         * Mencari data yang ingin diperbarui
         * 
         */
        $programmer = Programmers::where('id', $data['id_programmers'])->first();

        /**
         * Kosongkan data yang tidak relevan
         * untuk di-update dalam tabel
         * 
         */
        unset($data['id_programmers']);

        /**
         * Fix data dan lakukan perbaruan data
         * 
         */
        $programmer->update($data);

        /**
         * Lakukan response sukses jika seluruh baris
         * program di atas dieksekusi dengan benar
         * 
         */
        return response()->json([
            'success' => [
                'message' => 'Data programmer berhasil diupdate',
                'path' => $path ?? "",
            ]
        ])->setStatusCode(201);

    }

}
