<?php

use App\Http\Controllers\Frontend\SectionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StandardController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController as SectionBackendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PraiseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\GradeController as GradeFrontendController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WhiteboardController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Quizizz\QuizizzController;
use App\Http\Controllers\Quizizz\QuizizzQuestionController;
use App\Http\Controllers\Quizizz\StudentQuizizzController;
use App\Http\Controllers\Student\StudentController;

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    if (auth()->user()->isStudent()) {
        return redirect('student/dashboard');
    } else if (auth()->user()->isAdmin()) {
        return redirect('admin/dashboard');
    } else if (auth()->user()->isInstructor()) {
        return redirect('instructor/dashboard');
    }
})->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::get('packages', [PackagesController::class, 'allPackages'])->name('dashboard.packages');
    Route::get('packages/courses/{id}', [HomeController::class, 'packageCourses'])->name('dashboard.packages.courses');
    Route::get('/courses/{grade_id}', [HomeController::class, 'allCourses'])->name('dashboard.all.courses');
    Route::get('courses/topics/{id}', [TopicController::class, 'courseTopics'])->name('dashboard.course.topics');
    Route::get('fetch/course/topics/{id}', [CourseController::class, 'fetchCourseTopics'])->name('fetch.course.topics');
    Route::post('fetch/course/sections', [CourseController::class, 'fetchCourseSections'])->name('fetch.course.sections');
    Route::get('fetch/course/sections/{id}', [CourseController::class, 'fetchCourseSectionsForInstructor'])->name('fetch.course.sections.for.instructor');
    Route::get('course/sections/{id}', [SectionController::class, 'courseSections'])->name('dashboard.course.sections');
    Route::post('/rate/course/{course}', [CourseController::class, 'rateCourse'])->name('rate.course');

});



Route::get('/', [HomeController::class, 'landingPage']);
Route::view('about-us', 'frontend.landing-page.aboutUs')->name('aboutus');
Route::view('mathnopoly', 'frontend.landing-page.mathnopoly')->name('mathnopoly');
Route::view('peer-tutoring', 'frontend.landing-page.peerTutoring')->name('peer.tutoring');
Route::view('our-services', 'frontend.landing-page.ourServices')->name('our.services');

//stripe checout form
Route::post('payment', [PaymentController::class, 'payment'])->name('payment')->middleware(['auth', 'verified']);
Route::any('payment/submit', [PaymentController::class, 'paymentSubmit'])->name('payment.submit')->middleware(['auth', 'verified']);
Route::any('course/payment/submit', [PaymentController::class, 'coursePaymentSubmit'])->name('course.payment.submit')->middleware(['auth', 'verified']);


//group routea
Route::prefix('dashboard')->middleware(['auth', 'admin-area', 'verified'])->group(function () {
    Route::prefix('plan')->group(function () {
        Route::get('/', [PlansController::class, 'index'])->name('plans');
        Route::get('create', [PlansController::class, 'create'])->name('plan.create');
        Route::post('store', [PlansController::class, 'store'])->name('plan.store');
        Route::get('edit/{id}', [PlansController::class, 'edit'])->name('plan.edit');
        Route::post('update', [PlansController::class, 'update'])->name('plan.update');
        Route::get('delete/{id}', [PlansController::class, 'delete'])->name('plan.delete');
    });
});

Route::prefix('dashboard/package')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'index'])->name('packages');
    Route::middleware('admin-area')->group(function () {
        Route::get('create', [PackagesController::class, 'create'])->name('package.create');
        Route::post('store', [PackagesController::class, 'store'])->name('package.store');
        Route::get('edit/{id}', [PackagesController::class, 'edit'])->name('package.edit');
        Route::post('update', [PackagesController::class, 'update'])->name('package.update');
        Route::get('delete/{id}', [PackagesController::class, 'delete'])->name('package.delete');
    });
});

