@extends('admin.layout.master')
@section('content')

    <main class="main-content">
        @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                  
                    <form method="POST" action="{{route('povinece.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام استان</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title">
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