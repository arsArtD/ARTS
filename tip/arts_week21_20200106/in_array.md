

php中in_array使用的注意事项



in_array  
 默认不是严格模式 

in_array('0', [0,1,2]) 会返回true  
in_array('0', [0,1,2], true) 会返回false   
