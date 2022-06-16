<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Str;

class Finance extends Model
{
    protected $guarded = ['id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function portofloading()
    {
        return $this->belongsTo(Country::class,'port_of_loading','id');
    }

    public function dst()
    {
        return $this->belongsTo(Country::class,'destination','id');
    }

    public function invoice()
    {
        if($this->invoice)
        {
            $file= public_path('storage/'). $this->invoice;

            $headers = array(
                      'Content-Type: application/pdf',
                    );
        
            return FacadesResponse::download($file, Str::random(20) . '.pdf', $headers);
        }else{
            return 'Tidak Ada';
        }
    }

    public function getInvoiceAttribute($value)
    {
        return asset('storage/' . $value);
    }
    public function getDeliveryOrderAttribute($value)
    {
        return asset('storage/' . $value);
    }
    public function getPaymentStatusAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
