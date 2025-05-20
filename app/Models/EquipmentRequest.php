namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'requester_id',
        'requester_name',
        'request_date',
        'reason',
        'notes',
        'status' // pending, approved, rejected
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
}