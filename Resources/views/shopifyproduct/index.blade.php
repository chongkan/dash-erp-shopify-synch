@extends('layouts.main')

@section('page-title')
    {{__('Manage Product')}}
@endsection

@section('page-breadcrumb')
   {{__('Product')}}
@endsection
@section('page-action')
    <div>
        @permission('shopify create')
            <a class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="{{ __('Synch Products') }}"
                data-url="{{ route('garage-vehicle.create') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Synch Products') }}">
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
                        <table class="table mb-0 pc-dt-simple" id="shopify_product">
                            <thead>
                                <tr>
                                    <th>{{__('Product Image')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Category')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shopify_products['products'] as $shopify_product)
                                    <tr>
                                        <td>
                                            <div>
                                                <a href="{{$shopify_product['image']['src']}}" target="_blank">
                                                    <img alt="Image placeholder" src="{{$shopify_product['image']['src']}}" class="wid-75 rounded me-3">
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $shopify_product['title'] }}</td>
                                        <td>{{ $shopify_product['status'] }}</td>
                                        <td>{{ !empty($shopify_product['product_type'])?$shopify_product['product_type']:'-' }}</td>
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
