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
	this.$.menuTitle        = this.$.mainContainer.find('.title');
	this.window 	 	 	= $(window);

	this.animationId;
	
	this.$.randomTitle.attr('href',this.$.mainContainer.attr('data-random'));	
	this.initEvents();
	this.resizeTip();
	this.randomizeIntro();

	if (this.$.body.hasClass('category')) {
		this.initCat();
	}

	this.$.body.show();
};

App.prototype.initEvents = function() {
	var that = this;

	if (Cookies.get('visited')){
		this.removeIntro();
	}

	else {
		Cookies.set('visited', true, {expires: 7});
	}

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

	this.$.menuTitle.on('click', function() {
		that.toggleActive(this);
	});

	this.window.load(function(){
		that.$.postsRows.each(function(){
			$(this).waypoint(function(direction){
				$(this.element).animate({'opacity': 1}, 500);
			}, {
				offset: $(window).height() / 1.1
			});
		});	
	});
};

App.prototype.updateStyle = function() {
	var windowPos = this.window.scrollTop();
	var containerPos = this.$.mainContainer.offset().top;

	if (windowPos >= containerPos && containerPos > 10) {
		this.removeIntro();
	}
};

App.prototype.removeIntro = function() {
	this.$.introHeader.hide();
	this.window.scrollTop(0);
	this.$.leftMenu.addClass('fixed');
	Waypoint.refreshAll();
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

App.prototype.randomizeIntro = function() {
	var width  	  = this.window.width() - this.$.backgroundImages.width(),
		height 	  = this.window.height() - this.$.backgroundImages.height(),
		that   	  = this;

	this.$.backgroundImages.each(function(){
		var randomTop  = Math.random() * (height - $(this).height()),
			randomLeft = Math.random() * (width - $(this).width()),
			speeds     = [0.1, 0.25, 0.4, 0.6];

		$(this).css({
			'top': randomTop,
			'left': randomLeft
		});

		$(this).data('initialPosition',{
			'top': randomTop,
			'left': randomLeft
		});

		$(this).data('direction',{
			'top': false,
			'bottom': true,
			'left': false,
			'right': true
		});

		$(this).data('topSpeed', speeds[Math.floor(Math.random() * speeds.length)]);
		$(this).data('leftSpeed', speeds[Math.floor(Math.random() * speeds.length)]);
	});

	this.animateIntro();
};

App.prototype.animateIntro = function() {
	var that   	  = this,
		container = 30,
		speeds    = [0.1, 0.25, 0.4, 0.6];

	function animate(){
		that.animationId = requestAnimationFrame(animate);
		update();
	};

	function update(){
		that.$.backgroundImages.each(function(){
			var top = $(this).position().top;
			var left = $(this).position().left;

			if (Math.abs(top - $(this).data('initialPosition').top) > container) {
				$(this).data('direction').top = !$(this).data('direction').top;
				$(this).data('direction').bottom = !$(this).data('direction').bottom;

				$(this).data('topSpeed', speeds[Math.floor(Math.random() * speeds.length)]);
			}

			if (Math.abs(left - $(this).data('initialPosition').left) > container) {
				$(this).data('direction').left = !$(this).data('direction').left;
				$(this).data('direction').right = !$(this).data('direction').right;

				$(this).data('leftSpeed', speeds[Math.floor(Math.random() * speeds.length)]);
			}

			if ($(this).data('direction').top) {
				$(this).css('top', '-='+$(this).data('topSpeed'));
			}
			else {
				$(this).css('top', '+='+$(this).data('topSpeed'));
			}
			if ($(this).data('direction').left) {
				$(this).css('left', '-='+$(this).data('leftSpeed'));
			}
			else {
				$(this).css('left', '+='+$(this).data('leftSpeed'));
			}
		});
	}

	animate();
};

App.prototype.toggleActive = function(title) {
	$(title).parent().toggleClass('active');
};

$(document).ready(function(){
	var app = new App();
});