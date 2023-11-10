<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('tel');
            $table->text('service');

            $table->date('date');
            $table->time('time');

            $table->unsignedBigInteger('executor_id')->nullable();
            $table->index('executor_id', 'entry_executor_idx');
            $table->foreign('executor_id', 'entry_executor_fk')->on('users')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
