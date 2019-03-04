@extends('home')
@section('title', __('messages.customer_list'))

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h1>{{__('messages.customer_list')}}</h1>
            </div>
            <a class="btn btn-outline-primary" href="" data-toggle="modal" data-target="#cityModal">
                {{__('messages.filter')}}
            </a>
            <div class="col-12">
                @if (Session::has('success'))
                    <p class="text-success">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        {{ Session::get('success') }}
                    </p>
                @endif

                @if(isset($totalCustomerFilter))
                    <span class="text-muted">
                      {{__('messages.find') . ' ' . $totalCustomerFilter . ' '. __('messages.customer')}}
                  </span>
                @endif

                @if(isset($cityFilter))
                    <div class="pl-5">
                     <span class="text-muted"><i class="fa fa-check" aria-hidden="true"></i>
                         {{ __('messages.from') . ' ' . $cityFilter->name }}</span>
                    </div>
                @endif
            </div>
            <div class="col-6">
                <form class="navbar-form navbar-left" action="{{route('customers.search')}}">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search">
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-default">{{__('messages.search')}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('messages.customer_name')}}</th>
                    <th scope="col">{{__('messages.dob')}}</th>
                    <th scope="col">Email</th>
                    <th scope="col">{{__('messages.city')}}</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($customers) == 0)
                    <tr>
                        <td colspan="7" class="text-center">Không có dữ liệu</td>
                    </tr>
                @else
                    @foreach($customers as $key => $customer)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->dob }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->city['name'] }}</td>
                            <td><a href="{{ route('customers.edit', $customer->id) }}">{{__('messages.update')}}</a></td>
                            <td><a href="{{ route('customers.destroy', $customer->id) }}" class="text-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">{{__('messages.delete')}}</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <div><a class="btn btn-primary" href="{{ route('customers.create') }}">{{__('messages.add_new')}}</a></div>
        </div>
        <div class="float-right">
            <p>{{ $customers->appends(request()->query()) }}</p>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="cityModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <form action="{{ route('customers.filterByCity') }}" method="get">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!--Lọc theo khóa học -->
                            <div class="select-by-program">
                                <div class="form-group row">
                                    <label  class="col-sm-5 col-form-label border-right">{{__('messages.filter_by_cities')}}</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select w-100" name="city_id">
                                            <option value="">{{__('messages.choose_city')}}</option>
                                            @foreach($cities as $city)

                                                @if(isset($cityFilter))
                                                    @if($city->id == $cityFilter->id)
                                                        <option value="{{$city->id}}" selected >{{ $city->name }}</option>
                                                    @else
                                                        <option value="{{$city->id}}">{{ $city->name }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$city->id}}">{{ $city->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- </form> -->
                            </div>
                            <!--End-->

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submitAjax" class="btn btn-primary" >{{__('messages.choose')}}</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection