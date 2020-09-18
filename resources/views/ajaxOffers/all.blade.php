 @extends('layouts.app')

 @section('content')
     <div class="container" style="margin-top: 40px">
         @if (Session::has('error'))
             <div class="alert alert-danger">{{Session::get('error')}}</div>
         @endif

         @if (Session::has('success'))
             <div class="alert alert-success">{{Session::get('success')}}</div>
         @endif
         <div class="alert alert-success" id="success_msg" style="display: none" role="alert">
             تم حذف العرض بنجاح
         </div>
         <table class="table">
             <thead>
             <tr>
                 <th scope="col">#</th>
                 <th scope="col">{{__('massages.Offer Name')}}</th>
                 <th scope="col">{{__('massages.Offer Price')}}</th>
                 <th scope="col">{{__('massages.Offer Details')}}</th>
                 <th scope="col">{{__('massages.Offer Image')}}</th>
                 <th scope="col">{{__('massages.options')}}</th>
             </tr>
             </thead>
             <tbody>
             @foreach ($offers as $offer)
                 <tr class="offerRow{{$offer -> id}}">
                     <th scope="row">{{$offer -> id}}</th>
                     <td>{{$offer -> name}}</td>
                     <td>{{$offer -> pric}}</td>
                     <td>{{$offer -> details}}</td>
                     <td><img src="{{asset('images/offers/'.$offer -> photo)}}" class="img-thumbnail" width="100" height="100"></td>
                     <td>
                         <a href="{{url('offer/edit/'.$offer -> id)}}" class="btn btn-success btn-sm">{{__('massages.update')}}</a>
                         <a href="{{route('offer.delete',$offer -> id)}}" class="btn btn-danger btn-sm">{{__('massages.Delete')}}</a>
                         <a href="" offer_id="{{$offer -> id}}" class="btn btn-danger btn-sm delete-ajax">{{__('massages.Delete ajax')}}</a>
                         <a href="{{route('ajax.offer.edit',$offer -> id)}}"  class="btn btn-success btn-sm update-ajax">{{__('massages.update Ajax')}}</a>

                     </td>
                 </tr>
             @endforeach


             </tbody>
         </table>
     </div>
 @stop

 @section('scripts')
     <script>
         $(document).on('click','.delete-ajax',function (e){
             // save_offer is the id of button
             e.preventDefault();
            //to get id from button
             $offer_id = $(this).attr('offer_id');

             $.ajax({
                 type: 'post',
                 url: "{{route('ajax.offer.delete')}}",
                 data: {
                     '_token':"{{csrf_token()}}",
                     'id': $offer_id
                 },
                 success: function (data) {
                     if(data.status === true){
                         $('#success_msg').show();
                         $('.offerRow'+data.id).remove();
                     }
                 }, error: function (reject) {

                 }
             });
         });

     </script>

 @stop


