<div class="table overflow-auto" tabindex="8">
   <div>
    <label class="col-sm-2 col-form-label">عنوان جستجو</lebel>
    <input type="text" class="form-control text-left" dir="rtl" wire:model.live="search"></input>
   </div>
   <table class="table table-striped table-hover">
						<thead class="thead-light" >
						<tr>
							<th class="text-center align-middle text-primary">ردیف</th>
							<th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">عنوان آگهی</th>
							<th class="text-center align-middle text-primary">نام آگهی دهنده</th>
							<th class="text-center align-middle text-primary">دسته بندی</th>
                            <th class="text-center align-middle text-primary">وضعیت</th>
							 <th class="text-center align-middle text-primary">اعتبارآگهی</th>
					        <th class="text-center align-middle text-primary">حذف</th>
                            
							<th class="text-center align-middle text-primary">تاریخ ایجاد</th>
						</tr>
						</thead>
						<tbody>
                             @foreach($ads as $index=>$ad)
							<tr>
								<td class="text-center align-middle">{{$ads->firstItem()+$index}}</td>
								<td class="text-center align-middle">
									<figure class="avatar avatar">
										<img src="{{url('images/Ads/smallImages/'.$ad->image)}}" class="rounded-circle" alt="image">
									</figure>
								</td>
								<td class="text-center align-middle"><a href="{{route('show.public.ads',$ad->id)}}">{{$ad->title}}</a></td>
								<td class="text-center align-middle">{{$ad->user->username}}</td>
								<td class="text-center align-middle">{{$ad->category->title}}</td>
                                <td class="text-center align-middle"><button wire:click="changeStatus({{$ad->id}})">
                                    @if($ad->status===\App\Enums\AdStatus::Approved->value)
                                    <span class="badge badge-success cursor-pointer">تایید شده</span>

                                    @elseif($ad->status===\App\Enums\AdStatus::Pending->value)

                                    <span class="badge bg-warning cursor-pointer text-dark">در حال پردازش</span>	

                                    @else($ad->status===\App\Enums\AdStatus::Rejected->value)
                                    <span class="badge badge-danger cursor-pointer"> عدم تایید</span>

                                    @endif
                                </button></td>
								<td class="text-center align-middle">
									{{\Hekmatinasser\Verta\Verta::instance($ad->expired_at)->format(' %B %d,%Y')}}
								</td>
								
                                <td class="text-center align-middle">
									@if($ad->status===\App\Enums\AdStatus::Rejected->value)
									<a class="btn btn-outline-danger"  wire:click="deleteAd({{$ad->id}})">
										حذف
									</a>
									@endif
								</td>
								
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($ad->created_at)->format(' %B %d,%Y')}}</td>
							</tr>
						@endforeach
                        </tbody>
					</table>
					<div style="margin: 40px !important;"
						 class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
						
					</div>
</div>
