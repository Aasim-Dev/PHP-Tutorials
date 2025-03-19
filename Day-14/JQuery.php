<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<p1><h1>If you click on me, I will disappear.</h1></p1><br>
<p2><h2>Click me away!</h2></p2><br>
<p3><h3>Click me too!</h3></p3><br>
<p4><h4>P4 Click me too!</h4></p4><br>
<p5><h5>p5 Click me too!</h5></p5><br>
<p6><h6>P6 Click me too!</h6></p6><br>
<p7><h1>P7 Click me too!</h1></p7><br>
<p8><h2>P8Click me too!</h2></p8><br>
<p9><h3>P9 Click me too!</h3></p9><br>
<p10><h4>P10 Click me too!</h4></p10><br>
<p11><h5>P11 Click me too!</h5></p11><br>
<p12><h6>P12 Click me too!</h6></p12><br>

<script>

//Types of Selectore:- element, Id, Class, table, Tr(table row), td(table coloumn), tr:odd(odd row), this->select current element.

//Types of Events:- Click, dblclick, mouseenter, mouseleave, keyup, keypress, submit, focus, highlight, blur, load, resize.

//Types of Effects:- show, hide, fade, toggle, animate, set, get, stop. 

//Types of GET, SET :- text(), val(), html().

//if we want to remove child element from an element than we use empty() else if we wnat to remove the element than remove().
$(document).ready(function(){
  $("p1").click(function(){
    $(this).hide();
  });
  $("p2").mouseleave(function(){
    alert("Leaving");
  });
  $("p3").mouseenter(function(){
    alert("Entering");
  });
  $("p4").dblclick(function(){
    $(this).hide(20000);
  });
  $("p5").click(function(){
    $(this).fadeOut();
  });
  $("p6").click(function(){
    $(this).slideUp(10000);
  });
  $("p7").click(function(){
    $(this).slideToggle(10000);
  });
  $("p8").click(function(){
    $(this).fadeToggle(10000);
  });
  $("p9").dblclick(function(){
    $(this).toggle(9000);
  });
  $("p10").mouseenter(function(){
    alert("Entering");
  });
  $("p11").mouseenter(function(){
    alert("Entering");
  });
  $("p12").mouseenter(function(){
    alert("Entering");
  });
});
</script>


</body>
</html>
