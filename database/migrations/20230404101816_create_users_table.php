<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    private $tableName = "users";

    public function up()
    {
        if (Capsule::schema()->hasTable($this->tableName)) {
            return false;
        }

        Capsule::schema()->create($this->tableName, function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone', 64);
            $table->string('password', 255);
            $table->boolean('approved')->default(false);
            $table->boolean('status')->default(true);
        });
    }

    public function down()
    {
        Capsule::schema()->drop($this->tableName);
    }
}
