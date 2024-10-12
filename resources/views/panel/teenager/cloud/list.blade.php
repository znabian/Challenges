@extends('layouts.app')
@section('style')
    <style>
      .Parent
      {
        word-break: break-word;
        text-align: left;
        font-size: 7pt;
        border-radius: 11px 4px 4px 4px;
        background-color: #ffffff1c;
        padding: 5px 0px 0 0px;
        border-left: 2px solid #ffffff47;
      }
      .Parent>div
      {
        padding-top: 2px;padding-left: 12px; gap: 4px;
      }
      .replydiv
      {
        bottom: -10px;
        font-size: 8pt;
        height: 29px;
        position: absolute;
        width: 92%;
        margin-right: 13px;
        margin-block: 0px;
        z-index: 0;
        background: #f3f3f3;
        opacity: 0.5;
        border-radius: 16px 16px 0 0px;
        overflow: hidden;

      }
      .tools i
      {
        width: 23px;
        height: 23px;
        border-radius: 50%;
        background-color: #98999f8c;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 10px;
        cursor: pointer;
      }
      .tools i:hover
      {
        background-color: #98999f;
      }
      .toolsDiv
      {
        background-color: #98999f;
        color: #fff;
        font-size: 7pt;
        padding: 4px;
        border-radius: 4px;
        height: auto;
        margin: auto;
        justify-content: space-around;
        display: flex;
        width: 60px;
      }
      @media (min-width: 760px)
        {
            #content
            {
                width: 100%!important;
            }
            
        }
        #content
         {
            color: #4b4b4b;
            background-color: #F7F7F7;
            /* height: 100vh; */
            overflow: hidden;
            /* height: 88vh; */
            /* padding: 4vw; */
        }
        #chats {
            background: #F7F7F7;
            /* padding: 15px;
            border-radius: 35px;
            box-shadow: inset 0px 4px 11px -4px #b5b5b5; */
            height: 75vh;
            overflow: hidden;
        }
        #filebox {
            /* height: 45vh;
            overflow-y: auto; */
        }
        .datechat
        {
          font-size: 9pt;
          text-align: center;
         color: #41403e;
        }
      
        .circle
            {
                width: 35px;
                height: 35px;
                border-radius: 50%;
                background-color: #3e427a;
                color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 15px;
                font-family: 'Vazir';

            }
     #msgtxt:focus
        {
            outline:none!important;
            border-color: transparent!important;
            background-color: #f3f3f3!important;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9!important;
        }
        #msgtxt::placeholder
        {
            color: #95a9b4;
            padding-top: 5px;
            background-color: #f3f3f3;

        }
        .line {
            border-top: 1px solid black;
            margin-top: 12px;
            margin-bottom: 20px;
        }
        .card-body {
            display: grid;
            grid-auto-rows: max-content;
            padding: 3%;
            grid-auto-columns: max-content;
            justify-content: center;
            height: 50rem;
            border:1px solid gray;
            overflow: auto;
            background-color: white;
        }

        .img-circle {
            width: 50%;
            max-width: 10%;
            height: 100%;
        }

        .sender
        {
          background-color: #fff;
          /* border:2px solid #7C80AB; */
          color: #2d2d2d;
           float:right;
           border-radius:16px 0 16px 16px;
           margin: 5px;
           padding: 6px;
           font-size: 8pt;
        }
        .STriangle {
        /* width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #ababab;
        rotate: 314deg;
        margin-left: -12px;
        margin-top: 3px; */
        margin-left: -5px;
        margin-top: 5px;
        } 
    
        .preSender
        {
          
           border-radius:15px 0 15px 15px!important;
        }
        .number
        {
           font-size: 6pt;          
        }
        .sendbox
        {
          margin-top: 0px;
          /* border-top: 1px solid; */
          padding: 10px;
          /* display: inline-flex; */
          justify-content: center;
        }
        .sendbox textarea
        {
            background-color: #f3f3f3;
            font-size: 9pt;
            border: none;
            border-radius: 0;
            resize: none;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9;
        }
		#chatBox {
            background: #F7F7F7;
            height: 64vh;
		      /*height: 75vh;*/ 
            overflow-y: auto;
        }
        .sendbox .chatbox-rightbtn
        {
          border-radius:  0px 25px 25px 0;
          background-color: #f3f3f3;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9;
        }
        .sendbox .chatbox-leftbtn
        {
          border-radius: 25px 0px 0 25px;
          background-color: #f3f3f3;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9;
        }
        .sendbox button
        {
          color:#393939;
          border:none;
        }
        .resiver p,.sender p
        {
          font-family: "Peyda";
        }
        .senderImg
        {
          filter:grayscale(0%) sepia(10%) hue-rotate(178deg)
        }
        .resiver
        {
            background-color: #FFE4BB;
            color: #454442;
            float: left;
            border-radius: 0 16px 16px 16px;
            margin: 5px;
            padding: 6px;
            font-size: 8pt;
        }
        .RTriangle {
        /* width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #FFE4BB;
        rotate: 45deg;
        margin-right: -12px;
        margin-top: 4px; */
        margin-right: -5px;
        margin-top: 5px;
        }
        .preResiver
        {
           
            border-radius: 0 15px 15px 15px!important;
        }
        .chatcard
        {
          align-items: center;
          display: inline-flex;
          flex-direction: row-reverse;
        }
        .emoji {
          display: inline-block;
          font-size: 15pt;
          margin: 5px;
          cursor: pointer;
        }

        #emojiBox {
            width: 85%;
            height: 230px;
            border: 1px solid #d0d1df91;
            overflow-y: scroll;
            background-color: #d0d1df91;
            border-radius: 6px;
            position: relative;
            bottom:292px;
            right: 7%;
            padding: 8px;
            padding-right: 10px;
     }

     .equalizer {
      display: flex;
      justify-content: center;
      align-items: center;
      /*align-items: flex-end;
      height: 40px;
      width: 100%;
      background-color: #f2f2f2;
      padding: 20px;*/
    }
    
    .bar {
      width: 4px;
      margin: 0 5px;
      background-color: #b59f64;
    }
    .waveplayer {
    width: 100%;
    height: 50px;
    /* border: 9px solid white; */
    border-radius: 15px;
    padding: 5px;
    box-shadow: 0px 3px 5px 0px #c5c5c5;
}
.wave {
    width: 95%;
    /* height: 59px; */
    background-image: url('{{asset("img/player/wave.jpg")}}');
    background-size: 28px;
    background-position: center;
    background-repeat-y: no-repeat;
    background-blend-mode: screen;
    /* border: 9px solid white; */
    /* border-radius: 15px; */
    background-color: #fefefe94;
    position: relative;
}
.played {
    width: 0%;
    float: left;
    height: -webkit-fill-available;
    background-image: url('{{asset("img/player/wave.jpg")}}');
    background-size: 28px;
    background-position: left;
    background-repeat-y: no-repeat;
    /* border: 9px solid white; */
    /* border-radius: 15px; */
    /* background-color: red; */
}
.progress
      {
      position: absolute;
        width: 101%;
        /* margin-bottom: -40px; */
        padding: 12px;
        direction: ltr;
        opacity: 0; 
        cursor: pointer;
        top:4px;
    }
   
    .picfile {
    /* background-size: cover; */
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    height: 154px;
    background-color: #00000059;
    background-blend-mode: darken; 
    /* background-color: #4e4e4e91;
    background-blend-mode: darken; */
    width: 100%;
    border-radius: 23px;
    display: flex;
    justify-content: center;
    align-items: center;
    /* box-shadow: 0px 6px 10px -5px #1a18188f; */
}
    .videofile {
    background-repeat: no-repeat;
    background-color: #e3e3e4;
    background-image: url("{{asset('img/Logored.png')}}");
    background-size: 60%;
    background-position: center;
    background-blend-mode: darken;
    width: 100%;
    height: 190px;
    border-radius: 23px;
    display: flex;
    justify-content: center;
    align-items: center;
    /* box-shadow: 0px 6px 10px -5px #1a18188f; */
}
.videoplayer {

    margin-top: 4%;
    width: 100%;
    height: 154px;
    border-radius: 23px;
    /* box-shadow: 0px 6px 10px -5px #1a18188f; */
    object-fit: scale-down;
    background-color: #fff;
}
    </style>
