@extends('layouts.app')
@section('style')
    <style>
        #content
        {
            color: #fff;
            background-image: url("{{asset('img/home/back.png')}}");
            background-attachment: fixed;
            background-size: contain;
            background-repeat: repeat-y;
            /* background-repeat: no-repeat; */
            background-position: center;
            height: 100vh;
            /* height: 88vh; */
            padding: 4vw;
        }
        .datechat
        {
          font-size: 9pt;
          text-align: center;
         color: #97b4f1;
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
            border-color: #fff!important;
            box-shadow: unset!important;
        }
        #msgtxt::placeholder
        {
            color: #95a9b4;
            padding-top: 5px;

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
          background-color: #7C80AB;
          /* border:2px solid #7C80AB; */
          color: #fff;
           float:right;
           border-radius:15px 0 15px 15px;
           margin: 5px;
           padding: 6px;
           font-size: 8pt;
        }
        .number
        {
           font-size: 6pt;          
        }
        .sendbox
        {
          margin-top: 11px;
          /* border-top: 1px solid; */
          padding: 10px;
          /* display: inline-flex; */
          justify-content: center;
        }
        .resiver p,.sender p
        {
          font-family: "Peyda";
        }
        .resiver
        {
          background-color: #7178c6;
          color: #fff;
           float:left;
           border-radius:0 15px 15px 15px;
           margin: 5px;
           padding: 6px;
           font-size: 8pt;
        }
        .chatcard
        {
          align-items: center;
          display: inline-flex;
          flex-direction: row-reverse;
        }
    </style>
@endsection
@section('content')
<h6 class="mb-3 text-center" style="font-size: 14pt">{{$chall->Chall->Title}}</h6> 

  <div class="col-md-12 " id="chatBox" style="overflow: auto;height: 56vh;">
    @php
        $chats=$chall->Chat->MSG()->orderBy('Date')->get();
        $pre=0;
    @endphp
    @foreach($chats->groupBy(function($chats) {
      return date('Y-m-d',strtotime($chats->Date));
      }) as $date => $messages)
      @if(jdate($date)->format('Y-m-d')!=jdate()->format('Y-m-d'))
     <h6 class="datechat" >{{jdate($date)->format('d F')}}</h6>
     @else
     <h6 class="datechat" >امروز</h6>
     @endif
     @php
      if(jdate($date)->format('Y-m-d')!=jdate()->format('Y-m-d'))
         $dates[]=jdate($date)->format('d F');
         else
         $dates[]='امروز';
     @endphp
      @foreach($messages as $msg)
        <div class="col-md-12 d-flex @if(auth()->user()->Id!=$msg->Sender) flex-row-reverse @endif " >
            {{-- <div class="" style="text-align: left;"> --}}
              <img src="{{ asset('img/user.png') }}" class="img-circle @if($pre==$msg->Sender) opacity-0 @endif" alt="User Image">                          
            {{-- </div> --}}
            <div class=" @if(auth()->user()->Id==$msg->Sender) sender @else resiver @endif col-md-6 col-6 row">            
              <div class="col-md-12 text-right" style="word-break: break-word;">
                @if($pre!=$msg->Sender) 
                <b>{{$msg->SenderUser->FullName}}</b>
                @endif
                @if($msg->Body)
                    <p>{!!strtr($msg->Body,["\n"=>"<br>"])!!}</p>
                    @if($msg->File)
                    <button onclick="window.open('{{$msg->File}}','_blank')" class="pull-left fa fa-download btn "> </button>
                    @endif
                @else
                <div class="d-flex gap-1" style="cursor: pointer;word-break: break-word;padding: 10px;" onclick="window.open('{{$msg->File}}','_blank')">
                  <i class=" fa fa-2x fa-file fa-regular"></i>
                  <b dir="ltr" style="font-size: 5pt;">{{last(explode('/Chat/'.$chall->Id.'/'.$chall->Chat->Id.'/',$msg->File))}}</b>                
                </div>
                @endif
              </div>
              <div class="@if(auth()->user()->Id==$msg->Sender) p-0 text-right  @else text-left @endif ">
                @if(auth()->user()->Id==$msg->Sender)
                <i class="fa  @if($msg->Seen) fa-check-double px-1 text-3b407a @else fa-check @endif "></i>
                @endif
                <label class="fw-bolder number">{{jdate($msg->Date)->format('H:i:s')}}</label>
              </div>
            
            </div> 

        </div> 
        
        @php
          $pre=$msg->Sender;
        @endphp
      @endforeach
        @if(!$loop->last)
          @php
            $pre=0;
          @endphp
        @endif
    @endforeach
     
  </div> 
