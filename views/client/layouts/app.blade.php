{{-- THEME OVERRIDE ONLY: never overwrite resources/views/client/layouts/app.blade.php. --}}
@php
$ttData=get_defined_vars();unset($ttData['__env'],$ttData['app']);
$ttNative=resource_path('views/client/layouts/app.blade.php');
$ttHtml=view()->file($ttNative,$ttData)->render();
$ttCss='<link rel="stylesheet" href="'.e(asset('themes/techtrac/assets/css/theme.css')).'?v=2.0.0">';
$ttCss.='<link rel="stylesheet" href="'.e(asset('themes/techtrac/assets/css/lov-port.css')).'?v=3.0.0">';
$ttHtml=str_replace('</head>',$ttCss."\n</head>",$ttHtml);
if(strpos($ttHtml,'data-tt-shared-link')===false){
 $ttFile=base_path('themes/techtrac/views/ttlov/links.blade.php');
 $ttDesktop=view()->file($ttFile,['loMode'=>'desktop'])->render();
 $ttMobile=view()->file($ttFile,['loMode'=>'mobile'])->render();
 $ttHtml=preg_replace_callback('~(<div\b[^>]*\bclass="(?:[^"]*\s)?pn-nav(?:\s[^"]*)?"[^>]*>)~i',fn($m)=>$m[1].$ttDesktop,$ttHtml,1);
 $ttHtml=preg_replace_callback('~(<div\b[^>]*\bclass="(?:[^"]*\s)?pn-mobile-menu(?:\s[^"]*)?"[^>]*>)~i',fn($m)=>$m[1].$ttMobile,$ttHtml,1);
}
$ttClientBrandCss='<link rel="stylesheet" href="'.e(asset('themes/techtrac/assets/css/client-brand.css')).'?v=1.0.4">';
if(strpos($ttHtml,'assets/css/client-brand.css')===false)$ttHtml=str_replace('</head>',$ttClientBrandCss."\n</head>",$ttHtml);
$ttHtml=preg_replace('~<body\b~i','<body data-tt-client-brand="1" data-tt-client-theme="techtrac"',$ttHtml,1);
$ttHtml=preg_replace_callback('~(<nav\b[^>]*\bclass="pn-navbar"[^>]*>)(.*?)(</nav>)~is',function($m){
 $inside=preg_replace('~<div\b(?=[^>]*\bdata-tt-(?:shared|v2)-link)(?=[^>]*\bclass="pn-nav-item")[^>]*>\s*<a\b[^>]*>.*?</a>\s*</div>~is','',$m[2]);
 $inside=preg_replace('~<a\b[^>]*\bdata-tt-(?:shared|v2)-link[^>]*>.*?</a>~is','',$inside);
 return substr($m[1],0,-1).' data-tt-client-topbar="1">'.$inside.$m[3];
},$ttHtml,1);
$ttGroupedCss='<link rel="stylesheet" href="'.e(asset('themes/techtrac/assets/css/client-topbar.css')).'?v=1.0.0">';
$ttGroupedJs='<script defer src="'.e(asset('themes/techtrac/assets/js/client-topbar.js')).'?v=1.0.0"></script>';
$ttHtml=str_replace('</head>',$ttGroupedCss."\n</head>",$ttHtml);
$ttHtml=str_replace('</body>',$ttGroupedJs."\n</body>",$ttHtml);
$ttAlignmentCss='<link rel="stylesheet" href="'.e(asset('themes/techtrac/assets/css/site-alignment.css')).'?v=20261106-1">';
$ttHtml=str_replace('</head>',$ttAlignmentCss."\n</head>",$ttHtml);
echo str_replace('</body>',"<!-- TechTrac Lovable adapter with shared alignment -->\n</body>",$ttHtml);
@endphp
