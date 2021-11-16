<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Boyong Pos');
            $table->string('company_address')->default('Boyong Pos Address');
            $table->string('company_phone')->default('+63 9548712488');
            $table->string('company_email')->default('Boyong_Pos@gmail.com');
            $table->string('company_fax')->default('+63 9665487113');
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
        Schema::dropIfExists('companies');
    }
}
