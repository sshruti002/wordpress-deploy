<!DOCTYPE html>
<html>
<head>
<style>
h2{
    position: absolute;
    left: 410px;
    top: 20px;
    font-size: 3em;
}

.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
    position: absolute;
    left: 100px;
    top: 200px;
    margin-left: 200px;
    display: inline-block;

}

.button1:hover {
    background-color: #4CAF50;
    color: white;
}

.button2 {
    background-color: white; 
    color: black; 
    border: 2px solid #008CBA;
    position: absolute;
    right: 325px;
    top: 200px;
    margin-left: 200px;
}

.button2:hover {
    background-color: #008CBA;
    color: white;
}

.test{
    width: 80px;
    height: 80px;
    position: absolute;
    top: 280px;
    left: 240px;
}

.result{
    width: 65px;
    height: 65px;
    position: absolute;
    top: 280px;
    left: 460px;
}

.arrow{
    width: 6.2em;
    position: absolute;
    top: 265px;
    left: 335px;
}

.itest{
    width: 80px;
    height: 80px;
    position: absolute;
    top: 278px;
    right: 260px;
}

.iresult{
    width: 65px;
    height: 65px;
    position: absolute;
    top: 280px;
    right: 490px;
}

.iarrow{
    width: 6.2em;
    position: absolute;
    top: 265px;
    right: 355px;
}

.left{
    position: absolute;
    top: 380px;
    left: 280px;
    size: 2em;
}
.right{
    position: absolute;
    top: 380px;
    right: 350px;
    size: 2em;
}
</style>
</head>
<body>

<h2>Deploy Your Site</h2>
<?php  { ?>
<button class="button button1" type="submit" form="push">Push To Live</button>
<br>
<span>
<a href="https://www.develop.amitycreative.com/" target="_blank"><img src="images/test1.jpg" class="test" title="www.develop.amitycreative.com"></a>
<img src="images/arrow.png" class="arrow">
<a href="https://www.amitycreative.com/" target="_blank"><img src="images/result.jpeg" class="result" title="www.develop.amitycreative.com"></a>
</span>
<button class="button button2" type="submit" form="pull">Pull From Live</button>
<br>
<span>
<a href="https://www.develop.amitycreative.com/" target="_blank"><img src="images/test1.jpg" class="itest"></a>
<img src="images/arrow.png" class="iarrow">
<a href="https://www.amitycreative.com/" target="_blank"><img src="images/result.jpeg" class="iresult"></a>
</span>
<br>
<?php } ?>
<form id="push" action="action.php" method="post" class="left">
<input type="hidden" name="push" value="">
<input type="radio" name="option" value="full">Complete Package<br><br>
<input type="radio" name="option" value="db">Database Only<br><br>
<input type="radio" name="option" value="files">Files Only 
</form>
<span>
<form id="pull" action="action.php" method="post" class="right">
<input type="hidden" name="pull" value="">
<input type="radio" name="option" value="full">Complete Package<br><br>
<input type="radio" name="option" value="db">Database Only<br><br>
<input type="radio" name="option" value="files">Files Only 
</form>
</span>
</body>
</html>
