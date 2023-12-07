<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlansController extends Controller
{
    public function index()
    {
        $data['plans'] = Plan::allPlans();
        return view('plans.index', $data);
    }

    public function create()
    {
        return view('plans.create');
    }
    
    public function store(Request $req)
    {
        $plan = new Plan();
        $plan->setColumns($req);
        if($plan->save()) {
            return back()->with('success', __('messages.Plan created successfully'));
        } else {
            return back()->with('failure', __("messages.counldn't perform this action"));
        }
    }

    public function edit($id)
    {
        $data['plan'] = Plan::find($id);
        return view('plans.edit', $data);
    }

    public function update(Request $req)
    {
        $plan = Plan::find($req->id);
        $plan->setColumns($req);

        if($plan->update()) {
            return back()->with('success', __('messages.Plan updated successfully'));
        } else {
            return back()->with('failure', __("messages.counldn't perform this action"));
        }
    }

    public function delete($id)
    {
        $plan = Plan::find($id);
        if($plan->delete()) {
            return back()->with('failure', __('messages.Plan deleted successfully'));
        } else {
            return back()->with('failure', __("messages.counldn't perform this action"));
        }
    }
}
