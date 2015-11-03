var App = function(){
	this.init();
};

App.prototype.init = function() {
	this.$ = {};
	this.$.mainContainer 	= $('.main-container');
	this.$.introHeader 	 	= $('.intro-header');
	this.$.backgroundImages = this.$.introHeader.find('.background div');
	this.$.home 	 	 	= $('body.home');
	this.$.body 	 	 	= $('body');
	this.$.leftMenu 	 	= this.$.mainContainer.find('nav');
	this.$.searchTitle	 	= this.$.mainContainer.find('.menu-item-5 a');
	this.$.randomTitle 	 	= this.$.mainContainer.find('.menu-item-37 a');
	this.$.searchBox 	 	= this.$.mainContainer.find('nav form');
	this.$.categoryMenu  	= this.$.mainContainer.find('.categories .title');
	this.$.categories 	 	= this.$.mainContainer.find('.categories li a');
	this.$.postContainer 	= this.$.mainContainer.find('.post-container');
	this.$.postHeader 	 	= this.$.mainContainer.find('.post-container .post-header');
	this.$.postContent 	 	= this.$.mainContainer.find('.post-container .entry-content');
	this.$.posts 	 	 	= this.$.mainContainer.find('.tips .entry');
	this.$.postsRows 	 	= this.$.mainContainer.find('.tips .tips-row');
	this.$.upvoteBtn 	 	= this.$.mainContainer.find('.upvote-btn');
	this.$.likesCount 	 	= this.$.mainContainer.find('.likes-count');
	this.window 	 	 	= $(window);

	this.animationId;
	
	this.$.randomTitle.attr('href',this.$.mainContainer.attr('data-random'));	
	this.initEvents();
	this.resizeTip();
	this.randomizeIntro();
	//this.initPosts();

	if (this.$.body.hasClass('category')) {
		this.initCat();
	}

	this.$.body.show();
};

App.prototype.initEvents = function() {
	var that = this;

	/*if (Cookies.get('visited')){
		this.removeIntro();
	}

	else {
		Cookies.set('visited', true, {expires: 7});
	}*/

	if (this.$.home.length > 0) {
		this.window.on('scroll', function() {
			that.updateStyle();
		});
	};

	this.$.searchTitle.on('click', function(e) {
		e.preventDefault();
		that.$.searchBox.fadeToggle();
	});

	this.$.upvoteBtn.on('click', function(){
		var event = this;
		that.getAjax(event);
	});

	this.window.on('resize', function(){
		that.resizeTip();
		cancelAnimationFrame(that.animationId);
		that.randomizeIntro();
	});

	this.window.on('scroll', function() {
		that.initPosts();
	});
};

App.prototype.updateStyle = function() {
	var windowPos = this.window.scrollTop();
	var containerPos = this.$.mainContainer.offset().top;

	if (windowPos >= containerPos && containerPos > 10) {
		this.removeIntro();
	}
};

App.prototype.removeIntro = function(){
	this.$.introHeader.hide();
	this.window.scrollTop(0);
	this.$.leftMenu.addClass('fixed');
};

App.prototype.initCat = function() {
	var category = this.$.categoryMenu.attr('data-category');
	var categories = new Array();
	this.$.categories.each(function() {
			categories.push({tag:$(this), content: $(this).html().toLowerCase()});
		});
	for (var i = 0; i < categories.length; i++) {
		if (category == categories[i].content) {
			categories[i].tag.addClass('active');
		}
	};
};

App.prototype.getAjax = function(event) {
	var that = event;

	$.ajax({
	    type: 'post',
		url: 'http://'+ document.domain +'/wp-content/themes/grandmatheme/update-likes.php',
	    data: {
	    	tipId: $(that).attr('data-tipId')
	    },
	    success: function(data){
	    	this.$.likesCount.html(data);
	    	this.$.upvoteBtn.addClass('active');
	    }
	});
};

App.prototype.resizeTip = function() {
	var containerHeight = this.$.postContainer.height();
	var titleHeight = this.$.postHeader.outerHeight();
	var newHeight = containerHeight-titleHeight;

	this.$.postContent.outerHeight(newHeight);
};

App.prototype.initPosts = function() {
	var scroll = this.window.scrollTop();
	var windowHeight = this.window.height();
	this.$.postsRows.each(function() {
		var distance = $(this).offset().top;
		if ((scroll+windowHeight) > distance && scroll > 40) {
			$(this).fadeIn();
		}
	})
};

App.prototype.randomizeIntro = function(){
	var width  	  = this.window.width(),
		height 	  = this.window.height(),
		that   	  = this;

	this.$.backgroundImages.each(function(){
		var randomTop  = Math.random() * (height - $(this).height()),
			randomLeft = Math.random() * (width - $(this).width());

		$(this).css({
			'top': randomTop,
			'left': randomLeft
		});

		$(this).data('initialPosition', {
			top: randomTop,
			left: randomLeft
		});

		$(this).data('direction', {
			top: Math.round(Math.random()),
			left: Math.round(Math.random())
		});
	});

	this.animateImages();
};

App.prototype.animateImages = function(){
	var width  	  = this.window.width(),
		height 	  = this.window.height(),
		that   	  = this;

	function animate(){
		that.animationId = requestAnimationFrame(animate);
		update();
	};

	function update(){
		that.$.backgroundImages.each(function(){
			var directionTop  = $(this).data('direction').top,
				directionLeft = $(this).data('direction').left,
				initialTop 	  = $(this).data('initialPosition').top,
				initialLeft	  = $(this).data('initialPosition').left,
				positionTop   = $(this).position().top,
				positionLeft  = $(this).position().left,
				boxSize 	  = 100;

			if (directionTop){
				$(this).css({
					'top': '-=1px'
				});
			}

			else {
				$(this).css({
					'top': '+=1px'
				});
			}

			if (directionLeft){
				$(this).css({
					'left':  '-=1px'
				});
			}

			else {
				$(this).css({
					'left':  '+=1px'
				});
			}

			if (positionTop + $(this).height() > initialTop + $(this).height() + boxSize || 
				positionTop < initialTop - boxSize){
				$(this).data('direction').top = !directionTop;
			}

			if (positionLeft + $(this).width() > initialLeft + $(this).width() + boxSize || 
				positionLeft < initialLeft - boxSize){
				$(this).data('direction').left = !directionLeft;
			}
		});
	}

	animate();
};

$(document).ready(function(){
	var app = new App();
});