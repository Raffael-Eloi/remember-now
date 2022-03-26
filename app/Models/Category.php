<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class Category extends Model
{
    protected $table = 'categoy';
    protected $fillable = ['description'];

    protected function rules()
    {
        return [
            'description' => ['required', 'string', 'min:5', 'max:100']
        ];
    }

    protected function customMessages()
    {
        return [
            'description.required' => "O Campo descrição é obrigatório",
            'description.string' => "O Campo descrição não deve conter apenas números",
            'description.min' => "O Campo descrição deve ter no mínimo 4 caracteres",
            'description.max' => "O Campo descrição deve ter no máximo 100 caracteres",
        ];
    }

    public function customValidate(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->customMessages());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return [];
        }
    }
}
