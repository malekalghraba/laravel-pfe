<?php
    namespace App\Http\Controllers;
session_start();

$a=request('username');
$b=request('password');



use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\utilisateur;
class MainController extends Controller
{
    function index()
    {
     return view('welcome');
    }
    
    function checklogin(Request $request)
    {
     $this->validate($request, [
      'username'   => 'required',
      'password'  => 'required'
     ]);
        
      
     $_SESSION["user"]=$request->input('username');
     $data=$request->input('password');
     
     
    for($i = 0; $i < strlen($data); $i++){
        $data[$i] = ~ $data[$i];
      }
      $data = base64_encode($data);
      $_SESSION["pass"]= $data;
     
     $checkLogin = DB::table('utilisateurs')->where(['matricule'=>$_SESSION["user"],'password'=> $_SESSION["pass"]])->get();
     if(count($checkLogin)  >0) 
     {
     return redirect('/profil/successlogin');
     }
     else
     {
         
      return back()->with('error', 'Utilisateur invalide!! matricule ou mot de passe incorrecte ');
      

     }

    }


    function successlogin()
    {
     return view('profil');
    }
}

?>