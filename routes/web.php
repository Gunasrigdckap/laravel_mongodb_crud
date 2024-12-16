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

//Create a data
Route::get('/create', function (Request  $request) {
    $success = CustomerMongoDB::create([
        'guid'=> '2',
        'first_name'=> 'dharshini',
        'family_name' => 'sri',
        'email' => 'dhash@gmail.com',
        'address' => '22, Anna salai.'
    ]);
});


//Create a nested data

// Route::get('/createdata', function (Request $request) {
//     $success = CustomerMongoDB::create([
//         'guid'=> '3',
//         'first_name'=> 'Raman',
//         'family_name' => 'Prapha',
//        'email' => ["ram@gmail.com", "raman@dckap.com"],
//         'address' => [
//             'street' => "Gandhi street",
//             'city' => "Trichy",
//             'pin code' => "620013",
//         ],
//     ]);

// });


//Create nested data using arrays and objects

Route::get('/createdata', function (Request $request) {
    $success = CustomerMongoDB::create([
        'guid'=> '4',
        'first_name'=> 'Abi',
        'family_name' => 'Nice family',
       'email' => ["abi@gmail.com", "abirami@dckap.com",["abii@gmail.com", "abiramiii@dckap.com"]],
        'address' => [
            'street' => "Neru street",
            'city' => "Trichy",
            'pin code' => "620017",
        ],
    ]);

});


//Read data

Route::get('/find_eloquent', function (Request  $request) {
    $customer = CustomerMongoDB::where('guid', '1')->get();
});


//Update data using MongoDB query
Route::get('/update_eloquent', function (Request  $request) {
    $result = CustomerMongoDB::where('guid', '1')->update( ['first_name' => 'Jimmy'] );
   });


//delete data using MongoDB query
Route::get('/delete_eloquent', function (Request  $request) {
    $result = CustomerMongoDB::where('guid', '1')->delete();
   });












