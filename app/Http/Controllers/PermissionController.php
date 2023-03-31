<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index')->with('permissions',$permissions); 
    }


    public function store(Request $request)
{
    $permission = Permission::create($request->all());

    return response()->json([
        'message' => 'Permission created successfully',
        'data' => $permission
    ]);
}

public function update(Request $request, $id)
{
    $permission = Permission::findOrFail($id);

    $permission->update($request->all());

    return response()->json([
        'message' => 'Permission updated successfully',
        'data' => $permission
    ]);
}

public function destroy($id)
{
    $permission = Permission::findOrFail($id);

    $permission->delete();

    return response()->json([
        'message' => 'Permission deleted successfully'
    ]);
}
}