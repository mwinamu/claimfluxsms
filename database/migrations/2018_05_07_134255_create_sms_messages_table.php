<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create( 'sms_messages', function (Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'cfid','20' );
            $table->string( 'message_string','2000');
            $table->string( 'user_id','10' );
            $table->string( 'sms_names_id','10' );
            $table->boolean( 'dispatched' );
            $table->timestamp( 'dispatch_time' );
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
        //
    }
}
