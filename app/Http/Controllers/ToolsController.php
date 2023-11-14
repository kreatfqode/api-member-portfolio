<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToolsRequest;
use App\Models\API\MasterTools;
use App\Models\API\Tools;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    /**
     * Untuk melakukan pengambilan data
     * mengguankan endpoint skills
     * dan dengan method get
     * 
     */
    public function read(ToolsRequest $request): JsonResponse
    {
        $data = $request->validated();
        $query = Tools::select('tools.nama', 'tools.gambar', 'tools.id')->orderBy('nama', 'asc');

        /**
         * Periksa apakah data id_programmer ada
         * jika ada, filter data sesuai id
         * 
         */
        if (!empty($data['id_programmers'])) {
            $query = $query
                ->join('master_tools', 'master_tools.id_tools', 'tools.id')
                ->where('master_tools.id_programmers', $data['id_programmers']);
        }
        if (!empty($data['id_programmers_not']) && MasterTools::count() > 0) {
            $query = $query
                ->whereNotIn('tools.id', function ($query) use ($data) {
                    $query->select('id_tools')
                        ->from('master_tools')
                        ->where('id_programmers', $data['id_programmers_not']);
                });
        }

        if (!empty($data['search'])) {
            $query = $query->where('tools.nama', 'LIKE', '%' . $data['search'] . '%');
        }

        $tools = $query->get();
        /**
         * Mengembalikan response setelah data sudah difilter
         * sesuai kebutuhan untuk 
         */
        return response()->json(
            $tools
        )->setStatusCode(200);
    }

    public function create(ToolsRequest $request): JsonResponse
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
        $tools = new MasterTools($data);
        $tools->save();

        /**
         * Mengembalikan response jika data berhasil
         * ditambahkan dengan baik tanpa habatan
         * 
         */
        return response()->json(['success' => ['message' => 'Data tool anda berhasil ditambahkan']]);
    }
    public function delete(ToolsRequest $request): JsonResponse
    {
        /**
         * Melakukan pengecekan data apakah
         * data merupakan data yang valid
         * 
         */
        $data = $request->validated();
        $tools = MasterTools::where('id_programmers', $data['id_programmers'])
            ->where('id_tools', $data['id_tools']);
        $tools->delete();
        return response()->json(['success' => ['message' => 'Tool berhasil dihapus']]);
    }
}