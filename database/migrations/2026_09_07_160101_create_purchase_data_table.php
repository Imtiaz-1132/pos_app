<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_data', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('gender');
            $table->text('address');
            $table->string('telephone');
            $table->string('nid_front')->nullable();
            $table->date('date');
            $table->date('date_of_birth');
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('nid_back')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_data');
    }
};