<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'dob' => 'required|date',
            'pass' => 'required|string|min:6|confirmed', // Added 'confirmed' for password_confirmation
            'email' => 'required|email|unique:users,email',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        try {
            $data = [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'dob' => $validated['dob'],
                'pass' => Hash::make($validated['pass']), // Hash password
                'email' => $validated['email'],
                'status' => $validated['status'],
            ];

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('user_images', 'public');
                $data['image'] = $imagePath;
            }

            User::create($data);

            return redirect()->route('admin.user.index')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage(), [
                'input' => $request->except(['image', 'password', 'password_confirmation']),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with('error', 'Failed to create user. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'dob' => 'required|date',
            'pass' => 'nullable|string|min:6|confirmed', // Added 'confirmed' for password_confirmation
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        try {
            $user = User::findOrFail($id);
            $data = [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'dob' => $validated['dob'],
                'email' => $validated['email'],
                'status' => $validated['status'],
            ];

            // Only update password if provided
            if (!empty($validated['pass'])) {
                $data['pass'] = Hash::make($validated['pass']);
            }

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                $imagePath = $request->file('image')->store('user_images', 'public');
                if (!$imagePath) {
                    throw new Exception('Failed to store image');
                }
                $data['image'] = $imagePath;
            }

            $user->update($data);

            return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating user', [
                'error' => $e->getMessage(),
                'input' => $request->except(['image', 'password', 'password_confirmation']),
            ]);

            return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->delete();

            return redirect()->route('admin.user.index')->with('success', 'User deleted successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting user', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}