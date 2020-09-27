<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $name = config('acl.tables.roles');

        Schema::create($name, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->enum('special', ['no-access','all-access','no-defined'])->nullable();
            $table->enum('status', ['deleted','draft','published'])->default('published');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
         });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        $name = config('acl.tables.roles');

        Schema::drop($name);
    }
}
