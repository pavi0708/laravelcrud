<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function adminDashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function userDashboard()
    {
        $user = auth()->user();
        return view('user.dashboard', compact('user'));
    }

    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if the logged-in user is authorized
        if (auth()->user()->role_id == 1 || auth()->id() == $user->id) {
            $user->update($request->all());
            return redirect()->back()->with('success', 'User updated successfully.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Only Admins can delete
        if (auth()->user()->role_id == 1) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID
        return view('users.edit', compact('user')); // Pass the user to the edit view
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|integer',
        ]);
    
        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);
    
        // Redirect to the edit page with the user's ID
        return redirect()->route('admin.dashboard', ['id' => $user->id])
            ->with('success', 'User updated successfully.');
    }
    public function destroy($id)
{
    $user = User::findOrFail($id); // Find the user by ID

    // Delete the user
    $user->delete();

    // Redirect back to the user list or dashboard with a success message
    return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
}
public function create()
{
    return view('users.create'); // Return the view for the user creation form
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'required|integer|in:1,2',
    ]);

    // Create the new user
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => $request->role_id,
    ]);

    // Redirect back to the admin dashboard
    return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
}

}
