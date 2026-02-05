<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurriculoResource;
use App\Models\Curriculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CurriculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CurriculoResource::collection(
            Curriculo::orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $authUser = Auth::user()->id;
        $curriculoData = ['user_id' => $authUser];
        $curriculo = Curriculo::create($curriculoData);

        return new CurriculoResource($curriculo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Curriculo $curriculo)
    {
        return new CurriculoResource($curriculo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curriculo $curriculo)
    {
        abort_if ($request->user()->cannot('update', $curriculo), 403);
        $authUser = Auth::user()->id;
        $curriculoData = ['user_id' => $authUser];
        $curriculo->update($curriculoData);

        return new CurriculoResource($curriculo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculo $curriculo)
    {
        $curriculo->delete();
    }
}
