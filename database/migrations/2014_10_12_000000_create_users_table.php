<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profile_pic')->nullable();
            $table->string('gender');
            $table->string('hobbies');
            $table->string('file'); 
            $table->smallInteger('role')->tinyInteger('role')->nullable(false)->default(3)->comment = '1 = Sales,2 = CRM,3 = HR, 4 = SEO,5 = BDE';
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment = '0=Deactive, 1=Active';
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
