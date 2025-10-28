<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\services\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthInterface $manager;
    public function __construct(AuthInterface $manager)
    {
        $this->manager = $manager;
    }
    public function login(AuthRequest $request)
    {
        return $this->manager->login($request->validated());
    }

    public function register(AuthRequest $request)
    {
        return $this->manager->register($request->validated());
    }

    public function logout(Request $request)
    {
        return $this->manager->logout($request);
    }
}
