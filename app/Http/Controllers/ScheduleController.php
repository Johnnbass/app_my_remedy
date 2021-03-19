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
     */
    private function find($id) {
        $schedule = $this->schedule->find($id);
        if ($schedule === null) {
            $schedule = ['error' => 'Não foi possível concluir a operação, registro não identificado'];
        }
        return $schedule;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->schedule->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->schedule->create($request->all());
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
        $schedule = $this->find($id);
        if (!is_array($schedule)) {
            $schedule->update($request->all());
        }
        return $schedule;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = $this->find($id);
        if (!is_array($schedule)) {
            $schedule->delete();
            $schedule = ['msg' => 'O horário foi excluído com sucesso'];
        }
        return $schedule;
    }
}
