
	setSkin('green');

	// Stripes interval
	var stripesAnim;
	var stripesString='';
	$progress = $('.progress-bar');
	$percent = $('.percentage');
	$stripes = $('.progress-stripes');
	var processbarInfo=document.getElementById('progressbar-info');
	$stripes.text(stripesString);
	var stripesCount=0;
	var stripesSpeed=500;
	var progressbar=document.getElementById('progress');

	function progressSpeed(speed){
		stripesSpeed=speed;
	}


	function progressBarInit()
	{
		progressbar.style.display='block';
		stripesCount=0;
		clearInterval(stripesAnim);
	}

	function progressBarOperation(percentCount,isStripes,stripesText)
	{

		$progress.animate({
			width: percentCount+"%"
		}, 100, function() {
			$percent.text(percentCount+"%");
		});

		if(isStripes){
			stripesAnimate();
			stripesString=stripesText;
			processbarInfo.innerHTML=stripesText;
		}
	}

	function progressBarClose()
	{
		stripesCount=0;
		progressbar.style.display='none';
		clearInterval(stripesAnim);
	}
	

	
	/* STRIPES ANIMATION */
	function stripesAnimate() {
		animating();
		stripesAnim = setInterval(animating, stripesSpeed);
	}

	function animating() {
		if((stripesCount)%((stripesString.length+1))==0){
			$stripes.animate({
				marginLeft: "-=25px"
			}, stripesSpeed, "linear").append(stripesString);
		}
		else{
			$stripes.animate({
				marginLeft: "-=25px"
			}, stripesSpeed, "linear");
		}
		stripesCount++;
	} 
	
	function setSkin(skin){
		$('.loader').attr('class', 'loader '+skin);
	}