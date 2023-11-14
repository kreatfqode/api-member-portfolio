<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectsRequest;
use App\Models\API\Projects;
use App\Models\API\Skills;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Fungsi untuk mendapatkan data yang dibutuhkan
     * dari dalam database tabel programmer
     */
    public function read(ProjectsRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $query = Projects::select(
            'id',
            'id_programmers',
            'nama',
            'gambar',
            'tanggal',
            'link',
            'teknologi',
        )->where('id_programmers', $data['id_programmers']);

        $projects = $query->get();

        // Pisahkan teknologi menjadi array
        foreach ($projects as $project) {
            $teknologiList = explode(',', $project->teknologi);
            $skillNames = Skills::whereIn('id', $teknologiList)->pluck('nama');
            $project->teknologi = $skillNames->toArray();
        }

        /**
         * Mengembalikan response setelah data sudah difilter
         * sesuai kebutuhan untuk 
         */
        return response()->json(
            $projects
        )->setStatusCode(200);
    }

    public function create(ProjectsRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $data['teknologi'] = is_array($data['teknologi']) ? implode(',', $data['teknologi']) : $data['teknologi'];

        if (!empty($data['gambar'])) {
            /**
             * 'upload' adalah subfolder tempat gambar akan disimpan
             * di sistem penyimpanan yang Anda konfigurasi
             */
            $base64Parts = explode(",", $data['gambar']);
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
            $data['gambar'] = $path;
        }

        $programmer = new Projects($data);
        $programmer->save();

        return response()->json([
            'success' => [
                'message' => "Project berhasil dibuat"
            ]
        ])->setStatusCode(200);
    }
    public function delete(ProjectsRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $skills = Projects::where('id', $data['id_projects']);
        $skills->delete();

        return response()->json([
            'success' => [
                'message' => "Project berhasil dihapus"
            ]
        ])->setStatusCode(200);
    }
}
