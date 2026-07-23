<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    //

    public function dashboard()
    {
        $user = Auth::user();
        $totalComplaints = $user->complaints()->count();
        $pendingComplaints = $user->complaints()->where('status', 'pending')->count();
        $inProgressComplaints = $user->complaints()->where('status', 'in_progress')->count();
        $completedComplaints = $user->complaints()->where('status', 'completed')->count();
        
        // Recent complaints
        $recentComplaints = $user->complaints()->with('category')->latest()->limit(5)->get();
        
        // Today's complaints
        $todayComplaints = $user->complaints()->whereDate('created_at', today())->count();
        
        // This week's complaints
        $weekComplaints = $user->complaints()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('student.dashboard', compact(
            'user',
            'totalComplaints',
            'pendingComplaints',
            'inProgressComplaints',
            'completedComplaints',
            'recentComplaints',
            'todayComplaints',
            'weekComplaints'
        ));
    }

    public function createComplaint()
    {
        $categories = Category::all();
        return view('student.create-complaint', compact('categories'));
    }

    public function storeComplaint(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints', 'public');
        }

        Complaint::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'photo' => $photoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('student.history')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function history()
    {
        $complaints = Auth::user()->complaints()->with('category')->latest()->get();
        return view('student.history', compact('complaints'));
    }

    public function showComplaint($id)
    {
        $complaint = Complaint::with('category')->where('user_id', Auth::id())->findOrFail($id);
        return view('student.show-complaint', compact('complaint'));
    }
}
