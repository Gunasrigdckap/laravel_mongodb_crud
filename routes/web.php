<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use MongoDB\Client;
use App\Models\CustomerMongoDB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/test-mongo', function () {
    $client = new Client(env('DB_URI'));
    $database = $client->selectDatabase(env('DB_DATABASE'));

    // Convert the collections to an array of names
    $collections = [];
    foreach ($database->listCollections() as $collection) {
        $collections[] = $collection->getName();
    }

    // Return as JSON response
    return response()->json($collections);
});


Route::get('/create', function (Request  $request) {
    $success = CustomerMongoDB::create([
        'guid'=> '1',
        'first_name'=> 'john',
        'family_name' => 'Doe',
        'email' => 'johndoe@gmail.com',
        'address' => '123 my street, my city, zip, state, country'
    ]);
});

Route::get('/find_eloquent', function (Request  $request) {
    $customer = CustomerMongoDB::where('guid', '1')->get();
});

Route::get('/update_eloquent', function (Request  $request) {
    $result = CustomerMongoDB::where('guid', '1')->update( ['first_name' => 'Jimmy'] );
   });

Route::get('/delete_eloquent', function (Request  $request) {
    $result = CustomerMongoDB::where('guid', '1')->delete();
   });



   $customer = CustomerMongoDB::find($id);
   $customer->delete();


   






