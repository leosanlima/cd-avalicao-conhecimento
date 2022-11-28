<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'company_name'
      ];
  
      public function setCnpjAttribute(string $value)
      {
          $this->attributes['cnpj'] = preg_replace('/\D/', '', $value);
      }
}
