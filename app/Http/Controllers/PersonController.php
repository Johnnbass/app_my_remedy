<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Remedy;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Retrieve specific data from database
     * 
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    private function find($id)
    {
        return $this->person->find($id);
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
        $person = $this->person->all();
        return response()->json($person, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $person = $this->person->create($request->all());
        return response()->json($person, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $person = $this->find($id);
        if ($person === null) {
            return $this->setError();
        }
        return response()->json($person, 200);
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
        $person = $this->find($id);
        if ($person === null) {
            return $this->setError();
        }
        $person->update($request->all());
        return response()->json($person, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $person = $this->find($id);
        if ($person === null) {
            return $this->setError();
        }
        $this->deleteRemedyOnCascade($id);
        $person->delete();
        return response()->json(['msg' => 'A pessoa foi excluída com sucesso'], 200);
    }

    /**
     * Deletes the remedies registers for people deletes
     * 
     * @param $p_id
     */
    private function deleteRemedyOnCascade($p_id)
    {
        Remedy::where('person', '=', $p_id)->delete();        
    }
}
