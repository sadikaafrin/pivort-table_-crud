<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enum\Page;
use App\Enum\Section;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsWhatWeOfferController extends Controller
{
    public function index()
    {
        $custom_package = Cms::where('page_name', Page::What_WE_Offer->value)->where('section_name', Section::CUSTOM_PACKAGE->value)->first();
        $stock_option = Cms::where('page_name', Page::What_WE_Offer->value)->where('section_name', Section::STOCK_OPTION->value)->first();
        $sustainable_choice = Cms::where('page_name', Page::What_WE_Offer->value)->where('section_name', Section::SUSTAINABLE_CHOICE->value)->first();
        return view('backend.layouts.cms.offer-section.index', compact('custom_package', 'stock_option', 'sustainable_choice'));
    }

    public function customPackage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image_url'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $what_we_offer = Cms::where('page_name', Page::What_WE_Offer->value)->where('section_name', Section::CUSTOM_PACKAGE->value)->first();


        if ($request->hasFile('image_url')) {
            if ($what_we_offer->image_url) {
                $image_path = public_path($what_we_offer->image_url);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/what-we-offer');
        } else {
            $imageName = $what_we_offer->image_url;
        }

        Cms::updateOrCreate(
            [
                'page_name' => Page::What_WE_Offer->value,
                'section_name' => Section::CUSTOM_PACKAGE->value,
            ],
            [
                'page_name' => Page::What_WE_Offer->value,
                'section_name' => Section::CUSTOM_PACKAGE->value,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'image_url' => $imageName
            ]
        );

        return redirect()->back()->with('t-success', 'Custom package updated successfully.');
    }

    // public function stockOption(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required',
    //     ]);

    //     Cms::updateOrCreate(
    //         [
    //             'page_name' => Page::HOME->value,
    //             'section_name' => Section::WORKS_STEP_2->value,
    //         ],
    //         [
    //             'page_name' => Page::HOME->value,
    //             'section_name' => Section::WORKS_STEP_2->value,
    //             'title' => $request->title,
    //             'description' => $request->description,
    //         ]
    //     );

    //     return redirect()->back()->with('t-success', 'Work step 1 updated successfully.');
    // }

    // public function stockOption(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required',
    //     ]);

    //     Cms::updateOrCreate(
    //         [
    //             'page_name' => Page::HOME->value,
    //             'section_name' => Section::WORKS_STEP_3->value,
    //         ],
    //         [
    //             'page_name' => Page::HOME->value,
    //             'section_name' => Section::WORKS_STEP_3->value,
    //             'title' => $request->title,
    //             'description' => $request->description,
    //         ]
    //     );

    //     return redirect()->back()->with('t-success', 'Work step 3 updated successfully.');
    // }


}