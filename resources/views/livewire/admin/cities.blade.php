<div class="table overflow-auto" tabindex="8">
   <div>
    <label class="col-sm-2 col-form-label">عنوان جستجو</lebel>
    <input type="text" class="form-control text-left" dir="rtl" wire:model.live="search"></input>
   </div>
   <table class="table table-striped table-hover">
						<thead class="thead-light">
						<tr>
							<th class="text-center align-middle text-primary">ردیف</th>
							
							<th class="text-center align-middle text-primary">نام شهر</th>
							<th class="text-center align-middle text-primary">نام استان</th>
							<th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">حذف</th>
                            
							<th class="text-center align-middle text-primary">تاریخ ایجاد</th>
						</tr>
						</thead>
						<tbody>
                            @foreach($cities as $index=>$city)
							<tr>
								<td class="text-center align-middle">{{$cities->firstItem()+$index}}</td>
								
								<td class="text-center align-middle">{{$city->city}}</td>
								<td class="text-center align-middle">{{$city->province->title}}</td>
								
								
									<td class="text-center align-middle">
									<a class="btn btn-outline-info" href="{{route('city.edit',$city->id)}}" >
										ویرایش
									</a>
								</td>
                                <td class="text-center align-middle">
									<a class="btn btn-outline-danger"  wire:click="deleteCity({{$city->id}})">
										حذف
									</a>
								</td>
								<td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($city->created_at)->format(' %B %d,%Y')}}</td>
							</tr>
						@endforeach
					</table>
					<div style="margin: 40px !important;"
						 class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
						 {{$cities->appends(Request::except('page'))->links()}}
					</div>
</div>
