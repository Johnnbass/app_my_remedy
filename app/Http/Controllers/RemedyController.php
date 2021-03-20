<?php

namespace App\Http\Controllers;

use App\Models\Remedy;
use Illuminate\Http\Request;

class RemedyController extends Controller
{
    public function __construct(Remedy $remedy)
    {
        $this->remedy = $remedy;
    }

    /**
     * Retrieve specific data from database
     * 
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    private function find($id) {
        return $this->remedy->find($id);
    }

    /**
     * defines return error json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    private function setError()
    {
        return response()->json([
            'error' => 'Não foi possível concluir a operação. Registro não encontrado.'
        ], 404);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $remedy = $this->remedy->all();
        return response()->json($remedy, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $remedy = $this->remedy->create($request->all());
        return response()->json($remedy, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $remedy = $this->find($id);
        if ($remedy === null) {
            return $this->setError();
        }
        return response()->json($remedy, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $remedy = $this->find($id);
        if ($remedy === null) {
            return $this->setError();
        }
        $remedy->update($request->all());
        return response()->json($remedy, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $remedy = $this->find($id);
        if ($remedy === null) {
            return $this->setError();
        }
        $remedy->delete();
        return response()->json(['msg' => 'A medicação foi excluída com sucesso'], 200);
    }
}
