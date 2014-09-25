<?php

use Illuminate\Database\Seeder;


class JobTableSeeder extends Seeder
{
    public function run()
    {
        $time = time();

        $description1 = <<<ECONOMIST
        The Economist is an English-language weekly newspaper owned by The Economist Newspaper Ltd and edited in offices in London.[2][3][4]
        Continuous publication began under founder James Wilson in September 1843. For historical reasons The Economist refers to itself as a newspaper,
        but each print edition appears on small glossy paper like a news magazine, and its YouTube channel is called EconomistMagazine.
ECONOMIST;

        $description2 = <<<FINANSIST
        In Philadelphia, Frank Cowperwood, whose father is a banker, makes his first money by buying cheap soaps on the market and selling them back with profit to a grocer.
        Later, he gets a job in Henry Waterman & Company, and leaves it for Tighe & Company. He also marries an affluent widow, in spite of his young age.
        Over the years, he starts misusing municipal funds with the aid of the City Treasurer.
FINANSIST;

        $description3 = <<<MANAGER
        A project manager is a professional in the field of project management. Project managers can have the responsibility of the planning, execution and closing of any project,
        typically relating to construction industry, architecture, aerospace and defense, computer networking, telecommunications or software development.
MANAGER;

        DB::table('jobs')->delete();

        DB::table('jobs')->insert(array(
                array('id' => 1, 'title' => 'Economist', 'description' => $description1, 'email' => 'economist@mail.com', 'user_id' => 4, 'state' => Job::STATE_PUBLISHED, 'created_at' => $time, 'updated_at' => $time),
                array('id' => 2, 'title' => 'Finansist', 'description' => $description2, 'email' => 'finansist@mail.com', 'user_id' => 5, 'state' => Job::STATE_PUBLISHED, 'created_at' => $time, 'updated_at' => $time),
                array('id' => 3, 'title' => 'Manager', 'description' => $description3, 'email' => 'manager@mail.com', 'user_id' => 4, 'state' => Job::STATE_PENDING, 'created_at' => $time, 'updated_at' => $time)
            )
        );
    }
}