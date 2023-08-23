<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Section;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Subtopic;
use App\Models\Trainer;
use App\Models\TrainerAllocation;
use App\Models\Admin;
use App\Models\User;
use App\Models\Coding;
use App\Models\Mcq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Hash;
use GuzzleHttp\Client;

class DepartmentController extends Controller
{
    public function department()
    {
        $departments = Department::all();
        return view('page.department', compact('departments'));
    }

    public function getSubtopics(Request $request)
{
    $topicId = $request->input('topic_id'); // Assuming you pass the selected topic's ID
    // dd($topicId);
    $subtopics = Subtopic::where('topic_id', $topicId)->get(); // Adjust the model and relationship
    dd($subtopics);
    return response()->json($subtopics); // Return a JSON response
}
    //ide
    public function idepage()
    {
        $courses = Course::all();
        $topic= Topic::all();
        $subtopic=Subtopic::all();
        $codings = Coding::with('course', 'topic', 'subtopic')->get();
        //dd($codings);
        return view('page.ide', compact('courses','topic', 'subtopic','codings'));
    }

    
    public function gettopicside(Request $request)
    {
        $courseId = $request->input('course_id');
        $topics = Topic::where('course_id', $courseId)->get();
        $subtopics = Subtopic::where('course_id', $courseId)->get();

        return response()->json(['topics' => $topics, 'subtopics' => $subtopics]);
    }

    public function idestore(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'course_id' => 'required',
        'topic_id' => 'required',
        'subtopic_id' => 'required',
        'question' => 'required',
        'sample_input1' => 'required',
        'sample_input2' => 'required',
        'sample_input3' => 'required',
        'sample_input4' => 'required',
        'sample_output1' => 'required',
        'sample_output2' => 'required',
        'sample_output3' => 'required',
        'sample_output4' => 'required',
        'type' => 'required',
    ]);

    // Create a new Coding instance with the validated data
    $coding = Coding::create($validatedData);

    // Optionally, you can redirect the user after successful submission
    return redirect()->route('idepage')->with('success', 'Coding question added successfully!');
}

    public function editCoding($id)
        {
            $courses = Course::all();
            $topics = Topic::all();
            $subtopics = Subtopic::all();
            $coding = Coding::with('course', 'topic', 'subtopic')->findOrFail($id);

            return view('page.edit_coding', compact('courses', 'topics', 'subtopics', 'coding'));
        }

public function updateCoding(Request $request, $id)
{
    $validatedData = $request->validate([
        'course_id' => 'required',
        'topic_id' => 'required',
        'subtopic_id' => 'required',
        'question' => 'required',
        // Add validation rules for other fields
    ]);

    $coding = Coding::findOrFail($id);
    $coding->update($validatedData);

    return redirect()->route('idepage')->with('success', 'Coding question updated successfully!');
}

 
public function destroyCoding($id)
{
    $coding = Coding::findOrFail($id);
    $coding->delete();

    return redirect()->route('idepage')->with('success', 'Coding question deleted successfully!');
}





    //mcq pages
    public function mcqpage()
    {
        $courses = Course::all();
        $topic= Topic::all();
        $subtopic=Subtopic::all();
        
        $mcqs = Mcq::with('course', 'topic', 'subtopic')->get();
        
        //dd($codings);
        return view('page.mcq', compact('courses','topic', 'subtopic','mcqs'));
    }
    public function showMcqPage()
    {
        $courseId = $request->input('course_id');
        $topics = Topic::where('course_id', $courseId)->get();
        $subtopics = Subtopic::where('course_id', $courseId)->get();

        $mcqs = Mcq::with('course', 'topic', 'subtopic')->get();
        return view('page.mcq', compact('mcqs'));
    }

    public function mcqstore(Request $request)
    {
        // Validate the form data before saving
        $request->validate([
            'course' => 'required',
            'topic' => 'required',
            'subtopic' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'type' => 'required|in:1,2,3',
        ]);

        // Create a new MCQQuestion instance and fill it with the form data
        $mcqQuestion = new Mcq();
        $mcqQuestion->course_id = $request->input('course');
        $mcqQuestion->topic_id = $request->input('topic');
        $mcqQuestion->subtopic_id = $request->input('subtopic');
        $mcqQuestion->question = $request->input('question');
        $mcqQuestion->answer = $request->input('answer');
        $mcqQuestion->type = $request->input('type');

        // Save the MCQQuestion instance to the database
        $mcqQuestion->save();

        // Redirect to a success page or any other appropriate action
        return redirect()->route('mcqpage')->with('success', 'Mcq question added successfully!');
    }

    public function editMcq($id)
{
    $mcq = Mcq::findOrFail($id);
    $courses = Course::all();
    $topics = Topic::all();
    $subtopics = Subtopic::all();
    
    return view('page.edit_mcq', compact('mcq', 'courses', 'topics', 'subtopics'));
}

