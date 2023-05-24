<?php

namespace Database\Seeders;

use App\Models\Padlet;
use App\Models\Author;
use App\Models\PadletContainer;
use App\Models\PadletContainerUser;
use App\Models\User;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PadletListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('padlets')->insert([
            'title' => 'Das ist ein Titel vom PadletListSeeder',
            'subtitle' => 'Das ist ein Untertitel des Padlets',
            'padletId' => 'DasIstDiePadletID',
            'rating' => '4',
            'published' => new DateTime(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        */

        // USER 1
        $user = User::all()->first();

        // USER 2
        $user2 = new User;
        $user2->name = "Marta Musterfrau";
        $user2->email = "marta@gmail.com";
        $user2->isAdmin = false;
        $user2->password = bcrypt('secret');
        $user2->save();

        // USER 3
        $user3 = new User;
        $user3->name = "Jakob Berger";
        $user3->email = "jakob@gmail.com";
        $user3->isAdmin = false;
        $user3->password = bcrypt('secret');
        $user3->save();

        // PADLET-CONTAINER 1 - MAX MUSTERMANN
        $padletContainer1 = new PadletContainer();
        $padletContainer1->title = "PadletContainer_1";
        $padletContainer1->published = new DateTime();
        $padletContainer1->user()->associate($user);
        $padletContainer1->save();

        $padletContainerUser1 = new PadletContainerUser();
        $padletContainerUser1->role = "admin"; // ROLE
        $padletContainerUser1->user()->associate($user);
        $padletContainerUser1->padletContainer()->associate($padletContainer1);
        $padletContainerUser1->save();

        // PADLET-CONTAINER 2 - MARTA MUSTERFRAU
        $padletContainer2 = new PadletContainer();
        $padletContainer2->title = "PadletContainer_2";
        $padletContainer2->published = new DateTime();
        $padletContainer2->user()->associate($user2);
        $padletContainer2->save();

        $padletContainerUser2 = new PadletContainerUser();
        $padletContainerUser2->role = "user"; // ROLE
        $padletContainerUser2->user()->associate($user2);
        $padletContainerUser2->padletContainer()->associate($padletContainer2);
        $padletContainerUser2->save();

        $padlet4 = new Padlet();
        $padlet4->title = "Padlet-Entry #4 - Bearbeitbar";
        $padlet4->subtitle = "Das ist ein Untertitel";
        $padlet4->rating = 9;
        $padlet4->published = new DateTime();
        $padlet4->comment = "Neuer Kommentar";
        $padlet4->user()->associate($user2);
        $padlet4->padletContainer()->associate($padletContainer2);
        $padlet4->save();

        // PADLET-CONTAINER 3 - JAKOB BERGER
        $padletContainer3 = new PadletContainer();
        $padletContainer3->title = "PadletContainer_3";
        $padletContainer3->published = new DateTime();
        $padletContainer3->isPublic = false;
        $padletContainer3->user()->associate($user3);
        $padletContainer3->save();

        $padletContainerUser3 = new PadletContainerUser();
        $padletContainerUser3->role = "user"; // ROLE
        $padletContainerUser3->user()->associate($user3);
        $padletContainerUser3->padletContainer()->associate($padletContainer3);
        $padletContainerUser3->save();

        $padlet3 = new Padlet();
        $padlet3->title = "Padlet-Entry #3";
        $padlet3->subtitle = "Das ist ein Untertitel";
        $padlet3->rating = 7;
        $padlet3->published = new DateTime();
        $padlet3->user()->associate($user3);
        $padlet3->padletContainer()->associate($padletContainer1);
        $padlet3->padletContainer()->associate($padletContainer2);
        $padlet3->padletContainer()->associate($padletContainer3);
        $padlet3->save();

        /***********************************************************/

        $padlet1 = new Padlet();
        $padlet1->title = "Padlet-Entry #1";
        $padlet1->subtitle = "Das ist ein Untertitel";
        $padlet1->rating = 7;
        $padlet1->published = new DateTime();

        // Ersten User bekommen
        //$user = User::all()->first();
        $padlet1->user()->associate($user);
        $padlet1->padletContainer()->associate($padletContainer1);
        $padlet1->padletContainer()->associate($padletContainer2);
        $padlet1->save(); // Eintrag wird in die DB gespeichert

        $padlet2 = new Padlet();
        $padlet2->title = "Padlet-Entry #2";
        $padlet2->subtitle = "Das ist ein Untertitel";
        $padlet2->rating = 9;
        $padlet2->published = new DateTime();
        $padlet2->user()->associate($user2);

        $padlet2->padletContainer()->associate($padletContainer1);
        $padlet2->save(); // Eintrag wird in die DB gespeichert

        // Weitere Einträge für Padlet-Container 1
        $padlet5 = new Padlet();
        $padlet5->title = "Padlet-Entry #5";
        $padlet5->subtitle = "Das ist ein Untertitel";
        $padlet5->rating = 8;
        $padlet5->published = new DateTime();
        $padlet5->user()->associate($user);
        $padlet5->padletContainer()->associate($padletContainer1);
        $padlet5->save();

        $padlet6 = new Padlet();
        $padlet6->title = "Padlet-Entry #6";
        $padlet6->subtitle = "Das ist ein Untertitel";
        $padlet6->rating = 6;
        $padlet6->published = new DateTime();
        $padlet6->user()->associate($user);
        $padlet6->padletContainer()->associate($padletContainer1);
        $padlet6->save();

        $padlet7 = new Padlet();
        $padlet7->title = "Padlet-Entry #7";
        $padlet7->subtitle = "Das ist ein Untertitel";
        $padlet7->rating = 9;
        $padlet7->published = new DateTime();
        $padlet7->user()->associate($user);
        $padlet7->padletContainer()->associate($padletContainer1);
        $padlet7->save();

// Weitere Einträge für Padlet-Container 2
        $padlet5 = new Padlet();
        $padlet5->title = "Padlet-Entry #5";
        $padlet5->subtitle = "Das ist ein Untertitel";
        $padlet5->rating = 8;
        $padlet5->published = new DateTime();
        $padlet5->user()->associate($user2);
        $padlet5->padletContainer()->associate($padletContainer2);
        $padlet5->save();

        $padlet6 = new Padlet();
        $padlet6->title = "Padlet-Entry #6";
        $padlet6->subtitle = "Das ist ein Untertitel";
        $padlet6->rating = 6;
        $padlet6->published = new DateTime();
        $padlet6->user()->associate($user2);
        $padlet6->padletContainer()->associate($padletContainer2);
        $padlet6->save();

        $padlet7 = new Padlet();
        $padlet7->title = "Padlet-Entry #7";
        $padlet7->subtitle = "Das ist ein Untertitel";
        $padlet7->rating = 9;
        $padlet7->published = new DateTime();
        $padlet7->user()->associate($user2);
        $padlet7->padletContainer()->associate($padletContainer2);
        $padlet7->save();

// Weitere Einträge für Padlet-Container 3
        $padlet5 = new Padlet();
        $padlet5->title = "Padlet-Entry #5";
        $padlet5->subtitle = "Das ist ein Untertitel";
        $padlet5->rating = 8;
        $padlet5->published = new DateTime();
        $padlet5->user()->associate($user3);
        $padlet5->padletContainer()->associate($padletContainer3);
        $padlet5->save();

        $padlet6 = new Padlet();
        $padlet6->title = "Padlet-Entry #6";
        $padlet6->subtitle = "Das ist ein Untertitel";
        $padlet6->rating = 6;
        $padlet6->published = new DateTime();
        $padlet6->user()->associate($user3);
        $padlet6->padletContainer()->associate($padletContainer3);
        $padlet6->save();

        $padlet7 = new Padlet();
        $padlet7->title = "Padlet-Entry #7";
        $padlet7->subtitle = "Das ist ein Untertitel";
        $padlet7->rating = 9;
        $padlet7->published = new DateTime();
        $padlet7->user()->associate($user3);
        $padlet7->padletContainer()->associate($padletContainer3);
        $padlet7->save();

        //$authors = Author::all()->pluck("id");
       // $padlet1->authors()->sync($authors);
    }
}
