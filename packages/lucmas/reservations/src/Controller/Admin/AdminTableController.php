<?php

namespace Lucmas\Reservations\Controller\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;
use Lucmas\Reservations\Model\Table;
use Lucmas\Reservations\Model\User;
use Illuminate\Http\Request;

class AdminTableController extends AdminController
{

    public function tables()
    {
        return \view('Lucmas\Reservations\Views::admin.table.index');

    }

    public function store(Request $request, Table $table)
    {

        $request->validate([
            'number' => 'required|max:255',
        ]);
        $table->fill($request->all());
        if ($request->get('parent_id'))
            $table->parent_id = $request->get('parent_id');

        $table->save();

        return $table;
    }


    public function delete(Request $request, $table_id)
    {
        $table = Table::find($table_id);

        if (!$table_id) {
            return response()->json(['code' => '404', 'message' => 'Errore'], 404);
        }

        $table->delete();

        return response()->json(['code' => '204', 'message' => 'Eliminato'], 200);
    }

    public function update(Request $request, $tableId)
    {
        /** @var Table $table */
        $table = Table::find($tableId);

        if (!$table) {
            return response()->json(['code' => '404', 'message' => 'Errore'], 404);
        }

        $request->validate([
            'number' => 'required|max:255',
        ]);
        $table->number = $request->get('name');
        $table->save();
        return $table;
    }

}
