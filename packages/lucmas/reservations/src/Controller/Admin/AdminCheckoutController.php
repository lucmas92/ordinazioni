<?php

namespace Lucmas\Reservations\Controller\Admin;

use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;
use Illuminate\Http\Request;
use Lucmas\Reservations\Model\Table;
use Lucmas\Reservations\Resources\OrderTableResource;
use Lucmas\Reservations\Resources\TableResource;

class AdminCheckoutController extends AdminController
{

    public function checkout()
    {
        return \view('Lucmas\Reservations\Views::admin.checkout.index');
    }

    public function getTableWithOrderList()
    {
        $tables = Table::whereHas('order')->with('order.products')->with('order')->orderBy('number')->get();
        return OrderTableResource::collection($tables);

    }


}
