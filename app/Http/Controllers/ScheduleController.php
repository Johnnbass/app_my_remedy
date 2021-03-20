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
        return $this->schedule->find($id);
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
        $schedule = $this->schedule->all();
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
        try {
            $schedule = $this->schedule->create($request->all());
        } catch (\Throwable $err) {
            return response()->json(['error' => 'Não foi possível concluir a operação. Este horário já está cadastrado.'], 400);
        }
        return response()->json($schedule, 201);
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
