@extends('layouts.childApp')
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
        #chatBox {
            background: #F7F7F7;
            height: 64vh; 
		  /* height: 75vh;*/
            overflow-y: auto;
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
    height: 154px;
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
<h6  class="mb-2 text-center" style="cursor: pointer;font-size: 9pt"></h6> 
@endsection
@section('content')
  <div class="row mt-2" id="chatBox">
    
    
    @foreach ($items as $item)
        @if ($item != '.' && $item != '..')
            @if (is_dir($directoryPath . '/' . $item))
            <div class="col-4">
              <div class="btn d-grid" onclick="location.href='{{route('cloud.file.show',[$item])}}'">
                <i class="fa-5x fa fa-folder text-primary"></i>
                <span>{{$item}}</span>
              </div>

            </div>                
            @else
            <div class="col-12">
              <div class="btn d-flex" onclick="location.href='/cloud/{{session('User')->Id . '/' . $item}}'">
                <div class="col-4">
                <i class="fa-5x fa fa-file text-primary"></i>
                </div>
                <span class="bg-dark-subtle col p-3 rtl text-end">{{$item}}</span>
              </div>
            </div>
            @endif
        @endif
    @endforeach
    <div id="newfolderIcon" class="d-flex justify-content-center position-relative">
      <button class="bg-secondary-subtle bottom-0 btn circle p-5 position-fixed text-primary" onclick="newfolder.show()">
        <i class="fa fa-2x fa-folder-plus"></i></button>
    </div>
    
   
    
  </div>
   

<dialog id="newfolder" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">گروه جدید</h6>
    <button class="btn btn-close " id="fileprev_del" onclick="newfolder.close()"></button>
  </div>
  <div class="box-footer mt-2">
    <input type="text" name="" id="folder_name"  class=" form-control" style="font-size: 9pt;border-radius: 10px;resize: none;" placeholder="عنوان گروه"/>
    <button class="btn btn-primary mt-2 pull-left"  onclick="createFolder(this)" >ایجاد</button>
  </div>
</dialog>
<form action="" id="frm3">@csrf</form>
@endsection
@section('script')
<script>
chatBox.addEventListener("contextmenu", function(event) {
  event.preventDefault();
});
 
 function createFolder(btn)
 {
  if(!folder_name.value)
  folder_name.focus();
  else
  {
    var upformData = new FormData(document.getElementById('frm3'));
  btn.disabled=true;     
  upformData.append('Title', folder_name.value);       
  Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });     
  axios.post('{{route("cloud.folder.new")}}', upformData).then(response => { 
            
            document.querySelector('#newfolderIcon').remove();
            chatBox.innerHTML+=response.data.data;
             btn.disabled=false;folder_name.value='';
             newfolder.close();Swal.close();
          })
        .catch(error => {
             btn.disabled=false;  
            console.log(error);
            Swal.fire({
                title:"خطا",
                html:'اسمی که وارد کردی تکراریه',
                icon:'error',
                confirmButtonText:'باشه'
              });
          });
  }
  
}
</script>
@endsection