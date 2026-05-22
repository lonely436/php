<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Enterprise;

class EnterpriseController extends Controller
{
    public function index()
    {
        $enterprises = Enterprise::all();
        return response()->json(['data' => $enterprises]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'abbreviate' => 'required',
            'philosophy' => 'required',
            'description' => 'required',
        ]);

        $data = $request->only(['name', 'abbreviate', 'philosophy', 'description']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images');
            $data['image'] = "/uploads/" . $path;
        }

        $enterprise = Enterprise::create($data);

        return response()->json(['data' => $enterprise], 201);
    }

    public function destroy($id)
    {
        $enterprise = Enterprise::find($id);

        if (!$enterprise) {
            return response()->json(['error' => '企业不存在'], 404);
        }

        $enterprise->delete();

        return response()->json(['message' => '删除成功'], 200);
    }

    public function show($id)
    {
        $enterprise = Enterprise::find($id);

        if (!$enterprise) {
            return response()->json(['error' => '企业不存在'], 404);
        }

        return response()->json(['data' => $enterprise]);
    }

    public function update(Request $request, $id)
    {
        $enterprise = Enterprise::find($id);

        if (!$enterprise) {
            return response()->json(['error' => '企业不存在'], 404);
        }

        $request->validate([
            'name' => 'required|min:2',
            'abbreviate' => 'required',
            'philosophy' => 'required',
            'description' => 'required',
        ]);

        $data = $request->only(['name', 'abbreviate', 'philosophy', 'description']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images');
            $data['image'] = "/uploads/" . $path;
        }

        $enterprise->update($data);

        return response()->json(['data' => $enterprise]);
    }
}
