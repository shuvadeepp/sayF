<?php

/* * ******************************************
  File Name     : blogController.php
  Description   : Controller file for managing all the blog
  Created By    : Sandeep Kumar Senapati
  Created On    : 28-Apr-2021

  ======================================================================
  |Update History                                                      |
  ======================================================================
  |<Updated by>                 |<Updated On> |<Remarks>
  ----------------------------------------------------------------------
  |Name Goes Here               |DD-MMM-YYYY  |Remark goes here
  ----------------------------------------------------------------------
  |                             |             |
  ----------------------------------------------------------------------

 * ****************************************** */

namespace App\Http\Controllers\Application\Master;

use App\Http\Controllers\AppController;
use App\Models\BlogModel;
use Session;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Storage;

class BlogController extends AppController {
  public function index(){
      if(!empty(request()->all()) && request()->isMethod('post')) {
       
      $requestData = request()->all();  
      $Ids = $requestData['hdnIDs'];
      if(!empty($Ids)){
        $IdsArr = explode(',', $Ids);
      }
      if(request('hdnAction')=='D'){
        if(!empty($IdsArr)){
          BlogModel::whereIn('blogId',$IdsArr)->update(['deletedflag' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record deleted successfully');
        }       
      } 
      if(request('hdnAction')=='P'){
        if(!empty($IdsArr)){
          BlogModel::whereIn('blogId',$IdsArr)->update(['publishStatus' => 0,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
      if(request('hdnAction')=='UP'){
        if(!empty($IdsArr)){
          BlogModel::whereIn('blogId',$IdsArr)->update(['publishStatus' => 1,'updatedBy' => session('admin_session_data.userId')]);
          request()->session()->flash('success', 'Record updated successfully');
        }       
      }
    }
    $isViewAll   = (request('hdn_IsViewAll')!='' || request('hdn_IsViewAll')>0)?request('hdn_IsViewAll'):1;
    $arrResQuery=BlogModel::where([['deletedflag',0]]);
    
    if($isViewAll==2){
        $arrResQuery=$arrResQuery->get();
      }elseif($isViewAll==1){
        $arrResQuery=$arrResQuery->paginate(TOTPAGINATE);
      } 
      
    $this->viewVars['startrec']  = $isViewAll; 
    $this->viewVars['arrAllRecords'] = $arrResQuery;

    if(request('hidIds') > 0){
        $bId=request('hidIds');
        BlogModel::where('blogId', $bId)
                ->update([
                    'deletedFlag'=>1,
                    'updatedOn' => now()
                ]);
            request()->session()->flash('success', 'Record deleted successfully');                  
            return redirect::to('application/master/blog');
    }
    return view('application.master.viewBlog',$this->viewVars);
  }

  /*Function for add and edit education*/
  public function add($blogId){
    $blogId=($blogId)?decrypt($blogId):0;
    $this->viewVars['buttonVal'] = ($blogId > 0)?'Update Blog':'Add Blog';
    $redirectUrl     = ($blogId)?'application/master/blog/add/'.encrypt($blogId):'application/master/blog/add';

    $BlogModel = new BlogModel();
    $this->viewVars['editDetails'] = '';
    if($blogId>0){
      $editDetails = BlogModel::find($blogId)->toArray();
      $this->viewVars['editDetails'] = $editDetails;
    }
    if(!empty(request()->all()) && request()->isMethod('post')) {
      $requestData = request()->all();  
      // echo'<pre>';print_r($requestData);exit;
      $validator   = \Validator::make($requestData, [
                  'txtTitle'      => 'bail|required|max:100',
                  'txtSlug'       => 'bail|required',
                  'txtBlogDate'   => 'bail|required',
                  'txtPostby'     => 'bail|required',
                  'txtReadTime'   => 'bail|required',
                  'thumbImage'     => 'image|mimes:jpg,png,jpeg|max:1024|required_without:hdnthumbImage',
                  'blogImage'     => 'image|mimes:jpg,png,jpeg|max:1024|required_without:hdnBlogImage',
                  'blogDetails'   => 'bail|required',
                      ], 
                      ['txtTitle.required'            => 'Title Name is required',
                        'txtSlug.required'            => 'Slug is required',                            
                        'txtBlogDate.required'        => 'Publish date is required',                            
                        'txtPostby.required'          => 'Posted by is required', 
                        'txtReadTime.required'        => 'Estimated read time is required', 
                        'thumbImage.required_without' => 'Thumbnail Image is required', 
                        'thumbImage.mimes'            => 'Thumbnail Image should be jpg,png,jpeg',
                        'thumbImage.max'              => 'Thumbnail Image should not be more than 1 mb',
                        'blogImage.required_without'  => 'Image is required', 
                        'blogImage.mimes'             => 'Image should be jpg,png,jpeg',
                        'blogImage.max'               => 'Image should not be more than 1 mb',                         
                        'blogDetails.required'        => 'Blog details is required',                            
      ]);
      if ($validator->fails()) {
            return redirect($redirectUrl)->withErrors($validator)->withInput();
        } else {
          /*Update Record*/
          if($blogId > 0){
            $chkDup = BlogModel::where([['blogTitle', $requestData['txtTitle']], ['blogId','!=',$blogId], ['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
                $hdnBlogImage=$requestData['hdnBlogImage'];  
                // echo'<pre>';print_r($hdnBlogImage);exit; 
                $image       = request()->file('blogImage');
                if($image) {
                    if($hdnBlogImage && $image->getClientOriginalName()!='') 
                    {
                        @unlink('storage/app/uploads/blog/'.$hdnBlogImage);
                    }
                    $image       = request()->file('blogImage');
                    $newFlName                  = 'blog'.time().'.'.$image->getClientOriginalExtension();
                    request()->file('blogImage')->move('storage/app/uploads/blog/',$newFlName);
                }else{
                    $newFlName=$hdnBlogImage;
                }
                /* ::::: Thumbnail Image Dt: 4-11-2023 By:Shuvadeep Podder ::::: */
                $hdnthumbImage = $requestData['hdnthumbImage'];  
                $thumbImage       = request()->file('thumbImage');
                if($thumbImage) {
                    if($hdnthumbImage && $thumbImage->getClientOriginalName()!='') 
                    {
                        @unlink('storage/app/uploads/thumbnail/'.$hdnthumbImage);
                    }
                    $thumbImage       = request()->file('thumbImage');
                    $newThumbName                  = 'thumbnail'.time().'.'.$thumbImage->getClientOriginalExtension();
                    // request()->file('blogImage')->move('storage/app/uploads/thumbnail/',$newFlName);

                    $destinationPath      = "storage/app/uploads/thumbnail/";
                    $thumbImg = request()->file('thumbImage')->move($destinationPath, $newThumbName);
                }else{
                    $newThumbName=$hdnthumbImage;
                }
                /* ::::: Thumbnail Image END ::::: */

                BlogModel::where('blogId', $blogId)
                ->update([
                    'blogTitle'           => $requestData['txtTitle'],
                    'blogSlug'            => $requestData['txtSlug'],
                    'blogImage'           => $newFlName,
                    'thumbnail_Image'     => $newThumbName,
                    'blogDetails'         => htmlspecialchars($requestData['blogDetails'],ENT_QUOTES),
                    'publishDate'         => date('Y-m-d H:i:s', strtotime($requestData['txtBlogDate'])),
                    'intReadTime'         => $requestData['txtReadTime'],
                    'postedBy'            => $requestData['txtPostby'],
                    'updatedBy'           => session('admin_session_data.userId'),
                    'updatedOn'           => now(),
                ]);

              request()->session()->flash('success', 'Record updated successfully');
            }
          }
          /*Insert Record*/
          else{
            $chkDup = BlogModel::where([['blogTitle', $requestData['txtTitle']],['deletedflag','=',0]])->first();
            if($chkDup){
              request()->session()->flash('error', 'Duplicate record exist');
            }else{
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $blogPath  = $storagePath.'uploads/blog';
                if(!file_exists($blogPath)){
                    \mkdir($blogPath, 0755);
                }
                $image       = request()->file('blogImage');
                $newFlName                  = 'blog'.time().'.'.$image->getClientOriginalExtension();

                /* ::::: Thumbnail Image Dt: 4-11-2023 By:Shuvadeep Podder ::::: */
                $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                $thumbPath    = $storagePath.'uploads/thumbnail';
                // echo'<pre>';print_r($thumbPath);exit; 
                if(!file_exists($thumbPath)){
                    \mkdir($thumbPath, 0755);
                }
                $thumbnailImage       = request()->file('thumbImage');
                $newThumbName         = 'thumbImage'.time().'.'.$thumbnailImage->getClientOriginalExtension();
                $destinationPath      = "storage/app/uploads/thumbnail/";
                $thumbImg = request()->file('thumbImage')->move($destinationPath, $newThumbName);
                // echo'<pre>';print_r($thumbImg);exit; 
                /* ::::: Thumbnail Image END ::::: */
  
                if(request()->file('blogImage')->move('storage/app/uploads/blog/',$newFlName)) 
                {
                  $BlogModel->blogTitle           = $requestData['txtTitle'];
                  $BlogModel->blogSlug            = $requestData['txtSlug'];
                  $BlogModel->thumbnail_Image     = $newThumbName;
                  $BlogModel->blogImage           = $newFlName;
                  $BlogModel->blogDetails         = htmlspecialchars($requestData['blogDetails'],ENT_QUOTES);
                  $BlogModel->publishDate         = date('Y-m-d H:i:s', strtotime($requestData['txtBlogDate']));
                  $BlogModel->intReadTime         = $requestData['txtReadTime'];
                  $BlogModel->postedBy            = $requestData['txtPostby'];
                  $BlogModel->createdBy           = session('admin_session_data.userId');
                  $BlogModel->save();              
                }
              request()->session()->flash('success', 'Record added successfully');
            }
            
          }          
          return redirect::to('application/master/blog');
        }
    }

    return view('application.master.addBlog',$this->viewVars);
  }

 
}
