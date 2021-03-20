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
        return $this->person->with('remedy')->find($id);
    }

    /**
     * defines json return error
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
     * Validate fields
     * 
     * @param $request
     * @return \Illuminate\Http\Response
     */
    private function validateForm($request)
    {
        $rules = $this->person->rules();
        $feedback = $this->person->feedback();

        if ($request->method() === 'PATCH') {
            $dRules = array();

            foreach ($rules as $input => $rule) {
                if (array_key_exists($input, $request->all())) {
                    $dRules[$input] = $rule;
                }
            }
            $rules = $dRules;
        }

        $request->validate($rules, $feedback);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $person = array();

        // to query filters (attribute=name:operand:value)
        // to apply many filters, use ";" (attribute=name:operand:value;name2:operand2:value2)
        if ($request->has('filtro')) {
            $filters = explode(';', $request->filtro);

            foreach ($filters as $key => $condition) {
                $c = explode(':', $condition);
                $person = $this->person->with('remedy')->where($c[0], $c[1], $c[2]);
            }
        }

        // end query
        if ($request->has('dados')) {
            $data = $request->dados;
            $person = $person->selectRaw($data)->get();
        } else {
            $person = $person->get();
        }

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
        $this->validateForm($request);

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

        $this->validateForm($request);

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