@endsection
@section('title')  
    فیلم های من
@endsection
@section('subtitle')  
<h6 onclick="location.href='{{route('cloud.index')}}';" class="mb-2 text-center" style="cursor: pointer;font-size: 9pt">گروه {{$folder}}</h6> 
@endsection
@section('content')
  <div class="mt-2 mb-5 overflow-y-auto" id="chatBox">   
    
      
    
    <div class="mt-0 mx-auto col-10 d-grid gap-2" id="filebox">
      
      @foreach ($items as $item)
              <div class="col-md-12">
                <div class=" col-md-12 d-grid row rounded-4 p-3 bg-dark-subtle" >
                  <div class="">
                    <div class="videofile" id="videoDiv{{$item['Id']}}" style="background-color: #fff">
                        <img onclick="videoPlay('{{$item['Id']}}')" style="cursor: pointer" src="{{asset('img/details/play.png')}}" alt="Image" width="70" height="70">
                      
                    </div>
                    <video controls poster="{{asset('img/Logored.png')}}" class="videoplayer d-none" id="Vplayer{{$item['Id']}}" >
                      <source id="VSource{{$item['Id']}}" data-src="{{$item['Path']}}" type="video/{{explode('.',$item['Path'])[1]}}">
                    </video>
                  </div>
                  <span id="caption_{{$item['Id']}}" class=" col p-3 rtl text-end">{{$item['Caption']}}</span>
                  <span class="border-top col pt-2">
                    <i class="btn fa fa-pen" onclick="editCaption({{$item['Id']}})"></i>
                    <i class="btn fa fa-cut" onclick="moveItem({{$item['Id']}})"></i>
                    <i class="btn fa fa-trash" onclick="deleteItem({{$item['Id']}})"></i>
                  </span>
                </div>
              </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center position-relative">
      <button id="newfolderIcon" class="bg-secondary-subtle bottom-0 btn circle p-5 position-fixed text-primary" onclick="fileatt.click()" style="/*border: 2px solid; width: 60px;height: 60px;*/">
        <i class="fa fa-2x fa-file-circle-plus"></i>
      </button>
    </div>
  </div>
 <input type="file" name="" id="fileatt" onchange="showprewview(this);" class="d-none" accept="video/*">
 
   

