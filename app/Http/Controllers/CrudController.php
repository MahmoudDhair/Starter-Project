<?php

namespace App\Http\Controllers;

use App\Events\ViewViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{

    use OfferTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getOffer(){
        return Offer::select('id','name','pric') -> get();
    }

//    public function store(){
//        Offer::create([
//           'name'=>'Ahmed',
//            'pric'=>'300',
//            'details' => 'This Is Offer Tow'
//        ]);
//    }

    public function create(){
        return view('offers.create');
    }

    public function store(OfferRequest $request){
        // make validation to the filed in the form before store in database
//        $rolrs = $this->getRules();
//        $massage = $this -> getMassage();
//        $validator = Validator::make($request->all(),$rolrs,$massage);
//        if($validator -> fails()){
//            return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }
        //store image in folder
        $file_name = $this -> saveImage($request->photo,'images/offers');
        // insert data in database
        Offer::create([
            'photo'=>$file_name,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'pric'=>$request->pric,
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
        ]);
        return redirect()->back()->with(['success'=>'تم اضافة العرض بنجاح']);
    }

//    protected function getRules(){
//        return $roles=[
//            'name'=>'required|max:100|unique:offer,name',
//            'pric'=>'required|numeric',
//            'details'=>'required'
//        ];
//    }

//    protected function getMassage(){
//        return $massage = [
//            'name.required' => __('massages.offer name required'),
//            'name.max' =>  __('massages.offer name max'),
//            'name.unique' => __('massages.offer name unique'),
//            'pric.required' => __('massages.offer pric required'),
//            'pric.numeric' => __('massages.offer pric numeric'),
//            'details.required' => __('massages.offer details required'),
//        ];
//    }


    public function getAllOffer(){
//       $offers = Offer::select
//       ('id',
//           'pric',
//           'name_'.LaravelLocalization::getCurrentLocale().' as name',
//           'details_'.LaravelLocalization::getCurrentLocale().' as details',
//           'photo')
//           -> get();
        $offers = Offer::select
        ('id',
            'pric',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details',
            'photo')
            -> paginate(PAGINATION_COUNT);
        //return view('offers.all',compact('offers'));

        return view('offers.pagination',compact('offers'));
    }

    public function edit($offer_id){

       // $offer = Offer::findOrFail($offer_id);//if not exist offer return 404 not found
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }

        $offer = Offer::select('id','name_ar','name_en','pric','details_ar','details_en')->find($offer_id);
        return view('offers.edit',compact('offer'));
    }

    public function delete($offer_id){
        // chech
        $offer = Offer::find($offer_id);
        if(!$offer)
            return redirect() -> back() -> with(['error'=>__('massages.Offer Not Found')]);

        $offer -> delete();
        return redirect() -> route('offer.all') ->with(['success'=>__('massages.The Offer Deleted Successfully')]);

    }

    public function update(OfferRequest $request,$offer_id){
        // validation
        //check if id is exist
        $offer = Offer::find($offer_id); // we pass to find function id only
        if(!$offer){
            return redirect()->back();
        }
        //update
        $offer -> update($request->all());
        return redirect()->back()->with(['update'=>__('massages.The Offer Updated')]);
        //Or
//
//        $request ->update([
//            'name_ar'=>$request->name_ar,
//            'name_en'=>$request->name_en,
//            'pric'=>$request->pric,
//        ]);

    }

    public function getVideo(){
        $video = Video::first();
        event(new ViewViewer($video));
        return view('videos')->with('video',$video);
    }


    public function getAllActiveOffer(){
       return Offer::valid()->get();
    }





}
