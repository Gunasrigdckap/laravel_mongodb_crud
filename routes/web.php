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



Route::get('/testmongo', function () {
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
Route::get('/create', function () {
 $customer = CustomerMongoDB::create([
        'guid'=> '6',
        'first_name'=> 'dharshini',
        'family_name' => 'sri',
        'email' => 'dhash@gmail.com',
        'address' => '22, Anna salai.'
    ]);
  return response()->json([
    'message' => 'Data created successfully',
     'data' => $customer,
  ]);
});


//Create a nested data

// Route::get('/createdata', function () {
//      $customer = CustomerMongoDB::create([
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
//      return response()->json([
//     'message' => 'Data created successfully',
//     'data' => $customer,
//  ]);
// });


//Create nested data using arrays and objects

Route::get('/createdata', function () {
    $customer = CustomerMongoDB::create([
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
    return response()->json([
        'message' => 'Data created successfully',
        'data' => $customer,
    ], 200);
});


//Read data

Route::get('/find_eloquent', function () {
    $customer = CustomerMongoDB::where('guid', '4')->get();


    return response()->json([
        'message' => 'Data retrieved successfully',
        'data' => $customer,
    ], 200);
});


//Update data using MongoDB query
Route::get('/update_eloquent', function () {
    CustomerMongoDB::where('guid', '2')->update( ['first_name' => 'Dharshini'] );
    $updatedCustomer = CustomerMongoDB::where('guid', '2')->get();
    return response()->json([
        'message' => 'Data updated successfully',
        'data' => $updatedCustomer,
    ],200);
   });


//delete data using MongoDB query
Route::get('/delete_eloquent', function () {
    $customer = CustomerMongoDB::where('guid', '1')->delete();

    return response()->json([
        'message' => 'Data deleted successfully',
        'data' => $customer,
    ],200);
   });