public function updateMcq(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'course_id' => 'required',
        'topic_id' => 'required',
        'subtopic_id' => 'required',
        'question' => 'required',
        'answer' => 'required',
        'type' => 'required',
    ]);

    // Find the MCQ question by ID
    $mcq = Mcq::findOrFail($id);

    // Update the MCQ question with the validated data
    $mcq->update($validatedData);

    // Optionally, you can redirect the user after successful update
    return redirect()->route('mcqpage')->with('success', 'MCQ question updated successfully!');
}


public function destroyMcq($id)
{
    $mcq = Mcq::findOrFail($id);
    $mcq->delete();

    return redirect()->route('page.mcqpage')->with('success', 'MCQ question deleted successfully!');
}




    //student view
    // public function show()
    // {
    //     //dd($id);
    //     $id = auth()->id();
    //     $user = User::with('department', 'section', 'batch')->find($id);
    //     // dd($user);
     
    //     return view('auth.student')->with('user', $user);
    // }
    public function show()
    {
        $id = auth()->id();
    
        $user = User::with('department', 'section', 'batch') // Add 'trainer1' and 'trainer2'
            ->join('allocation_trainers', 'users.batch_id', '=', 'allocation_trainers.batch_id')
            ->join('trainers as trainer1', 'allocation_trainers.trainer1_id', '=', 'trainer1.id')
            ->join('trainers as trainer2', 'allocation_trainers.trainer2_id', '=', 'trainer2.id')
            ->join('courses', 'allocation_trainers.course_id', '=', 'courses.id')
            ->leftJoin('topics', 'courses.id', '=', 'topics.course_id')
            ->leftJoin('subtopics', 'topics.id', '=', 'subtopics.topic_id')
            ->select('users.*', 'courses.name as course_name', 'topics.name as topic_name', 'subtopics.name as subtopic_name','trainer1.name as trainer1_name','trainer2.name as trainer2_name')
            ->where('users.id', $id)
            ->first();
            
    
        return view('auth.student')->with('user', $user);
    }

    public function viewcourse()
    {
        $id = auth()->id();
    
        $user = User::with('department', 'section', 'batch') // Add 'trainer1' and 'trainer2'
            ->join('allocation_trainers', 'users.batch_id', '=', 'allocation_trainers.batch_id')
            ->join('trainers as trainer1', 'allocation_trainers.trainer1_id', '=', 'trainer1.id')
            ->join('trainers as trainer2', 'allocation_trainers.trainer2_id', '=', 'trainer2.id')
            ->join('courses', 'allocation_trainers.course_id', '=', 'courses.id')
            ->leftJoin('topics', 'courses.id', '=', 'topics.course_id')
            ->leftJoin('subtopics', 'topics.id', '=', 'subtopics.topic_id')
            ->select('users.*', 'courses.name as course_name', 'courses.id as course_id', 'topics.name as topic_name', 'subtopics.name as subtopic_name','trainer1.name as trainer1_name','trainer2.name as trainer2_name')

            ->where('users.id', $id)
            ->first();
            
    
        return view('auth.viewcourse')->with('user', $user);
    }
    //view course
    public function coursedetails($course_id)
    {
        //dd($course_id);
        // Fetch the course, topics, and subtopics for the given course ID
        $course = Course::find($course_id);
        $topics = Topic::where('course_id', $course_id)->get();
        $subtopics = Subtopic::whereIn('topic_id', $topics->pluck('id'))->get();
       
        // Pass the data to the view
        $data = [
            'course' => $course,
            'topics' => $topics,
            'subtopics' => $subtopics,
        ];
        
        return view('auth.course', $data);
    }

    public function getQuestions($subtopic_id)
    {
        $subtopic = Subtopic::find($subtopic_id);
    
        if (!$subtopic) {
            return response()->json([
                'message' => 'Subtopic not found',
            ], 404);
        }
    
        // Retrieve coding questions using join
        $codingQuestions = DB::table('codings')
            ->join('subtopics', 'codings.subtopic_id', '=', 'subtopics.id')
            ->where('subtopics.id', $subtopic_id)
            ->select('codings.*', 'subtopics.id as subtopic_id')
            ->get();
            
        // Retrieve mcq questions using join
        $mcqQuestions = DB::table('mcqs')
            ->join('subtopics', 'mcqs.subtopic_id', '=', 'subtopics.id')
            ->where('subtopics.id', $subtopic_id)
            ->select('mcqs.*', 'subtopics.id as subtopic_id')
            ->get();
    
        return response()->json([
            'coding' => $codingQuestions,
            'mcq' => $mcqQuestions,
        ]);
    }
    
    public function testquestions($subtopicId)
    {
        $codingQuestions = DB::table('codings')
            ->where('subtopic_id', $subtopicId)
            ->select('id', 'question') // Include the 'id' field
            ->distinct()
            ->get();
    
        return view('page.testpage', compact('codingQuestions', 'subtopicId'));
    }
    public function mcqtest($subtopicId)
    {
        // Fetch MCQ questions from the database using the provided subtopic ID
        $mcqQuestions = DB::table('mcqs')
            ->where('subtopic_id', $subtopicId)
            ->select('question') // Select only the 'question' field
            ->distinct() // Ensure unique questions
            ->get();

        // Load the 'testpage' view and pass the questions as data to the view
         return response()->json(['mcqQuestions' => $mcqQuestions]);
    }

    public function compile(Request $request)
    {
       
        $apiKey = '527f3e6a78msh87438a0a9e651b9p17aa28jsnb8c687f0607c';
        $compilerEndpoint = 'https://online-code-compiler.p.rapidapi.com/v1/';

        $client = new Client();

        try {
            $response = $client->request('POST', $compilerEndpoint, [
                'json' => [
                    "language" => "python3",
                    "version" => "latest",
                    "code" => $request->input('code'),
                    "input" => null
                ],
                'headers' => [
                    'X-RapidAPI-Host' => 'online-code-compiler.p.rapidapi.com',
                    'X-RapidAPI-Key' => $apiKey,
                    'content-type' => 'application/json',
                ],
            ]);

            $result = json_decode($response->getBody(), true);

            
            return response()->json(['result' => $result]);


        } catch (\Exception $e) {
            return response()->json(['error' => 'Compilation failed.']);
        }
    }

    public function storeCodingAnswer(Request $request)
    {
        // Retrieve the student ID, question ID, answer, and output from the request
        $studentId = $request->input('student_id');
        $questionId = $request->input('question_id');
        $answer = $request->input('answer');
        $output = $request->input('output');

        // Store the coding answer in your database
        // Example code: (Make sure to adjust this according to your database structure)
        DB::table('coding_answers')->insert([
            'student_id' => $studentId,
            'question_id' => $questionId,
            'answer' => $answer,
            'output' => $output,
        ]);

        return response()->json(['message' => 'Coding answer stored successfully']);
    }


        public function getSupportedLanguages()
        {
            $response = Http::get('https://api.jdoodle.com/v1/languages');

            $languages = collect($response->json());

            return view('testquestions', compact('languages'));
        }

        public function compile1(Request $request)
        {
            $code = $request->input('code');
            $output = $this->runCompiler($code);

            return view('testquestions', ['output' => $output, 'code' => $code]);
        }
    //login
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $admin = Admin::where('email', $credentials['email'])->first();

    if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
        // Invalid credentials, redirect back with error message
        return redirect()->back()->withInput()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // Authentication passed, log in the admin
    Auth::guard('admin')->login($admin);

    return redirect('/department');
}
public function ulogin(Request $request)
{
    try {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            // Invalid credentials, redirect back with error message
            return redirect()->back()->withInput()->withErrors([
                'email' => 'Invalid email or password.',
            ]);
        }

        // Authentication passed, log in the user
        Auth::login($user);

        return redirect('/students'); // Redirect to /student route

    } catch (\Exception $e) {
        // Log the exception
        Log::error($e->getMessage());

        // Redirect with an error message or handle the error appropriately
        return redirect()->back()->withErrors([
            'error' => 'An unexpected error occurred.',
        ]);
    }
}

 


