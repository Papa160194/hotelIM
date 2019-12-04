<?php

namespace App\Http\Controllers;

use App\Client;
use App\Commande;
use App\Produit;
use Illuminate\Http\Request;
use App\Plat;
use App\Compose;
use App\Table;
use PDF;
use DB;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produit = Produit::all();
        $clients = Client::all();
        $commandes = Commande::all();
       $plats = Plat::all();

        return view('plats.index', compact('plats','produit','commandes','clients'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plats = Plat::all();
        $tables = Table::all();
        $clients = Client::all();
        $commandes = Commande::all();
        $produits = Produit::all();
        //'table_id',
        return view('plats.create', compact('commandes','produits','clients','tables','plats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd($request->all());
        $produits = $request['produits'];
        $quantite = $request['quantite'];
        $arrlength = count($request['produits']);
        for($x = 0; $x < $arrlength; $x++) {
            $produit = Produit::find($produits[$x]);
            if($produit->quantite < $quantite[$x] ){
                return redirect()->route('plats.create')->with('error',' Stock inssufisant!!!'.$produit->nom);
            }

            }
        for($x = 0; $x < $arrlength; $x++) {
            $produit = Produit::find($produits[$x]);

               $produit->quantite = $produit->quantite - $quantite[$x];
               $produit->save();
            }

        $data=$request->all();
        $lastid=Commande::create($data)->id;
        $request->merge(['commande_id' => $lastid]);
       // dd( $request['commande_id' ]);
        $data = $request->all();
        $plat=Plat::create($data)->id;
      //  dd($plat);
        for($x = 0; $x < $arrlength; $x++) {

        $compose = new Compose();
            //$compose->produit_id = implode(',',$produits);
            $compose->produit_id = $produits[$x];
            $compose->quantite = $quantite[$x];
            $produit = Produit::find($produits[$x]);
            //$compose->produit_id = $produits->id;
            $compose->plat_id =$plat;
            $compose->save();
        }


        return redirect()->route('commandes.index')->with('success','Commande enregistré!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$plat = Plat::find($id);
        //return view('plats.show', compact('plat','clients'));
        $plats = Plat::where('commande_id','=',$id)->get();
        return view('tests.new',compact('plats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produits = Produit::get(); //Get all roles

        $compose = Compose::all();
        $produits = Produit::all();
        $clients = Client::all();
        $tables = Table::all();
        $plat = Plat::find($id);
        return view('plats.edit', compact('produit','plat','clients','tables','produits','compose','produits'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'client_id' => 'required',
            'table_id' => 'required',

        ]);
        $commande = Commande::find($id)->update($request->all());


        $plat['nom'] = $request->get('nom');
        $plat['prix'] = $request->get('prix');
        $plat['quantite'] = $request->get('quantite');

        $plat['commande_id'] = $commande->id;

        $plat= Plat::update($plat);

        $produits = $request['produits'];

        if(isset($produits)) {
            // DB::table('produits')->decrement('quantite', $request->quantite);
         $compose = new Compose();
             //$compose->produit_id = implode(',',$produits);
             $compose->produit_id()->sync($produits);

             //$compose->produit_id = $produits->id;
             $compose->plat_id = $plat->id;
             $compose->update();
            }
         return redirect()->route('plats.index')->with('success','Plat enregistré!!!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function facturePdf($id){
        $plat = Plat::find($id);

        $pdf = PDF::loadView('PDF.factureResto', compact('plat'));
        return $pdf->download('demonutslaravel.pdf');
    }

    public function newProduit($id){
        $produit = Produit::find($id);
        $plat = Plat::find($id);
        return view('plats.new', compact('produit','plat'));
    }


}
