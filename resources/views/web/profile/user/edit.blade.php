@extends('web.profile.layout.site')
@section('content')
	<main class="main-content py-4">
	@include('admin.layout.errors')
		 <div class="container" >
              <div class="card shadow-sm" style="width: 50%; height:auto">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"> ویرایش اطلاعات کاربر <span class="text-warning">{{ $user->name }}</span></h3>
            </div>
            <div class="text-center mb-4">
    <figure class="avatar avatar-lg mx-auto">
        <img src="{{ url('images/user/smallImages/'.$user->image) }}" class="rounded-circle" alt="تصویر کاربر">
    </figure>
    
</div>
            <div class="card-body" >
               
                
                    <form method="POST" action="{{route('profile.update',$user->id)}}" enctype="multipart/form-data" style="direction: rtl;">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تصویر </label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control text-left" dir="rtl" name="image" value="">
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام کاربری</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="user_name" value="{{$user->username}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ایمیل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">موبایل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="mobile" value="{{$user->mobile}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">کلمه عبور</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control text-left" dir="rtl" name="password">
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