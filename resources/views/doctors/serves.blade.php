 @extends('layouts.app')

 @section('content')
     <div class="container" style="margin-top: 40px">
        <h1 class="text-center">Serves</h1>
         <table class="table">
             <thead>
             <tr>
                 <th scope="col">#</th>
                 <th scope="col">Name</th>

             </tr>
             </thead>
             <tbody>

                    @if(isset($serves) && $serves->count() >0)
                        @foreach($serves as $serve)
                        <tr class="Row{{$serve->id}}">
                             <th scope="row">{{$serve->id}}</th>
                             <td>{{$serve->name}}</td>
                        </tr>
                        @endforeach
                    @endif
             </tbody>
         </table>

         <br>  <br>

         <form method="POST" action="{{route('serve.store')}}" >
             @csrf
             {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}


             <div class="form-group">
                 <label for="name_ar">اختر الطبيب</label>
                <select name="doctor_id" class="form-control">
                    @if(isset($allDoctor) && $allDoctor->count() >0)
                        @foreach($allDoctor as $Doctor)
                            <option value="{{$Doctor->id}}">{{$Doctor->name}}</option>
                        @endforeach
                    @endif
                </select>
             </div>

             <div class="form-group">
                 <label for="name_ar">اختر الخدمات</label>
                 <select name="serve_id[]" class="form-control" multiple>
                     @if(isset($allServes) && $allServes->count() >0)
                         @foreach($allServes as $allServe)
                            <option value="{{$allServe->id}}">{{$allServe->name}}</option>
                         @endforeach
                     @endif
                 </select>
             </div>

             <button type="submit" class="btn btn-primary">{{__('massages.Offer Submit')}}</button>
         </form>
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


