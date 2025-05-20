namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\EquipmentRequest;
use Illuminate\Support\Facades\Auth;

class EquipmentRequestController extends Controller
{
    public function create()
    {
        $equipment = Equipment::where('status', 'available')->get();
        return view('equipment_requests.create', compact('equipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'reason' => 'required|string'
        ]);

        EquipmentRequest::create([
            'equipment_id' => $request->equipment_id,
            'requester_id' => Auth::id(),
            'requester_name' => Auth::user()->name,
            'request_date' => now(),
            'reason' => $request->reason,
            'notes' => '',
        ]);

        return redirect()->route('equipment-requests.create')->with('success', 'Permintaan berhasil diajukan.');
    }
}