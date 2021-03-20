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
            'schedule.required' => 'Você deve informar o Horário',
            'schedule.unique' => 'O Horário informado já existe'
        ];
    }

    public function remedy()
    {
        return $this->hasMany('App\Models\Remedy');
    }
}
