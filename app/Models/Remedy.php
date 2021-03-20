<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedy extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'dosage', 'price', 'schedule', 'person', 'period'];

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
            'schedule' => 'required|integer',
            'person' => 'required|integer',
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
            'name.required' => 'O campo Nome é obrigatório',
            'name.min' => 'O campo Nome deve ter no mínimo 3 letras',
            'name.max' => 'O campo Nome deve ter no máximo 30 letras',
            'dosage.required' => 'O campo Dosagem é obrigatório',
            'dosage.max' => 'O campo Dosagem deve ter no máximo 6 letras e números',
            'schedule.required' => 'O campo Horário é obrigatório',
            'schedule.integer' => 'O campo Horário deve ser preenchido com um valor válido',
            'person.required' => 'O campo Pessoa é obrigatório',
            'person.integer' => 'O campo Pessoa deve ser preenchido com um valor válido',
            'period.required' => 'O campo Período é obrigatório',
            'period.integer' => 'O campo Período deve ser preenchido com números'
        ];
    }
}
