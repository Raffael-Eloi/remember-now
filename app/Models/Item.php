<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class Item extends Model
{
    protected $table = 'item';
    protected $fillables = ['description', 'id_user', 'id_category', 'id_status'];

    protected function rules()
    {
        return [
            'description' => ['required', 'string', 'min:5', 'max:1000'],
            'id_user' => ['required', 'integer'],
            'id_category' => ['required', 'integer'],
            'id_status' => ['required', 'integer'],
        ];
    }

    protected function customMessages()
    {
        return [
            'description.required' => "O Campo descrição é obrigatório",
            'description.string' => "O Campo descrição não deve conter apenas números",
            'description.min' => "O Campo descrição deve ter no mínimo 4 caracteres",
            'description.max' => "O Campo descrição deve ter no máximo 100 caracteres",
            'id_category.required' => "O Campo categoria é obrigatório",
            'id_status.required' => "O Campo status é obrigatório",
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
