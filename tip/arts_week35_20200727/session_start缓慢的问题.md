


解决session_start缓慢的问题: 

http://www.majiameng.com/article/2708.html
https://www.php.net/manual/en/function.session-start.php


```
Session_start (); // starts the session
$ _ SESSION ['user'] = "Me ";
Session_write_close (); // close write capability
Echo $ _ SESSION ['user']; // you can still access it

```

