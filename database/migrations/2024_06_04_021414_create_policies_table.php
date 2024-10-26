<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->notNull();
            $table->string('name')->notNull();
            $table->text('description')->nullable();
            $table->integer('type')->nullable(); // 1 is contantly; 2 is reference to another policy
            $table->integer('reference_policy_id')->nullable();
            $table->datetime('valid_from')->nullable();
            $table->datetime('valid_to')->nullable();
            $table->string('unit_value')->nullable();
            $table->float('value', 53)->defaultValue(0);
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policies');
    }
}
