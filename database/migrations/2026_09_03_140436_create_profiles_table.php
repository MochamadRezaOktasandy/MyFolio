<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('headline');
            $table->text('short_bio');
            $table->longText('bio');
            $table->string('profile_image')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('location');
            $table->string('availability_status')->default('Available for Work');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};