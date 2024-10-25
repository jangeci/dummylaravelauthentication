<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOauthPersonalAccessClientsClientIdToUuid extends Migration
{
    public function up()
    {
        Schema::table('oauth_personal_access_clients', function (Blueprint $table) {
            // Assuming client_id references oauth_clients.id
            $table->uuid('client_id')->change();
        });
    }

    public function down()
    {
        Schema::table('oauth_personal_access_clients', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->change(); // Reverting back to integer if needed
        });
    }
}
