@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add new Offer')}}
                </div>
        
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
              @endif
        
            <br>
            <form id="offerForm" method="POST"  action="" enctype="multipart/form-data">
                @csrf
        
                <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.offer photo')}}</label>
                <input type="file" class="form-control" name="photo" >
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control" name="name_ar" aria-describedby="emailHelp" placeholder="{{__('messages.Offer Name ar')}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name="name_en" aria-describedby="emailHelp" placeholder="{{__('messages.Offer Name en')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name="price" placeholder="{{__('messages.Offer Price')}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" placeholder="{{__('messages.Offer details ar')}}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details en')}}</label>
                        <input type="text" class="form-control" name="details_en" placeholder="{{__('messages.Offer details en')}}">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                    </form>
                    
                    <div class="alert alert-success" id="success_msg" style="display: none;">
                        تم الحفظ بنجاح
                    </div>
                
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
         $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>
@endsection

