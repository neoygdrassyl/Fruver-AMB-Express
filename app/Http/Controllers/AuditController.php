<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use App\Models\Audit;

class AuditController extends Controller
{
    public function index(Request $request)
    {

        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Audit::eloquentQuery($sortBy, $orderBy, $searchValue);

        $query->where("id", 'like' ,'%'.$searchValue.'%')->orWhere("user", 'like' ,'%'.$searchValue.'%')->orWhere("table", 'like' ,'%'.$searchValue.'%')->orWhere("action", 'like' ,'%'.$searchValue.'%')->orWhere("updated_at", 'like' ,'%'.$searchValue.'%');

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        $entry = new Audit();
        $entry->user = $request->user;
        $entry->table = $request->table;
        $entry->action = $request->action;

        if ($entry->save()){
            return true;
        }else{
            return false;
        }
    }
}
