 @extends('layouts.app')

 @section('content')
     <div class="container" style="margin-top: 40px">
        <h1 class="text-center">Doctors</h1>
         <table class="table">
             <thead>
             <tr>
                 <th scope="col">#</th>
                 <th scope="col">Name</th>
                 <th scope="col">Title</th>
                 <th scope="col">Options</th>

             </tr>
             </thead>
             <tbody>

                    @if(isset($doctor) && $doctor->count() >0)
                        @foreach($doctor as $doctor)
                        <tr class="Row{{$doctor->id}}">
                             <th scope="row">{{$doctor->id}}</th>
                             <td>{{$doctor->name}}</td>
                             <td>{{$doctor->title}}</td>
                             <td>
                                 <a href="" doctor_id="{{$doctor->id}}" class="btn btn-danger btn-delete">حذف الطبيب</a>
                                 <a href="{{route('doctors.serve',$doctor->id)}}"  class="btn btn-info">الخدمات</a>
                             </td>
                        </tr>
                        @endforeach
                    @endif
             </tbody>
         </table>
     </div>
 @stop

 @section('scripts')
     <script>
         $(document).on('click','.btn-delete',function (e){
             // save_offer is the id of button
             e.preventDefault();
            //to get id from button
             var $doctor_id = $(this).attr('doctor_id');

             $.ajax({
                 type: 'post',
                 url: "{{route('doctor.delete')}}",
                 data: {
                     '_token':"{{csrf_token()}}",
                     'id': $doctor_id
                 },
                 success: function (data) {
                         $('.Row'+data.id).remove();

                 }, error: function (reject) {

                 }
             });
         });

     </script>

 @stop


