<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            if (!empty($request->input('search.value'))) {
                $searchTerm = $request->input('search.value');
                $data->where('title', 'LIKE', "%$searchTerm%");
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function ($data) {
                    $description       = $data->description;
                    $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;
                    return '<p>' . $short_description . '</p>';
                })
                ->addColumn('image', function ($data) {
                    $url = asset($data->image);
                    $image       = "<img src='$url' width='50' height='50'>";
                    return $image;
                })
                ->addColumn('created_at', function ($data) {
                    return date('M d, Y', strtotime($data->created_at));
                })
                ->addColumn('category_name', function ($data) {
                    return $data->blog_category->name;
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
                    return ' <a href="' . route('admin.blogs.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white btn-sm" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="showDeleteConfirm(' . $data->id . ')">
                              <i class="bi bi-trash"></i>
                              </button>';
                })
                ->rawColumns(['description', 'status', 'action','image','category_name','created_at'])
                ->make();
        }
        return view('backend.layouts.blog.index');
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 'active')->get();
        return view('backend.layouts.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3080',
            'blog_category_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uploadImage($image, 'blogs');
        }

        try{
            $data = new Blog();
            $data->user_id = auth()->user()->id;
            $data->title = $request->title;
            $data->slug = Str::slug($request->title);
            $data->description = $request->description;
            $data->image = $imageName;
            $data->blog_category_id = $request->blog_category_id;
            $data->save();
        }catch(\Exception $e){
            return redirect()->back()->with('t-error', $e->getMessage());
        }
        return redirect()->route('admin.blogs.index')->with('t-success', 'Blog created successfully');
    }

    public function edit($id)
    {
        $data = Blog::find($id);
        $categories = BlogCategory::where('status', 'active')->get();
        return view('backend.layouts.blog.edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'blog_category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3080',
        ]);

        $data = Blog::find($id);

        if ($request->hasFile('image')) {

            if($data->image){
                $previousImagePath = public_path($data->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = uploadImage($image, 'blogs');

        }else{

            $imageName = $data->image;

        }

        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->description = $request->description;
        $data->blog_category_id = $request->blog_category_id;
        $data->image = $imageName;
        $data->save();

        return redirect()->route('admin.blogs.index')->with('t-success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        $data = Blog::find($id);
        if($data->image){
            $previousImagePath = public_path($data->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully!'
        ]);
    }

    public function status($id)
    {
        $data = Blog::findOrFail($id);
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