//Admin area
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('doLogin', [AdminController::class, 'doLogin']);

    Route::middleware(['admin-auth', 'admin-area', 'verified'])->group(function () {
        //admin
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        //Grade
        Route::resource('grades', GradeController::class);
        Route::resource('standards', StandardController::class);
        //instructors
        Route::prefix('instructors')->group(function () {
            Route::get('/', [InstructorController::class, 'index'])->name('admin.instructors');
            Route::post('store', [InstructorController::class, 'store'])->name('admin.instructors.store');
            Route::get('edit/{id}', [InstructorController::class, 'edit'])->name('admin.instructors.edit');
            Route::post('update', [InstructorController::class, 'update'])->name('admin.instructors.update');
            Route::get('delete/{id}', [InstructorController::class, 'delete'])->name('admin.instructors.delete');
            Route::get('assign/courses/form', [InstructorController::class, 'assignCoursesForm'])->name('admin.instructors.assign.courses.form');
            Route::post('assign/courses', [InstructorController::class, 'assignCourses'])->name('admin.instructors.assign.courses');
        });
    });
});

//student auth 

// Route::middleware(['subscription'])->group(function () {
//student area
Route::prefix('student')->group(function () {
    Route::middleware(['auth', 'verified', 'student-area'])->group(function () {
        Route::get('dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    });
});

//global routes
Route::prefix('class')->middleware(['auth', 'verified'])->group(function () {
    Route::get('lecture/{lecture_id}', [ClassController::class, 'index']);
    Route::get('lecture/state/{lecture_id}', [ClassController::class, 'lectureState']);
    Route::prefix('student')->group(function () {
        Route::get('get/messages/{id}', [ClassController::class, 'getMessages']);
        Route::any('send/message', [ClassController::class, 'sendMessage']);
    });
    Route::get('whiteboard/{lecture_id}', [WhiteboardController::class, 'whiteBoard']);
    Route::post('whiteboard/saved', [WhiteboardController::class, 'saveWhiteBoard']);
    Route::get('getWhiteboard/data', [WhiteboardController::class, 'getWhiteBoardData']);
});

Route::middleware(['auth', 'verified'])->prefix('course')->group(function () {
    Route::get('create', [CourseController::class, 'create'])->middleware('teacher-area');
    Route::get('index', [CourseController::class, 'index'])->name('courses')->middleware('teacher-area');
    Route::post('store', [CourseController::class, 'store'])->middleware('teacher-area');
    Route::get('edit/{course_id}', [CourseController::class, 'edit'])->middleware('teacher-area');
    Route::post('update', [CourseController::class, 'update'])->middleware('teacher-area');
    Route::get('delete/{course_id}', [CourseController::class, 'delete'])->middleware('teacher-area');
    Route::get('lectures/{course_id}', [CourseController::class, 'courseLectures']);
});

Route::prefix('grade')->group(function () {
    Route::get('courses/{id}', [CourseController::class, 'gradeCourses'])->name('grade.courses');
});

Route::prefix('student')->middleware(['auth', 'student-area', 'verified'])->group(function () {
    Route::prefix('/course')->group(function () {
        Route::get('list', [StudentController::class, 'courseList']);
        Route::get('enroll/{course_id}', [StudentController::class, 'enrollCourse']);
        Route::get('enrolled', [StudentController::class, 'enrolledCourses']);
        Route::get('lecture', [StudentController::class, 'studentCourseLecture'])->name('student.course.lecture');
    });

    Route::get('subscribed/packages', 'PackagesController@subscribedPacakages')->name('student.subscribed.packages');
});

Route::prefix('student')->middleware(['admin-auth', 'admin-area', 'verified'])->group(function () {
    Route::get('index',  [StudentController::class, 'getAllStudents']);
    Route::get('edit/{student_id}',  [StudentController::class, 'editStudent']);
    Route::post('update',  [StudentController::class, 'updateStudent']);
    Route::get('delete/{student_id}',  [StudentController::class, 'deleteStudent']);
    Route::get('courses/{student_id}',  [StudentController::class, 'studentCourses']);
});

Route::prefix('lecture')->middleware(['auth', 'verified'])->group(function () {
    Route::get('create', [LectureController::class, 'create'])->name('lecture.create')->middleware('teacher-area');
    Route::get('index', [LectureController::class, 'index'])->middleware('teacher-area');
    Route::post('store', [LectureController::class, 'store'])->middleware('teacher-area');
    Route::get('edit/{id}', [LectureController::class, 'edit'])->middleware('teacher-area');
    Route::post('update', [LectureController::class, 'update'])->middleware('teacher-area');
    Route::get('delete/{id}', [LectureController::class, 'delete'])->middleware('teacher-area');
});

Route::prefix('profile')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::post('update', [ProfileController::class, 'updateProfile']);
    Route::get('change/password', [ProfileController::class, 'password']);
    Route::post('update/password', [ProfileController::class, 'updatePassword']);
    Route::post('update/avatar', [ProfileController::class, 'uploadProfileImage']);
});

Route::prefix('video')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [VideoController::class, 'index']);
    Route::get('create', [VideoController::class, 'create'])->middleware('admin-area');
    Route::post('store', [VideoController::class, 'store'])->middleware('admin-area');
    Route::get('edit/{video_id}', [VideoController::class, 'edit'])->middleware('admin-area');
    Route::post('update', [VideoController::class, 'update'])->middleware('admin-area');
    Route::get('delete/{video_id}', [VideoController::class, 'delete'])->middleware('admin-area');
});

