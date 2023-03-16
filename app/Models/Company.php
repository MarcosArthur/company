<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = ['uf', 'name', 'document'];

    public function suppliers() : HasMany 
    {
        return $this->hasMany(Supplier::class); 
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('d-m-Y H-i-m');
    }

    public function setDocumentAttribute($document)
    {
        $this->attributes['document'] = preg_replace('/[^0-9]/', '', (string) $document);
    }

    public function getDocumentAttribute($document)
    {
        return substr($document, 0, 2) . '.' . substr($document, 2, 3) . '.' . substr($document, 5, 3) . '/' . substr($document, 8, 4) . '-' . substr($document, 12, 2);
    }

}