@if($chall->Chat->Closed)
<div class="text-center " style="">
  <p class="alert bg-2F3068">{{auth()->user()->FullName}} <br>  چت این چالش بسته شده </p>
</div>
@elseif($chall->Expired)
<div class="text-center " style="">
  <p class="alert bg-2F3068">{{auth()->user()->FullName}} <br> زمان تحویل این چالش گذشته </p>
</div>
@else
<div class="col-md-12 sendbox d-flex">
  <div class="d-flex " style="border-radius:  0px 25px 25px 0;background-color: #ffffffc2;">
  <button class="btn fa fa-paperclip" style="color:#f83673;border:none;"  onclick="fileatt.click()"></button>
  </div>
  <textarea name="" id="msgtxt" rows="2" class="col-md-9 form-control" style="background-color: #ffffffc2;font-size: 9pt;border: none;border-radius: 0; resize: none;" placeholder="متن پیام"></textarea>
  <div class="d-flex flex-row-reverse" style="border-radius: 25px 0px 0 25px;background-color: #ffffffc2;">
    <button class="fa fa-paper-plane btn "  style="color:#f83673;border:none"  onclick="sendmsg(this)"></button>
    {{-- <button class="btn  fa fa-file fa-regular" style="border: none;" onclick="fileatt.click()"></button> --}}
    <input type="file" name="" id="fileatt" onchange="showprewview(this);" class="d-none" accept=".zip, .rar, .tar, .gz,.pdf">
  </div>
</div>


@endif

<dialog id="dialogFile" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">ارسال فایل</h6>
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
    <textarea name="" id="msg2" rows="2" class="form-control" style="font-size: 9pt;border-radius: 10px;resize: none;" placeholder="متن پیام"></textarea>
    <button class="btn btn-primary mt-2 pull-left" onclick="sendmsg(this,1)">ارسال</button>
  </div>
</dialog>

<form action="" id="frm3">@csrf</form>
<audio src="{{asset('sound/chat.mp3') }}" id="chataudio" style="display: none"></audio>
@endsection
@section('script')
<script>
  $(chatBox).ready(function()
  {
    chatBox.scrollTo( chatBox.scrollHeight, chatBox.scrollHeight); 
  });
</script>
<script>
    
  var ChatId='{{$chall->Chat->Id}}';
  var uId='{{auth()->user()->Id}}';
