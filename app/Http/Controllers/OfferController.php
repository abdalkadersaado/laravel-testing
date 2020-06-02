<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use LaravelLocalization;
use App\Traits\OfferTrait;

class OfferController extends Controller
{
    use OfferTrait;
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        //validate data before insert to database

        /*
        $rules = $this->getRules() ; 


        $messages =  $this->getMessages();

        $validator = Validator::make($request->all() ,$rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        */

        // save phote in folder 
        $file_name = $this->saveImage($request->photo ,'images/offers');
    
        // insert 

        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' =>$request->price,
            'details_ar'=> $request->details_ar,
            'details_en' => $request->details_en,
            'photo' => $file_name,
        ]);

        return redirect()->back()->with(['success' => 'تم اضافه العرض بنجاح ']);

        
        
        /*Offer::create([
            'name' => 'abod',
            'details' => 'that alot of offers'
        ]);*/
    }
    /*
    protected function getRules(){
        return $Rules = [
            'name'=>'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required'
        ];
    }

    protected function getMessages() {
       return  $messages = [
            'name.required' => __('messages.Offer Name required'),
            'name.unique' =>  __('messages.offer name must be unique'),
            'details.required' => __('messages.Offer details required'),
            'price.required' => __('messages.Offer Price required') ,
            'price.numeric' => __('messages.offfer price must be numeric')
            
        ];
    }
    */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($offer_id)
    {
       // Offer::findOrFail($offer_id);

       $offer = Offer::find($offer_id); // search in given table only id 
       if(!$offer){
           return redirect()->back();
       }

       $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price')->find($offer_id);
        return view('offers.edit',compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request,$offer_id)
    {
        // validate 

        // check if offer exists
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        //update data 
        $offer->update($request->all());

        return redirect()->back()->with(['success'=>'تم التحديث بنجاح ']) ;

       /* $offer = update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en ,
            ......... 
            
        ]); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function getAllOffers()
    {
       $offers= Offer::select('id',
       'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
       'details_' . LaravelLocalization::getCurrentLocale() . ' as details' ,
       'price')->get();
       return view('offers.all',compact('offers'));
    }

    
    
}
