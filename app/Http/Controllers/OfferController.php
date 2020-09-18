<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        // display the create page of offer with ajax
        return view('ajaxOffers.create');
    }

    public function store(OfferRequest $request){
        // store date from Form
        $file_name = $this->saveImage($request->photo , 'images/offers');
        $offer = Offer::create([
            'photo'=>$file_name,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'pric'=>$request->pric,
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
        ]);
        if($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'تم اضافة العرض بنجاح'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'يرجى المحاولة مرة اخر في وقت لاحق'
            ]);
        }
    }

    public function all(){
        $offers = Offer::select('id',
            'pric',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details',
            'photo') -> get();

        return view('ajaxOffers.all',compact('offers'));
    }

    public function delete(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'يرجى المحاولة مرة اخر في وقت لاحق',
                'id' =>$request->id
            ]);

        $offer -> delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة العرض بنجاح',
            'id' =>$request->id
        ]);
    }

    public function edit($offer_id){
        // $offer = Offer::findOrFail($offer_id);//if not exist offer return 404 not found
        $offer = Offer::find($offer_id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'يرجى المحاولة مرة اخر في وقت لاحق',
                'id' =>$offer_id
            ]);
        }

        $offer = Offer::select('id','name_ar','name_en','pric','details_ar','details_en')->find($offer_id);
        return view('ajaxOffers.edit',compact('offer'));
    }

    public function update(Request $request){
        $offer = Offer::find($request->offer_id); // we pass to find function id only
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'يرجى المحاولة مرة اخر في وقت لاحق',
                'id' =>$request->offer_id
            ]);
        }
        //update
        $offer -> update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة العرض بنجاح',
            'id' =>$request->offer_id
        ]);
    }
}
