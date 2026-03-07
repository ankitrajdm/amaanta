<?php
// bootstrap Laravel app so Eloquent works
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\PageSection;

$sec = PageSection::where('section_key', 'what_we_do')->first();
echo "*** content stored before decode ***\n";
var_dump($sec?->content);
if($sec){
    $sec->content = html_entity_decode($sec->content, ENT_QUOTES|ENT_HTML5);
    $sec->save();
    echo "*** after decode & save ***\n";
    var_dump($sec->content);
}
