@extends('layouts.main')

@section('page-title')
    {{__('Manage Category')}}
@endsection

@section('page-breadcrumb')
   {{__('Category')}}
@endsection
@section('page-action')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="shopify_category">
                            <thead>
                                <tr>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Title')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shopify_categorys['custom_collections'] as $shopify_category)
                                    <tr>
                                        <td>
                                            <div>
                                                @if (!empty($shopify_category['image']))
                                                    <a href="{{$shopify_category['image']['src']}}" target="_blank">
                                                        <img alt="Image placeholder" src="{{$shopify_category['image']['src']}}" class="rounded" style="width:70px; height:50px;">
                                                    </a>
                                                @else
                                                    <a href="{{asset('Modules/WordpressWoocommerce/Resources/assets/image/woocommerce.png')}}" target="_blank">
                                                        <img alt="Image placeholder" src="{{asset('Modules/WordpressWoocommerce/Resources/assets/image/woocommerce.png')}}" class="rounded" style="width:70px; height:50px;">
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $shopify_category['title'] }}</td>
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
