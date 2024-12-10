<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoutubesTable extends Migration
{
    public function up()
    {
        Schema::create('youtubes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->string('url')->nullable(false);
            $table->string('channel_code');
            $table->string('region'); 
            $table->string('language'); 
            $table->text('description'); 
            $table->string('email_host_main')->nullable(false);  
            $table->string('email_host');
            $table->string('email_management');
            $table->string('email_network');
            $table->string('network');
            $table->integer('profit_sharing_percent');
            $table->integer('status')->default(0)->nullable(false); // Tình trạng
            $table->integer('department_id');
            $table->integer('channel_manager'); // Tình trạng
            $table->json('service_account');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
