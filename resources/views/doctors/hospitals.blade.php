 @extends('layouts.app')

 @section('content')
     <div class="container" style="margin-top: 40px">
         <h1 class="text-center">Hospitals</h1>
         <table class="table">
             <thead>
             <tr>
                 <th scope="col">#</th>
                 <th scope="col">Name</th>
                 <th scope="col">Address</th>
                 <th scope="col">Options</th>

             </tr>
             </thead>
             <tbody>
             @if(isset($hospitals) && $hospitals->count() >0)
                 @foreach($hospitals as $hospital)
                     <tr>
                         <th scope="row">{{$hospital->id}}</th>
                         <td>{{$hospital->name}}</td>
                         <td>{{$hospital->address}}</td>
                         <td>
                             <a href="{{route('hospital.doctors',$hospital->id)}}" class="btn btn-info">عرض الاطباء</a>
                             <a href="{{route('hospital.delete',['hospital_id'=>$hospital->id])}}" class="btn btn-danger">حذف الاطباء</a>
                         </td>
                     </tr>
                 @endforeach
             @endif
             </tbody>
         </table>
     </div>
 @stop




