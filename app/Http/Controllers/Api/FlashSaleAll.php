<?php

namespace App\Http\Controllers\Api;

use App\Models\FlashSale;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class FlashSaleAll
{
    public function __invoke(): JsonResponse
    {
        $flashProducts = FlashSale::with('product')->latest()->get();

        return DataTables::of($flashProducts)
            ->addColumn('select', function ($row) {
                return '<input type="checkbox" name="ids[]" class="selectbox" value="' . $row->id . '">
        ';
            })
            ->addColumn('created_at', function ($row) {
                return date('d/m/Y h:i A', strtotime($row->created_at));
            })
            ->addColumn('product_title', function ($row) {
                return '<a href="catalog?filter[title]=' . $row->product->title . '">' . $row->product->title . '</a>';
            })
            ->addColumn('product_code', function ($row) {
                return $row->product->product_code;
            })
            ->addColumn('product_price', function ($row) {
                return number_format($row->product->price);
            })
            ->addColumn('flash_price', function ($row) {
                return number_format($row->flash_price);
            })
            ->addColumn('action', function ($row) {
                return '<a target="_blank" class="btn btn-info btn-sm btn-block" href="/flash-sale/'
                    . $row->id . '/edit" ><i class="fas fa-eye"></i> Edit</a>';
            })
            ->rawColumns(['select', 'product_title', 'product_code', 'product_price', 'action'])
            ->make();
    }
}
