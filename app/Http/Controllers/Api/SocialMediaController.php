<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    use ApiResponse;
    public function socialMedia()
    {
        try {
            $socialMedia = SocialMedia::all();
            return $this->success($socialMedia, 'All Social Media List', 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }
}
