<?php

namespace App\Listeners;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class SendTelegramActivityNotification
{
    public function handle(Activity $activity)
    {
        // Log::info("Activity Log Terdeteksi: " . $activity->description);
        // Log::info("Token yang terbaca: " . config('services.telegram.token'));

        // Filter: Hanya kirim jika event adalah 'updated' atau 'deleted'
        $allowedEvents = ['updated', 'deleted'];
        
        if (in_array($activity->description, $allowedEvents)) {
            $this->sendToTelegram($activity);
        }
    }

    protected function sendToTelegram(Activity $activity)
    {
        $token = config('services.telegram.token');
        $chatId = config('services.telegram.chat_id');

        // if (!$token || !$chatId) {
        //     Log::error("Telegram Token atau Chat ID belum disetting di .env");
        //     return;
        // }

        $message = "🚨 *Activity Log Alert*\n\n"
                 . "👤 *User:* " . ($activity->causer->name ?? 'System') . "\n"
                 . "📝 *Action:* " . strtoupper($activity->description) . "\n"
                 . "📦 *Module:* " . $activity->subject_type . "\n"
                 . "🆔 *ID:* " . $activity->subject_id . "\n"
                 . "🆔 *Properties:* " . $activity->properties . "\n"
                 . "⏰ *Time:* " . $activity->created_at->format('d-m-Y H:i:s');

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown',
        ]);
    }
}