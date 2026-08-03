@extends('admin.layout.master')
@section('content')

    <main class="main-content">
        @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                  
                    <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام دسته</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title">
                            </div>
                        </div>
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">دسته پدر</label>
                            <div class="col-sm-10">
                            <select class="form-select" name="parent_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" value="">دسته اصلی</option>
                                @foreach($Categories as $key=>$value)
                                <option  value="{{$key}}"> {{$value}}</option>

                                @endforeach
                            </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
							<label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
							<input  class="col-sm-10" type="file" class="form-control-file" id="file" name="image">
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