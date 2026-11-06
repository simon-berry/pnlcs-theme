<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TechTracLovablePageController;
// Loaded from routes/web.php. Existing exact routes are never replaced.
foreach([
 ['pricing','techtrac.lov.pricing','pricing'],
 ['wordpress-hosting','techtrac.lov.wordpress','wordpress'],
 ['n8n-hosting','techtrac.lov.n8n','n8n'],
] as [$uri,$name,$method]){
 $exists=false;
 foreach(Route::getRoutes() as $known){if(trim($known->uri(),'/')===$uri && in_array('GET',$known->methods(),true)){$exists=true;break;}}
 if(!$exists && !Route::has($name))Route::get('/'.$uri,[TechTracLovablePageController::class,$method])->name($name);
}
