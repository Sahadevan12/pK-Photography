<?php
// app/Http/Controllers/Admin/CustomerUploadController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerUploadController extends Controller
{
    public function index()
    {
        $uploads = CustomerUpload::with(['order', 'product'])
            ->latest()
            ->paginate(20);
        return view('admin.uploads.index', compact('uploads'));
    }

    public function updateStatus(Request $request, CustomerUpload $upload)
    {
        $request->validate(['status' => 'required|in:pending,processed']);
        $upload->update(['status' => $request->status]);
        return back()->with('success', 'Upload status updated.');
    }

    public function destroy(CustomerUpload $upload)
    {
        Storage::disk('public')->delete($upload->file_path);
        $upload->delete();
        return back()->with('success', 'Upload deleted.');
    }
}