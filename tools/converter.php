<?php
if(isset($_POST['p']))
{
	$password = $_POST['p']; 
	$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
	$password = hash('sha512', $password.$random_salt);
}
?>
<!doctype html>
<html>
<head>
	<script src="../sha512.js"></script>
	<script src="../forms.js"></script>
</head>
<body>
<div style="width: 1024px; margin: 0px auto 0px auto;">
	<form style="text-align: center; width: 1008px; height: 250px; border: 1px solid #000; box-shadow: 0px 0px 7px #3cf;" method="post">
        <h1 style=" color: #000; width: 1008px; text-align: center; margin: 40px 0px 20px 0px;">SHA512 Converter</h1>
        <div style="height: 50px; clear: both;">
			<input placeholder="Text to be converted here:" style="width: 300px;" type="text" name="password" />
			<input style="" value="Convert" type="submit" name="submit" onClick="formhash(this.form, this.form.password)"/>
		</div>
        <div style="clear: both; width: 1008px; margin: 0px auto 0px auto;" >
            <div style="margin-bottom: 10px;">
                <p style="text-align: center; color: #000; width: 50px; float: left; margin: 0px 0px 0px 28px; padding: 0px;">Hash:</p>
                <input type="text" name="hashword" style="width:900px; float: left; margin: 0px;" value="<?php if(isset($_POST['p'])) { echo $password; }?>"/><br>
            </div>
            <p style="text-align: center; color: #000; width: 50px; float: left; margin: 0px 0px 0px 28px; padding: 0px;">Salt:</p><input type="text" name="salt" style="width:900px; float: left; margin: 0px;" value="<?php if(isset($_POST['p'])){ echo $random_salt; } ?>"/>
        </div>
    </form>
</div>
</body>
</html>