<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('avatar')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->foreignId('gender_id')->nullable();
            $table->foreignId('country_id')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->foreignId('education_level_id')->nullable();
            $table->foreignId('career_id')->nullable();
            $table->foreignId('ethnicity_id')->nullable();
            $table->foreignId('orientation_id')->nullable();
            $table->foreignId('zodiac_sign_id')->nullable();
            $table->foreignId('religion_id')->nullable();
            $table->foreignId('politics_id')->nullable();
            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('user_genders')->onUpdate('set null')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('user_countries')->onUpdate('set null')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('user_states')->onUpdate('set null')->onDelete('set null');
            $table->foreign('education_level_id')->references('id')->on('user_education_levels')->onUpdate('set null')->onDelete('set null');
            $table->foreign('career_id')->references('id')->on('user_careers')->onUpdate('set null')->onDelete('set null');
            $table->foreign('ethnicity_id')->references('id')->on('user_ethnicities')->onUpdate('set null')->onDelete('set null');
            $table->foreign('orientation_id')->references('id')->on('user_orientations')->onUpdate('set null')->onDelete('set null');
            $table->foreign('zodiac_sign_id')->references('id')->on('user_zodiac_signs')->onUpdate('set null')->onDelete('set null');
            $table->foreign('religion_id')->references('id')->on('user_religions')->onUpdate('set null')->onDelete('set null');
            $table->foreign('politics_id')->references('id')->on('user_politics')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
