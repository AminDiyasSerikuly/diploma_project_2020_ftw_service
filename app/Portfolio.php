<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Portfolio extends Model
{    
    protected $table = 'portfolio';
    public static function getPortfolioCover($id)
    {
      $q = DB::table('portfolio_images')->where('portfolio_id', $id)->limit(1)->get();
      foreach($q as $r){
        return $r->img_thumbnail_path;
      }
    } 
    public static function getPortfolioImageCount($id)
    {
      $q = DB::table('portfolio_images')->where('portfolio_id', $id)->get();
      return $q->count();
    }
    public static function getPortfolioImages($id)
    {
      $q = DB::table('portfolio_images')->where('portfolio_id', $id)->get();
      return $q;
    }
    public static function getPortfolioName($id)
    {
      $q = DB::table('portfolio')->where('id', $id)->get();
      foreach($q as $r){
        return $r->portfolio_name;
      }
    }
    public static function getPortfolioNarrative($id)
    {
      $q = DB::table('portfolio')->where('id', $id)->get();
      foreach($q as $r){
        return $r->narrative;
      }
    } 
}
