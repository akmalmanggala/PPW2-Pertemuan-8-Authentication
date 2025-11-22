<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    protected $table = 'job_vacancies';

    protected $fillable = [
        'title',
        'description',
        'location',
        'company',
        'logo',
        'salary',
        'job_type',
        'is_active',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_vacancy_id');
    }
}
