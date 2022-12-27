<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Models\NavigationItems;
use File;
use Illuminate\Support\Str;

class NavigationController extends Controller
{
   /* protected $controllerName;
    public function __construct(){
        $this->controllerName = "navigations";
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav_category = null)
    {
        $navigations  = Navigation::where('nav_category',$nav_category)->where('parent_page_id',0)->orderBy('position','ASC')->get();
        return view('admin.navigation.navigation_list', compact('navigations','nav_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category)
    {
        $request_segment = \Request::segment(4);
        if(intval($request_segment) == 0){
            $request_segment = \Request::segment(3);
            $current_max_position = Navigation::where('nav_category',$request_segment)->max('position');
        }else{
            $current_max_position = Navigation::where('parent_page_id',$request_segment)->max('position');
            $category .= '/'.$request_segment;
        }

        $next_position = $current_max_position + 1;
        $categories = Navigation::where('page_type','group')->where('nav_category', $category)->get();

        return view('admin.navigation.navigation_create',compact('category','next_position','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $nav_category)
    {
        $this->validate($request,[
            'nav_name' => 'required|min:2',
            'caption' => 'required',
            'icon_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'

        ]);

        $data = $request->all();
        //dd($data);
        $data['nav_category'] = $nav_category;
        $request_segment = \Request::segment(4);
        $parent_id = intval($request_segment);

        $data['alias'] = $this->createSlug($data['nav_name']);

        $data['parent_page_id'] = $parent_id;
        $parent_id = ($parent_id == '')?'':'/'.$parent_id;

        if($request->hasFile('icon_image')){
            $img_file = $request->file('icon_image');
            $data['icon_image'] = time().'_'.$img_file->getClientOriginalName();
            $destinationPath = public_path('uploads/icon_image');
            $img_file->move($destinationPath,$data['icon_image']);


        }
        if($request->hasFile('featured_image')){
            $img_file = $request->file('featured_image');
            $data['featured_image'] = time().'_'.$img_file->getClientOriginalName();
            $destinationPath = public_path('uploads/featured_image');
            $img_file->move($destinationPath,$data['featured_image']);
        }

       /* $file = $request->file('img_file');
        if($request->hasFile('img_file'))
        {
            if ($request->file('img_file')->isValid()) {
                $width = '170'; $height = '120';
                $data['icon_image'] = image_upload($file, $this->controllerName, $width, $height);
            }
        }*/

        if($request->hasFile('banner_image')){
            $banner_file = $request->file('banner_image');
            $data['banner_image'] = time().'_'.$banner_file->getClientOriginalName();
            $destinationPath = public_path('uploads/banner_image');
            $banner_file->move($destinationPath,$data['banner_image']);
        }

        if($request->hasFile('attachment')){
            $attachment_file = $request->file('attachment');
            $data['attachment'] = time().'_'.$attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/attachment');
            $attachment_file->move($destinationPath,$data['attachment']);
        }

        if($request->hasFile('main_attachment')){
            $attachment_file = $request->file('main_attachment');
            $data['main_attachment'] = time().'_'.$attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/main_attachment');
            $attachment_file->move($destinationPath,$data['main_attachment']);
        }

        $navigation = Navigation::create($data);

        /*if($request->hasFile('pg_file')){
            $orders = $request->input('pg_sort');
            $captions = $request->input('pg_content');
            $names = $request->input('pg_name');
            $files = $request->file('pg_file');

            foreach($files as $index => $image){
              $filename = time().'_'.$image->getClientOriginalName();
              $image->move(public_path('uploads/photo gallery'),$filename);

              $photo = NavigationItems::create([ 
                'sort'=>$orders[$index],
                'name'=>$names[$index],
                'content'=>$captions[$index],
                'file'=>$filename,
                'navigation_id'=>$navigation->id
                    ]);  
            }
        }*/


