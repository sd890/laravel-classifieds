@extends('admin.layout.master')
@section('content')
	<main class="main-content">
    @include('admin.layout.errors')
		<div class="card">
            <div class="card-body">
                <div class="container">
                   
                    <form method="POST" action="{{route('city.update',$city->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام شهر</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{$city->city}}">
                            </div>
                        </div>
                         <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label"> نام استان</label>
                            <div class="col-sm-10">
                            <select class="form-select" name="province_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                              
                                @foreach($provineces as $key=>$value)
                                @if($city->province_id==$key)
                                <option selected="selected" value="{{$key}}"> {{$value}}</option>
                                    @else
                                    <option value="{{$key}}"> {{$value}}</option>
                                    @endif
                                @endforeach
                            </select>
                            </div>
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