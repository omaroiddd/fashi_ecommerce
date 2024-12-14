<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $tags = Tag::all();
        $sizes = Size::all();
        $products = Product::with(['brand', 'category', 'tags','sizes'])->paginate(12);
        return view('site.pages.shop', compact('brands', 'categories','tags','products','sizes'));
    }

    public function singleProduct(Product $product)
    {
        $related_products =
        Product::whereHas('tags', function ($query) use ($product) {
            // Find products with the same tags as the current product
            $query->whereIn('tags.id', $product->tags->pluck('id'));
        })
        ->where('products.id', '!=', $product->id) // Exclude the current product
        ->get();

        return view('site.pages.single-product', compact('product', 'related_products'));
    }

    public function show($category)
    {
        // Find the category by its name or ID
        $category = Category::where('name', $category)->firstOrFail(); // or use `findOrFail` for ID

        // Fetch products associated with the category
        $products = $category->products()->paginate(12); // You can adjust the pagination as needed

        // Return the category view with the category and its products
        return view('site.pages.categories.show', compact('category', 'products'));
    }

    public function filter(Request $request)
    {
        // dd($request);
        $query = Product::query();


        if ($request->has('categories') && !empty($request->categories)) {
            $query->whereIn('category_id', $request->categories);
        }

        if ($request->has('sizes') && !empty($request->sizes)) {
            $query->whereHas('sizes', function ($q) use ($request) {
                $q->where('size_id', $request->sizes);
            });
        }

            // Filter by tag
        if ($request->has('tag') && !empty($request->tag)) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tag_name', $request->tag);
            });
        }

        if ($request->has('price_range') && !empty($request->price_range)) {
            $query->whereBetween('price', [
                $request->price_range['min'] ?? 0,
                $request->price_range['max'] ?? 1000 // default values
            ]);
        }

        if ($request->has('brands') && !empty($request->brands)) {
            $query->whereIn('brand_id', $request->brands);
        }

        $products = $query->with(['brand', 'category', 'tags','sizes'])->paginate(12);

        return response()->json([
            'data' => $products->items(),
        ]);
    }


    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:3',
        ]);

        $query = $request->input('query');
        $products = Product::where('title', 'like', "%{$query}%")
            ->select('id', 'title', 'image', 'price')  // Only return necessary columns
            ->limit(5)  // Limit results to avoid unnecessary load
            ->get();

        return response()->json($products);
    }
}
