

## 定义布局

@section
@show
@yield(用来继承的关键点)  

## 组件 && 插槽 
@component
@slot 

## 显示原生数据 
{!! $name !!}  默认是经过 htmlentities 函数处理以避免 XSS 攻击  

## 流程控制 
@if   
@elseif   
@else  
@endif  
@isset  
@empty  
@unless  
@switch   
@case  
@for  
@foreach 
@while  
@loop  

## 包含子视图  
@include('a.b')

## 扩展指令  
