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
            'name.required' => 'O campo Nome é obrigatório',
            'name.min' => 'O campo Nome deve ter no mínimo 3 letras',
            'name.max' => 'O campo Nome deve ter no máximo 30 letras',
            'address.max' => 'O campo Endereço deve ter no máximo 200 números'
        ];
    }
}
