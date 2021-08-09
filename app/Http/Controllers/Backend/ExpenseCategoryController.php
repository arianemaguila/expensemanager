<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensecategories = ExpenseCategory::all();
		if (Auth::check()) {
			return view('expensecategories.index', compact('expensecategories'));
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
			'name' => 'required|unique:expense_categories',
			'description' => 'required'
		]);
		
		$exepenseCategory = new ExpenseCategory;
		$exepenseCategory->name = $request->input('name');
		$exepenseCategory->description = $request->input('description');
		
		$exepenseCategory->save();
		
		if (Auth::check()) {
			return redirect('expensecategories')->with('success','Expense Category Successfully Saved!');
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
			'name' => 'required|unique:expense_categories',
			'description' => 'required'
		]);
		
		$input = $request->all();
		
		$expensecategory = ExpenseCategory::find($id);
		
		$expensecategory->update($input);
		
		if (Auth::check()) {
			return redirect('expensecategories')->with('success','Expense Category Updated Successfully!');
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
		if (Auth::check()) {
			$expenses = DB::table('expenses')->where('expense_category_id', $id)->get();
			
			$expensesCount = $expenses->count();
			
			if($expensesCount==0){
				ExpenseCategory::find($id)->delete();
				return redirect('expensecategories')->with('success','Expense Category Deleted Successfully!');
			}else{
				return redirect('expensecategories')->with('errorMsg','Cannot Delete Expense Category!');
			}
		}else{
			return view('auth\login');
		}
    }
}
