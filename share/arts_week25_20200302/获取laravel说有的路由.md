


```
 $route->getName()
 $route->uri
 $route->getPrefix()
 $route->getActionMethod()
```

```
Route::get('get-all-route', function () {
    $getRouteCollection = Route::getRoutes(); //get and returns all returns route collection

	foreach ($getRouteCollection as $route) {
	    echo $route->getName();
	}
});
```
