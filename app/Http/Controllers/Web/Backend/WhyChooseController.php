<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enum\Page;
use App\Models\Cms;
use App\Enum\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class WhyChooseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Cms::where('page_name', Page::ABOUT_US->value)->where('section_name', Section::WHY_CHOOSE_ITEMS->value)->latest()->get();
            if (!empty($request->input('search.value'))) {
                $searchTerm = $request->input('search.value');
                $data->where('title', 'LIKE', "%$searchTerm%");
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function ($data) {
                    $description       = $data->description;
                    $short_description = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                    return '<p>' . $short_description . '</p>';
                })
                ->addColumn('image', function ($data) {
                    $url = asset($data->image_url);
                    $image       = "<img src='$url' width='50' height='50'>";
                    return $image;
                })
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
                    return ' <a href="' . route('admin.cms.why_choose_items.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white btn-sm" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a> 
                              <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="showDeleteConfirm(' . $data->id . ')">
                              <i class="bi bi-trash"></i>
                              </button>';
                })
                ->rawColumns(['image', 'status', 'action','description'])
                ->make();
        }
        return view('backend.layouts.about-us.why-choose.index');
    }

    public function create()
    {
        return view('backend.layouts.about-us.why-choose.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $data = new Cms();
        $data->page_name = Page::ABOUT_US->value;
        $data->section_name = Section::WHY_CHOOSE_ITEMS->value;
        $data->title = $request->title;
        $data->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uploadImage($image, 'cms/why-choose-us');
            $data->image_url = $imageName;
        }
        $data->save();
        return redirect()->route('admin.cms.why_choose_items.index')->with('t-success', 'Why choose us updated successfully.');
    }

    public function edit($id)
    {
        $data = Cms::find($id);
        return view('backend.layouts.about-us.why-choose.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ]);

        $data = Cms::find($id);

        if ($request->hasFile('image')) {
            if ($data->image_url) {
                $previousImagePath = public_path($data->image_url);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = uploadImage($image, 'cms/why-choose-us');
            $data->image_url = $imageName;
        }else{
            $imageName = $data->image_url;
        }

        $data->page_name = Page::ABOUT_US->value;
        $data->section_name = Section::WHY_CHOOSE_ITEMS->value;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->image_url = $imageName;
        
        $data->save();
        return redirect()->route('admin.cms.why_choose_items.index')->with('t-success', 'Why choose us updated successfully.');
    }

    public function destroy($id)
    {
        $data = Cms::find($id);
        if($data->image){
            $previousImagePath = public_path($data->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully!'
        ]);
    }

    public function status($id)
    {
        $data = Cms::findOrFail($id);
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
