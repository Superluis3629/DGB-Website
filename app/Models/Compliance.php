<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    use HasFactory;
    protected $fillable = ["recipient", "type_of_report", "title", "company", "department", "name", "date_time", "place_of_the_event", "detail_of_event", "the_attached_file", "mention_anyone", "feel_free", "problem_happen", "problem_has_lasted"];
}