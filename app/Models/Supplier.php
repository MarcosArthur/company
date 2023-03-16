<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phone;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','company_id', 'name', 'document', 'document_type', 'birt_date', 'rg'];

    protected $hidden = ['id', 'company_id'];

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('d-m-Y H-i-m');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class); 
    }

    public function setDocumentAttribute($document)
    {
        $this->attributes['document'] = preg_replace('/[^0-9]/', '', (string) $document);
    }

    public function getDocumentAttribute($document)
    {   
        if ($this->document_type == 'legal') return substr($document, 0, 2) . '.' . substr($document, 2, 3) . '.' . substr($document, 5, 3) . '/' . substr($document, 8, 4) . '-' . substr($document, 12, 2);

        
        return substr($document,0,3) . "." . substr($document, 3, 3) . "." . substr($document, 6, 3) . "-" . substr($document, 9, 2);
    }



}
