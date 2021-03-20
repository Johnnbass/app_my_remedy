<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'age', 'address'];

    /**
     * Field rules
     * 
     * @return Array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30',
            'address' => 'max:200'
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
            'name.required' => 'Você precisa informar o Nome',
            'name.min' => 'O Nome deve ter pelo menos 3 letras',
            'name.max' => 'O Nome deve ter até 30 letras',
            'address.max' => 'O Endereço deve ter até 200 letras e números'
        ];
    }

    public function remedy()
    {
        return $this->hasMany('App\Models\Remedy');
    }
}