public function logout()
{
    Auth::logout();
    return redirect('/');
}

    //register
    public function register(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ]);

        // Create a new user
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Redirect or return a response
        return redirect('/')->with('success', 'Registration successful!');
    }
    //trainer
    public function trainer()
    {
        $trainers = Trainer::all();
        return view('page.trainer',compact('trainers'));
    }
    public function trainerstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Trainer::create([
            'name' => $request->name
        ]);

        return redirect('trainer');
    }
    public function traineredit(string $id)
    {
        $trainers = Trainer::find($id);     
        return view('page.traineredit', compact('trainers'));
    }
    
    public function trainerupdate(Request $request, string $id)
    {
        Trainer::where('id', $id)->update([
            'name' => $request->name,               
        ]);
        return redirect('trainer');
    }
    
    public function trainerdestroy(string $id)
    {
        Trainer::find($id)->delete();
        return redirect('trainer');
    }
    //course
    public function course()
    {
        $courses = Course::all();
        return view('page.course',compact('courses'));
    }
    public function cstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Course::create([
            'name' => $request->name
        ]);

        return redirect('course');
    }
    public function cedit(string $id)
    {
        $courses = Course::find($id);     
        return view('page.cedit')->with('course',$courses);
    }
    public function cupdate(Request $request, string $id)
    {
        Course::where('id', $id)->update([
            'name' => $request->name,               
        ]);
        return redirect('course');
    }
    public function cdestroy(string $id)
    {
        Course::find($id)->delete();
        return redirect('course');
    }
    
    //section crud
    public function editSection(string $id)
    {
        $section = Section::findOrFail($id);
        $departments = Department::all();
        return view('page.edit_section', compact('section', 'departments'));
    }

    public function updateSection(Request $request, string $id)
    {
        $section = Section::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'department_id' => 'required'
        ]);

        $section->update([
            'name' => $request->name,
            'department_id' => $request->department_id
        ]);

        return redirect('section');
    }

    public function deleteSection(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect('section');
    }
