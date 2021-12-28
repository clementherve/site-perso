<?php
/*
- Long polling to check new posts
*/

//initializing the post count
$count1 = count(glob("../../../DATA/*.txt"));

//initializing the timeout
$timeout=0;

//event loop
while(count(glob("../../../DATA/*.txt")) == $count1 and $timeout < 30){
	sleep(2);
	$timeout++;
	clearstatcache();//VERY IMPORTANT!!! if you don't clear the glob cache, you'll never catch new posts
}

//sending back the status
if(count(glob("../../../DATA/*.txt")) != $count1){
	echo count(glob("../../../DATA/*.txt")) - $count1;
} else {
	echo "0";
}
?>
