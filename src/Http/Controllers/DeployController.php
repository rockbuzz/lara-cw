<?php

namespace Rockbuzz\LaraCW\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Artisan, Log};
use Rockbuzz\LaraCW\Composer;

class DeployController extends Controller
{
    public function index()
    {
        if ($this->hasDeploy()) {
            $tokenResponse = $this->getTokenResponse();
            return response()->json(
                $this->pull($tokenResponse->access_token)
            );
        }
        return response()->json(['message' => 'Can\'t deploy'], 500);
    }

    private function getTokenResponse()
    {
        return $this->callCloudwaysAPI(
            'POST',
            '/oauth/access_token',
            null,
            [
                'email' => config('cw.email'),
                'api_key' => config('cw.api_key')
            ]
        );
    }

    private function pull($accessToken)
    {
        try {

            $jsonOutput = $this->callCloudWaysAPI(
                'POST',
                '/git/pull',
                $accessToken,
                [
                    'server_id' => config('cw.server_id'),
                    'app_id' => config('cw.app_id'),
                    'git_url' => config('cw.git_url'),
                    'branch_name' => config('cw.branch_name'),
                    'deploy_path' => config('cw.deploy_path')
                ]
            );

        } catch (\Exception $exception) {

            Log::error($exception);

            return response()->json($exception->getMessage(), 500);

        } finally {

            app()->make(Composer::class)
                ->setWorkingPath(base_path())
                ->run(config('cw.composer'));

            collect(config('cw.artisan'))
                ->each(function(string $commant) { 
                    Artisan::call($commant);
                    Log::info("Comando $commant executado");
                }
            );
        }

        return response()->json($jsonOutput);
    }

    private function callCloudwaysAPI($method, $url, $accessToken, $post = [])
    {
        $baseURL = config('cw.api_url');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_URL, $baseURL . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Set Authorization Header
        if ($accessToken) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);
        }

        //Set Post Parameters
        $encoded = '';
        if (count($post)) {
            foreach ($post as $name => $value) {
                $encoded .= urlencode($name) . '=' . urlencode($value) . '&';
            }
            $encoded = substr($encoded, 0, strlen($encoded) - 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode != '200') {
            die('An error occurred code: ' . $httpcode . ' output: ' . substr($output, 0, 10000));
        }
        curl_close($ch);
        return json_decode($output);
    }

    protected function hasDeploy(): bool
    {
        return config('cw.status') && config('app.env') === config('cw.env');
    }

}
