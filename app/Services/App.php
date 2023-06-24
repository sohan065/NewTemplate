<?php

namespace App\Services;

use Token;
use Exception;
use Carbon\Carbon;
use App\Models\App as ModelApp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Services\Repositories\AppRepository;

class App implements AppRepository
{
    public function registration($credentials)
    {
        $uuid = Str::uuid();
        $expDate = Carbon::now()->addDays(365 * $credentials['exp_date']);
        $key = Token::create([
            'uuid' => $uuid,
            'name' => $credentials['name'],
            'email' =>  $credentials['email'],
            'phone' =>  $credentials['phone'],
            'exp_date' => $expDate,
        ]);
        if ($key) {
            try {
                ModelApp::create([
                    'uuid' => $uuid,
                    'name' => $credentials['name'],
                    'domain' => $credentials['domain'],
                    'email' =>  $credentials['email'],
                    'phone' =>  $credentials['phone'],
                    'key' =>  $key,
                    'exp_date' =>  $expDate,
                ]);
                return response(['message' => 'success', 'key' => $key], 201);
            } catch (Exception $e) {
                Log::error($e);
                return response(['message' => 'failed'], 406);
            }
        }
        return response(['message' => 'server side error'], 500);
    }

    public function setEnvironment($credentials)
    {
        $database_name     = $this->envsetup($credentials);
    }
    private function envsetup($environments)
    {
        try {
            $envPath = app()->environmentFilePath();
            $envContents = file_get_contents($envPath);
            foreach ($environments as $key => $value) {
                $pattern = "/^{$key}=.*/m";
                $replacement = "{$key}=\"{$value}\"";
                $newEnvContents = preg_replace($pattern, $replacement, $envContents, 1, $count);
                if ($count === 0) {
                    $newEnvContents .= "\n{$key}=\"{$value}\"";
                }
                file_put_contents($envPath, $newEnvContents);
            }
            return true;
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }

    public function searchFile()
    {
        $logFilePath = storage_path('logs/installer.log');

        if (File::exists($logFilePath)) {
            $contect = file_get_contents($logFilePath);
            $token = Token::decode($contect);
            if ($token) {
                $app_name = $token['app_name'];
                if ($app_name == env('APP_NAME')) {
                    return true;
                }
            }
        }
        return false;
    }

    public function writeFile()
    {
        $array = [
            'date' => Carbon::now(),
            'app_name' => env('APP_NAME'),
        ];
        $token = Token::create($array);
        $logFilePath = storage_path('logs/installer.log');
        $contents = $token;

        File::put($logFilePath, $contents);
        return 'done';
    }
}
