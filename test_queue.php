<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== QUEUE TEST ===\n";
echo "Queue connection: " . config('queue.default') . "\n";
echo "Jobs before: " . DB::table('jobs')->count() . "\n\n";

echo "Dispatching job...\n";
$start = microtime(true);

$job = App\Models\JobVacancy::first();
$user = App\Models\User::find(3);

dispatch(new App\Jobs\SendApplicationMailJob($job, $user));

$end = microtime(true);
$time = round(($end - $start) * 1000, 2);

echo "Dispatch time: {$time}ms\n";
echo "Jobs after: " . DB::table('jobs')->count() . "\n\n";

if ($time > 500) {
    echo "❌ SLOW! Queue is SYNC (dispatch took > 500ms)\n";
} else {
    echo "✅ FAST! Queue is ASYNC (dispatch took < 500ms)\n";
}

if (DB::table('jobs')->count() > 0) {
    echo "✅ Job queued in database\n";
} else {
    echo "❌ Job NOT queued (executed immediately)\n";
}
