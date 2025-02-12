<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\AvailableBalance;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Version;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the dynamic pages.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = Product::all();
            if (!empty($request->input('search.value'))) {
                $searchTerm = $request->input('search.value');
                $data->where('page_title', 'LIKE', "%$searchTerm%");
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($data) {
                    return $data->category->name;
                })

                // ->addColumn('version_name', function ($data) {
                //     return $data->version->name;
                // })


                // ->addColumn('available_balance', function ($data) {
                //     return $data->availableBalance->balance;
                // })
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
                    return ' <a href="' . route('admin.product.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white btn-sm" title="Edit">
                              <i class="bi bi-pencil"></i>
                              </a>
                              <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="showDeleteConfirm(' . $data->id . ')">
                              <i class="bi bi-trash"></i>
                              </button>';
                })
                ->rawColumns(['category_name',  'status', 'action'])
                ->make();
        }

        return view('backend.layouts.product.index');
    }

    /**
     * Show the form for creating a new dynamic page.
     *
     * @return View|RedirectResponse
     */
    public function create(): View | RedirectResponse
    {
        if (User::find(auth()->user()->id)) {
            $categories = Category::all();
            $versions = Version::all();
            $availableBalance = AvailableBalance::all();
            return view('backend.layouts.product.create', compact('categories', 'versions', 'availableBalance'));
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Store a newly created dynamic page in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'version_id' => 'nullable|array',
                'version_id.*' => 'exists:versions,id',
                'available_balance_id' => 'nullable|array',
                'available_balance_id.*' => 'exists:available_balances,id',
                'usage' => 'required|string',
                'delivery_time' => 'required|string',
                'stock' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3080',
            ]);

            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uploadImage($image, 'products');
            }

            $data = new Product();
            $data->category_id = $request->category_id;
            $data->usage = $request->usage;
            $data->delivery_time = $request->delivery_time;
            $data->stock = $request->stock;
            $data->image = $imageName;
            $data->save();

            if ($request->has('version_id')) {
                $data->versions()->attach($request->input('version_id'));
            }

            if ($request->has('available_balance_id')) {
                $data->availableBalance()->attach($request->input('available_balance_id'));
            }


            return redirect()->back()->with('t-success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('t-error', 'Error: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified dynamic page.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function edit(int $id): View | RedirectResponse
    {
        if (User::find(auth()->user()->id)) {
            $data = Product::with('versions', 'availableBalance')->findOrFail($id);
            $categories = Category::all();
            $versions = Version::all();
            $availableBalance = AvailableBalance::all();
            return view('backend.layouts.product.edit', compact('data', 'categories', 'versions', 'availableBalance'));
        }
        return redirect()->route('admin.product.index');
    }


    /**
     * Update the specified dynamic page in the database.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */


    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'version_id' => 'nullable|array',
            'version_id.*' => 'exists:versions,id',
            'available_balance_id' => 'nullable|array',
            'available_balance_id.*' => 'exists:available_balances,id',
            'usage' => 'nullable|string',
            'delivery_time' => 'nullable|string',
            'stock' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3080',
        ]);

        $product = Product::find($id);
        if ($request->hasFile('image')) {
            if ($product->image) {
                $previousImagePath = public_path($product->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = uploadImage($image, 'products');
        } else {

            $imageName = $product->image;
        }


        try {
            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->usage = $request->usage;
            $product->delivery_time = $request->delivery_time;
            $product->stock = $request->stock;
            $product->image = $imageName;
            $product->save();

            if ($request->has('version_id')) {
                $product->versions()->sync($request->input('version_id'));
            }


            if ($request->has('available_balance_id')) {
                $product->availableBalance()->sync($request->input('available_balance_id'));
            }

            return redirect()->back()->with('t-success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Change the status of the specified dynamic page.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Product::findOrFail($id);
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

    public function destroy(int $id): JsonResponse
    {
        $page = Product::findOrFail($id);
        $page->delete();
        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}