<dialog id="helpcompress1" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">راهنمای کم حجم کردن فیلم</h6>
    <button class="btn btn-close "  onclick="helpcompress1.close()"></button>
  </div>
  <div class="box-footer mt-2">
    <p>
      1- وارد سایت <a href="https://www.compress2go.com/compress-video" target="_blank">compress2go</a> شوید و در این قسمت فیلم مورد نظر خود را بارگذاری کنید
    </p>
    <img style="width: 100%" src="{{asset('img/help/1.jpg')}}" alt="help">
    <p>
      2- پس از تکمیل بارگذاری فیلم در کادر Set file size حجم فیلم مورد نظر خود را ( بطور مثال 10) وارد کنید و روی دکمه START کلیک کنید
    </p>
    <img style="width: 100%" src="{{asset('img/help/2.jpg')}}" alt="help">
    <p>
      3- پس از تکمیل فرایند در صفحه باز شده فیلم کم حجم شده را با کلیک روی دکمه Download  ذخیره کنید
    </p>
    <img style="width: 100%" src="{{asset('img/help/3.jpg')}}" alt="help">
    
    <button class="btn btn-primary mt-2 pull-left"  onclick='window.open("https://www.compress2go.com/compress-video");window.focus();' >ورود به سایت</button>
    <button class="btn btn-danger mt-2 pull-right"  onclick='helpcompress1.close();helpcompress2.show();' >راهنمای اول</button>
  </div>
