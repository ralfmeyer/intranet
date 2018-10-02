<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Sql;
use App\Role;


class SqlController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $user = Auth::user();
//        $user->authorizeRoles(['admin']);
        $sql = Sql::all();
        return view('sql.index', compact('sql'));
    }

    public function create(){
        return view('sql.create');
    }

    public function store(Request $request){
       // validate
       $this->validate($request, [
        'bezeichnung'       => 'required',
        'anweisung'      => 'required'
        ]);


        // store
        Sql::create([
            'bezeichnung'      =>  $request->bezeichnung,
            'anweisung'      =>  $request->anweisung,
            'options' =>  $request->options,
        ]);
        return back();
    }

    public function show($id){
       return $this->execute($id);
    }
    
    public function edit(Sql $sql){
        $roles = Role::get(); // ( 'id', 'description' );
        return View('sql.edit', compact('sql', 'roles'));
    }

    public function update(Request $request, Sql $sql)
    {
        $this->validate($request, [
            'bezeichnung'       => 'required',
            'anweisung'      => 'required',
            'ausgabe'      => 'required'
            ]);
          
         $sql->update($request->all());
         $sql->roles()->sync( $request->roles);

         return redirect('/sql');// back();

    }

    public function destroy(Sql $sql)
    {
      $sql->delete();
       return back();
    }    

    public function test(){
        $meldung = "Fehlerfrei";
        try{
            // $meldung = DB::connection('mysql')->select('select @@version');
            $meldung = DB::connection('ep-sql')->getPdo(); // select('select @@version');
        }
        catch (Exception $e) {
            $meldung = "Could not connect to the database.  Please check your configuration. error:" . $e ;
        }
        return view('sql.testdb', compact('meldung') );
    }

    public function execute(Int $id){
        $sql = Sql::find($id);
        $sqlanweisung = $sql->anweisung;
        $meldung = "";
        try {
            $data = DB::connection('ep-sql')->select( $sqlanweisung );
        }
        catch (exception $e){
            $meldung = $e->getMessage();
         echo 'sql.form.'.$meldung;
         die();            
        }
        // echo 'sql.form.'.$sql->ausgabe;
        // die();
        //$options = json_encode($sql->options);
        $options = $sql->options;
        // $options = json_decode($sql->options);
        return view( 'sql.form.'.$sql->ausgabe, compact( 'data', 'sqlanweisung', 'meldung', 'options'));        
    }

    public function anyData(){
        $id = 1;
        $sql = Sql::find($id);
        $sqlanweisung = $sql->anweisung;
        $meldung = "";
        try {
            $data = DB::connection('ep-sql')->select( $sqlanweisung );
        }
        catch (exception $e){
            $meldung = $e->getMessage();
         echo 'sql.form.'.$meldung;
         die();            
        }
        // echo 'sql.form.'.$sql->ausgabe;
        // die();
        //$options = json_encode($sql->options);
        $options = $sql->options;
        // $options = json_decode($sql->options);
        
        
        return $data->make(true);
        // response()->json($data);
        // return view( 'sql.form.'.$sql->ausgabe, compact( 'data', 'sqlanweisung', 'meldung', 'options'));        
    }



}