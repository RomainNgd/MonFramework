<?php


use Phinx\Seed\AbstractSeed;

class PostSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run() : void
    {
        $data = [];
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 100; ++$i) {
            $date = $faker->unixTime('now');
            $data [] = [
                'name' => $faker->sentence(3),
                'slug' => $faker->slug,
                'content' =>$faker->text(3000),
                'created_at' => date('Y-m-d H:i:s', $date),
                'update_at' => date('Y-m-d H:i:s', $date),
            ];
        }
        $this->table('posts')
            ->insert($data)
            ->save();
    }
}