var dates={!!json_encode($dates??[])!!};
@if(in_array(last($dates??[]),['امروز',jdate()->format('d F')]))
var preSender={{$pre}};
@else
var preSender=0;
@endif
    
   
</script>
<script>

   function showprewview(obj)
    {
        var files=obj.files;
        if(files.length)
        {       
          var fileSize = files[0].size /1024/1024; 
          if (fileSize <= 100) 
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
                confirmButtonText: 'بله',
                text:"{{auth()->user()->FullName}} \n فایل ارسالی بایستی کمتر از 100 مگ باشد"
            });
          }
        } 
        else
        document.getElementById('dialogFile').close();    
    }
    function sendmsg(obj,msgBox=0)
    {
      obj.disabled=true;
      var file=fileatt.files;
      if(msgBox)
      var msg=msg2.value;
      else
      var msg=msgtxt.value;
      msgtxt.value=msg2.value='';
      
      if(msg || file.length>0)
      {
        var upformData = new FormData(document.getElementById('frm3'));
        if(file.length)
        upformData.append('file', file[0]);
        if(msg)
        upformData.append('Body', msg);

        upformData.append('ChatId', '{{$chall->Chat->Id}}');
        upformData.append('ChallId', '{{$chall->Id}}');
        upformData.append('Resiver', '{{$chall->Chat->Resiver}}');
        upformData.append('Sender', '{{auth()->user()->Id}}');
                    
        axios.post('{{route("chat.send")}}', upformData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
        })
        .then(response => { 
          preSender=uId;
           showmessages(response.data);
            obj.disabled=false;
          })
        .catch(error => {
            obj.disabled=false;
            console.log(error);
            obj.disabled=false;
            Swal.fire({
                        icon: 'error',
                        title: 'پیام ارسال نشد',                        
                        confirmButtonText: 'بله',
                        //text:"{{auth()->user()->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                         html:"مشکلی پیش آمده است لطفا مجددا تلاش کنید<p><small> <br>  "+error.stack+"</small></p>",

                    });
         });
         
      }
      else
      {
        obj.disabled=false;msgtxt.focus();
      }
      
    }
   function showmessages(data)
   {
    if(!dates.includes(data.Date2))
    {
      var datechat=document.createElement("h6");
      datechat.textContent=data.Date2;
      datechat.classList.add("datechat");
      chatBox.appendChild(datechat);
      dates.push(data.Date2);
    }
    var div=document.createElement("div");
    div.className = "col-md-12 d-flex";
    if (uId == data.ResiverId)
     div.classList.add("flex-row-reverse");
    /*var innerDiv1 = document.createElement("div");
    innerDiv1.style.textAlign = "left";*/
    var img = document.createElement("img");
    img.src = "{{ asset('img/user.png') }}";
    img.className = "img-circle";

    if (preSender == data.SenderId)
      img.classList.add("opacity-0");

    //innerDiv1.appendChild(img);
    div.appendChild(img);
    var innerDiv2 = document.createElement("div");
    if (uId != data.ResiverId) 
      innerDiv2.className = "sender";
    else
      innerDiv2.className = "resiver";
    
    innerDiv2.classList.add("col-md-6","col-6","row");
    var innerDiv3 = document.createElement("div");
    innerDiv3.className = "col-md-12 text-right";
    innerDiv3.style.wordBreak = "break-word";
    if (preSender != data.SenderId)
     {
      var h6 = document.createElement("b");
      h6.textContent = data.Sender;
      innerDiv3.appendChild(h6);
    }
    if (data.Body) 
    {
      var p = document.createElement("p");
      p.innerHTML = data.Body.replace("\n","<br>");
      innerDiv3.appendChild(p);
      if (data.File) 
      {
        var button = document.createElement("button");
        button.className = "pull-left fa fa-download btn ";
        button.addEventListener("click",function() {
                    window.open(data.File,'_blank');
                  });
        innerDiv3.appendChild(button);
      }
    }
    else 
    {
      var div2 = document.createElement("div");
      div2.classList.add('d-flex','gap-1');
      div2.style.cursor = "pointer";
      div2.style.wordBreak = "break-word";
      div2.style.padding = "10px";
      div2.addEventListener("click",function() {
                    window.open(data.File,'_blank');
                  });
      var i = document.createElement("i");
      i.className = "fa fa-2x fa-file fa-regular";
      var b = document.createElement("b");
      b.dir = "ltr";
      b.style.fontSize= "5pt";
      b.textContent = data.File.split("{{'Chat/'.$chall->Id.'/'.$chall->Chat->Id.'/'}}")[1];
      div2.appendChild(i);
      div2.appendChild(b);
      innerDiv3.appendChild(div2);
    }
    innerDiv2.appendChild(innerDiv3);
    var innerDiv4 = document.createElement("div");
    if (uId != data.ResiverId)
      innerDiv4.className = "p-0 text-right";
    else
      innerDiv4.className = "text-left";
    
    if (uId != data.ResiverId) 
    {
      var ion = document.createElement("i");
      ion.className = "fa";
      if (data.Seen)
       {
        ion.classList.add("fa-check-double");
        ion.classList.add("px-1","text-3b407a");
      }
       else 
        ion.classList.add("fa-check");

      innerDiv4.appendChild(ion);
    }
    var label = document.createElement("label");
    label.className = "fw-bolder number";
    label.textContent = data.Time;
    innerDiv4.appendChild(label);
    innerDiv2.appendChild(innerDiv4);
    div.appendChild(innerDiv2);
    chatBox.appendChild(div);
    msgtxt.value='';
    fileprev_del.click();
    preSender=data.SenderId;
    chatBox.scrollTo( chatBox.scrollHeight, chatBox.scrollHeight);

   }
