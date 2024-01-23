@extends('layouts.main')

@section('page-title')
    {{__('Manage Order')}}
@endsection

@section('page-breadcrumb')
   {{__('Order')}}
@endsection
@section('page-action')
    <div>
        @permission('garagevehicle create')
            <a class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="{{ __('Synch Orders') }}"
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

      <div class="mt-2" id="multiCollapseExample1">
        <div class="card">
            <div class="card-body">
                {{ Form::open(['route' => ['invoice.index'], 'method' => 'GET', 'id' => 'customer_submit']) }}
                <div class="row d-flex align-items-center justify-content-end">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                        <div class="btn-box">
                            {{ Form::label('issue_date', __('Issue Date'), ['class' => 'form-label']) }}
                            {{ Form::text('issue_date', isset($_GET['issue_date']) ? $_GET['issue_date'] : null, ['class' => 'form-control flatpickr-to-input','placeholder' => 'Select Date']) }}

                        </div>
                    </div>
                    @if (\Auth::user()->type != 'client')
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                            <div class="btn-box">
                                {{ Form::label('customer', __('Customer'), ['class' => 'form-label']) }}
                                {{ Form::select('customer', $customer, isset($_GET['customer']) ? $_GET['customer'] : '', ['class' => 'form-control select', 'placeholder' => 'Select Customer']) }}
                            </div>
                        </div>
                    @endif
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="btn-box">
                            {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                            {{ Form::select('status', ['' => 'Select Status'] + $status, isset($_GET['status']) ? $_GET['status'] : '', ['class' => 'form-control select']) }}
                        </div>
                    </div>
                    <div class="col-auto float-end ms-2 mt-4">

                        <a href="#" class="btn btn-sm btn-primary"
                            onclick="document.getElementById('customer_submit').submit(); return false;"
                            data-bs-toggle="tooltip" title="{{ __('Apply') }}"
                            data-original-title="{{ __('apply') }}">
                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                        </a>
                        <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-danger" data-toggle="tooltip"
                            data-original-title="{{ __('Reset') }}">
                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                        </a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="shopify_order">
                            <thead>
                                <tr>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Customer')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shopify_orders['orders'] as $shopify_order)
                                    <tr>
                                        <td>
                                            @if(\Auth::user()->can('shopify order show'))
                                                <a href="{{route('shopify-order.show',$shopify_order['id'])}}" class="btn btn-outline-primary">
                                                    <span class="btn-inner--text">{{$shopify_order['name']}}</span>
                                                </a>
                                            @else
                                                <span class="btn-inner--text">{{$shopify_order['name']}}</span>
                                            @endif
                                        </td>
                                        <td>{{ !empty($shopify_order['shopify_order'])?$customer['customer']:'No Customer' }}</td>
                                        <td>{{ company_date_formate($shopify_order['created_at']) }}</td>
                                        <td>{{ $shopify_order['financial_status'] }}</td>
                                        <td>{{ $shopify_order['total_price'] }}</td>
                                        <td>
                                            <div>
                                                <div class="actions">
                                                    @permission('shopify order show')
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="{{route('shopify-order.show',$shopify_order['id'])}}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title="{{ __('Details') }}"> <span class="text-white"> <i class="ti ti-eye"></i></span></a>
                                                        </div>
                                                    @endpermission
                                                </div>
                                            </div>
                                        </td>
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
