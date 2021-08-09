<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if (Auth::check()) {
			$expenses = Expense::where('user_id',Auth::id())->get();
			$expensecategories = ExpenseCategory::all();
			return view('expenses.index', compact('expenses','expensecategories'));
		}else{
			return view('auth\login');
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'expense_category_id' => 'required',
			'amount' => 'required|numeric',
			'entry_date' => 'required'
		]);
		
		if (Auth::check()) {
			$expense = new Expense;
			$expense->expense_category_id = $request->input('expense_category_id');
			$expense->user_id = Auth::id();
			$expense->amount = $request->input('amount');
			$expense->entry_date = $request->input('entry_date');
			
			$expense->save();
			return redirect('expenses')->with('success','Expense Successfully Saved!');
		}else{
			return view('auth\login');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'expense_category_id' => 'required',
			'amount' => 'required|numeric',
			'entry_date' => 'required'
		]);
		
		$input = $request->all();
		$expense = Expense::find($id);
		$expense->update($input);
		
		if (Auth::check()) {
			return redirect('expenses')->with('success','Expense Updated Successfully!');
		}else{
			return view('auth\login');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
		if (Auth::check()) {
			return redirect('expenses')->with('success','Expense Deleted Successfully!');
		}else{
			return view('auth\login');
		}
    }
}
