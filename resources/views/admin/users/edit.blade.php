@extends('admin.layout.master')
@section('content')

    <main class="main-content">
        @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                  
                    <form method="POST" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                         <div class="form-group row">
                                <label class="col-sm-2 col-form-label">نام کاربری</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="userName" value="{{$user->username}}">
                                </div>
                                
                        </div>
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">نقش</label>
                            <div class="col-sm-10">
                            <select class="form-select" name="role" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                              
                                
                                <option  value="{{\App\Enums\role::Admin->value}}"> ادمین</option>
                                <option  value="{{\App\Enums\role::Moderator->value}}"> ناظر</option>
                                <option  value="{{\App\Enums\role::Support->value}}"> پشتیبان</option>
                                <option  value="{{\App\Enums\role::Manager->value}}"> مدیر</option>
                                <option  value="{{\App\Enums\role::Banned->value}}"> مسدودسازی</option>
                                <option  value="{{\App\Enums\role::User->value}}"> کاربر عادی</option>

                                
                            </select>
                            </div>
                        </div>
                        
                          <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">وضعیت</label>
                            <div class="col-sm-10">
                            <select class="form-select" name="status" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                              
                                
                                <option  value="{{\App\Enums\userStatus::Active->value}}"> فعال</option>
                                <option  value="{{\App\Enums\userStatus::InActive->value}}"> غیر فعال</option>
                                
                                
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