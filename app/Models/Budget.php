<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\BudgetStatus;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'customer_id',
        'supplier_id',
        'product_id',
        'quantity',
        'status',

      ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return BudgetStatus::title((int) $this->status);
    }
}
