<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['schedule'];

    /**
     * Field rules
     * 
     * @return Array
     */
    public function rules()
    {
        return ['schedule' => 'required|unique:schedules'];
    }

    /**
     * Rules feedback texts
     * 
     * @return Array
     */
    public function feedback()
    {
        return [
            'schedule.required' => 'O campo Horário é obrigatório',
            'schedule.unique' => 'Este horário já está cadastrado'
        ];
    }
}
