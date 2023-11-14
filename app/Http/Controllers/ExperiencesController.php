<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperiencesRequest;
use App\Models\API\Experiences;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExperiencesController extends Controller
{
    /**
     * Untuk melakukan pengambilan data mengguankan 
     * endpoint experiences dan dengan method get
     * 
     */
    public function read(ExperiencesRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $query = Experiences::select('id', 'tahun', 'tempat', 'bidang', 'deskripsi')->orderBy('tahun', 'asc');

        /**
         * Periksa apakah data id_programmer ada
         * jika ada, filter data sesuai id
         * 
         */
        if (!empty($data['id_programmers'])) {
            $query = $query
                ->where('id_programmers', $data['id_programmers']);
        }

        /**
         * Periksa apakah data search ada
         * jika ada, lakukan filter data
         * 
         */
        if (!empty($data['search'])) {
            $query = $query
                ->where('deskripsi', 'LIKE', '%' . $data['search'] . '%');
        }

        /**
         * Mendapatkan data dari database berdasarkan
         * pengaturan query di atas
         */
        $experiences = $query->get();

        /**
         * Mengembalikan response setelah data sudah difilter
         * sesuai kebutuhan untuk 
         */
        return response()->json(
            $experiences
        )->setStatusCode(200);
    }
    public function create(ExperiencesRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();

        $experiences = new Experiences($data);
        $experiences->save();

        return response()->json([
            'success' => [
                'message' => 'Experience berhasil ditambahkan',
            ]
        ])->setStatusCode(201);
    }
    public function delete(ExperiencesRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();

        $experiences = Experiences::where('id', $data['id_experiences']);
        $experiences->delete();

        return response()->json([
            'success' => [
                'message' => 'Experience berhasil dihapus',
            ]
        ])->setStatusCode(200);
    }
}
