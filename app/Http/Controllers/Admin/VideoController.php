<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NavigationVideoItems;

class VideoController extends Controller
{

     //Video gallery
    public function showVideoList($nav_category=null,$id){
        $links = NavigationVideoItems::where('navigation_id',$id)->paginate(5);
        return view('admin.gallery.video_gallery_list',compact('nav_category','links'));
    }


    public function addVideo($category,$id){
        return view('admin.gallery.add_video_gallery',compact('category','id'));
    }

    public function storeVideoAlbum(Request $request,$nav_category){
         
        $orders = $request->input('vg_sort');
        $names = $request->input('vg_name');
        $namesnepal = $request->input('vg_name_nepali');
        $vlink = $request->input('vg_link');
        $contents = $request->input('vg_content');
        $contentsnepali = $request->input('vg_content_nepali');
       

       $data['nav_category'] = $nav_category;
       $request_segment = \Request::segment(4);
       $parent_id = intval($request_segment);
       $data['parent_page_id'] = $parent_id;
       $parent_id = ($parent_id == '')?'':'/'.$parent_id;

       foreach($vlink as $index=>$link){
        $videos = NavigationVideoItems::create([
                                            'navigation_id'=>$request->id,
                                            'sort'=>$orders[$index],
                                            'link'=>$vlink[$index],
                                            'name'=>$names[$index],
                                            'name_nepali'=>$namesnepal[$index],
                                            'content'=>$contents[$index],
                                            'content_nepali'=>$contentsnepali[$index]
                                        
        ]);      
    }    
    return redirect('admin/navigation-list/'.$data['nav_category']. $parent_id."/vlink")->with('success','Links Added Successfully!!');  
    }

   public function updateLinks(Request $request, $id){
       
       $request->offsetUnset('_token'); // Confirmed _token field is gone.
       $request->offsetUnset('_method'); // Confirmed _mothod field is gone.
         
      $data = $request->all();
      NavigationVideoItems::find($id);
     
       NavigationVideoItems::where('id',$id)->update($data);
       return redirect()->back()->with('success', 'Link Updated'); 
    }



    public function deleteLink($id){
        $media = NavigationVideoItems::find($id);
        if(null == $media){
            abort (404);
        }
        if(!$media->delete()){
            abort(500);
        }

        return redirect()->back()->with('success','Links Deleted Successfully!!');
    }
}
