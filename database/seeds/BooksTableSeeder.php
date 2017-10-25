<?php

use Illuminate\Database\Seeder;
use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Book::create(['title'=>"American Gods",'isbn'=>"9780062113450"]);
        Book::create(['title'=>"Acid house", 'isbn'=>"9788823503595"]);



    }
}
