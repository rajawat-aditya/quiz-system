<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\MCQ;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    function adminLogin(Request $request)
    {
        $loginValidation = $request->validate([
            "name" => "required",
            "password" => "required"
        ]);
        $admin_login = Admin::where([
            ['name', $request->name],
            ['password', $request->password]

        ])->first();

        if (!$admin_login) {
            $loginValidation = $request->validate([
                "user" => "required"
            ], [
                "user.required" => "User does not found"
            ]);

        }
        Session::put('admin-login', $admin_login);
        return redirect('admin_dashboard');


    }
    function adminDashboard()
    {
        $loginPage = Session::get('admin-login');
        if($loginPage){

         $user= User::count();

            return view('admindashboard', ['name' => $loginPage->name , 'totalUser'=>$user]);
        }


    }
    function adminCategory()
    {
        $showcategory = Category::get();

        $loginPage = Session::get('admin-login');
        if ($loginPage) {

            return view('adminCategory', ['name' => $loginPage->name, 'categories' => $showcategory]);
        } else {
            return redirect('admin_login');
        }

    }
    function addCategory(Request $request)
    {
        $loginPage = Session::get('admin-login');
        $validation = $request->validate([
            "category" => "required|unique:categorie,name|min:2"

        ]);
        $category = new Category();
        $category->name = $request->category;
        $category->creator = $loginPage->name;
        if ($category->save()) {
            Session::flash('category', "added " . $request->category . " succsesfully");
            return redirect('admin_category');
        }


    }
    function deleteCategory($id)
    {
        $idDeleted = Category::find($id)->delete();
        Session::flash('deleteMessage', "Category deleted Succesfully");

        return redirect('admin_category');
    }
    function addQuiz()    {

        $loginPage = Session::get('admin-login');
        $categories = Category::get();
        if ($loginPage) {
            $quiz_name = request('quizName');
            $category_id = request('category_id');
            $totalMCQs = 0;

            if ($quiz_name && $category_id && !Session::has('quizDetails')) {

                $add_quize = new Quiz();
                $add_quize->name = $quiz_name;
                $add_quize->category_id = $category_id;
                if ($add_quize->save()) {
                    Session::put('quizDetails', $add_quize);
                      return redirect('add_quiz');


                }
            } else {
                $quizdetails = Session::get('quizDetails');
                if ($quizdetails) {

                    $totalMCQs = MCQ::where('quiz_id', $quizdetails->id)->count();
                } else {
                    $totalMCQs = 0;
                }
                return view('add-quiz', ['name' => $loginPage->name, 'category' => $categories, 'totalMCQs' => $totalMCQs]);
            }



        }}
        function addMCQ(Request $request)
        {
            $validation = $request->validate([
                'mcqname' => 'required',
                'a' => 'required',
                'b' => 'required',
                'c' => 'required',
                'd' => 'required',
                'correct_ans' => 'required',
            ]);
            $mcq = new MCQ();
            $quizdetails = Session::get('quizDetails');
            $admindetails = Session::get('admin-login');
            $mcq->question = $request->mcqname;
            $mcq->a = $request->a;
            $mcq->b = $request->b;
            $mcq->c = $request->c;
            $mcq->d = $request->d;
            $mcq->correct_ans = $request->correct_ans;
            $mcq->admin_id = $admindetails->id;
            $mcq->quiz_id = $quizdetails->id;
            $mcq->category_id = $quizdetails->category_id;
            if ($mcq->save()) {
                if ($request->submit == 'add-more') {
                    return redirect('add_quiz');
                } else {
                    Session::forget('quizDetails');
                    return redirect('add_quiz');
                }
            }
        }
        function endQuiz()
        {
            Session::forget('quizDetails');
            return redirect('add_quiz');

        }

        function showQuiz($id, $quizName)
        {


            $loginPage = Session::get('admin-login');
            $showMcqs = MCQ::where('quiz_id', $id)->get();
            if ($loginPage) {

                return view('show-mcq', ['name' => $loginPage->name, 'showMcqs' => $showMcqs, 'quizName' => $quizName]);
            } else {
                return redirect('admin_login');
            }
        }

        function quizList($id, $category)
        {

            $loginPage = Session::get('admin-login');
            if ($loginPage) {
                $quizData = Quiz::where('category_id', $id)->get();
                return view('viewQuiz-list', ['name' => $loginPage->name, 'quizData' => $quizData, 'categories' => $category]);
            } else {
                return redirect('admin_login');
            }

        }























        function adminLogout()
        {
            Session::forget('admin-login');

            return redirect('admin_login');
        }

        function adminUsers()
        {
            $loginPage = Session::get('admin-login');
            if ($loginPage) {
                $users = User::orderBy('created_at', 'desc')->get();
                return view('admin-users', ['name' => $loginPage->name, 'users' => $users]);
            } else {
                return redirect('admin_login');
            }
        }


    


    function adminAllCategories()
    {
        $loginPage = Session::get('admin-login');
        if ($loginPage) {
            $categories = Category::withCount('quizes')->orderBy('created_at', 'desc')->get();
            return view('admin-all-categories', ['name' => $loginPage->name, 'categories' => $categories]);
        } else {
            return redirect('admin_login');
        }
    }

    function adminAllQuizzes()
    {
        $loginPage = Session::get('admin-login');
        if ($loginPage) {
            $quizzes = Quiz::with('category')->withCount('Mcq')->orderBy('created_at', 'desc')->get();
            return view('admin-all-quizzes', ['name' => $loginPage->name, 'quizzes' => $quizzes]);
        } else {
            return redirect('admin_login');
        }
    }

    function adminAllMcqs()
    {
        $loginPage = Session::get('admin-login');
        if ($loginPage) {
            $mcqs = MCQ::with(['quiz', 'category'])->orderBy('created_at', 'desc')->get();
            return view('admin-all-mcqs', ['name' => $loginPage->name, 'mcqs' => $mcqs]);
        } else {
            return redirect('admin_login');
        }
    }



    function deleteQuiz($id)
    {
        Quiz::find($id)->delete();
        Session::flash('deleteMessage', 'Quiz deleted successfully');
        return redirect()->back();
    }




    function deleteMcq($id)
    {
        MCQ::find($id)->delete();
        Session::flash('deleteMessage', 'MCQ deleted successfully');
        return redirect()->back();
    }

    function exportUsers()
    {
        // Get all users
        $users = User::all();

        // Create CSV headers
        $headers = array(
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="users-list.csv"',
        );

        // CSV data
        $csvData = "User List Report\n";
        $csvData .= "Generated on: " . date('Y-m-d H:i:s') . "\n\n";
        $csvData .= "ID,Name,Email,Account Status,Member Since,Last Updated\n";

        foreach ($users as $user) {
            $csvData .= $user->id . ",";
            $csvData .= $user->name . ",";
            $csvData .= $user->email . ",";
            $csvData .= ($user->active == 2 ? "Active" : "Inactive") . ",";
            $csvData .= ($user->created_at ? $user->created_at->format('Y-m-d') : 'N/A') . ",";
            $csvData .= ($user->updated_at ? $user->updated_at->format('Y-m-d H:i') : 'N/A') . "\n";
        }

        return response($csvData, 200, $headers);
    }
}
