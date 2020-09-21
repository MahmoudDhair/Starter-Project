<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Serve;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function getHasOne(){
        $usre = User::with(['phone'=>function($q){
            $q->select('code','number','user_id');
        }])->find(11);
        return response()->json($usre);
    }
    public function getHasOneReverse(){
        //To append phone and user of phone
        $phone = Phone::with(['user'=>function($q){
            $q->select('name','email','id');

        }])->find(1);
        //To visible the hidden attribute in the model
        $phone->makeVisible(['user_id']);
        //To hidden the visible attribute in the model
        //$phone->makeHidden(['number']);

        //To append phone and user of phone

        return $phone;
    }
    public function getAllUserHasPhone(){
        $users = User::whereHas('phone', function ($q) {
            //The condition in phone relation
            //$q->where();
        })->get();
        return $users;
    }

    public function getAllUserNotHasPhone(){
        $users = User::whereDoesntHave('phone', function ($q) {
            //The condition in phone relation
            //$q->where();
        })->get();
        return $users;
    }

    ################# Start One To Many Relation ######################

    public function getHospitalDoctors(){
       // $hospital = Hospital::get();  // to get All Hospital

        $hospital = Hospital::with(['doctors'=>function($q){
           // $q->select('name','hospital_id');
        }])->find(2); //Hospital::where('id',2)->first() //Hospital::first()
        //$doctor = $hospital ->doctors; // get all doctor in this hospital
        return $hospital;
    }

    public function getAllHospitals(){
        $hospitals = Hospital::select('id','name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function getDoctonInHospital($hospital_id){
       $hospital = Hospital::find($hospital_id);
       $doctor = $hospital->doctors;
       return view('doctors.doctors',compact('doctor'));
    }

    public function doctorDelete(Request $request){
       $doctor = Doctor::find($request->id);
       if(!$doctor){
           return response()->json([
               'status'=>false,
           ]);
       }
        $doctor -> delete();
       return  response()->json([
           'status'=>false,
           'id'=>$doctor->id
       ]);

    }

    public function hospitalsHasDoctors(){
        $hospitals = Hospital::with('doctors')->whereHas('doctors')->get();
        return $hospitals;
    }

    public function hospitalsHasDoctorsWithMale(){
        $hospitals = Hospital::with('doctors')->whereHas('doctors',function ($q){
            $q->where('gender',1);
        })->get();
        return $hospitals;
    }

    public function hospitalsNotHasDoctors(){
        $hospitals = Hospital::whereDoesntHave('doctors', function ($q) {
            //$q->where();
        })->get();
        return $hospitals;
    }

    public function hospitalDelete($hospital_id){
        $hospital = Hospital::find($hospital_id);
        if(!$hospital){
            return abort('404');
        }
        $hospital->doctors()->delete();
        $hospital->delete();
        return redirect()->route('hospitals');

    }
    ################# End One To Many Relation ######################

    ################# Start Many To Many Relation ######################

    public function getDoctorServes(){
       return $doctor = Doctor::with('serves')->find(8);
      // return $doctor->serves;
    }

    public function getServesDoctor(){
        return $serv = Serve::with('doctors')->find(1);
        // return $doctor->serves;
    }

    public function getDoctonServesById($doctor_id){
        $doctor = Doctor::find($doctor_id);
        $serves = $doctor->serves;

        $allDoctor = Doctor::select('id','name')->get();
        $allServes = Serve::select('id','name')->get();
        return view('doctors.serves',compact('serves','allDoctor','allServes'));
    }

    public function getServesToDoctor(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        if(!$doctor){
            return abort('404');
        }
        // attach function (array of data) => save data in the table many to many an it allowed to redundant data(عندما يتم اضافة بيانات  في الجدول يتم تتم اضافة البيانات مرة اخرى  يتم تركرها)
        //$doctor->serves()->attach($request->serve_id);

        // sync function // update data that mean remove old data and insert new data
        //$doctor->serves()->sync($request->serve_id);

        // syncWithoutDetaching function // append new data to old data and when append data redundant the data redundant do not insert
        $doctor->serves()->syncWithoutDetaching($request->serve_id);


        return 'success';
    }


    ################# End Many To Many Relation ######################

    ####################### Has One Through #####################

    public function getPatientDoctor(){
        $patient = Patient::find(1);
        return $patient->doctor;
    }

    public function getCountryDoctor(){
       // return $country = Country::with('doctors')->find(2);

        $country = Country::find(2);
        return $country->hospitals;

    }

    ####################### Has One Through #####################



    public function accessors(){
        return Doctor::select('id', 'name','gender','full_infor')->get();
    }


    public function index(){
        $number = [1,2,3,4,5,6,7,8,9];
         $col = collect($number);
         return $col->avg();

    }

}
