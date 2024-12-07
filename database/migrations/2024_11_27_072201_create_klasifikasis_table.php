<?php

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
        Schema::create('klasifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('group_code');
            $table->foreign('group_code')->references('code')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('transaction_type');
            $table->text('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klasifikasis');
    }
};
