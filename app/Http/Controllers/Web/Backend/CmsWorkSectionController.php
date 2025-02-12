<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enum\Page;
use App\Models\Cms;
use App\Enum\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsWorkSectionController extends Controller
{
    public function index()
    {
        $step1 = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::WORKS_STEP_1->value)->first();
        $step2 = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::WORKS_STEP_2->value)->first();
        $step3 = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::WORKS_STEP_3->value)->first();
        $step4 = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::WORKS_STEP_4->value)->first();
        return view('backend.layouts.cms.work-section.index', compact('step1', 'step2', 'step3', 'step4'));
    }

    public function step1(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_1->value,
            ],
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_1->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Work step 1 updated successfully.');
    }

    public function step2(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_2->value,
            ],
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_2->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Work step 1 updated successfully.');
    }

    public function step3(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_3->value,
            ],
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_3->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Work step 3 updated successfully.');
    }

    public function step4(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_4->value,
            ],
            [
                'page_name' => Page::HOME->value,
                'section_name' => Section::WORKS_STEP_4->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Work step 4 updated successfully.');
    }
}
