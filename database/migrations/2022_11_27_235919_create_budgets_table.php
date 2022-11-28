<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BudgetStatus;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255);
            $table->foreignId('customer_id');
            $table->foreign('customer_id', 'fk_customer_id')
                ->references('id')
                ->on('customers');
            $table->foreignId('supplier_id');
            $table->foreign('supplier_id', 'fk_supplier_id')
                    ->references('id')
                    ->on('suppliers');
            $table->foreignId('product_id');
            $table->foreign('product_id', 'fk_product_id')
                    ->references('id')
                    ->on('products');
            $table->integer('quantity')->default(0);
            $table->integer('status')->default(BudgetStatus::PENDING);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
