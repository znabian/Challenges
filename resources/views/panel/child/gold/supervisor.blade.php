@extends('layouts.goldchall')
@section('style')
<style>
    

        #content
        {
            color: #535353;            
            max-height: 100vh;
            /* height: 88vh; */
            padding: 4vw;
        }
        .card {
            background: #fdfdfd;
            border-radius: 25px;
            border: unset;
            /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
            /* border: 1px solid #edc587; */
            color: #616161;
            /* padding: 10px; */
            font-weight: bolder;
            font-family: 'PEYDA-BLACK';
            box-shadow: -3px 0px 7px -3px #c2c2c2, 5px 5px 10px -3px #c2c2c2;
            /* margin-bottom: 30px; */
            max-height: 170px;
            /* width: 45%; */
        }
        .noinfo
        {
            background: #fff;
            border-radius: 25px;
            border: unset;
            /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
           
            color: #616161;
            padding: 8%;
            font-weight: bolder;
            font-family: 'PEYDA-BLACK';
            box-shadow: -3px 0px 7px -3px #c2c2c2, 5px 5px 10px -3px #c2c2c2;
            margin-top: 20%;
        }
        .btn-master
        {
            background: linear-gradient(to left, #00a73b, #00a73b);
            border: 1px solid #fff;
            border-radius: 15px;
            color: #fff;
            padding: 7px;
            width: 28%;
            /* font-size: 15pt!important; */
            box-shadow: 5px 5px 8px -5px #a79f9f;
            font-size: 9pt;

        }
        .btngold {
                background: linear-gradient(180deg,#c4b071, #E9D491, #E9D491, #BCA96C);
                outline: 2px solid #C2BB78;
                border: 0;
                padding: 7px;
                font-size: 9pt;
            }
                .logo
                {
                    height: 15vh;
                    width: 15vh;
                    box-shadow: 0 0 5px 1px #191b41; 
                }
                .circle
                {
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    background-color: #b5b5b5;
                    color: #fff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 15px;
                    font-family: 'Vazir';

                }
                .status {
                border-radius: 50%;
                background-color: #b5b5b5;
                color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size:13px;   
                border: none;
                font-weight: bolder;
                width: 20px;
                height: 20px;
            }
            i.status.fa-close
            {                
                /* color: #ffa1a3; */
                /* background-color: #727272!important; */
                background-color: #E91E63!important;
            }
            i.status.fa-check
            {                
                /* color: #9effc2; */
                background-color: #38a274!important;
            }
            i.status .fa-exclamation
            {                
                /* color: #e9dd3d; */
            }
    </style>
    <style>
          @media (max-width: 488px)
            {
                .hmobile
                {
                height: 75vh;
                }
            }
         /* @media (max-width: 488px)
            { */
                
                .logo
                {
                    height: 17vh!important;
                    width: 100%!important;
                }
                .content-center
                {
                    width: 22vw!important;
                    margin: auto;
                }
                .card {
                   
                    padding: unset!important;
                font-size: 10pt!important;
                } 
                .btn-master {
                    /* width: 40px!important; */
                    /* font-size: 12pt!important; */
                    /* margin-left: 1px!important; */
                    /* margin-top: 6px; */
                }
        /* } */
        .imgicon {
            width: 15rem;
            height: 10rem;
            margin: 0 auto;
        }
        .subtitle
        {
            color: #8f8f8f;
            font-family:Peyda;
            font-size: 6pt;
            font-weight: 100;
        }
        .title
        {
            color: #676767;
            font-size: 9pt; 
            /* line-height:0 !important; */
            font-family: 'PEYDA';
        }
      
        #content
        {
            /* background-image: url("{{asset('img/home/side.png')}}");
            background-size: 121px;
            background-repeat: no-repeat;
            background-position: left; */
            padding: 0!important;
            background-attachment:fixed;
        }
        .circleImg {
                width: 73px;
                height: 73px;
                border-radius: 50%;
                background-color: #ffffff;
                color: #fff;
                position: absolute;
                top: 13px;
                right: 4px;
            }
        @media (min-width: 760px)
        {
            #content
            {
                background-size: 101px!important;
                background-attachment:scroll!important;
                width: 100%;
            }
            #content2
            {
                height: 93% !important;
            }

                        
            ::-webkit-scrollbar {  
                width: 5px; /* Width of the scrollbar */  
            }  

            ::-webkit-scrollbar-track {  
                background: transparent; /* Background of the scrollbar track */  
            }  

            ::-webkit-scrollbar-thumb {  
                background: #bebebe; /* Color of the scrollbar thumb */  
                border-radius: 10px; /* Rounded corners for the thumb */  
            }  

            ::-webkit-scrollbar-thumb:hover {  
                background: #9e9e9e; /* Color of the thumb on hover */  
            }  
        }
        #content
        {
            background-image: url("{{asset('img/child/home/back.png')}}");
            background-color: #f6f6f6;
            background-blend-mode: darken;
        }
        body
        {
            background-color: #f6f6f6;
        }
        .content2
        {
            height:unset!important;
        }
        .card-body
        {
            padding: 9px;
        }
    </style>
@endsection
@section('backUrl') 
{{route('gold.landing')}}
@endsection
@section('content')  

<div id="content2" class="content2 " >       
    <div class="col-md-9 h-auto m-auto my-5 pt-3 py-2 rounded-4 text-center" style="background-color: #ffffff8c;border: 4px double #75757533;">
        <p>اطلاعات ناظر خودت رو وارد کن</p>
    </div>     
    <div class="py-2 col-md-9 h-auto justify-content-center m-auto pt-3 rounded-4 shadow" style="background-color: #ffffff8c;border: 1px solid #75757533;">
        <form action="{{route('gold.supervisor.set')}}" id="frm" method="POST">
            @csrf
            <div class="col-12 mt-2 p-3 row " id="frmSupervisor" >
               <div class="col-6">
                 <label for="" class="form-label">نام ناظر</label>
                 <input type="text" name="Name"  value="{{old('Name')??($mysubject['Name']??'')}}" class="form-control" onkeypress="noNumber(event)">
               </div>
               <div class="col-6">
                 <label for="" class="form-label">نام خانوادگی ناظر</label>
                 <input type="text" name="Family"  value="{{old('Family')??($mysubject['Family']??'')}}" class="form-control" onkeypress="noNumber(event)">
               </div>
               <div class="col-6">
                 <label for="" class="form-label">سن ناظر</label>
                 <input type="number" id="agesup"  min="18" max="99" name="Age"  value="{{old('Age')??($mysubject['Age']??'')}}" class="form-control">
               </div>
               <div class="col-6">
                 <label for="" class="form-label">نسبت ناظر</label>
                 <input type="text" name="Relation"  value="{{old('Relation')??($mysubject['Relation']??'')}}" class="form-control" onkeypress="noNumber(event)">
                </div>
                <div class="col-12">
                 <label for="" class="form-label">شماره تماس ناظر</label>
                 <input type="number" id="phonesup" name="Phone" value="{{old('Phone')??($mysubject['Phone']??'')}}" class="form-control">
               </div>
               <div class="col-12 pt-3 text-start">
                <span class="p-2 rounded-3 text-light btngold c-pointer" onclick="frmsubmit(this)">ثبت اطلاعات
                    <i class="px-2 fa fa-arrow-left" id="faicon"></i>
                </span>
               </div>
            </div>
        </form>

    </div>
</div>
      
@endsection
@section('script')  
<script>
    function noNumber(event) {  
            const charCode = event.which ? event.which : event.keyCode;  
            // اگر کاراکتر وارد شده عدد باشد (0-9)  
            if (charCode >= 48 && charCode <= 57) {  
                event.preventDefault(); // جلوگیری از وارد کردن عدد  
            }  
        }  
function frmsubmit(obj)
{
    obj.disabled=true;
    var flag=false;
    frmSupervisor.querySelectorAll('input').forEach(elm => {
        if(!elm.value.trim())
        flag=true;
    });
    if(flag)
    {
        Swal.fire({
                        icon: 'error',
                        title: 'خطا',                        
                        confirmButtonText: 'بله',
                        //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                        html:"{{session('User')->Name}} عزیز \n تمامی فیلد ها رو تکمیل کن",

                    });
        obj.disabled=false;

        return 0;
    }
    if(agesup.value<18 )
    {
        Swal.fire({
                        icon: 'error',
                        title: 'خطا',                        
                        confirmButtonText: 'بله',
                        //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                        html:"{{session('User')->Name}} عزیز \n ناظر باید بالای 18 سال سن داشته باشه",

                    });
        obj.disabled=false;

        return 0;
    }
    if(phonesup.value.length<11 )
    {
        Swal.fire({
                        icon: 'error',
                        title: 'خطا',                        
                        confirmButtonText: 'بله',
                        //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                        html:"{{session('User')->Name}} عزیز \n شماره تماس ناظر رو بدرستی وارد کن",

                    });
        obj.disabled=false;

        return 0;
    }

    /*Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });*/
              faicon.classList.remove('fa-arrow-left');
              faicon.classList.add('fa-spinner');
              frm.submit();
}
</script>   
@endsection