Route::prefix('praise')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PraiseController::class, 'index']);
    Route::get('create', [PraiseController::class, 'create']);
    Route::post('store', [PraiseController::class, 'store']);
    Route::get('edit/{id}', [PraiseController::class, 'edit']);
    Route::post('update', [PraiseController::class, 'update']);
    Route::get('delete/{id}', [PraiseController::class, 'delete']);
});

Route::prefix('category')->middleware(['admin-area', 'auth', 'verified'])->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('create', [CategoryController::class, 'create']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::get('edit/{id}', [CategoryController::class, 'edit']);
    Route::post('update', [CategoryController::class, 'update']);
    Route::get('delete/{id}', [CategoryController::class, 'delete']);

    Route::get('courses/{id}', [CategoryController::class, 'categoryCourses'])->name('categor.courses');
});

Route::prefix('topic')->middleware(['auth', 'teacher-area', 'verified'])->group(function () {
    Route::get('/{id}', [TopicController::class, 'index'])->name('topics');
    Route::get('create/{id}', [TopicController::class, 'create'])->name('topic.create');
    Route::post('store', [TopicController::class, 'store'])->name('topic.store');
    Route::get('edit/{id}', [TopicController::class, 'edit'])->name('topic.edit');
    Route::post('update', [TopicController::class, 'update'])->name('topic.update');
    Route::get('delete/{id}', [TopicController::class, 'delete'])->name('topic.delete');
});

Route::prefix('grade')->group(function () {
    Route::get('courses/{id}', [GradeFrontendController::class, 'gradeCourses'])->name('grade.courses');
});

Route::prefix('sections')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [SectionBackendController::class, 'index'])->name('sections')->middleware('teacher-area');
    Route::get('create', [SectionBackendController::class, 'create'])->name('sections.create')->middleware('teacher-area');
    Route::post('store', [SectionBackendController::class, 'store'])->name('sections.store')->middleware('teacher-area');
    Route::get('edit/{id}', [SectionBackendController::class, 'edit'])->name('sections.edit')->middleware('teacher-area');
    Route::post('update', [SectionBackendController::class, 'update'])->name('sections.update')->middleware('teacher-area');
    Route::get('delete/{id}', [SectionBackendController::class, 'delete'])->name('sections.delete')->middleware('teacher-area');
    Route::get('lectures/{id}', [SectionBackendController::class, 'sectionsLectures'])->name('sections.lectures')->middleware('teacher-area');
});

