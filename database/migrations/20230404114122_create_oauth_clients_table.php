<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Phinx\Migration\AbstractMigration;

final class CreateOauthClientsTable extends AbstractMigration
{
    private $tableName = "oauth_clients";

    public function up()
    {
        if (Capsule::schema()->hasTable($this->tableName)) {
            return false;
        }

        Capsule::schema()->create($this->tableName, function (Blueprint $table) {
            $table->string('id', 100);
            $table->string('secret', 100);
            $table->string('name');
            $table->text('redirect_uri');
            $table->text('scopes')->nullable();
            $table->string('grant_types', 80);
            $table->boolean('is_confidential')->default(true);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Capsule::schema()->drop($this->tableName);
    }
}