</dialog>
<dialog id="helpcompress2" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">راهنمای کم حجم کردن فیلم</h6>
    <button class="btn btn-close "  onclick="helpcompress2.close()"></button>
  </div>
  <div class="box-footer mt-2">
    <p>
      1- وارد سایت <a href="https://www.youcompress.com/" target="_blank">youcompress</a> شوید و در این قسمت فیلم مورد نظر خود را بارگذاری کنید
    </p>
    <img style="width: 100%" src="{{asset('img/help/2-1.jpg')}}" alt="help">
    <p>
      2- پس از تکمیل فرایند، فیلم کم حجم شده را با کلیک روی دکمه Download  ذخیره کنید و پس از اتمام ذخیره سازی فیلم روی دکمه Delete file from server رو کلیک کنید 
    </p>
    <img style="width: 100%" src="{{asset('img/help/2-2.jpg')}}" alt="help">
    
    <button class="btn btn-primary mt-2 pull-left"  onclick='window.open("https://www.youcompress.com");window.focus();' >ورود به سایت</button>
    <button class="btn btn-danger mt-2 pull-right"  onclick='helpcompress2.close();helpcompress1.show();' >راهنمای دوم</button>
  </div>
</dialog>
<dialog id="dialogFile" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">بارگذاری فایل</h6>
    <button class="btn btn-close " id="fileprev_del" onclick="fileatt.value='';dialogFile.close()"></button>
  </div>
  <div class="">
    <div class="bg-body-secondary d-flex p-2 p-md-4">
      <div class="m-auto d-grid">
        <span id="prevNAME" class=" small">219918-P1BLEW-593.png</span>        
         <span id="prevSIZE" class=" bold ltr number" style="font-size: 8pt">63.23 KB</span>
      </div>
    
      <div id="prevIMG" class="circle">
        <i class="fa fa-file fa-regular"></i>
      </div>
    </div>
    
  </div>
  <div class="box-footer mt-2">
    <textarea name="" id="msg2" rows="5" class=" form-control" style="font-size: 9pt;border-radius: 10px;resize: none;" placeholder="توضیحات"></textarea>
    <button class="btn btn-primary mt-2 pull-left"  onclick="sendmsg(this,1)" >بارگذاری</button>
  </div>
</dialog>
<dialog id="EditCaption" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">ویرایش توضیحات</h6>
    <button class="btn btn-close " onclick="EditCaptionid.value='';EditCaptiontxt.value='';EditCaption.close()"></button>
  </div>
  <div class="box-footer mt-2">
    <input type="hidden" id="EditCaptionid">
    <textarea name="" id="EditCaptiontxt" rows="5" class=" form-control" style="font-size: 9pt;border-radius: 10px;resize: none;" placeholder="توضیحات"></textarea>
    <button class="btn btn-primary mt-2 pull-left"  onclick="updateCaption(this)" >بروزرسانی</button>
  </div>
</dialog>
<dialog id="moveItemDialog" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">انتقال از  {{$folder}}  به</h6>
    <button class="btn btn-close " onclick="moveItemid.value='';moveItemDialog.close()"></button>
  </div>
  <div class="box-footer mt-2">
    <input type="hidden" id="moveItemid">
    @php
       $d=base_path().'/../cloud/'.session('User')->Id; 
        $folders=scandir($d);
        sort($folders);
    @endphp
  <div class="row mt-2" style="height: 15rem;overflow-y: auto;">
    @foreach ($folders as $index=>$item)
      @if ($item != '.' && $item != '..' && $item != $folder)
         @if (is_dir($d . '/' . $item))
         <div class="col-4">
           <div class="btn d-grid" onclick="document.querySelector('#moveItemfolder{{$index}}').checked=true;">
            <div class="d-flex">
            <input type="radio" class="mt-auto" id="moveItemfolder{{$index}}" name="moveItemfolder" value="{{$item}}">
            <i class="fa-2x fa fa-folder text-primary"></i>

            </div>
             <span>{{$item}}</span>
           </div>

         </div>
         @endif
      @endif
    @endforeach
  </div>
    <button class="btn btn-primary mt-2 pull-left"  onclick="moveItemto(this)" >انتقال</button>
  </div>
</dialog>

