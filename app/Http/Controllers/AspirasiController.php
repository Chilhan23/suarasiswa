<?php
namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AspirasiController extends Controller
{
    private function logUnauthorized(string $action, array $extra = []): void
    {
        $user = Auth::user();
        Log::channel('security')->warning('UNAUTHORIZED_ACCESS', [
            'action'     => $action,
            'user_id'    => $user?->id,
            'user_name'  => $user?->name,
            'user_email' => $user?->email,
            'user_role'  => $user?->role,
            'ip'         => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url'        => request()->fullUrl(),
            'method'     => request()->method(),
            'timestamp'  => now()->toDateTimeString(),
            ...$extra,
        ]);
    }

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $this->logUnauthorized('admin_access_student_dashboard');
            session()->flash('403_context', 'admin_ke_student');
            abort(403);
        }
        $user = Auth::user();
        $aspirasi = $user->aspiration()->latest()->get();
        $categories = \App\Models\Category::all();
        return view('students.dashboard', compact('aspirasi', 'categories'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $this->logUnauthorized('admin_tried_submit_aspirasi');
            session()->flash('403_context', 'admin_ke_student');
            abort(403);
        }
        $validated = $request->validate([
            'title'       => 'required|min:3|max:200',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|min:10',
        ]);
        $validated['user_id'] = Auth::id();
        Aspiration::create($validated);
        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dikirim!')->with('tab', 'list');
    }

    public function update(Request $request, string $id)
    {
        $aspirasi = Aspiration::findOrFail($id);
        if ($aspirasi->user_id !== Auth::id()) {
            $this->logUnauthorized('edit_other_user_aspirasi', [
                'target_aspirasi_id'    => $id,
                'target_aspirasi_owner' => $aspirasi->user_id,
            ]);
            abort(403);
        }
        if ($aspirasi->status !== 'pending') {
            return redirect()->route('aspirasi.index')->with('error', 'Aspirasi sudah diproses.')->with('tab', 'list');
        }
        $validated = $request->validate(['title' => 'required|min:3|max:200', 'content' => 'required|min:10']);
        $aspirasi->update($validated);
        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diperbarui!')->with('tab', 'list');
    }

    public function destroy(string $id)
    {
        $aspirasi = Aspiration::findOrFail($id);
        if ($aspirasi->user_id !== Auth::id()) {
            $this->logUnauthorized('delete_other_user_aspirasi', [
                'target_aspirasi_id'    => $id,
                'target_aspirasi_owner' => $aspirasi->user_id,
            ]);
            abort(403);
        }
        if ($aspirasi->status !== 'pending') {
            return redirect()->route('aspirasi.index')->with('error', 'Tidak bisa dihapus.')->with('tab', 'list');
        }
        $aspirasi->delete();
        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dihapus.')->with('tab', 'list');
    }

    public function adminIndex(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            $this->logUnauthorized('student_access_admin_dashboard');
            session()->flash('403_context', 'student_ke_admin');
            abort(403);
        }
        $query = Aspiration::with(['user', 'category', 'admin'])->latest();
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $aspirasi = $query->get();
        $categories = \App\Models\Category::all();
        return view('admin.dashboard', compact('aspirasi', 'categories'));
    }

    public function updateStatus(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            $this->logUnauthorized('student_tried_update_status', ['target_aspirasi_id' => $id]);
            session()->flash('403_context', 'student_ke_admin');
            abort(403);
        }
        $validated = $request->validate([
            'status'         => 'required|in:pending,proses,selesai',
            'admin_response' => 'nullable|string|max:1000',
        ]);
        $aspirasi = Aspiration::findOrFail($id);
        $aspirasi->update([
            'status'         => $validated['status'],
            'admin_response' => $validated['admin_response'],
            'handled_by'     => Auth::id(),
            'processed_at'   => now(),
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'Status berhasil diperbarui!');
    }
}