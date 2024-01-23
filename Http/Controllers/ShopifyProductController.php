<?php

namespace Modules\ShopifySync\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ShopifyProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(Auth::user()->isAbleTo('shopify product manage'))
        {
            $company_settings = getCompanyAllSetting();
            $shopify_store_url = isset($company_settings['shopify_store_url']) ? $company_settings['shopify_store_url'] : '';
            $shopify_access_token = isset($company_settings['shopify_access_token']) ? $company_settings['shopify_access_token'] : '';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://{$shopify_store_url}.myshopify.com/admin/api/2023-07/products.json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "X-Shopify-Access-Token: $shopify_access_token"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response == false) {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
            $shopify_products = json_decode($response, true);
            return view('shopifysync::shopifyproduct.index',compact('shopify_products'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('shopifysync::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('shopifysync::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('shopifysync::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
