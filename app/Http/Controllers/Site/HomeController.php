<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Brand;
use App\Models\Messages;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();
        $facebook = Setting::select('facebook')->first();
        $twitter = Setting::select('twitter')->first();
        $instagram = Setting::select('instagram')->first();
        $youtube = Setting::select('youtube')->first();
        // dd($facebook);
        $productsMen =
            Product::with(['brand', 'category', 'tags'])
            ->whereHas('category', function ($query) use ($categories) {
                $query->where('name', 'mens');
            })->paginate(3);
        $productsWomen =
            Product::with(['brand', 'category', 'tags'])
            ->whereHas('category', function ($query) use ($categories) {
                $query->where('name', 'womens');
            })->paginate(3);
        return view('site.pages.home', compact('categories', 'brands', 'tags', 'productsMen', 'productsWomen','facebook','youtube','instagram','twitter'));

    }

    public function inCorrectRole()
    {
        return view('site.pages.forbidden');
    }
    public function NotFoundPage()
    {
        return view('site.pages.notFound');
    }
    public function contact()
    {
        return view('site.pages.contact');
    }

    public function sendMessage(ContactRequest $request)
    {
        $date = $request->validated();
        Messages::create($date);
        return redirect()->route('site.contact')->with('success', 'Your message has been sent successfully');
    }
}
