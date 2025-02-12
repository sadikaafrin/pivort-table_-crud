<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enum\Page;
use App\Models\Cms;
use App\Enum\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OurProcessController extends Controller
{
    public function index()
    {
        $process1 = Cms::where('page_name', Page::ABOUT_US->value)->where('section_name', Section::PROCESS_1->value)->first();
        $process2 = Cms::where('page_name', Page::ABOUT_US->value)->where('section_name', Section::PROCESS_2->value)->first();
        $process3 = Cms::where('page_name', Page::ABOUT_US->value)->where('section_name', Section::PROCESS_3->value)->first();
        $processFinal = Cms::where('page_name', Page::ABOUT_US->value)->where('section_name', Section::PROCESS_FINAL->value)->first();
        return view('backend.layouts.about-us.our-process.index', compact('process1', 'process2', 'process3', 'processFinal'));
    }

    public function process1(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::PROCESS_1->value,
            ],
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::PROCESS_1->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Our process 1 updated successfully.');
    }

    public function process2(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::PROCESS_2->value,
            ],
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::PROCESS_2->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Our process 1 updated successfully.');
    }

    public function process3(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::PROCESS_3->value,
            ],
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::PROCESS_3->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Our process 3 updated successfully.');
    }

    public function processFinal(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Cms::updateOrCreate(
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::WORKS_STEP_4->value,
            ],
            [
                'page_name' => Page::ABOUT_US->value,
                'section_name' => Section::PROCESS_FINAL->value,
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->with('t-success', 'Our process final updated successfully.');
    }
}
