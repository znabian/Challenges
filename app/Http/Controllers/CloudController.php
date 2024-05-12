<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CloudController extends Controller
{
    /**
     * Display a listing of the user's folders.
     */
    private $api_token;
    public function __construct()
    {
        $this->api_token=env('API_TOKEN');
    }
    public function index()
    {
        $user=session('User');
        $directoryPath=base_path().'/../cloud/'.$user->Id;
        if(File::exists($directoryPath))
        $items = scandir($directoryPath); 
        else
        {
            mkdir($directoryPath, 0777, true); // Create the directory if it doesn't exist
            $items = scandir($directoryPath); 
        }
        sort($items);
        if(session('User')->Age<12)
        return view('panel.child.cloud.index',compact('items','directoryPath'));
        return view('panel.teenager.cloud.index',compact('items','directoryPath'));
    }
    /**
     * Display a listing of the folder's content.
     */
    public function folder_show($folder,Request $req)
    {
        $user=session('User');
        $directoryPath=base_path().'/../cloud/'.$user->Id.'/'.$folder;
        if(File::exists($directoryPath))
        {
         $items = $this->getData('select',["uid"=>$user->Id,'group'=>$folder],'myfiles',1); 
         if(session('User')->Age<12)
         return view('panel.child.cloud.list',compact('folder','items','directoryPath'));
         return view('panel.teenager.cloud.list',compact('folder','items','directoryPath'));

        }        
        else
           abort(404);
        
       
    }

    /**
     * creating a new folder.
     */
    public function create_folder(Request $req)
    {
        $user=session('User');
        $newPath=base_path().'/../cloud/'.$user->Id.'/'.$req->Title;
            $directoryPath=base_path().'/../cloud/'.$user->Id;
        if(!File::exists($newPath))
        {
            mkdir($newPath, 0777, true); 
            $out='<div class="col-4">
              <div class="btn d-grid" onclick="location.href=\''.route('cloud.file.show',[$req->Title]).'\'">
                <i class="fa-5x fa fa-folder text-primary"></i>
                <span>'.$req->Title.'</span>
              </div>

            </div>
            <div id="newfolderIcon" class="d-flex justify-content-center position-relative">
              <button class="bg-secondary-subtle bottom-0 btn circle p-5 position-fixed text-primary" onclick="newfolder.show()">
                <i class="fa fa-2x fa-folder-plus"></i></button>
            </div>';
            return response()->json(['status'=>1,'data'=>$out]);

        }
        else
        return response()->json(['status'=>0,'data'=>'','msg'=>'عنوان وارد شده تکراری است'],500);

    }
    /**
     * creating a new file.
     */
    public function create_file(Request $req)
    {
        $user=session('User');
        $uPath=base_path().'/../cloud/'.$req->UserId.'/'.$req->Group;
        if($req->hasFile('file'))
        {
                $file=$req->file('file');
                $fileName=$req->UserId . '_';
                if(Str::contains($file->getClientMimeType(),'video'))
                $fileName.='_movie__'; 
                elseif(Str::contains($file->getClientMimeType(),'image'))
                $fileName.='_image__'; 
                else
                $fileName.='_file__'; 

                $fileName.=time() ."_FirstclassCloud.{$file->getClientOriginalExtension()}";
                    if(!is_dir($uPath))
                    mkdir($uPath, 0777, true); 
                    $file->move($uPath,$fileName);
                    $path=route('home').'/cloud/'.$req->UserId.'/'.$req->Group.'/'.$fileName;
        }
        else
        return response()->json(['status'=>0],500);
        try
        {
            $files=$this->getData('update',['group'=>$req->Group,'type'=>$req->Type,'size'=>$req->Size,'title'=>$req->Title??null,'path'=>$path,"uid"=>$req->UserId],'upload',1);
            $out='';
            foreach ($files as $item)
            {
                    $out.='<div class="col-md-12">
                    <div class=" col-md-12 d-grid row rounded-4 p-3 bg-dark-subtle" >
                    <div class="">
                        <div class="videofile" id="videoDiv'.$item['Id'].'" style="background-color: #fff">
                            <img onclick="videoPlay(\''.$item['Id'].'\')" style="cursor: pointer" src="'.asset('img/details/play.png').'" alt="Image" width="70" height="70">
                        
                        </div>
                        <video controls poster="'.asset('img/Logored.png').'" class="videoplayer d-none" id="Vplayer'.$item['Id'].'" >
                        <source id="VSource'.$item['Id'].'" data-src="'.$item['Path'].'" type="video/'.explode('/',$item['Type'])[1].'">
                        </video>
                    </div>
                    <span id="caption_'.$item['Id'].'" class=" col p-3 rtl text-end">'.$item['Caption'].'</span>
                    <span class="border-top col pt-2">
                    <i class="btn fa fa-pen" onclick="editCaption('.$item['Id'].')"></i>
                    <i class="btn fa fa-cut" onclick="moveItem('.$item['Id'].')"></i>
                    <i class="btn fa fa-trash" onclick="deleteItem('.$item['Id'].')"></i>
                     </span>
                  </div>
                </div>';
                
            }
            return response()->json(['status'=>1,'data'=>$out]);

        } 
        catch (\Throwable $th) 
        {
            unlink($uPath.'/'.$fileName);
            return response()->json(['status'=>0],500);
        }
        
       

    }
    /**
     * update caption of the file.
     */
    public function caption_update(Request $req)
    {
        
        try
        {
            $files=$this->getData('update',['title'=>$req->Title??null,"id"=>$req->Id,"uid"=>$req->UserId,"group"=>$req->Group],'updateCaption',1);
            $out='';
            foreach ($files as $item)
            {
                    $out.='<div class="col-md-12">
                    <div class=" col-md-12 d-grid row rounded-4 p-3 bg-dark-subtle" >
                    <div class="">
                        <div class="videofile" id="videoDiv'.$item['Id'].'" style="background-color: #fff">
                            <img onclick="videoPlay(\''.$item['Id'].'\')" style="cursor: pointer" src="'.asset('img/details/play.png').'" alt="Image" width="70" height="70">
                        
                        </div>
                        <video controls poster="'.asset('img/Logored.png').'" class="videoplayer d-none" id="Vplayer'.$item['Id'].'" >
                        <source id="VSource'.$item['Id'].'" data-src="'.$item['Path'].'" type="video/'.explode('/',$item['Type'])[1].'">
                        </video>
                    </div>
                    <span id="caption_'.$item['Id'].'"  class=" col p-3 rtl text-end">'.$item['Caption'].'</span>
                    <span class="border-top col pt-2">
                    <i class="btn fa fa-pen" onclick="editCaption('.$item['Id'].')"></i>
                    <i class="btn fa fa-cut" onclick="moveItem('.$item['Id'].')"></i>
                    <i class="btn fa fa-trash" onclick="deleteItem('.$item['Id'].')"></i>
                     </span>
                  </div>
                </div>';
                
            }
            return response()->json(['status'=>1,'data'=>$out]);

        } 
        catch (\Throwable $th) 
        {
            
            return response()->json(['status'=>0],500);
        }
        
       

    }
    /**
     * delete the file.
     */
    public function file_delete(Request $req)
    {
        
        try
        {
            //$file=$this->getData('select',["id"=>$req->Id,"uid"=>$req->UserId,"group"=>$req->Group],'getfile',1);
            //unlink($file);
            $files=$this->getData('update',["id"=>$req->Id,"uid"=>$req->UserId,"group"=>$req->Group],'deleteFile',1);
            $out='';
            foreach ($files as $item)
            {
                    $out.='<div class="col-md-12">
                    <div class=" col-md-12 d-grid row rounded-4 p-3 bg-dark-subtle" >
                    <div class="">
                        <div class="videofile" id="videoDiv'.$item['Id'].'" style="background-color: #fff">
                            <img onclick="videoPlay(\''.$item['Id'].'\')" style="cursor: pointer" src="'.asset('img/details/play.png').'" alt="Image" width="70" height="70">
                        
                        </div>
                        <video controls poster="'.asset('img/Logored.png').'" class="videoplayer d-none" id="Vplayer'.$item['Id'].'" >
                        <source id="VSource'.$item['Id'].'" data-src="'.$item['Path'].'" type="video/'.explode('/',$item['Type'])[1].'">
                        </video>
                    </div>
                    <span id="caption_'.$item['Id'].'" class=" col p-3 rtl text-end">'.$item['Caption'].'</span>
                    <span class="border-top col pt-2">
                    <i class="btn fa fa-pen" onclick="editCaption('.$item['Id'].')"></i>
                    <i class="btn fa fa-cut" onclick="moveItem('.$item['Id'].')"></i>
                    <i class="btn fa fa-trash" onclick="deleteItem('.$item['Id'].')"></i>
                     </span>
                  </div>
                </div>';
                
            }
            return response()->json(['status'=>1,'data'=>$out]);

        } 
        catch (\Throwable $th) 
        {
            return response()->json(['status'=>0,'message'=>$th],500);
        }
        
       

    }
    /**
     * move the file.
     */
    public function file_move(Request $req)
    {
        // try
        {
            $file=$this->getData('select',["id"=>$req->Id,"uid"=>$req->UserId,"group"=>$req->Group],'getfile',1)[0];
            $path=str_replace('/'.$req->UserId.'/'.$file['Group'].'/','/'.$req->UserId.'/'.$req->Group.'/',$file['Path']);
            rename(base_path()."/../cloud/".$req->UserId."/".$file['Group']."/".basename($path),base_path()."/../cloud/".$req->UserId.'/'.$req->Group.'/'.basename($path));
            $files=$this->getData('update',["id"=>$req->Id,"uid"=>$req->UserId,"Group"=>$req->Group,"folder"=>$req->folder,"Path"=>$path],'moveFile',1);
            $out='';
            foreach ($files as $item)
            {
                    $out.='<div class="col-md-12">
                    <div class=" col-md-12 d-grid row rounded-4 p-3 bg-dark-subtle" >
                    <div class="">
                        <div class="videofile" id="videoDiv'.$item['Id'].'" style="background-color: #fff">
                            <img onclick="videoPlay(\''.$item['Id'].'\')" style="cursor: pointer" src="'.asset('img/details/play.png').'" alt="Image" width="70" height="70">
                        
                        </div>
                        <video controls poster="'.asset('img/Logored.png').'" class="videoplayer d-none" id="Vplayer'.$item['Id'].'" >
                        <source id="VSource'.$item['Id'].'" data-src="'.$item['Path'].'" type="video/'.explode('/',$item['Type'])[1].'">
                        </video>
                    </div>
                    <span id="caption_'.$item['Id'].'" class=" col p-3 rtl text-end">'.$item['Caption'].'</span>
                    <span class="border-top col pt-2">
                    <i class="btn fa fa-pen" onclick="editCaption('.$item['Id'].')"></i>
                    <i class="btn fa fa-cut" onclick="moveItem('.$item['Id'].')"></i>
                    <i class="btn fa fa-trash" onclick="deleteItem('.$item['Id'].')"></i>
                     </span>
                  </div>
                </div>';
                
            }
            return response()->json(['status'=>1,'data'=>$out]);

        } 
       /* catch (\Throwable $th) 
        {
            
            return response()->json(['status'=>0,'message'=>$th],500);
        }*/
        
       

    }

    /**
     * Store  in DB
     */
    public function getData($type,$param,$function,$sName=null)
    {
        if($type=="update")
        $url="http://185.116.161.39/API/updateApi_jwt.php";
        elseif($type=="updateinsert")
        $url="http://185.116.161.39/API/updateOrInserApi_jwt.php";
        elseif($type=="insertGetId")
        $url="http://185.116.161.39/API/insertGetIdApi_jwt.php";
        else
        $url="http://185.116.161.39/API/selectApi_jwt.php";
        switch ($function) {
            case "upload":
                    $update="INSERT INTO InterviewCloudTbl (UserId,Caption,Path,Type,Size,[Group]) VALUES (".$param['uid'].",N'".$param['title']."',N'".$param['path']."', '".$param['type']."', '".$param['size']."', N'".$param['group']."');";
                    $select=" SELECT * FROM InterviewCloudTbl  WHERE  UserId = ".$param['uid']." AND [Group] like N'".$param["group"]."' AND Active =1 ;";
                                  
                break;
            case "updateCaption":
                    $update="UPDATE InterviewCloudTbl set Caption=N'".$param["title"]."' where Id=".$param['id']." and UserId=".$param['uid'];
                    $select=" SELECT * FROM InterviewCloudTbl  WHERE  UserId = ".$param['uid']." AND [Group] like N'".$param["group"]."' AND Active =1 ;";
                                  
                break;
            case 'deleteFile':
                    $update="UPDATE InterviewCloudTbl set Active=0 where Id=".$param['id']." and UserId=".$param['uid'];
                    $select=" SELECT * FROM InterviewCloudTbl  WHERE  UserId = ".$param['uid']." AND [Group] like N'".$param["group"]."' AND Active =1 ;";
                             
                break;
            case 'moveFile':
                    $update="UPDATE InterviewCloudTbl set [Group]=N'".$param["Group"]."',Path=N'".$param["Path"]."' where Id=".$param['id']." and UserId=".$param['uid'];
                    $select=" SELECT * FROM InterviewCloudTbl  WHERE  UserId = ".$param['uid']." AND [Group] like N'".$param["folder"]."' AND Active =1 ;";
                             
                break;
            case 'myfiles':
                    $update="";
                    $select=" SELECT * FROM InterviewCloudTbl  WHERE  UserId = ".$param['uid']." AND [Group] like N'".$param["group"]."' AND Active =1 ;";
                                  
                break;
            case 'getfile':
                    $update="";
                    $select=" SELECT Path,[Group] FROM InterviewCloudTbl  WHERE  UserId = ".$param['uid']." AND Id =".$param['id']." ;";
                                  
                break;
            default:
                # code...
                break;
        }
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',           
                'api_token' => $this->api_token,
            ])->asForm()->post($url,['update' => $update,'data' => $select,'insert'=>$insert??'']);
           
            if($sName)
            {
                if($response->ok())
                {
                    $data=$response->json(); 
                    if($data['status']==200)
                    $challs=collect($data['data']); 
                    else
                    $challs=collect([]); 
                    
                }
                else
                $challs=collect([]);
                if($sName!=1)
                session([$sName=>$challs]);
                else
                return $challs;
                 

            }
            return true;
    }
}
