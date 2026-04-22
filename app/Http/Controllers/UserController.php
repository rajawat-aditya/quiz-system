<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\MCQ;
use App\Models\User;
use App\Models\Record;
use App\Models\MCQ_Record;
use App\Mail\verifyUser;
use App\Mail\userForgetPassword;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    //
    function welcome(){
        $category=Category::withCount('quizes')->orderBy('quizes_count','desc')->take(5)->get();
     $quizdata=Quiz::withCount('Record')->orderBy('Record_count','desc')->take(5)->get();
        return view('welcome',['categories'=>$category,'quizdata'=>$quizdata]);
    }   
    function showCategory(){
     $category=Category::withCount('quizes')->orderBy('quizes_count','desc')->paginate(2);
        return view('userShow-categories',['categories'=>$category]);
    }

    function QuizPage($id,$category){
       $quizdata=Quiz::withCount('Mcq')->where('category_id',$id)->get();
        return view('userQuiz-page',['quizdata'=>$quizdata,'categories'=>$category]);


    }
    function userSignup(){
        return view('user-signup');
    }
    function getSignup(Request $request){
       $validate=$request->validate([
"name"=>"required|min:3",
"email"=>"required|email|unique:user,email",
"password"=>"required|min:3|confirmed",
       ]);
       $user=User::create([
          
"name"=>$request->name,
"email"=>$request->email,
"password"=>Hash::make($request->password), 
       ]);

       $link=Crypt::encryptString($user->email);
       $link=url('/verify-email/'.$link);

       Mail::to($user->email)->send(new verifyUser($link));


       if($user){
        Session::put('user',$user);
        if(Session::has('quiz-url')){
            $url=Session::get('quiz-url');
            Session::forget('quiz-url');
            return redirect($url)->with('success','Signup successful, Please verify your email');
        }
        return redirect('/')->with('success','User Registered successfully , Please verify your email');
       }
          
       
    }
    function verifyEmail($email){
        $orgEmail=Crypt::decryptString($email);
            $user=User::where('email',$orgEmail)->first();
            if($user){
               $user->active=2;
               if($user->save()){
                return redirect('/');
               }
           
      
    }
    }

