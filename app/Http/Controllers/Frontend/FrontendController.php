<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Blog;
use App\Model\Category;
use App\Model\Tags;
use App\Model\Contact;
use App\Model\Page;
use App\Model\Gallery;
use App\Model\GalleryImages;
use URL;
use App\Model\Slideshow;
use App\Model\ClientData;
use App\Model\InfoBox;
use App\Model\SubCategory;
use App\Model\Teams;
use App\SettingGeneral;
use Illuminate\Support\Facades\Redirect;

class FrontendController extends Controller
{
    private $controller = 'frontend';
    public function index(Request $request)
    {
        // echo "For Frond End";

        $tulisan_berjalan = SettingGeneral::where('name','title_marquee')->first();
        
        $infobox = InfoBox::take(1)->first();

        return view('frontend.testing', compact(['infobox', 'tulisan_berjalan']))->with(['controller'=>$this->controller]);
    }


   public function testing(Request $request)
    {
        // echo "For Frond End";

        $tulisan_berjalan = SettingGeneral::where('name','title_marquee')->first();
        
        $infobox = InfoBox::take(1)->first();

        return view('frontend.antrian ', compact(['infobox', 'tulisan_berjalan']))->with(['controller'=>$this->controller]);
    }
}
