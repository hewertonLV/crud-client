<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{

    protected $fillable = [
        'name',
        'email',
        'cpf'
    ];

    public static $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:clients',
        'cpf' => 'required|string|unique:clients|max:11',
    ];

    public static function formatEmail($email)
    {
        return strtoupper($email);
    }

    public static function formatCpf($cpf)
    {
        return str_replace('-', '', str_replace('.', '', $cpf));
    }

    public static function createdClient($request)
    {
        try {
            $request->validate(Client::$rules);
            self::fill($request->input());
            return self::save();
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }

    use SoftDeletes;
    use HasFactory;
}
