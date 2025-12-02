<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestaurantBranch;

class RestaurantBranchController extends Controller
{
    public function showBranches()
    {
        $branches = RestaurantBranch::all();
        return view('porkhub.branchlist', compact('branches'));
    }

    public function createBranch()
    {

        return view('porkhub.createbranch');
    }

    public function storeBranch(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            
        ]);

        RestaurantBranch::create($request->only(['name','address']));
        return redirect()->route('branches.list')->with('success', 'Branch created successfully.');

    }

    public function editBranch($id)
    {
        $branch = RestaurantBranch::findOrFail($id);
        return view('porkhub.updatebranch', compact('branch'));
    }

    public function updateBranch(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            
        ]);

        $branch = RestaurantBranch::findOrFail($id);
        $branch->update($request->only(['name','address']));
        return redirect()->route('branches.list')->with('success', 'Branch updated successfully.');
    }

    public function deleteBranch($id)
    {
        $branch = RestaurantBranch::findOrFail($id);
        $branch->delete();
        return redirect()->route('branches.list')->with('success', 'Branch deleted successfully.');
    }

}
