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
        Schema::create('inv_products', function (Blueprint $table) {
            $table->ulid("id")->primary()->unique();
            $table->string('barcode')->unique();
            $table->string('name');
            $table->ulid("state_id")->nullable();
            $table->ulid("condition_id")->nullable();
            $table->ulid("family_id")->nullable();
            $table->ulid("class_id")->nullable();
            $table->ulid("type_prod_id")->nullable();
            $table->ulid("personnel_id")->nullable();
            $table->ulid("enviroment_id")->nullable();
            $table->ulid("brand_id")->nullable();
            $table->ulid("project_id")->nullable();
            $table->date("adq_date")->nullable();
            $table->ulid("provider_id")->nullable();
            $table->string('nro_doc', 100)->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->boolean("state")->default(true);
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('inv_states');
            $table->foreign('condition_id')->references('id')->on('inv_conditions');
            $table->foreign('family_id')->references('id')->on('inv_families');
            $table->foreign('class_id')->references('id')->on('inv_classes');
            $table->foreign('type_prod_id')->references('id')->on('inv_types_product');
            $table->foreign('personnel_id')->references('id')->on('inv_personnel');
            $table->foreign('enviroment_id')->references('id')->on('inv_environments');
            $table->foreign('brand_id')->references('id')->on('inv_brands');
            $table->foreign('project_id')->references('id')->on('inv_projects');
            $table->foreign('provider_id')->references('id')->on('inv_providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_products');
    }
};
