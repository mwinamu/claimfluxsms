<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create( 'sms_templates', function (Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'cfid','20' );
            $table->string( 'debtor_name' );
            $table->string( 'debtor_number' );
            $table->string( 'ptp_amount' );
            $table->string( 'ptp_date' );
            $table->string( 'client' );
            $table->string( 'account_number' );
            $table->string( 'paybill_number' );
            $table->string( 'acm_name' );
            $table->string( 'acm_number' );
            $table->string( 'acm_email' );
            $table->string( 'balance' );
            $table->string( 'waiver_amount' );
            $table->string( 'waived_amount' );
            $table->string( 'user_id','10' );
            $table->string( 'sms_names_id','10' );
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