        return redirect('admin/navigation-list/'.$nav_category.$parent_id)->with('success','Data Added Succssfully!!');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nav_category, $id)
    {
        $navigation = Navigation::find($id);
        $categories = Navigation::where('page_type','group')->where('nav_category', $nav_category)->get();
        return view('admin.navigation.navigation_edit', compact('navigation','nav_category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nav_category, $id)
    {
        $this->validate($request,[
            'nav_name' => 'required|min:3',
            'caption' => 'required',
            'icon_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            
        ]);
        $request->offsetUnset('_token');
        $request->offsetUnset('_method');

        $data = $request->all();
//        $parent_id = get_parent($id);
        $navigation = Navigation::find($id);
        $parent_id = (intval($navigation->parent_page_id) == 0)?'':'/'.intval($navigation->parent_page_id);
//        $navigation = Navigation::find($id);

        if($request->hasFile('icon_image')){
            if(file_exists(public_path('uploads/icon_image').'/'.$navigation->icon_image)){
                File::delete('uploads/icon_image/'.$navigation->icon_image);
            }
            $icon_image = $request->file('icon_image');
            $data['icon_image'] = time().'_'.$icon_image->getClientOriginalName();
            $destinationPath = public_path('uploads/icon_image');
            $icon_image->move($destinationPath,$data['icon_image']);
        }

        if($request->hasFile('featured_image')){
            if(file_exists(public_path('uploads/featured_image').'/'.$navigation->icon_image)){
                File::delete('uploads/featured_image/'.$navigation->icon_image);
            }
            $icon_image = $request->file('featured_image');
            $data['featured_image'] = time().'_'.$icon_image->getClientOriginalName();
            $destinationPath = public_path('uploads/featured_image');
            $icon_image->move($destinationPath,$data['featured_image']);
        }

         if($request->hasFile('banner_image')){
            if(file_exists(public_path('uploads/banner_image').'/'.$navigation->banner_image)){
                File::delete('uploads/banner_image/'.$navigation->banner_image);
            }
            $banner_image = $request->file('banner_image');
            $data['banner_image'] = time().'_'.$banner_image->getClientOriginalName();
            $destinationPath = public_path('uploads/banner_image');
            $banner_image->move($destinationPath,$data['banner_image']);
        }
        
        if($request->hasFile('attachment')){
            if(file_exists(public_path('uploads/attachment').'/'.$navigation->attachment)){
                File::delete('uploads/attachment/'.$navigation->attachment);
            }

            $attachment_file = $request->file('attachment');
            $data['attachment'] = time().'_'.$attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/attachment');
            $attachment_file->move($destinationPath,$data['attachment']);
        }

        if($request->hasFile('main_attachment')){
            if(file_exists(public_path('uploads/main_attachment').'/'.$navigation->attachment)){
                File::delete('uploads/main_attachment/'.$navigation->attachment);
            }

            $attachment_file = $request->file('main_attachment');
            $data['main_attachment'] = time().'_'.$attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/main_attachment');
            $attachment_file->move($destinationPath,$data['main_attachment']);
        }

        Navigation::where('id',$id)->update($data);

        $navigationItems = NavigationItems::all();

        NavigationItems::where('navigation_id',$id)->update(['navigation_id'=>$id]);

        return redirect('/admin/navigation-list/'.$nav_category . $parent_id )->with('success','Data Updated Successfully!!');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nav_category,$id)
    {
        $navigation = Navigation::find($id);
        $parent_id = (intval($navigation->parent_page_id) == 0)?'':'/'.intval($navigation->parent_page_id);

        if(file_exists(public_path('uploads/icon_image/'.$navigation->icon_image))){
            File::delete(public_path('uploads/icon_image/'.$navigation->icon_image));
        }

        if(file_exists(public_path('uploads/featured_image/'.$navigation->featured_image))){
            File::delete(public_path('uploads/featured_image/'.$navigation->featured_image));
        }

        if(file_exists(public_path('uploads/banner_image/'.$navigation->banner_image))){
            File::delete(public_path('uploads/banner_image/'.$navigation->banner_image));
        }
        
        if(file_exists(public_path('uploads/attachment/'.$navigation->attachment))){
            File::delete(public_path('uploads/attachment/'.$navigation->attachment));
        }

        if(file_exists(public_path('uploads/main_attachment/'.$navigation->main_attachment))){
            File::delete(public_path('uploads/main_attachment/'.$navigation->main_attachment));
        }


        $navigation->delete($id);
        return redirect('admin/navigation-list/'.$nav_category.$parent_id)->with('success','Data Deleted Succssfully!!');
    }
    
    public function deleteIconImage($nav_category,$id){
        $icons = Navigation::where('id',$id)->where('icon_image','like','%_%')->first();
        $image = $icons->icon_image;
        File::delete(public_path('uploads/icon_image/'.$image));
        $icons->update(['icon_image'=>null]);
        return redirect()->back();
    }

    public function deleteFeaturedImage($nav_category,$id){
        $icons = Navigation::where('id',$id)->where('featured_image','like','%_%')->first();
        $image = $icons->featured_image;
        File::delete(public_path('uploads/featured_image/'.$image));
        $icons->update(['featured_image'=>null]);
        return redirect()->back();
    }

    public function deleteBannerImage($nav_category,$id){
        $bannerimage = Navigation::where('id',$id)->where('banner_image','like','%_%')->first();
        $image = $bannerimage->banner_image;
        File::delete(public_path('uploads/banner_image/'.$image));
        $bannerimage->update(['banner_image'=>null]);
        return redirect()->back();
    }

    public function deletemainattachment($nav_category,$id){
        $mainattachment = Navigation::where('id',$id)->where('main_attachment','like','%_%')->first();
        $image = $mainattachment->main_attachment;
        File::delete(public_path('uploads/main_attachment/'.$image));
        $mainattachment->update(['main_attachment'=>null]);
        return redirect()->back();
    }

    public function deleteattachment($nav_category,$id){
        $attachment = Navigation::where('id',$id)->where('attachment','like','%_%')->first();
        $image = $attachment->attachment;
        File::delete(public_path('uploads/attachment/'.$image));
        $attachment->update(['attachment'=>null]);
        return redirect()->back();
    }


    public function childNavigation($nav_category,$parent_id){
        $navigations = Navigation::where('nav_category',$nav_category)->where('parent_page_id',$parent_id)->get();
        return view('admin.navigation.navigation_list', compact('navigations','nav_category'));

    }


    /*Photo gallery*/

    public function showMediaList($nav_category=null,$id){
        $medias = NavigationItems::where('navigation_id',$id)->paginate(10);
        return view('admin.gallery.photo_gallery_list',compact('nav_category','medias'));
    }

    public function addMedia($category,$id){
        return view('admin.gallery.add_photo_gallery',compact('category','id'));      
    }

    public function storeAlbum(Request $request,$nav_category){
        $this->validate($request,[
            'pg_file'=>'required'
        ]);
       $data = $request->all();
       $data['nav_category'] = $nav_category;

       $request_segment = \Request::segment(4);
       $parent_id = intval($request_segment);
       $data['parent_page_id'] = $parent_id;
       $parent_id = ($parent_id == '')?'':'/'.$parent_id;

       if($request->hasFile('pg_file')){
        $orders = $request->input('pg_sort');
        $names = $request->input('pg_name');
        $names_nepali = $request->input('pg_name_nepali');
        $link = $request->input('pg_link');
        $contents = $request->input('pg_caption');
        $contents_nepali = $request->input('pg_caption_nepali');
        $files = $request->file('pg_file');


        foreach($files as $index=>$image){
            $filename = time().'_'.$image->getClientOriginalName();
            $destinationPath = public_path('uploads/photo_gallery');
            $image->move($destinationPath, $filename);
            $media = NavigationItems::create([
                                            'navigation_id'=>$request->id,
                                            'sort'=>$orders[$index],
                                            'file'=>$filename,
                                            'name'=>$names[$index],
                                            'name_nepali'=>$names_nepali[$index],
                                            'link'=>$link[$index],
                                            'content'=>$contents[$index],
                                            'content_nepali'=>$contents_nepali[$index]
                                        
        ]);       
         }
       }

       return redirect('admin/navigation-list/'.$data['nav_category']. $parent_id."/showList")->with('success','Media Added Successfully!!');

           
    }

    public function updateMedia(Request $request, $id){
       
       $request->offsetUnset('_token'); // Confirmed _token field is gone.
       $request->offsetUnset('_method'); // Confirmed _mothod field is gone.
         
      $data = $request->all();
       $media = NavigationItems::find($id);

       if($request->hasFile('file')){
        if(file_exists(public_path('uploads/photo_gallery').'/'.$media->file)){
            unlink('uploads/photo_gallery/'.$media->file);

        }
        
        $filename = $request->file('file');
        $data['file'] = time().'_'.$request->file('file')->getClientOriginalName();
        $destinationPath = public_path('uploads/photo_gallery');
        $filename->move($destinationPath,$data['file']);
       }
     
        NavigationItems::where('id',$id)->update($data);
       return redirect()->back()->with('success', 'Media Updated'); 
    }

    public function deleteMedia($id){
        $media = NavigationItems::find($id);
        if(null == $media){
            abort (404);
        }
        if(!$media->delete()){
            abort(500);
        }

        return redirect()->back()->with('success','Media Deleted Successfully!!');
    }


    public function update_status(Request $request, $id){

       $data['page_status'] = $request->page_status;
       Navigation::where('id', $id)->update($data);
     }

    public function createSlug($title, $id = 0)
    {

        $alias = Str::slug($title, '-');
        $allAlias = $this->getRelatedSlugs($alias, $id);


        if (!$allAlias->contains('alias', $alias)) {
            return $alias;
        }



        $i = 1;
        $is_contain = true;
        do {
            $newAlias = $alias . '-' . $i;
            if (!$allAlias->contains('alias', $newAlias)) {
                $is_contain = false;
                return $newAlias;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($alias, $id = 0)
    {
        return Navigation::select('alias')->where('alias', 'like', $alias . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
