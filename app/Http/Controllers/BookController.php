<?php
/**
 * Created by PhpStorm.
 * User: strahinja.ristic
 * Date: 10/24/2017
 * Time: 1:05 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Database\Eloquent\Model;
use Log;


class BookController extends Controller
{


    function searchBook(Request $request){


        $isbn = $request->input('isbn');

        $devLibrary = Book::where('isbn', '=', $isbn)->firstOrFail();

        if(is_null($devLibrary)){

            return "The book with that isbn doesnt exist in the devtech library";
        }else{

            $googleBook = file_get_contents ("https://www.googleapis.com/books/v1/volumes?q=".$isbn."+isbn");

            $bookJSON = json_decode($googleBook,true);


          //  $title = $bookJSON["items"][0]["volumeInfo"]["title"];


          // return $title;
            return view('book')->with('book', json_decode($googleBook, true));
        }


    }

}