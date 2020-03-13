<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
   protected $table = 'plats';
   protected $fillable = ['nom','prix'];

   public function composes(){
    return $this->hasMany(Compose::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function commande()
    {
        return $this->belongsToMany(Commande::class);
    }

    /*public function produits(){
        return $this->belongsToMany(Produit::class);
     }*/
    public function detailCommandes(){
        return $this->hasMany(DetailCommande::class);
    }
}