<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Phinx\Migration\AbstractMigration;

final class CreateOauthPersonalAccessTokensTable extends AbstractMigration
{
    private $tableName = "oauth_personal_access_tokens";

    public function up()
    {
        if (Capsule::schema()->hasTable($this->tableName)) {
            return false;
        }

        Capsule::schema()->create($this->tableName, function (Blueprint $table) {
            $table->string('id', 100);
            $table->string('name', 255);
            $table->string('token', 255);
            $table->text('scopes')->nullable();
            $table->boolean('revoked')->default(false);
            $table->dateTime('expires_at')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('user_id');
            $table->string('client_id', 100);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('oauth_clients');
        });
    }

    public function down()
    {
        Capsule::schema()->drop($this->tableName);
    }
}
