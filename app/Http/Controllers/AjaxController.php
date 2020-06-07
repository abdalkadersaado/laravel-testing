<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Http\Requests\OfferRequest;
use App\Traits\OfferTrait;

class AjaxController extends Controller
{
    use OfferTrait;

    public function create()
    {
        //view form to add this offer

        return view('offersAjax.create');
    }

    public function store(Request $request)
    {
        //save offer into database using ajax

         // save phote in folder 
         $file_name = $this->saveImage($request->photo ,'images/offers');
    
         // insert 
 
         $offer = Offer::create([
             'name_ar' => $request->name_ar,
             'name_en' => $request->name_en,
             'price' =>$request->price,
             'details_ar'=> $request->details_ar,
             'details_en' => $request->details_en,
             'photo' => $file_name,
         ]);
        if($offer)
         return response()->json([
             'status'=> true ,
             'msg'=>'تم الحفظ بنجاح' ,
         ]);
         else 
         return response()->json([
            'status'=> false ,
            'msg'=>'فشل الحفظ , حاول مجددا ' ,
        ]);

    }
}
