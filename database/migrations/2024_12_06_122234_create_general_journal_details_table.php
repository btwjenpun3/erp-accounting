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
        Schema::create('general_journal_details', function (Blueprint $table) {
            $table->id();
            $table->string('general_journal_reff');
            $table->foreign('general_journal_reff')->references('reff')->on('general_journals')->onDelete('cascade')->onUpdate('cascade');
            $table->string('account_code');
            $table->foreign('account_code')->references('code')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('currency_code');
            $table->double('debit')->default(0);
            $table->double('credit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_journal_details');
    }
};
