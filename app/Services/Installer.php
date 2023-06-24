<?php

namespace App\Services;

use Token;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Services\Repositories\InstallerRepository;

class Installer implements InstallerRepository
{
    public function install()
    {
        return "testing";
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
