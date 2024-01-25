<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featured_product = Product::where('trending', '1')->take(15)->get();
        $treding_category = Category::where('popular', '1')->take(15)->get();
        return view('frontend.index', compact('featured_product', 'treding_category'));
    }

    public function category()
    {
        $category = Category::where('status', '0')->get();
        return view('frontend.category', compact('category'));
    }

    public function view_category($slug)
    {
        if(Category::where('slug', $slug)->exists()){
            $category = Category::where('slug', $slug)->first();
            $product = Product::where('category_id', $category->id)->where('status', '0')->get();
            return view('frontend.product.index', compact('category', 'product'));
        } 
        else{
            return redirect('/')->with('status', 'Slug does not exist');
        }
        
    }

    public function view_product($category_slug, $product_slug)
    {
        if(Category::where('slug', $category_slug)->exists()){
            if(Product::where('slug', $product_slug)->exists()){
                $product = Product::where('slug', $product_slug)->first();
                return view('frontend.product.view', compact('product'));
            }
        }
        else{
            return redirect('/')->with('status', 'None of that category found');
        }
    }

}
