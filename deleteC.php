<?php
Artisan::command('remove:controller {name : AnswersController}', function ($name) {
    // File location
    $file_location = base_path() . '/app/Http/Controllers/' . $name . '.php';
    // Check if exist
    if (file_exists($file_location)) {
        exec('rm ' . $file_location);
        $this->info($name.' has been deleted!');
    } else {
        $this->error('Cannot delete ' . $name . ', file not found.');
    }
})->describe('Remove spesific controller');