@extends('admin.layout.master')
@section('content')

    <main class="main-content">
        @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                  
                    <form method="POST" action="{{route('city.store')}}" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group row">
                                <label class="col-sm-2 col-form-label">نام شهرها</label>
                                <div class="col-sm-10">
                                    <div id="city-fields">
                                        <input type="text" class="form-control mb-2" name="cities[]" placeholder="نام شهر">
                                    </div>
                                    <button type="button" id="add-city" class="btn btn-info">افزودن شهر جدید</button>
                                </div>
                        </div>
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label"> نام استان</label>
                            <div class="col-sm-10">
                            <select class="form-select" name="province_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                              
                                @foreach($provineces as $key=>$value)
                                <option  value="{{$key}}"> {{$value}}</option>

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
<script>
    document.getElementById('add-city').addEventListener('click', function() {
        let cityFields = document.getElementById('city-fields');
        let input = document.createElement('input');
        input.type = 'text';
        input.name = 'cities[]';
        input.placeholder = 'نام شهر';
        input.classList.add('form-control', 'mb-2');
        cityFields.appendChild(input);
    });
</script>
@endsection