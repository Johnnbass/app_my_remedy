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
     */
    private function find($id) {
        $remedy = $this->remedy->find($id);
        if ($remedy === null) {
            $remedy = ['error' => 'Não foi possível concluir a operação, registro não identificado'];
        }
        return $remedy;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->remedy->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->remedy->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $remedy = $this->find($id);
        if (!is_array($remedy)) {
            $remedy->update($request->all());
        }
        return $remedy;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remedy = $this->find($id);
        if (!is_array($remedy)) {
            $remedy->delete();
            $remedy = ['msg' => 'A medicação foi excluída com sucesso'];
        }
        return $remedy;
    }
}
