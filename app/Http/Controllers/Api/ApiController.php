<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponderTrait;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponderTrait;

    const PER_PAGE = 20;
}
