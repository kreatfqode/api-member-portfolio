<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillsRequest;
use App\Models\API\MasterSkills;
use App\Models\API\Skills;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    /**
     * Untuk melakukan pengambilan data
     * mengguankan endpoint skills
     * dan dengan method get
     * 
     */
    public function read(SkillsRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $query = Skills::select('skills.id', 'skills.nama', 'skills.gambar')->orderBy('nama', 'asc');

        /**
         * Periksa apakah data id_programmer ada
         * jika ada, filter data sesuai id
         * 
         */
        if (!empty($data['id_programmers'])) {
            $query = $query
                ->join('master_skills', 'master_skills.id_skills', 'skills.id')
                ->where('master_skills.id_programmers', $data['id_programmers']);
        }
        if (!empty($data['id_programmers_not']) && MasterSkills::count() > 0) {
            $query = $query
                ->whereNotIn('skills.id', function ($query) use ($data) {
                    $query->select('id_skills')
                        ->from('master_skills')
                        ->where('id_programmers', $data['id_programmers_not']);
                });
        }

        if (!empty($data['search'])) {
            $query = $query
                ->where('skills.nama', 'LIKE', '%' . $data['search'] . '%');
        }

        $skills = $query->get();
        /**
         * Mengembalikan response setelah data sudah difilter
         * sesuai kebutuhan untuk 
         */
        return response()->json(
            $skills
        )->setStatusCode(200);
    }

    public function create(SkillsRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();

        /**
         * Simpan data ke dalam tabel
         * database yang sesuai
         */
        $skills = new MasterSkills($data);
        $skills->save();

        /**
         * Mengembalikan response jika data berhasil
         * ditambahkan dengan baik tanpa habatan
         * 
         */
        return response()->json(['success' => ['message' => 'Data skill anda berhasil ditambahkan']]);
    }
    public function delete(SkillsRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $skills = MasterSkills::where('id_programmers', $data['id_programmers'])
            ->where('id_skills', $data['id_skills']);
        $skills->delete();

        return response()->json(['success' => ['message' => 'Skill berhasil dihapus']]);
    }
}