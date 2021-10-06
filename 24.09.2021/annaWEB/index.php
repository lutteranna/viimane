<?php
echo "HELLO";
print("hello");
printf("praegune kellaaeg on: " . (new DateTime())->format('Y-m-d H:I:s')); 

function addOne(int $num): int {
    return $num + 1;
}
?> 
<h1<h1>

<?php echo "tere-tere tere" ?>

<p><?php echo 10+10; ?></p> 

<h2>Näidismäng:</h2>
<button>liida üks</button>
<span><?php echo addOne(10); ?></span>)

<form>
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname">
</form>