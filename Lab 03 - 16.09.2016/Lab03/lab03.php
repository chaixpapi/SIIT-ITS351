<html>
<body>
<h1> Lab 3: PHP Form </h1>

<h1> New Client Information </h1>
<form action = "lab03p2.php" method = "post">
NAME: <input type = "text" name = "text1">
<hr>
USERNAME : <input type = "text" name = "text2">
<hr>
PASSWORD: <input type = "password" name = "pass">
<hr>

<h1> Input Hidden </h1>
Hidden Field : <input type = "hidden" name = "userid" value = "hidden from user">
<hr>

<h1> Radio Button </h1>
OS NAME
<br><input type = "radio" name = "osname" value = "osx">  OS X 
<br><input type = "radio" name = "osname" value = "win10">  Windows 
<br><input type = "radio" name = "osname" value = "ios" CHECKED> iOS 
<hr>

DEVICE NAME
<br><input type = "radio" name = "device" value = "mobile" CHECKED>  Mobile
<br><input type = "radio" name = "device" value = "pc">  Personal Computer
<br><input type = "radio" name = "device" value = "tablet"> Tablet
<hr>

<h1> Checkbox </h1>
Games
<br><input type = "checkbox" name = "car1" value = "Toyota"> Toyota
<br><input type = "checkbox" name = "car2" value = "Honda" CHECKED> Honda
<br><input type = "checkbox" name = "car3" value = "Nissan"> Nissan
<br><input type = "checkbox" name = "car4" value = "Mazda"> Mazda
<hr>

<h1> Combo Box </h1>
Gender
<select name = "gender">
<option value = "Male"> Male </option>
<option value = "Female"> Female </option>
<option value = "Not Available" SELECTED> Other </option>
</select>
<hr>

<h1> List Box </h1>
Gender
<select name = "gender2" size = "5">
<option value = "Male"> Male </option>
<option value = "Female"> Female </option>
<option value = "Not Available" SELECTED> Other </option>
</select>
<hr>

<h1> File </h1>
File
<input type = "file" name = "upload">
<hr>

<h1> Textarea </h1>
Memo
<textarea name = "mymemo" rows = "10" cols = "15"> My Memo here..... </textarea>
<hr>

<input type = "submit">

</form>

</body>
</html>