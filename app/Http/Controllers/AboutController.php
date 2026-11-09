<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Index;
use App\Models\ServicesPage;

class AboutController extends Controller
{
    public function index()
    {
        $hero = About::where('key', 'hero_section')->first();
        $skills = About::where('key', 'skills')->first();
        $counters = About::where('key', 'counters')->first();
        $timeline = About::where('key', 'timeline')->first();
        $gallery = About::where('key', 'gallery')->first();
        $videoSection = About::where('key', 'video_section')->first();
        $pageBackground = About::where('key', 'page_background')->first();
        $serviceData = ServicesPage::first();
        $indexData = Index::first();

        return view('about', [
            'title'          => 'Өв Соёл ХХК - Бидний тухай',
            'activePage'     => 'about',

            // JSON decode → Array
            'heroData'       => $hero->value ?? [],
            'skillsData'     => $skills->value ?? [],
            'countersData'   => $counters->value ?? [],
            'timelineData'   => $timeline->value ?? [],
            'galleryData'    => $gallery->value ?? [],
            'videoSection'   => $videoSection->value ?? [],
            'pageBackground' => $pageBackground->value ?? [],
            'serviceData'    => $serviceData,
            'teamData'       => $indexData,
        ]);
    }
}
