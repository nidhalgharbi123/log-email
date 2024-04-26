<?php

namespace App\Listeners;

use Illuminate\Auth\Events as LaravelEvents;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

class LogActivityListener
{
    public function login(LaravelEvents\Login $event)
    {
        $ip = Request::getClientIp(true);
        $this->info($event, "user {$event->user->email} logged in from {$ip}", $event->user->only('id', 'email'));
    }

    public function logout(LaravelEvents\Logout $event)
    {
        $ip = Request::getClientIp(true);
        $this->info($event, "user {$event->user->email} logged out from {$ip}", $event->user->only('id', 'email'));
    }

    protected function info($event, $message, $context = [])
    {
        $eventName = $this->getEventName($event);
        Log::info("[{$eventName}] {$message}", $context);
    }

    protected function getEventName($event)
    {
        $class = get_class($event);
        preg_match('/\\\\([^\\\\]+)$/', $class, $matches);
        return isset($matches[1]) ? $matches[1] : $class;
    }
}

