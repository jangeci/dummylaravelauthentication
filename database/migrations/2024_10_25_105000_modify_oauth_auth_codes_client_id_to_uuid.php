<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOauthAuthCodesClientIdToUuid extends Migration
{
    public function up()
    {
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            // Change client_id to UUID (or char(36) for MySQL)
            $table->uuid('client_id')->change();
        });
    }

    public function down()
    {
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            // Revert client_id back to unsignedBigInteger (if needed)
            $table->unsignedBigInteger('client_id')->change();
        });
    }
}