//batch crud
public function batch()
    {
        
        $batches = Batch::all();
        return view('page.batch', compact('batches'));

    }

    public function batchstore(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',            
        ]);   
        Batch::insert([
            'name' => $request->name
        ]); 
            // $students->fill($request->post())->save();
    
            return redirect()->route('batch');
            
    }

    public function bedit(string $id)
    {
        $batches = Batch::find($id);     
        return view('page.bedit')->with('batch',$batches);
    }

    /**
     * Update the specified resource in storage.
     */
    public function bupdate(Request $request, string $id)
    {
        Batch::where('id', $id)->update([
            'name' => $request->name,               
        ]);
        return redirect('batch');
    }

    public function bdestroy(string $id)
    {
        Batch::find($id)->delete();
        return redirect('batch');
    }
    //department crud
    public function edit(string $id)
    {
        $departments = Department::find($id);     
        return view('page.edit')->with('department',$departments);
    }

    /**
     * Update the specified resource in storage.
     */
    public function dupdate(Request $request, string $id)
    {
        Department::where('id', $id)->update([
            'name' => $request->name,               
        ]);
        return redirect('department');
    }

    public function destroy(string $id)
{
    // Delete related records in allocation_trainers table
    TrainerAllocation::where('department_id', $id)->delete();
    
    // Delete the department
    Department::find($id)->delete();

    return redirect('department');
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Department::create([
            'name' => $request->name
        ]);

        return redirect('department');
    }

