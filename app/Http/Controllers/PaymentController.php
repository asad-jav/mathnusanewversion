<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\StripeClient;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function payment(Request $req)
    {
        if(!Auth::user()->sections->contains($req->section_id)){
            if($req->type == Plan::COURSE) {
                $section = Section::find($req->section_id);
                if($section->enrollment_count >= $section->max_enrollment){
                    return back()->with('failure', 'This section is full, please join other section');
                } else {
                    $data['course'] = Course::find($req->course_id);
                    $data['section_id'] = $req->section_id;
                    return view('stripe.coursePayment', $data);
                }
            } else {
                $data['package'] = Package::find($req->package_id);
                return view('stripe.packagePayment', $data);
            }
        } else {
            return back()->with('failure', 'You already have purchased this course');
        }
        
    }

    public function coursePaymentSubmit(Request $req)
    {
        $stripe = new StripeClient('sk_test_51GwxpWC4TmetQIXp7fiykigYXMoeXlXVabCejPgal4gr24mEJYkjr2UWKhcS40IlBQppxoUJWYAksYqiutgJa6Pj00EVYmPGG7');

        if(!Auth::user()->sections->contains($req->section_id)){
            $charge = $stripe->charges->create([
                'amount' => $req->amount * 100,
                'currency' => 'usd',
                'source' => $req->stripeToken,
                'description' => $req->name,
            ]);

            $count = 0;

            if($charge->paid) {
                $payment = new Payment();
                $payment->user_id = Auth::id();
                $payment->charge_id = $charge->id;
                $payment->product_name = $req->product_name;
                $payment->type = Payment::COURSE;
                
                if($payment->save()){
                    $course_user = DB::table('course_user')->insert([
                        'payment_id' => $payment->id,
                        'user_id' => Auth::id(),
                        'course_id' => $req->course_id,
                        'section_id' => $req->section_id
                    ]);

                    $section_user = DB::table('section_user')->insert([
                        'user_id' => Auth::id(),
                        'section_id' => $req->section_id
                    ]);

                    $section = Section::find($req->section_id);
                    $section->updateEnrollmentCount();

                    if($course_user && $section->update() && $section_user) {
                        return redirect()->route('dashboard.course.sections', $req->course_id)->with('success', 'Course has been purchased successfully');
                    } else {
                        return redirect()->route('dashboard.course.sections', $req->course_id)->with('failure', 'Course has not been purchased successfully');
                    }
                }
            }
        } else {
            return redirect()->route('dashboard.course.sections', $req->course_id)->with('failure', 'You already have purchased this course');
        }
        
    }

    public function paymentSubmit(Request $req)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $charge = $stripe->charges->create([
            'amount' => $req->amount * 100,
            'currency' => 'usd',
            'source' => $req->stripeToken,
            'description' => $req->name,
        ]);

        if($req->type == Payment::COURSE){
            $charge = $stripe->charges->create([
                'amount' => $req->amount * 100,
                'currency' => 'usd',
                'source' => $req->stripeToken,
                'description' => $req->name,
            ]);

            if($charge->paid) {
                $payment = new Payment();
                $payment->user_id = Auth::id();
                $payment->charge_id = $charge->id;
                $payment->product_name = $req->product_name;
                $payment->type = Payment::COURSE;
                
                if($payment->save()){
                    $course_user = DB::table('course_user')->insert([
                        'payment_id' => $payment->id, 
                        'user_id' => Auth::id(), 
                        'course_id' => $req->course_id
                    ]);

                    if($course_user) {
                        return redirect()->route('dashboard.all.courses', $req->course_grade)->with('success', 'Course has purchased successfully');
                    }
                }
            }
        } else {
            $charge = $stripe->charges->create([
                'amount' => $req->amount * 100,
                'currency' => 'usd',
                'source' => $req->stripeToken,
                'description' => $req->name,
            ]);

            if($charge->paid) {
                $payment = new Payment();
                $payment->user_id = Auth::id();
                $payment->charge_id = $charge->id;
                $payment->product_name = $req->product_name;
                $payment->type = Payment::PACKAGE;
                
                if($payment->save()){
                    $package_user = DB::table('package_user')->insert([
                        'payment_id' => $payment->id, 
                        'user_id' => Auth::id(), 
                        'package_id' => $req->package_id
                    ]);

                    $package_courses = Package::find($req->package_id)->courses;
                    foreach($package_courses as $course){
                        $course_user = DB::table('course_user')->insert([
                            'payment_id' => $payment->id, 
                            'user_id' => Auth::id(),
                            'course_id' => $course->id
                        ]);
                    }
                    
                    return redirect()->route('dashboard.packages', $req->course_grade)->with('success', 'Course has purchased successfully');
                }
            }
        }
    }
}