Route::post('file/upload', [ClassController::class, 'fileUpload']);

Route::prefix('ajax')->group(function () {
    Route::get('grade/courses/{grade_id}', [AjaxController::class, 'gradeCourses']);
    Route::post('course/status/', [AjaxController::class, 'updateCourseStatus']);
});

Route::prefix('instructor')->group(function () {
    Route::get('login', [InstructorController::class, 'login'])->name('instructor.login');
    Route::post('authenticate', [InstructorController::class, 'authenticate'])->name('instructor.authenticate');
    Route::middleware(['auth', 'teacher-area', 'verified'])->group(function () {
        Route::get('dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');
        Route::get('course/lectures', [InstructorController::class, 'instructorCourseLecture'])->name('instructor.course.lectures');
    });
});

Route::prefix('schools')->group(function () {
    Route::get('add', [SchoolController::class, 'create'])->name('schools.add');
    Route::post('store', [SchoolController::class, 'store'])->name('schools.store');
});
Route::middleware(['auth', 'verified'])->group(function () {
    //Quizizz for admin and instructor
    Route::resource('quizizz', QuizizzController::class);
    Route::get('get-grade-courses', [QuizizzController::class, 'get_grade_courses'])->name('get-grade-courses');
    Route::get('get_standard_detail', [QuizizzController::class, 'get_standard_detail'])->name('get_standard_detail');
    Route::post('import-questions', [QuizizzController::class, 'import_questions'])->name('import-questions');
    Route::get('student/quizizz/view/{id}', [QuizizzController::class, 'studentQuizizz']);
    Route::get('student/quizizz/answers/{id}/{student_id}', [QuizizzController::class, 'studentQuizizzAnswer']);
    Route::post('quiz/question/student/answer', [StudentQuizizzController::class, 'markStudentAnswer']);
    Route::get('student/quizz/report/{quiz_id}/{student_id}', [StudentQuizizzController::class, 'studentQuizReport']);
    Route::get('change/quizz/report/status/{status}/{quiz_id}', [StudentQuizizzController::class, 'studentQuizReportStatus']);
    Route::get('quizz/reports/view/{quiz_id}', [StudentQuizizzController::class, 'quizReportView']);
});

// Route::resource('quizz-question','Quizizz\QuizizzQuestionController')->middleware(['auth','verified']);
Route::prefix('quizz-question')->middleware(['auth', 'verified'])->group(function () {
    Route::get('create/{id}', [QuizizzQuestionController::class, 'create']);
    Route::post('store', [QuizizzQuestionController::class, 'store'])->name('quizz-question.store');
    Route::get('edit/{id}', [QuizizzQuestionController::class, 'edit']);
    Route::post('update/{id}', [QuizizzQuestionController::class, 'update']);
    Route::get('delete/{id}', [QuizizzQuestionController::class, 'destroy']);
});
Route::prefix('student')->middleware(['auth', 'verified'])->group(function () {
    Route::get('quizizz', [StudentQuizizzController::class, 'index']);
    Route::get('quizizz/{id}', [StudentQuizizzController::class, 'startQuizz']);
    Route::post('quizizz/save', [StudentQuizizzController::class, 'saveQuizz']);
    Route::get('quizizz/report/{id}', [StudentQuizizzController::class, 'quizzReport']);
    Route::get('quiz/{status}', [StudentQuizizzController::class, 'QuizStatus']);
});
Route::get('view/student/cuf/details/{score_id}',[StudentQuizizzController::class,'CufAnswerDetails']);
Route::get('getip/{ip?}', function ($ip = null) {
    $ip = App\Libraries\Http::ipInfo($ip);
    return $ip;
});
// });



require __DIR__ . '/auth.php';
