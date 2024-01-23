@extends('layouts.main')

@section('page-title')
    {{__('Manage Shopify Customers')}}
@endsection

@section('page-breadcrumb')
   {{__('Shopify Customers')}}
@endsection
@section('page-action')
    <div>
        @permission('garagevehicle create')
            <a class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="{{ __('Synch Customers') }}"
                data-url="{{ route('garage-vehicle.create') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Synch Customers') }}">
                <i class="ti ti-plus"></i>
            </a>
        @endpermission
        {{-- <a href="{{ route('driver.grid') }}" class="btn btn-sm btn-primary btn-icon"
            data-bs-toggle="tooltip"title="{{ __('Grid View') }}">
            <i class="ti ti-layout-grid text-white"></i>
        </a> --}}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="shopify_customer">
                            <thead>
                                <tr>
                                    <th>{{__('Avatar')}}</th>
                                    <th>{{__('First Name')}}</th>
                                    <th>{{__('Last Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone No')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shopify_customers['customers'] as $shopify_customer)
                                    @php
                                        $nameValues = array_column($shopify_customer['addresses'], 'phone');
                                        $phone_number = implode(',', $nameValues);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div>
                                                <a href="{{get_file('/uploads/users-avatar/avatar.png')}}" target="_blank">
                                                    <img alt="Image placeholder" src="{{get_file('/uploads/users-avatar/avatar.png')}}" class="img-fluid rounded-circle card-avatar" style="width: 35px;">
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $shopify_customer['first_name'] }}</td>
                                        <td>{{ $shopify_customer['last_name'] }}</td>
                                        <td>{{ $shopify_customer['email'] }}</td>
                                        <td>{{!empty($phone_number)?$phone_number:'' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