//allocate
public function allocate()
    {
        $departments = Department::all();
        $sections = Section::all();
        $batchs = Batch::all();
        $courses = Course::all();
        $trainers = Trainer::all();
        $allocation=TrainerAllocation::all();
        
        return view('page.allocate', compact('allocation','departments', 'sections','batchs','courses','trainers'));
    }
    public function aedit($id)
    {
        $allocation = TrainerAllocation::findOrFail($id);
        $batchs = Batch::all();
        $departments = Department::all();
        $sections = Section::all();
        $courses = Course::all();
        $trainers = Trainer::all();
    
        return view('page.aedit', compact('allocation', 'batchs', 'departments', 'sections', 'courses', 'trainers'));
    }


    public function aupdate(Request $request, $id)
    {
        $allocation = TrainerAllocation::findOrFail($id);
    
        // Validate the form data
        $validatedData = $request->validate([
            'batch_id' => 'required',
            'department_id' => 'required',
            'section_id' => 'required',
            'course_id' => 'required',
            'trainer1_id' => 'required',
            'trainer2_id' => 'required',
        ]);
    
        $allocation->update($validatedData);
    
        return redirect('allocate')->with('success', 'Trainer Allocation updated successfully.');
    }
public function adestroy($id)
{
    $allocation = TrainerAllocation::findOrFail($id);
    $allocation->delete();

    return redirect()->back()->with('success', 'Trainer Allocation deleted successfully.');
}

    public function astore(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'batch_id' => 'required',
        'department_id' => 'required',
        'section_id' => 'required',
        'course_id' => 'required',
        'trainer1_id' => 'required',
        'trainer2_id' => 'required',
    ]);

    try {
        // Create the allocation record in the database
        TrainerAllocation::create($validatedData);

        // Redirect to a success page or perform any additional actions
        return redirect()->back()->with('success', 'Trainer Allocation created successfully.');
    } catch (\Exception $e) {
        // Handle any exceptions that occur during the creation process
        return redirect()->back()->with('error', 'Failed to create Trainer Allocation.');
    }
}

    //section
    public function section()
    {
        $departments = Department::all();
        $sections = Section::with('department')->get();
        return view('page.section', compact('departments', 'sections'));
    }
   

    public function secstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required'
        ]);

        Section::create([
            'name' => $request->name,
            'department_id' => $request->department_id
        ]);

        return redirect('section');
    }

    //topic operations
    public function topic()
    {
        $courses = Course::all();
        $topics = Topic::with('course')->get();
        return view('page.topic', compact('courses', 'topics'));
    }


    
    public function tstore(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',  
            'course_id'=>'required'          
        ]);
        Topic::insert([
            'name' => $request->name,
            'course_id'=>$request->course_id

        ]); 
            // $students->fill($request->post())->save();
    
            return redirect('topic');
        
            
    }

    public function tedit(string $id)
    {
        $courses = Course::all();
        $topics = Topic::with('course')->find($id);
        return view('page.tedit', compact('courses', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function tupdate(Request $request, string $id)
    {
        Topic::where('id', $id)->update([
            'name' => $request->name,
            'course_id' => $request->course_id,               
        ]);
        return redirect('topic');
    }


    public function tdestroy(string $id)
    {
        Topic::find($id)->delete();
        return redirect('topic');
    }

    //subtopic operations

    public function subtopic()
    {
        $courses = Course::all();
        $subtopics = Subtopic::all();
        $topics = Topic::all();
        return view('page.subtopic', compact('courses', 'subtopics', 'topics'));
    }

    public function ststore(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'topic_id' => 'required|exists:topics,id',
            'name' => 'required|string|max:255',
        ]);

        Subtopic::create([
            'course_id' => $request->course_id,
            'topic_id' => $request->topic_id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Subtopic created successfully.');
    }

    public function stedit($id)
    {
        $subtopic = Subtopic::findOrFail($id);
        $courses = Course::all();
        $topics = Topic::all();
        return view('page.stedit', compact('subtopic', 'courses','topics'));
    }

    public function stupdate(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'topic_id' => 'required|exists:topics,id',
            'name' => 'required|string|max:255',
        ]);

        $subtopic = Subtopic::findOrFail($id);
        $subtopic->update([
            'course_id' => $request->course_id,
            'topic_id' => $request->topic_id,
            'name' => $request->name,
        ]);

        return redirect('subtopic')->with('success', 'Subtopic updated successfully.');
    }

    public function stdestroy($id)
    {
        $subtopic = Subtopic::findOrFail($id);
        $subtopic->delete();

        return redirect()->back()->with('success', 'Subtopic deleted successfully.');
    }

    public function getTopics($courseId)
    {
        $topics = Topic::where('course_id', $courseId)->get();

        return response()->json(['topics' => $topics]);
    }

    
}
