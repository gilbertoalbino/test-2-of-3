<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        DB::table('people')->insert([
            'name' => 'Gilberto Albino',
            'created_at' => new \DateTime(),
        ]);

        /**
         * Don't blame me! For some reason
         * this Seeder wasn't inserting a value if a contact was duplicated in the array.
         */
        DB::table('contacts')->insert([
            'person_id' => 1,
            'contact' => 'phone',
            'value' => '(11) 97673-8833',
            'created_at' => new \DateTime(),
        ]);

        DB::table('contacts')->insert([
            'person_id' => 1,
            'contact' => 'email',
            'value' => 'contato@gilbertoalbino.com',
            'created_at' => new \DateTime(),
        ]);

        DB::table('contacts')->insert([
            'person_id' => 1,
            'contact' => 'phone',
            'value' => '(11) 2309-1883',
            'created_at' => new \DateTime(),
        ]);

        DB::table('contacts')->insert([
            'person_id' => 1,
            'contact' => 'email',
            'value' => 'gilbertoalbino@gmail.com',
            'created_at' => new \DateTime(),
        ]);

        DB::table('contacts')->insert([
            'person_id' => 1,
            'contact' => 'whatsapp',
            'value' => '(11) 97673-8833',
            'created_at' => new \DateTime(),
        ]);
    }
}