function forgetPassword(){
    return view('forget-password');
}
 function userForgetPassword(Request $request){

       $link=Crypt::encryptString($request->email);
       $link=url('/verify-forget-password/'.$link);

       Mail::to($request->email)->send(new userForgetPassword($link));
    return redirect('/');


 }
 function verifyForgetPassword($email){
   $orgEmail=Crypt::decryptString($email);
   return view('user-Set-Forgetpassword',['email'=>$orgEmail]);
     

  }
  function setForgetPassword(Request $request){
        $validate=$request->validate([

"email"=>"required|email|",
"password"=>"required|min:3|confirmed",
       ]);
        $user=User::where('email',$request->email)->first();
        if($user){
          $user->password=Hash::make($request->password);
          if($user->save()){
            return redirect('/user_login');
            }
        }


  }


    function startQuiz($id ,$name){
        $totalMcqs=MCQ::where('quiz_id',$id)->count();
        $mcqs=MCQ::where('quiz_id',$id)->get();
        if($mcqs->isEmpty() ){
            return redirect()->back()->with('error','No MCQ found for this quiz');  

        }
            
            
        Session::put('firstMcq',$mcqs[0]);
        return view('start-quiz',['totalMcqs'=>$totalMcqs,'quizname'=>$name]) ;
    }
    function userLogout(){
        Session::forget('user');
        return redirect('/');
    }
    function getSignupQuiz(){
        Session::put('quiz-url', url()->previous());
        return view('user-signup');
    }
    function loginPage(){
        return view('user-login');
    }
        function userLogin(Request $request){
       $validate=$request->validate([
"email"=>"required|email|",
"password"=>"required",
       ]);
       $user=User::where('email',$request->email)->first();
       if(!$user || !Hash::check($request->password,$user->password)){
           return redirect()->back()->with('error','Invalid credentials. Please check your email and password.');
       }

       Session::put('user',$user);
       $successMessage = 'User logged in successfully.';
       if(Session::has('quiz-url')){
           $url = Session::get('quiz-url');
           Session::forget('quiz-url');
           return redirect($url)->with('success', $successMessage);
       }

       return redirect('/')->with('success', $successMessage);

    }
    function userLoginquiz(){
            Session::put('quiz-url', url()->previous());
        return view('user-login');

    }
    function mcqPage($id ,$name){
        $record= new Record();
        $record->user_id=Session::get('user')->id;
        $record->quiz_id=Session::get('firstMcq')->quiz_id;
        $record->status=1;
       if($record->save()){
        $firstMcq=Session::get('firstMcq');
  
        $currentQuiz=[];
       $currentQuiz['totalMcqs']= MCQ::where('quiz_id', $firstMcq->quiz_id)->count();
      $currentQuiz['currentMcq']=1;
    $currentQuiz['quizName']=$name;
       $currentQuiz['quizid']=Session::get('firstMcq')->quiz_id;
       $currentQuiz['Recordid']=$record->id;
 Session::put('currentQuiz', $currentQuiz);
   $mcqData=MCQ::find($id);
        return view('mcq-page',['quizName'=>$name,'mcqData'=>$mcqData]);
    
    
    }else{
                return "something went wrong";
    }
    }
    function submitNext(Request $request,$id){
$cuurentQuiz=session::get('currentQuiz');
$cuurentQuiz['currentMcq']+=1;
 $mcqData=MCQ::where([    ['id','>',$id],    ['quiz_id','=',$cuurentQuiz['quizid']]])->first();
$isExist=MCQ_Record::where([ 
       ['record_id','=',$cuurentQuiz['Recordid']],['mcq_id','=', $request->mcq_id]])->count();
      
       if($isExist<1){  
        $mcq_record=new MCQ_Record();
    $mcq_record->record_id=$cuurentQuiz['Recordid'];
    $mcq_record->user_id=Session::get('user')->id;
    $mcq_record->mcq_id=$request->mcq_id;
    $mcq_record->select_answer=$request->option;
    if($request->option == MCQ::find($request->mcq_id)->correct_ans){            
        $mcq_record->is_correct=1;
    }else{
        $mcq_record->is_correct=0;
    }
   if(!$mcq_record->save()){
    return "something went wrong";
   }
       }


Session::put('currentQuiz', $cuurentQuiz);  
if($mcqData){
   return view('mcq-page',['quizName'=>$cuurentQuiz['quizName'],'mcqData'=>$mcqData]);
}
else{
 $resultData=MCQ_Record::WithMCQ()->where('record_id',$cuurentQuiz['Recordid'])->get();
 $correctAnswer=MCQ_Record::where([
    ['record_id','=',$cuurentQuiz['Recordid']],
    ['is_correct','=',1]
 ])->count();
  $record=Record::find($cuurentQuiz['Recordid']);
 
  if($record){
    $record->status=2;
    $record->update();

  }
    return view('userShow_result',['resultData'=>$resultData,'quizName'=>$cuurentQuiz['quizName'],'correctAnswer'=>$correctAnswer,'totalMcqs'=>$cuurentQuiz['totalMcqs']]);

}
    }
function userDetails(){
   $Quizrecord=Record::WithQuiz()->where('user_id',Session::get('user')->id)->get();
    
    return view('user-deatils',['quizrecords'=> $Quizrecord]);    
}

function QuizSearch(Request $request){
  $quizdata=Quiz::withCount('Mcq')->where('name','Like','%'.$request->search.'%')->get();
    return view('quiz-search',['quizdata'=>$quizdata,'quiz'=>$request->search]);
}

function certificate(){
    $data=[];
$data['quizName']=str_replace('-', ' ', session::get('currentQuiz')['quizName']);
  $data['userName']=Session::get('user')->name;

    return view('certificate',['data' => $data]);
}

function downloadCertificate(){
    $data=[];
$data['quizName']=str_replace('-', ' ', session::get('currentQuiz')['quizName']);
  $data['userName']=Session::get('user')->name; 
$pdf = Pdf::loadView('download-certificate', ['data' => $data])->setPaper('A4', 'landscape');
return $pdf->download('download-certificate.pdf');

}



  


function about(){
    return view('about');
}
}
