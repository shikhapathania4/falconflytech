<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUSES = [
        'pending' => 'Pending',
        'processing' => 'Processing',
        'completed' => 'Completed',
        'canceled' => 'Canceled',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Service model
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
