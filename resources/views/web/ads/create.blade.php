@extends('web.profile.layout.site')
@section('content')
    <main class="main-content">
    @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                 
                    <form method="POST" action="{{route('my_ads.store')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">عنوان آگهی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title">
                            </div>
                        </div>
                        
                       
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label"> توضیح کوتاه</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="short_description">
                            </div>
                        </div>
                        
                       
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">توضیحات </label>
                            <div class="col-sm-10">
                               <textarea id="description" class="form-control" name="description" rows="10" cols="30"></textarea>
                            </div>
                        </div>
                        <label class="col-sm-2 col-form-label">نوع قیمت </label>
                            <div class="col-sm-10">
                                <label><input type="radio" name="price_type" value="negotiable"> توافقی</label>
                                <label><input type="radio" name="price_type" value="fixed"> قیمت مشخص</label>
                            </div>
                            <div class="col-sm-10 mt-2">
                                <input type="number" class="form-control" name="price" placeholder="مبلغ (در صورت نیاز)">
                            </div>

                       
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">دسته بندی</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($categories as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label"> شهر</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="city_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($cities as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                     
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                           <input type="file" class="form-control-file" id="file" name="image">
                        </div>
                         
                            <div class="col-sm-10">
                                  <label class="col-sm-2 col-form-label">نمایش شماره همراه</label>
                               <input type="checkbox" name="show_mobile" />
                                
                            </div>
                        <div class="form-group row">
                            <button name="submit" type="submit" class="btn btn-success btn-uppercase">
                                <i class="ti-check-box m-r-5"></i> ذخیره
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>

           $('.form-select').select2();

           var customOptions = {
               placeholder: "روز / ماه / سال"
               , twodigit: false
               , closeAfterSelect: true
               , nextButtonIcon: "fa fa-arrow-circle-right"
               , previousButtonIcon: "fa fa-arrow-circle-left"
               , buttonsColor: "#5867dd"
               , markToday: true
               , markHolidays: true
               , highlightSelectedDay: true
               , sync: true
               , gotoToday: true
           }
           kamaDatepicker('special_expiration', customOptions);

           if($('#description').length) {
               CKEDITOR.replace('description');
           }

    </script>
    @endsection