<form action="" id="frm3">@csrf</form>
@endsection
@section('script')
<script>
chatBox.addEventListener("contextmenu", function(event) {
  event.preventDefault();
});
filebox.addEventListener("contextmenu", function(event) {
  event.preventDefault();
});
 
 function editCaption(id)
 {
  EditCaptionid.value=id;
  EditCaptiontxt.value=document.getElementById('caption_'+id).innerText;
  document.getElementById('EditCaption').show(); 
}
 function moveItem(id)
 {
  moveItemid.value=id;  
  document.getElementById('moveItemDialog').show(); 
}
function updateCaption(obj)
{
  obj.disabled=true;
  obj.classList.add('disabled');
  if(EditCaptiontxt.value)
  {
    Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              }); 
    var upformData = new FormData(document.getElementById('frm3'));
   
    upformData.append('Title', EditCaptiontxt.value);
    upformData.append('Group', '{{$folder}}');
    upformData.append('UserId', '{{session('User')->Id}}');
    upformData.append('Id', EditCaptionid.value);
    axios.post('{{route("cloud.file.caption.edit")}}', upformData
    ).then(response => { 
        
        obj.disabled=false;
        obj.classList.remove('disabled');
        
        filebox.innerHTML=response.data.data;
        EditCaption.close();Swal.close();EditCaptiontxt.value='';EditCaptionid.value='';
          })
        .catch(error => {
          obj.disabled=false;
        obj.classList.remove('disabled');
            console.log(error);
            Swal.fire({
                title:"خطا",
                html:'مشکلی پیش اومده',
                icon:'error',
                confirmButtonText:'باشه'
              });
          });
        }
        else
        EditCaptiontxt.focus();
  
  
}
function deleteItem(id)
{
    Swal.fire({
                icon: 'error',
                title: 'توجه',
                text:"{{session('User')->FullName}} \n  از حذف این محتوا مطمئنی؟",            
                showDenyButton: true,
                confirmButtonText:'بله حذف شه',
                denyButtonText: 'نه'
              }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              }); 
          var upformData = new FormData(document.getElementById('frm3'));
        
          upformData.append('Group', '{{$folder}}');
          upformData.append('UserId', '{{session('User')->Id}}');
          upformData.append('Id', id);
          axios.post('{{route("cloud.file.del")}}', upformData
          ).then(response => { 
              filebox.innerHTML=response.data.data;
              Swal.fire({
                      title:"عملیات موفقیت آمیز",
                      html:'محتوا با موفقیت حذف شد',
                      icon:'success',
                      confirmButtonText:'باشه'
                    });
                })
              .catch(error => {
                  console.log(error);
                  Swal.fire({
                      title:"خطا",
                      html:'مشکلی پیش اومده',
                      icon:'error',
                      confirmButtonText:'باشه'
                    });
                });
        }
      
      });
  
  
}
function moveItemto(obj)
{
  if(document.querySelector('input[name=moveItemfolder]:checked'))
  {
    Swal.fire({
                icon: 'error',
                title: 'توجه',
                text:"{{session('User')->FullName}} \n  از انتقال این محتوا مطمئنی؟",            
                showDenyButton: true,
                confirmButtonText:'بله منتقل شه',
                denyButtonText: 'نه'
              }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              }); 
          var upformData = new FormData(document.getElementById('frm3'));
        
          upformData.append('folder', '{{$folder}}');
          upformData.append('Group', document.querySelector('input[name=moveItemfolder]:checked').value);
          upformData.append('UserId', '{{session('User')->Id}}');
          upformData.append('Id', moveItemid.value);
          axios.post('{{route("cloud.file.move")}}', upformData
          ).then(response => { 
            moveItemDialog.close();
              filebox.innerHTML=response.data.data;
              Swal.fire({
                      title:"عملیات موفقیت آمیز",
                      html:'محتوا با موفقیت منتقل شد',
                      icon:'success',
                      confirmButtonText:'باشه'
                    });
                })
              .catch(error => {
                  console.log(error);
                  Swal.fire({
                      title:"خطا",
                      html:'مشکلی پیش اومده',
                      icon:'error',
                      confirmButtonText:'باشه'
                    });
                });
        }
      
      });
  }
  else
  {
    Swal.fire({
                icon: 'error',
                title: 'توجه',
                text:"{{session('User')->FullName}} \n  یه گروه برای انتقال محتوا انتخاب کن",            
                confirmButtonText:'باشه'
                
              });
  }
    
  
  
}

