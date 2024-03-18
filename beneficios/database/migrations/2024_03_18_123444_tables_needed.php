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
        Schema::create('social_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        


        Schema::create('user_social_insurance', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user")->references("id")->on("users");
            $table->foreignId("social_insurance")->references("id")->on("social_insurances");
            $table->timestamps();
        });

        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId("social_insurance")->references("id")->on("social_insurances");
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('social_insurance_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->unsignedInteger('social_insurance')->nullable();
            $table->foreignId("social_insurance")->references("id")->on("social_insurances")->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('benefits_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId("social_insurance_plan")->references("id")->on("social_insurance_plans");
            $table->foreignId("benefit")->references("id")->on("benefits");
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_benefits', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('user');
            $table->foreignId("user")->references("id")->on("users")->nullable();
            // $table->unsignedInteger('benefit');
            $table->foreignId("benefit")->references("id")->on("benefits")->nullable();
            // $table->unsignedInteger('benefit_plan')->nullable();
            $table->foreignId("benefit_plan")->references("id")->on("benefits_plans")->nullable();
            $table->timestamps();
        });

        Schema::create('payment_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('from');
            $table->timestamp('to');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user")->references("id")->on("users");
            $table->foreignId("social_insurance")->references("id")->on("social_insurances");
            $table->foreignId("period")->references("id")->on("payment_periods");
            $table->timestamp('paidAt');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