</script>
@if(!$chall->Chat->Closed)
@if(!$chall->Expired)
<script>
  const ably2 = new Ably.Realtime.Promise('900Xog.XhH1eQ:aV0Kdq_mJUTBt5KUsgQvHTdtjbUAaXHAkHvVanuuG9U');
    ably2.connection.once('connected');
  /* Rsive Message Channel*/
    var channel1 = ably2.channels.get('Challenge-Chat-Messages.'+ChatId+'_'+uId);
    channel1.subscribe('ChatMessages', function(data)
     {
      axios.post('{{route("chat.read",[$chall->Chat->Id])}}',{Resiver:'{{auth()->user()->Id}}'});      
        showmessages(JSON.parse(data.data));
        document.getElementById('chataudio').play();
                   
        
    });
    
    /*Seen Messages*/
    var channel2 = ably2.channels.get('Challenge-Chat-Seen.'+ChatId+'_'+uId);
    channel2.subscribe('ChatSeen', function(data) {          
      document.querySelectorAll('.fa-check').forEach(itm=>{
        itm.classList.remove('fa-check');
        itm.classList.add('fa-check-double','px-1','text-3b407a');
      }); 
    });

    /*Close Messages*/
    var channel3 = ably2.channels.get('Challenge-Chat-Close.'+ChatId+'_'+uId);
    channel3.subscribe('ChatClose', function(data) {          
      document.querySelectorAll('.sendbox').forEach(itm=>{
        itm.remove();
      }); 
      
      const div = document.createElement("div");
      div.classList.add("text-center");
      div.style = "";

      const p = document.createElement("p");
      p.classList.add("alert", "bg-2F3068");
      p.textContent = " چت این چالش بسته شده ";

      div.appendChild(p);
      content.appendChild(div);
    });
</script>
@endif
@endif
<script>
    const elements = document.querySelectorAll('.sender');
    elements.forEach(element => {

      element.addEventListener("contextmenu", function(event) {
        /*event.preventDefault();
        if(document.getElementById("contextMenu"))
        document.getElementById("contextMenu").remove();

        var contextMenu = document.createElement("div");
        contextMenu.classList.add("context-menu");
  
        var deleteOption = document.createElement("div");
        deleteOption.classList.add("menu-option");
        deleteOption.textContent = "حذف پیام";
  
        var copyOption = document.createElement("div");
        copyOption.classList.add("menu-option");
        copyOption.textContent = "کپی پیام";
  
  
        contextMenu.appendChild(deleteOption);
        contextMenu.appendChild(copyOption);

        contextMenu.id='contextMenu';
        contextMenu.style.position = "absolute";
        contextMenu.style.left = event.X + "px";
        contextMenu.style.top = event.Y + "px";
  
        chatBox.appendChild(contextMenu);*/
        
      });
    });
    document.addEventListener("click", function() {
      if(document.getElementById("contextMenu"))
            document.getElementById("contextMenu").remove();
    });
</script>
@endsection