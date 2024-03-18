<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get('log') == true) {
            return redirect()->to('/home');
        }
        if (session()->get('log1') == true) {
            return redirect()->to('/home-anggota');
        }
        if (session()->get('log2') == true) {
            return redirect()->to('/home-petugas');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
