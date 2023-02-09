<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'vendor_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function photo_personal()
    {
        return $this->belongsTo(Attachment::class, 'personal_photo_id', 'id');
    }
    public function photo_bank()
    {
        return $this->belongsTo(Attachment::class, 'account_bank_photo_id', 'id');
    }
    public function photo_face()
    {
        return $this->belongsTo(Attachment::class, 'verfiy_face_person_id', 'id');
    }
    public function commercialRecord()
    {
        return $this->belongsTo(Attachment::class, 'commercial_record', 'id');
    }
    public function document_photo()
    {
        return $this->belongsTo(Attachment::class, 'document_photo_id', 'id');
    }
    public function getAcceptAttribute()
    {
        if ($this->accept_status == '1') {
            return '<span class="badge bg-info">'.__('Pending').'</span>';
        } elseif ($this->accept_status == '2') {
            return '<span class="badge bg-success">'.__('Accepted').'</span>';
        } elseif ($this->accept_status == '3') {
            return '<span class="badge bg-danger">'.__('Rejected').'</span>';
        } else {
            return '<span class="badge bg-primary">لا يوجد بيانات</span>';
        }
    }
    public function getActiveAttribute()
    {
        return $this->active_status ? 'مفعل' : 'غير مفعل';
    }
    public function getAcceptRetAttribute()
    {
        return $this->accept_return ? 'نعم' : 'لا';
    }
    public function getAcceptResAttribute()
    {
        return $this->accept_resellers ? 'نعم' : 'لا';
    }

    public function countSales()
    {
        return $this->orders()->count();
    }
}
