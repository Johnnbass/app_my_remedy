<?php

namespace App\Http\Controllers;

use App\Models\Person;
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
     */
    private function find($id) {
        $person = $this->person->find($id);
        if ($person === null) {
            $person = ['error' => 'Não foi possível concluir a operação, registro não identificado'];
        }
        return $person;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->person->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return Person::create($request->all());
        return $this->person->create($request->all());
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
        $person = $this->find($id);
        if (!is_array($person)) {
            $person->update($request->all());
        }
        return $person;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = $this->find($id);
        if (!is_array($person)) {
            $person->delete();
            $person = ['msg' => 'A pessoa foi excluída com sucesso'];
        }
        return $person;
    }
}
