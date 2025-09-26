<?php
class Router {
private array $routes = [];
private string $prefix = '';


function get($path,$handler){ $this->map('GET',$path,$handler); }
function post($path,$handler){ csrf_check(); $this->map('POST',$path,$handler); }
function group($prefix, callable $fn) { $prev = $this->prefix; $this->prefix .= rtrim($prefix,'/'); $fn($this); $this->prefix = $prev; }


private function map($method,$path,$handler){
$path = $this->prefix . ($path==='/'?'':$path);
$regex = '#^' . preg_replace('#\{([a-z_]+)\}#i','(?P<$1>[^/]+)', rtrim($path,'/')) . '/?$#i';
$this->routes[] = compact('method','regex','handler');
}
function dispatch($method,$uri){
$uri = rtrim($uri,'/').'/';
foreach($this->routes as $r){
if($r['method']===$method && preg_match($r['regex'],$uri,$m)){
$params = array_filter($m,'is_string',ARRAY_FILTER_USE_KEY);
return $this->call($r['handler'],$params);
}
}
http_response_code(404); echo '404';
}
private function call($handler,$params){
if (is_array($handler)) { [$class,$method] = $handler; $obj = new $class; return $obj->$method(...array_values($params)); }
if (is_callable($handler)) return $handler(...array_values($params));
}
}