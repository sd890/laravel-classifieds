<div class="table overflow-auto" tabindex="8">
   <div>
    <label class="col-sm-2 col-form-label">عنوان جستجو</lebel>
    <input type="text" class="form-control text-left" dir="rtl" wire:model.live="search"></input>
   </div>
   <table class="table table-striped table-hover">
						<thead class="thead-light" >
						<tr>
							<th class="text-center align-middle text-primary">ردیف</th>
							<th class="text-center align-middle text-primary">نام کاربر</th>
                            <th class="text-center align-middle text-primary">نام کاربری</th>
							<th class="text-center align-middle text-primary">ایمیل</th>
							<th class="text-center align-middle text-primary">موبایل </th>
                            <th class="text-center align-middle text-primary">نقش کاربر</th>
                            <th class="text-center align-middle text-primary">وضعیت</th>
                            <th class="text-center align-middle text-primary">ویرایش نقش</th>
					        <th class="text-center align-middle text-primary">حذف</th>
                            
							<th class="text-center align-middle text-primary">تاریخ ایجاد</th>
						</tr>
						</thead>
						<tbody>
                             @foreach($users as $index=>$user)
							<tr>
								<td class="text-center align-middle">{{$users->firstItem()+$index}}</td>

								<td class="text-center align-middle">{{$user->name}}</td>

                                <td class="text-center align-middle">{{$user->username}}</td>

                                <td class="text-center align-middle">{{$user->email}}</td>

                                <td class="text-center align-middle">{{$user->mobile}}</td>

                                <td class="text-center align-middle">{{$user->role}}</td>

                                <td class="text-center align-middle">{{$user->status}}</td>

								<td class="text-center align-middle"><a href="{{route('users.edit',$user->id)}}">ویرایش</a></td>
							
                                <td class="text-center align-middle">
									<a class="btn btn-outline-danger"  wire:click="deleteUser({{$user->id}})">
										حذف
									</a>
								</td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->format(' %B %d,%Y')}}</td>
							</tr>
						@endforeach
                        </tbody>
					</table>
					<div style="margin: 40px !important;"
						 class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
						
					</div>
</div>
