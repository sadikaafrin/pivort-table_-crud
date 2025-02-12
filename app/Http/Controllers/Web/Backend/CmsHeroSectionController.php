<?php

namespace App\Http\Controllers\Web\Backend;

use App\Enum\Page;
use App\Models\Cms;
use App\Enum\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsHeroSectionController extends Controller
{
    public function index()
    {
        $hero_section = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::HERO_SECTION->value)->first();
        return view('backend.layouts.cms.hero-section.index', compact('hero_section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image_url'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $hero_section = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::HERO_SECTION->value)->first();


        if ($request->hasFile('image_url')) {
            if ($hero_section->image_url) {
                $image_path = public_path($hero_section->image_url);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/hero-section');
        } else {
            $imageName = $hero_section->image_url;
        }

        try {
            CMS::updateOrCreate(
                [
                    'page_name' => Page::HOME->value,
                    'section_name' => Section::HERO_SECTION->value,
                ],
                [
                    'page_name' => Page::HOME->value,
                    'section_name' => Section::HERO_SECTION->value,
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'description' => $request->description,
                    'image_url' => $imageName
                ]
            );

            return redirect()->back()->with('t-success', 'Home Banner updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function aboutUs()
    {
        $about_us = Cms::where('page_name', Page::ABOUT_US->value)->where('section_name', Section::ABOUT_US->value)->first();
        return view('backend.layouts.cms.about-section.index', compact('about_us'));
    }

    public function aboutSectionUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image_url'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $about_us = Cms::where('page_name', Page::ABOUT_US->value)->where('section_name', Section::ABOUT_US->value)->first();


        if ($request->hasFile('image_url')) {
            if ($about_us->image_url) {
                $image_path = public_path($about_us->image_url);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/about-us-section');
        } else {
            $imageName = $about_us->image_url;
        }

        try {
            CMS::updateOrCreate(
                [
                    'page_name' => Page::ABOUT_US->value,
                    'section_name' => Section::ABOUT_US->value,
                ],
                [
                    'page_name' => Page::ABOUT_US->value,
                    'section_name' => Section::ABOUT_US->value,
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'image_url' => $imageName
                ]
            );

            return redirect()->back()->with('t-success', 'About Us Page updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ourStory()
    {
        $our_story = Cms::where('page_name', Page::OUR_STORY->value)->where('section_name', Section::OUR_STORY->value)->first();
        return view('backend.layouts.cms.our-story-section.index', compact('our_story'));
    }

    public function ourStoryUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image_url'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $out_story = Cms::where('page_name', Page::OUR_STORY->value)->where('section_name', Section::OUR_STORY->value)->first();


        if ($request->hasFile('image_url')) {
            if ($out_story->image_url) {
                $image_path = public_path($out_story->image_url);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/our-story-section');
        } else {
            $imageName = $out_story->image_url;
        }

        try {
            CMS::updateOrCreate(
                [
                    'page_name' => Page::OUR_STORY->value,
                    'section_name' => Section::OUR_STORY->value,
                ],
                [
                    'page_name' => Page::OUR_STORY->value,
                    'section_name' => Section::OUR_STORY->value,
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'image_url' => $imageName
                ]
            );

            return redirect()->back()->with('t-success', 'Our Story Page updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function ourMission()
    {
        $our_mission = Cms::where('page_name', Page::OUR_MISSION->value)->where('section_name', Section::OUR_MISSION->value)->first();
        return view('backend.layouts.cms.our-mission-section.index', compact('our_mission'));
    }

    public function ourMissionUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image_url'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $our_mission = Cms::where('page_name', Page::OUR_MISSION->value)->where('section_name', Section::OUR_MISSION->value)->first();


        if ($request->hasFile('image_url')) {
            if ($our_mission->image_url) {
                $image_path = public_path($our_mission->image_url);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/our-mission-section');
        } else {
            $imageName = $our_mission->image_url;
        }

        try {
            CMS::updateOrCreate(
                [
                    'page_name' => Page::OUR_MISSION->value,
                    'section_name' => Section::OUR_MISSION->value,
                ],
                [
                    'page_name' => Page::OUR_MISSION->value,
                    'section_name' => Section::OUR_MISSION->value,
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'image_url' => $imageName
                ]
            );

            return redirect()->back()->with('t-success', 'Our Mission Page updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function ourVision()
    {
        $our_vision = Cms::where('page_name', Page::OUR_VISION->value)->where('section_name', Section::OUR_VISION->value)->first();
        return view('backend.layouts.cms.our-vision-section.index', compact('our_vision'));
    }

    public function ourVisionUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image_url'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $our_vision = Cms::where('page_name', Page::OUR_VISION->value)->where('section_name', Section::OUR_VISION->value)->first();


        if ($request->hasFile('image_url')) {
            if ($our_vision->image_url) {
                $image_path = public_path($our_vision->image_url);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/our-vision-section');
        } else {
            $imageName = $our_vision->image_url;
        }

        try {
            CMS::updateOrCreate(
                [
                    'page_name' => Page::OUR_VISION->value,
                    'section_name' => Section::OUR_VISION->value,
                ],
                [
                    'page_name' => Page::OUR_VISION->value,
                    'section_name' => Section::OUR_VISION->value,
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'image_url' => $imageName
                ]
            );

            return redirect()->back()->with('t-success', 'Our Mission Page updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function weOffer()
    {
        $what_we_offer = Cms::where('page_name', Page::What_WE_Offer->value)->where('section_name', Section::What_WE_Offer->value)->first();
        return view('backend.layouts.cms.what-we-offer.index', compact('what_we_offer'));
    }

    public function offerUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
        ]);


        try {
            CMS::updateOrCreate(
                [
                    'page_name' => Page::What_WE_Offer->value,
                    'section_name' => Section::What_WE_Offer->value,
                ],
                [
                    'page_name' => Page::What_WE_Offer->value,
                    'section_name' => Section::What_WE_Offer->value,
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                ]
            );

            return redirect()->back()->with('t-success', 'Our Offer Page updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }





    public function whyChooseUs()
    {
        $why_choose_us = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::WHY_CHOOSE_US->value)->first();
        return view('backend.layouts.cms.why-choose-us.index', compact('why_choose_us'));
    }

    public function whyChooseUsUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $why_choose_us = Cms::where('page_name', Page::HOME->value)->where('section_name', Section::WHY_CHOOSE_US->value)->first();

        if ($request->hasFile('image_url')) {
            if ($why_choose_us->image_url) {
                $image_path = public_path($why_choose_us->image_url);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image = $request->file('image_url');
            $imageName = uploadImage($image, 'cms/why-choose-us');
        } else {
            $imageName = $why_choose_us->image_url;
        }

        try {
            CMS::updateOrCreate(
                [
                    'page_name' => Page::HOME->value,
                    'section_name' => Section::WHY_CHOOSE_US->value,
                ],
                [
                    'page_name' => Page::HOME->value,
                    'section_name' => Section::WHY_CHOOSE_US->value,
                    'title' => $request->title,
                    'description' => $request->description,
                    'image_url' => $imageName
                ]
            );

            return redirect()->back()->with('t-success', 'Why Choose Us updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    // public function searchPersonalEvent(Request $request)
    // {
    //     try {
    //         $searchEventName = $request->input('event_name');
    //         $searchStartDate = $request->input('start_date');
    //         $searchEndTime = $request->input('end_time');

    //         $events = Event::with(['invitees:id,name,image'])
    //             ->when($searchEventName, function ($query, $searchEventName) {
    //                 $query->where('event_name', 'like', '%' . $searchEventName . '%');
    //             })
    //             ->when($searchStartDate, function ($query, $searchStartDate) {
    //                 $query->where('start_date', 'like', '%' . $searchStartDate . '%');
    //             })
    //             ->when($searchEndTime, function ($query, $searchEndTime) {
    //                 $query->where('end_time', 'like', '%' . $searchEndTime . '%');
    //             })->where('visibility', 'personal')
    //             ->get();



    //         if ($events->isEmpty()) {
    //             return $this->error([], 'No events found for the search term.', 404);
    //         }

    //         return $this->success(
    //             $events,
    //             'Successfully fetched Event list'
    //         );
    //     } catch (\Exception $e) {
    //         Log::error('Error searching events: ' . $e->getMessage(), [
    //             'stack' => $e->getTraceAsString()
    //         ]);

    //         return $this->error(
    //             null,
    //             'An error occurred while searching events. Please try again later.',
    //             500
    //         );
    //     }
    // }
}