<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use function Pest\version;

class VersionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Version::latest()->get();
            if (!empty($request->input('search.value'))) {
                $searchTerm = $request->input('search.value');
                $data->where('name', 'LIKE', "%$searchTerm%");
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $status = ' <div class="form-check form-switch">';
                    $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= "checked";
                    }
                    $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return ' <button type="button" data-id="' . $data->id . '" class="edit btn btn-primary text-white btn-sm" title="Edit"> <i class="bi bi-pencil"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="showDeleteConfirm(' . $data->id . ')">
                    <i class="bi bi-trash"></i>
                    </button>';
                })
                ->rawColumns(['status', 'action'])
                ->make();
        }
        return view('backend.layouts.version.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:blog_categories',
        ]);

        try {
            Version::create([
                'name' => $request->name,

            ]);

            return response()->json([
                'success' => true,
                'message' => 'Version created successfully!',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $data = Version::find($id);

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $version = Version::find($request->id);
        if ($version) {
            $version->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Version updated successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Version not found!'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            Version::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Version deleted successfully!'
            ]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function status(int $id)
    {
        $data = Version::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        }
    }
}
