<?php

namespace App\Http\Controllers;

use App\Models\Panier_model;
use Auth;
use Carbon\Carbon;
use App\Models\Prodect;
use Illuminate\Http\Request;
use App\Models\Utilisateur_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class control_master extends Controller
{
    public function index (){
        return view('create');
    }
    public function verification(Request $request){
        $email = $request->email;
        $password = $request->password;
        $request->validate([
            'email'=>'required|unique:utilisateur,email',
            'password'=>'required|confirmed'
        ]);
        Utilisateur_model::create([
            'email'=>$email,
            'password'=>bcrypt($password)
        ]);
        return to_route('login_view')->with('success','your account a create withe success');
    }
    public function login_view(){
        return view('login');
    }
    public function verification_login(Request $request){
        $email = $request->email;
        $password = $request->password;
        
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $verification = ['email'=>$email , 'password'=>$password];
        $veri = Auth::attempt($verification);
        if($veri){
            return to_route('home')->with('success','tu es connecter');
        }else{
            return to_route('login_view')->with('failed','le email ou le mot de pass est inccorect');
        }
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return to_route('home')->with('success_deconnecter','vous etez deconnecter');
    }
    public function home(){
        $data= Prodect::all();
        //dd($data);
        $aujourdhui = Carbon::now();
        $dateFormatee = $aujourdhui->toDateString();        
        return view('home',compact('data','dateFormatee'));
    }
    public function stock(Request $request){
        $nameProduit = $request->input('name_produit');
        $descriptionProduit = $request->input('description_produit');
        $prixProduit = $request->input('prix_produit');
        $quantiteProduit = $request->input('quantite_produit');
        $img = $request->input('img_url');
        $user = $request->input('user');
        Panier_model::create([
            'name_produit' => $nameProduit,
            'description' => $descriptionProduit,
            'prix' => $prixProduit,
            'quantite' => $quantiteProduit,
            'img_produit'=>$img,
            'utilisateur'=>$user
        ]);

        // Or you can perform any other logic based on the received data.

        // Return a response if needed
        return response()->json(['message' => 'Data received successfully']);
    
    }
    public function panier_view(){
        $data = Panier_model::all();                
        return view('panier',compact('data'));
    }
    public function delete(Request $request){

        $id = $request->input('id');
            
        // Vérifier si l'élément avec cet ID existe
        $compte_a_supprimer = Panier_model::find($id);

        if (!$compte_a_supprimer) {
            // Si l'élément n'est pas trouvé, retourner une réponse d'erreur
            return response()->json(['error' => 'Item not found'], 404);
        }

        // L'élément existe, donc on peut le supprimer
        $compte_a_supprimer->delete();

        // Retourner une réponse réussie
        return response()->json(['message' => 'Data deleted successfully']);
    }
    public function form_confirmation_view(Request $request){    
        try{    
            $id = $request->input('id');
            //$donne = Utilisateur_model::all();
            //return view('form_confirmation_view',compact('donne'));
            return response()->json(['success' => true, 'data' => $id]);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Erreur interne du serveur'], 500);
        }
    }
    public function test(Request $request) {        
        $id = $request->query('id');
        //$donne = $request->query('autreDonnee');
        $donne = Utilisateur_model::all();
        //dd($donne);
        return view('form_confirmation_view',compact('donne','id'));
    }
    public function stock_confirmation(Request $request)
    {
        $this->validateConfirmationRequest($request);
    
        $localisation = $request->input('localisation');
        $phone = $request->input('phone');
        $id = $request->input('id');
    
        try {
            Utilisateur_model::updateOrCreate(['id' => $id], [
                'localisation' => $localisation,
                'phone_number' => $phone,
            ]);
    
            return response()->json(['message' => 'Mise à jour réussie']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur interne du serveur'], 500);
        }
    }
    
    public function confirmer(Request $request){
        $user_email = $request->input('email');
        $confirmer = $request->input('confirmer');
        $id_prodect = $request->input('id_prodect');
        $utilisateur = Panier_model::find($id_prodect);        
        //$utilisateur = Panier_model::where('utilisateur', $user_email)->firstOrFail();        
            $utilisateur->update([
                'nouvelle_colonne' => $confirmer                         
            ]);            
            return response()->json(['message' => 'Mise à jour réussie']);
    }
    
    
    private function validateConfirmationRequest(Request $request)
    {
        $this->validate($request, [
            'localisation' => 'required|string',            
            'id' => 'required|integer',
        ]);
    }
    public function fastfood(){
        $data = Prodect::all();        
        return view('fast_food',compact('data'));
    }
    public function homefood(){
        $data = Prodect::all();        
        return view('homefood',compact('data'));
    }
}
