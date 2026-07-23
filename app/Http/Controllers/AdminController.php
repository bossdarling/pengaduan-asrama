<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        $totalComplaints = Complaint::count();
        $pendingComplaints = Complaint::where('status', 'pending')->count();
        $inProgressComplaints = Complaint::where('status', 'in_progress')->count();
        $completedComplaints = Complaint::where('status', 'completed')->count();
        $totalStudents = User::where('role', 'student')->count();
        $pendingStudents = User::where('role', 'student')->where('is_approved', false)->count();
        $approvedStudents = User::where('role', 'student')->where('is_approved', true)->count();
        
        // Recent complaints
        $recentComplaints = Complaint::with(['user', 'category'])->latest()->limit(5)->get();
        
        // Complaints by category
        $complaintsByCategory = Complaint::select('category_id')
            ->selectRaw('count(*) as count')
            ->with('category')
            ->groupBy('category_id')
            ->get();
        
        // Today's complaints
        $todayComplaints = Complaint::whereDate('created_at', today())->count();
        
        // This week's complaints
        $weekComplaints = Complaint::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('admin.dashboard', compact(
            'totalComplaints',
            'pendingComplaints',
            'inProgressComplaints',
            'completedComplaints',
            'totalStudents',
            'pendingStudents',
            'approvedStudents',
            'recentComplaints',
            'complaintsByCategory',
            'todayComplaints',
            'weekComplaints'
        ));
    }

    public function complaints(Request $request)
    {
        $query = Complaint::with(['user', 'category']);
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $complaints = $query->latest()->get();
        $categories = Category::all();

        return view('admin.complaints', compact('complaints', 'categories'));
    }

    public function showComplaint($id)
    {
        $complaint = Complaint::with(['user', 'category'])->findOrFail($id);
        return view('admin.show-complaint', compact('complaint'));
    }

    public function updateComplaintStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
            'response' => 'nullable|string',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            'status' => $validated['status'],
            'response' => $validated['response'],
        ]);

        return redirect()->route('admin.complaints')->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    public function students()
    {
        $students = User::where('role', 'student')->latest()->get();
        return view('admin.students', compact('students'));
    }

    public function approveStudent($id)
    {
        $student = User::findOrFail($id);
        $student->update(['is_approved' => true]);

        return redirect()->route('admin.students')->with('success', 'Mahasiswa berhasil disetujui!');
    }

    public function rejectStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students')->with('success', 'Mahasiswa berhasil ditolak!');
    }

    public function reports(Request $request)
    {
        $query = Complaint::with(['user', 'category']);
        
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $complaints = $query->latest()->get();
        
        $totalComplaints = $complaints->count();
        $pendingComplaints = $complaints->where('status', 'pending')->count();
        $inProgressComplaints = $complaints->where('status', 'in_progress')->count();
        $completedComplaints = $complaints->where('status', 'completed')->count();

        return view('admin.reports', compact(
            'complaints',
            'totalComplaints',
            'pendingComplaints',
            'inProgressComplaints',
            'completedComplaints'
        ));
    }

    public function generatePDF(Request $request)
    {
        $query = Complaint::with(['user', 'category']);
        
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $complaints = $query->latest()->get();
        
        $totalComplaints = $complaints->count();
        $pendingComplaints = $complaints->where('status', 'pending')->count();
        $inProgressComplaints = $complaints->where('status', 'in_progress')->count();
        $completedComplaints = $complaints->where('status', 'completed')->count();

        $data = [
            'complaints' => $complaints,
            'totalComplaints' => $totalComplaints,
            'pendingComplaints' => $pendingComplaints,
            'inProgressComplaints' => $inProgressComplaints,
            'completedComplaints' => $completedComplaints,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
        ];

        $pdf = PDF::loadView('admin.pdf-report', $data);
        return $pdf->download('laporan-pengaduan-' . date('Y-m-d') . '.pdf');
    }
}
