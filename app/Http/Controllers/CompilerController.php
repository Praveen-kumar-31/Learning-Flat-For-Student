<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;


class CompilerController extends Controller
{
   
    public function compile(Request $request)
    {
        $code = $request->input('code');
        $output = $this->runCompiler($code);

        return view('page.testpage', ['output' => $output, 'code' => $code]);
    }

    protected function runCompiler($code)
    {
        // Adjust this to your actual compilation command and logic
        $process = new Process(['your-compiler-command', $code]);
        $process->run();

        return $process->getOutput();
    }
}
