<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Helpers\FrontendHelper;
use App\Helpers\ProductHelper;
use App\Mail\InquiryMailer;
use App\Models\Catalogue;
use App\Models\GlobalSetting;
use App\Models\Navigation;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Cart;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(FrontendHelper $frontendHelper, CategoryHelper $categoryHelper, ProductHelper $productHelper )
    {
        $settings = GlobalSetting::where('id', 1)->first();
        $sliders = Navigation::where('page_type', 'Slider')->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('code','ASC')->get();

        $featured_products = Product::where('featured_products', 1)->get();
        $latest_products = Product::orderBy('id', 'desc')->get();
        $popular_products = Product::where('popular_product', '1')->get();
        $hot_deals = Product::where('hot_deal', '1')->get();
        $names = Product::pluck('name');

        $carts  = Cart::content();



        return view('website.index', [
            'product_Helper' => $productHelper,
            'frontend_helper' => $frontendHelper,
            'category_Helper' => $categoryHelper,
            'settings' => $settings,
            'sliders' => $sliders,
            'menus' => $menus,
            'categories' => $categories,
            'featured_products' => $featured_products,
            'latest_products' => $latest_products,
            'popular_products' => $popular_products,
            'hot_deals' => $hot_deals,
            'carts' => $carts,
            'names' => $names,
        ]);
    }

    public function home(FrontendHelper $frontendHelper, CategoryHelper $categoryHelper, ProductHelper $productHelper )
    {
        // $password = Hash::make('Admin123');
        // $user = Admin::all();
        // $u = $user->first();
        // $u->email = "md@gmail.com";
        // $u->password = $password;
        // $u->save();
        // return $u;
        
        // $password = Hash::make('Admin1234');
        // $user = User::all();
        // $u = $user->first();
        // $u->email = "md@gmail.com";
        // $u->password = $password;
        // $u->save();
        // return $u;
        
        $settings = GlobalSetting::where('id', 1)->first();
        $sliders = Navigation::where('page_type', 'Slider')->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $names = Product::pluck('name');

        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();

        $featured_products = Product::where('featured_products', 1)->get();
        $latest_products = Product::orderBy('id', 'desc')->get();
        $popular_products = Product::where('popular_product', '1')->get();
        $hot_deals = Product::where('hot_deal', '1')->get();
        $carts  = Cart::content();
//Recently viewed -- setting up session variable
        Session::put('recentlyViewedProductIds');

        return view('website.home-new', [
            'product_Helper' => $productHelper,
            'frontend_helper' => $frontendHelper,
            'category_Helper' => $categoryHelper,
            'settings' => $settings,
            'sliders' => $sliders,
            'menus' => $menus,
            'categories' => $categories,
            'featured_products' => $featured_products,
            'latest_products' => $latest_products,
            'popular_products' => $popular_products,
            'hot_deals' => $hot_deals,
            'carts' => $carts,
            'names' => $names,
        ]);
    }

    public function getPages($alias, FrontendHelper $frontendHelper)
    {

        $settings = GlobalSetting::where('id', 1)->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $names = Product::pluck('name');
        $model = Navigation::where('alias', $alias)->first();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();
        $carts  = Cart::content();
        $view = 'website.pages.inner-page';
        if($model->id ==3)
        {
            return redirect()->route('website.home');
        }

        if($model->id ==6)
        {
            $view = 'website.pages.catalogue';
        }

        return view($view, [
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,
            'model' => $model,
            'categories' => $categories,
            'carts' => $carts,
            'names' => $names,
        ]);
    }

    public function getCatalogue(FrontendHelper $frontendHelper,$id)
    {


        $model = Navigation::where('id', $id)->first();


        $settings = GlobalSetting::where('id', 1)->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $catalogues = Navigation::where('parent_page_id',$id )->get();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();
        $carts  = Cart::content();


        return view('website.pages.catalogue-detail', [
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,
            'catalogues' => $catalogues,
            'categories' => $categories,
            'model' => $model,
            'carts' => $carts,
        ]);
    }

    public function getInnerPageDetails($slug, FrontendHelper $frontendHelper,ProductHelper $productHelper)
    {
        $product = Product::where('slug', $slug)->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $names = Product::pluck('name');

        $settings = GlobalSetting::where('id', 1)->first();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();
        $carts  = Cart::content();


        /*------------ Recently viewed trips start ---------------*/
        Session::push('recentlyViewedProductIds',$product->id); //adding id
        $notDuplicate = array_unique( Session::get('recentlyViewedProductIds')); //removing duplicate
        Session::put('recentlyViewedProductIds',$notDuplicate);
        //shifting old id if there is more than 5 trips
        if (count(Session::get('recentlyViewedProductIds')) > 5) {
            $newArray = array_slice(Session::get('recentlyViewedProductIds'), -5);
            Session::put('recentlyViewedProductIds',$newArray);
        }
        /*------------ Recently viewed trips ends ---------------*/

        return view('website.pages.detail', [
            'product' => $product,
            'menus' => $menus,
            'settings' => $settings,
            'frontend_helper' => $frontendHelper,
            'categories' => $categories,
            'carts' => $carts,
            'productHelper' => $productHelper,
            'names' => $names,
        ]);
    }

    public function getCategoryPages($slug, FrontendHelper $frontendHelper)
    {
        $settings = GlobalSetting::where('id', 1)->first();
        $carts  = Cart::content();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $categorySlug = ProductCategory::where('slug', $slug)->first();
        $names = Product::pluck('name');

        // $products = Product::where('category_id', $categorySlug->id)->get();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();

        $categoryIds = ProductCategory::where('parent_id', $parentId = ProductCategory::where('id', $categorySlug->id)
            ->value('id'))
            ->pluck('id')
            ->push($parentId)
            ->all();

       $products = Product::whereIn('category_id', $categoryIds)->orderBy('code', 'desc')->paginate(20);


        return view('website.category.inner-page', [
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,
            'model' => $categorySlug,
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
            'names' => $names,
        ]);
    }

    public function getProducts( FrontendHelper $frontendHelper)
    {
        $settings = GlobalSetting::where('id', 1)->first();
        $carts  = Cart::content();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
       // $categorySlug = ProductCategory::where('slug', $slug)->first();
        $names = Product::pluck('name');

        // $products = Product::where('category_id', $categorySlug->id)->get();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();

        $products = Product::orderBy('id','DESC')->paginate(20);


        return view('website.product.inner-page', [
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,

            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
            'names' => $names,
        ]);
    }

    public function inquiryRequest($slug, Request $request)
    {
        try {
            $data = $request->all();

            $product = Product::where('slug', $slug)->first();
            $data['product'] = $product->name;
            //Mail::to('maansi.chaudhary3@gmail.com')->send(new InquiryMailer($data));

        } catch (\Throwable $e) {

            return redirect()->back()->with('error', 'There is Error while sending Mail');
        }
        return redirect()->back()->with('success', 'Your request has been sent successfully. You will soon be notified.');
    }

    /*public function viewPdfFile($id)
    {
        $catalogue = Catalogue::findOrFail($id);
        $file = public_path('uploads/catalogue/') . $catalogue->file;
        if (file_exists($file))
        {
            $headers = [
                'Content-Type' => 'application/pdf'
            ];
            return response()->download($file, $catalogue->slug, $headers,'inline');
        }
        else
        {
            abort(404, 'File not found!');
        }
    }*/

    public function getContactPage(FrontendHelper $frontendHelper)
    {
        $settings = GlobalSetting::where('id', 1)->first();
        $carts  = Cart::content();
        $names = Product::pluck('name');
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();
        return view('website.contact-us', [
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,
            'categories' => $categories,
            'carts' => $carts,
            'names' => $names,
        ]);
    }


    public function searchProducts(Request $request ,FrontendHelper $frontendHelper)
    {

        $keywords  = $request->q ;
        $product =Product::where ( 'name', 'LIKE', '%' . $keywords . '%' ) ->paginate(20);
        $names = Product::pluck('name');


        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $settings = GlobalSetting::where('id', 1)->first();
        $categories = ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();
        $carts  = Cart::content();
        if (count ( $product ) > 0)
            return view ( 'website.pages.search',[
                'products' => $product,
                'settings' => $settings,
                'menus' => $menus,
                'categories' => $categories,
                'frontend_helper' => $frontendHelper,
                'carts' => $carts,
                'names' => $names,
                'keywords' => $keywords,
            ] );
        else
        {
            return redirect()->back()->with('messsage', 'No Details found. Try to search again !' );
        }
    }




    /*public function selectSearch(Request $request)
    {
        $products = [];
        if($request->has('q')){
            $search = $request->q;
            $products =Product::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }

         return response()->json($products);
    }*/
}
