<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    //aqui se asignan los campos a asignar de forma masiva
    protected $fillable = ['name','due','comments'];
}
