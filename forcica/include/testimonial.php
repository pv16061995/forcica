<div class="animatedParent animateOnce" data-sequence="500">
<div class="test-sec rep-sec-bg">
<div class="container text-center">
<h1 class="heading-title animated fadeInDownShort" data-id="1">What Our Students Are Saying Now</h1>
<hr class="animated fadeInDownShort" data-id="1">
<div class="row text-left">

<div class="col-md-6 top-marg-3 animated fadeInLeftShort" data-id="2">
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6 text-center">
<div class="box">
<div class="rating-star">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star-half"></i>
</div>
<div class="rating-text"><strong>4.72</strong> out of <strong>5</strong></div>
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 text-center">
<div class="box">
<div class="review-num">
140,609
</div>
<div class="review-text">REVIEWS</div>
</div>
</div>
</div>
</div>

<div class="col-md-6 top-marg-3 animated fadeInRightShort" data-id="2">
<div class="row">
<div class="col-md-12">
<div id="testi" class="owl-carousel owl-theme">

<?php 
$obj=New Common();
$testi=$obj->getfeedbackOrderBySTATUS('1');
while($testimonial=$testi->fetch_assoc()) 
{

if($testimonial=='Male')
{
	$default_img_test='male_default.png';
}else{
	$default_img_test='female_default.png';
}

?>
	
<div class="item">
<div class="box2">
<p><?php echo $testimonial['message']; ?></p>
</div>
<div class="auther-box clearfix">
<?php if($testimonial['image']==''){
echo '<img src="'.BASEPATH.'userdocs/'.$default_img_test.'">';
}else{
	echo '<img src="'.BASEPATH.'userdocs/'.$testimonial['sid'].'/'.$testimonial['image'].'">';
}	
 ?>

<!-- <img src="images/auther-1.png"> -->
<span><strong><?php echo ucfirst(strtolower($testimonial['first_name'].' '.$testimonial['last_name']));?></strong> <?php echo date('d-M-Y',strtotime($testimonial['created_on']));?></span>
</div>
</div>
<?php }?>
<!-- <div class="item">
<div class="box2">
<p>I used so many indicators before. None of them made consistent results. I follow economic calendar and trade from the exact time the news is released. All of my strategy isnt working for me. My trading style doesn’t fit to what indicators i used. I also spend a lot of time on screen to see all the movements of the market.</p>
</div>
<div class="auther-box clearfix">
<img src="images/auther-2.png">
<span><strong>Anthony Santos</strong> Student Feedback</span>
</div>
</div> -->

<!-- <div class="item">
<div class="box2">
<p>I came here with no knowledge about trading and now  I am still can"t believe everything I learned through these classes. I really enjoy the classes and all the tools we can use to succeed in the trading. I was extremely impressed and always felt the primary focus were my interests. I really recommend this program.</p>
</div>
<div class="auther-box clearfix">
<img src="images/auther-3.jpg">
<span><strong>Mary O. Randle</strong> Student Feedback</span>
</div>
</div> -->

</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>