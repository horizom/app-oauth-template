<?php


use Illuminate\Database\Capsule\Manager as DB;
use Phinx\Seed\AbstractSeed;

class ScopesSeeder extends AbstractSeed
{
    public function run()
    {
        DB::table('oauth_scopes')->insert([
            ['scope' => 'read', 'is_default' => 1],
            ['scope' => 'write', 'is_default' => 0],
            ['scope' => 'update', 'is_default' => 0],
            ['scope' => 'delete', 'is_default' => 0],
        ]);
    }
}
