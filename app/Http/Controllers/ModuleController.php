<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Question;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Question::get();

      //  return  response()->json($users);
        return json_encode(array('data' => $data,'count' => 3));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }

       //  $data = Question::get();
       //  $data = DB::table('questions')->get();

    //   //  return  response()->json($users);
    //     return json_encode(array('data' => $data,'count' => 4));


// $host = $_ENV['PG_HOST'];
// $port = $_ENV['PG_PORT'];
// $db = $_ENV['PG_DB'];
// $user = $_ENV['PG_USER'];
// $password = $_ENV['PG_PASSWORD'];
// $endpoint = $_ENV['PG_ENDPOINT'];

// $host = "ep-ancient-hat-81967113-pooler.us-east-1.postgres.vercel-storage.com";
// $port = "5432";
// $db = "verceldb";
// $user = "default";
// $password = "PZceg7UF1MpN";
// $endpoint = "ep-ancient-hat-81967113-pooler";

// $connection_string = "host=" . $host . " port=" . $port . " dbname=" . $db . " user=" . $user . " password=" . $password . "' sslmode=require";

//  $connection_string = "host=" . $host . " port=" . $port . " dbname=" . $db . " user=" . $user . " password=" . $password . " options='endpoint=" . $endpoint . "' sslmode=require";


// $dbconn = pg_connect($connection_string);

// if (!$dbconn) {
//     die("Connection failed: " . pg_last_error());
// }
// echo "Connected successfully";

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
