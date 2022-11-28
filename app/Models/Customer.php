<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Customer
 * @package App\Models
 * @property string name
 * @property string cpf
 * @property int id
 * @property Collection|CustomerAddress[] addresses
 * @method static create(array $data)
 * @method static paginate(int $int)
 * @method static whereHas(string $relationship, \Closure $closure)
 */
class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'cpf',
    ];

    public function setCpfAttribute(string $value)
    {
        $this->attributes['cpf'] = preg_replace('/\D/', '', $value);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public static function individualList()
    {
        $userAuth = auth()->user();
        return self::all()
            ->when($userAuth->isCustomerEmployee(), function ($q) use ($userAuth) {
                return $q->where('id', $userAuth->customer()->id);
            });
    }
}
