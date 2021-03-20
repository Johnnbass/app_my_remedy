<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedy extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'dosage', 'price', 'schedule_id', 'person_id', 'period'];

    /**
     * Field rules
     * 
     * @return Array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30',
            'dosage' => 'required|max:6',
            'schedule_id' => 'required|integer',
            'person_id' => 'required|integer',
            'period' => 'required|integer'
        ];
    }

    /**
     * Rules feedback texts
     * 
     * @return Array
     */
    public function feedback()
    {
        return [
            'name.required' => 'Você precisa informar o Nome do Medicamento',
            'name.min' => 'O Nome do Medicamento deve ter pelo menos 3 letras',
            'name.max' => 'O Nome do Medicamento deve ter até 30 letras',
            'dosage.required' => 'Você precisa informar a Dosagem do Medicamento',
            'dosage.max' => 'A dosagem deve ter até 6 letras e números',
            'schedule_id.required' => 'Você deve informar um Horário',
            'person_id.required' => 'Você deve informar uma Pessoa',
            'period_id.required' => 'Você deve informar um Período (em dias de uso)',
            'period.integer' => 'Você deve informar um Período em números'
        ];
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Schedule');
    }

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }
}
