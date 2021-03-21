<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Retrieve specific data from database
     * 
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    private function find($id) {
        return $this->schedule->with('remedy')->find($id);
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
     */
    private function validateForm($request)
    {
        $rules = $this->schedule->rules();
        $feedback = $this->schedule->feedback();

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
        $schedule = $this->schedule->with('remedy');

        // to query filters (attribute=name:operand:value)
        // to apply many filters, use ";" (attribute=name:operand:value;name2:operand2:value2)
        if ($request->has('filtro')) {
            $filters = explode(';', $request->filtro);

            foreach ($filters as $key => $condition) {
                $c = explode(':', $condition);
                $schedule = $schedule->where($c[0], $c[1], $c[2]);
            }
        }

        // end query
        if ($request->has('dados')) {
            $data = $request->dados;
            $schedule = $schedule->selectRaw($data)->get();
        } else {
            $schedule = $schedule->get();
        }

        return response()->json($schedule, 200);
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
        
        try {
            $schedule = $this->schedule->create($request->all());

            return response()->json($schedule, 201);
        } catch (\Throwable $err) {
            return response()->json(['error' => 'Não foi possível concluir a operação. Este horário já está cadastrado.'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $schedule = $this->find($id);
        if ($schedule === null) {
            return $this->setError();
        }

        return response()->json($schedule, 200);
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
        $schedule = $this->find($id);
        if ($schedule === null) {
            return $this->setError();
        }

        $this->validateForm($request);

        $schedule->update($request->all());
        
        return response()->json($schedule, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $schedule = $this->find($id);
        if ($schedule === null) {
            return $this->setError();
        }

        $schedule->delete();

        return response()->json(['msg' => 'O horário foi excluído com sucesso'], 200);
    }
}