function showprewview(obj)
    {
        var files=obj.files;
        if(files.length)
        {       
          var fileSize = files[0].size /1024/1024; 
          if(files[0].type.startsWith('video/'))
          {
            if (fileSize <= 10) 
            {
              document.getElementById('dialogFile').show();      
              document.getElementById('prevNAME').textContent=files[0].name; 
              var fileSizeInKB = files[0].size / 1024;
              var fileSizeInMB = fileSizeInKB / 1024;   
              if (fileSizeInMB < 1) 
              fileSize= fileSizeInKB.toFixed(2) + ' KB';
              else
              fileSize=fileSizeInMB.toFixed(2) + ' MB';
              document.getElementById('prevSIZE').textContent=fileSize;
              msg2.value=msgtxt.value;
            }
            else
            {
              document.getElementById('dialogFile').close();  
              obj.value='';fileSize = 0;
              Swal.fire({
                  icon: 'error',
                  title: 'توجه',
                  text:"{{session('User')->FullName}} \n فایل ارسالی بایستی کمتر از 10 مگ باشد . میتونی از قسمت راهنما نحوه کم حجم کردن فیلم رو آموزش ببینی",            
                  showDenyButton: true,
                  confirmButtonText:'راهنما',
                  denyButtonText: 'باشه'
                }).then((result) => {
                  if (result.isConfirmed) {
                    helpcompress2.show();
                  }
                });
            }

          }
          else
          {
            document.getElementById('dialogFile').close();  
            obj.value='';fileSize = 0;
            Swal.fire({
                icon: 'error',
                title: 'توجه',
                text:"{{session('User')->FullName}} \n فقط میتونی فیلم بارگذاری کنی",            
                confirmButtonText:'باشه',
              });
          }
        } 
        else
       fileatt.click();    
    }
function sendmsg(obj,msgBox=0)
{
  obj.disabled=true;
  obj.classList.add('disabled');
  var file=fileatt.files;
  var msg=msg2.value;
  
  if(file.length>0)
  {
    Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              }); 
    var upformData = new FormData(document.getElementById('frm3'));
    if(file.length)
    upformData.append('file', file[0]);
    if(msg)
    upformData.append('Title', msg);

    upformData.append('Group', '{{$folder}}');
    upformData.append('Size', document.getElementById('prevSIZE').textContent);
    upformData.append('Type', file[0].type);
    upformData.append('UserId', '{{session('User')->Id}}');
    
    

    axios.post('{{route("cloud.file.new")}}', upformData, {
    headers: {
        'Content-Type': 'multipart/form-data'
    }
    }).then(response => { 
        
        obj.disabled=false;
        obj.classList.remove('disabled');
        
        filebox.innerHTML=response.data.data;
        dialogFile.close();Swal.close();msg2.value='';
          })
        .catch(error => {
          obj.disabled=false;
        obj.classList.remove('disabled');
            console.log(error);
            Swal.fire({
                title:"خطا",
                html:'مشکلی پیش اومده',
                icon:'error',
                confirmButtonText:'باشه'
              });
          });
      
  }
  
}

function videoPlay(id)
  {
    document.querySelectorAll('video').forEach(itm=>{itm.pause()});
    var video = document.getElementById('Vplayer'+id);
    document.getElementById('videoDiv'+id).classList.add('d-none');
    video.classList.remove('d-none');
    if(video.readyState=== 0)
    {      
      video.src = video.children[0].getAttribute('data-src');
      video.load();
      video.play();
    }
    if (video.requestFullscreen) {
        video.requestFullscreen();
    } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen();
    } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen();
    }
    
    video.addEventListener('play', function(event) {
      video.style.objectFit='contain';
    });
    video.addEventListener('pause', function(event) {
      video.style.objectFit='cover';
    });
    video.addEventListener('end', function(event) {
      video.style.objectFit='cover';
      if (document.fullscreenElement === video ||
      document.webkitFullscreenElement === video ||
      document.mozFullscreenElement === video ||
      document.msFullscreenElement === video)
      {
        document.exitFullscreen();
        /*video.classList.add('d-none');
        document.getElementById('videoDiv'+id).classList.remove('d-none');*/
      }
      
    });
  }
</script>
@endsection