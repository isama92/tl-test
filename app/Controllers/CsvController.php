<?php

namespace App\Controllers;

class CsvController extends Controller
{
    public function index()
    {
        return $this->container->renderer()->render('csv/index.twig', ['name' => 'John']);
    }
}
