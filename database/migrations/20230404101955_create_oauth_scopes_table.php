<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Phinx\Migration\AbstractMigration;

final class CreateOauthScopesTable extends AbstractMigration
{
    private $tableName = "oauth_scopes";

    public function up()
    {
        if (Capsule::schema()->hasTable($this->tableName)) {
            return false;
        }

        Capsule::schema()->create($this->tableName, function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('scope', 200)->unique();
            $table->tinyInteger('is_default')->default(0);
        });
    }

    public function down()
    {
        Capsule::schema()->drop($this->tableName);
    }
}
