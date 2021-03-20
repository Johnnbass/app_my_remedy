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
        return $this->remedy->with(['schedule', 'person'])->find($id);
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
        $rules = $this->remedy->rules();
        $feedback = $this->remedy->feedback();

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
        $remedy = array();

        // to query attributes
        if ($request->has('dadosh') || $request->has('dadosp')) {
            $sData = $request->dadosh ?? '';
            $pData = $request->dadosp ?? '';
            $remedy = $this->remedy->with(["schedule:id,{$sData}", "person:id,{$pData}"]);
        } else {
            $remedy = $this->remedy->with(['schedule', 'person']);
        }

        // to query filters (attribute=name:operand:value)
        // to apply many filters, use ";" (attribute=name:operand:value;name2:operand2:value2)
        if ($request->has('filtro')) {
            $filters = explode(';', $request->filtro);

            foreach ($filters as $key => $condition) {
                $c = explode(':', $condition);
                $remedy = $remedy->where($c[0], $c[1], $c[2]);
            }
        }

        // end query
        if ($request->has('dados')) {
            $data = $request->dados;
            $remedy = $remedy->selectRaw($data)->get();
        } else {
            $remedy = $remedy->get();
        }

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
        $this->validateForm($request);

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

        $this->validateForm($request);

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
