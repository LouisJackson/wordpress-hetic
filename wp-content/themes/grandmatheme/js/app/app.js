function App() {
	this.init();
}

App.prototype.init = function() {
	this.$ = {};
	this.$.mainContainer = $('.main-container');
	this.$.introHeader = $('.intro-header');
	this.$.home = $('body.home');
	this.$.body = $('body');
	this.$.leftMenu = this.$.mainContainer.find('nav');
	this.$.searchTitle = this.$.mainContainer.find('.menu-item-5 a');
	this.$.randomTitle = this.$.mainContainer.find('.menu-item-37 a');
	this.$.searchBox = this.$.mainContainer.find('nav form');
	this.$.categoryMenu = this.$.mainContainer.find('.categories .title');
	this.$.categories = this.$.mainContainer.find('.categories li a');
	this.$.postContainer = this.$.mainContainer.find('.post-container');
	this.$.postHeader = this.$.mainContainer.find('.post-container .post-header');
	this.$.postContent = this.$.mainContainer.find('.post-container .entry-content');
	this.window = $(window);
	
	this.$.randomTitle.attr('href',this.$.mainContainer.attr('data-random'));	

	this.initEvents();
	this.resizeTip();

	if (this.$.body.hasClass('category')) {
		this.initCat();
	}
}

App.prototype.initEvents = function() {

	var that = this;

	if (this.$.home.length > 0) {
		this.window.on('scroll', function() {
			that.updateStyle();
		});
	};

	this.$.searchTitle.on('click', function(e) {
		e.preventDefault();
		that.$.searchBox.fadeToggle();
	});

	$('.upvote-btn').on('click', function(){
		var event = this;
		that.getAjax(event);
	});

	$(window).on('resize', function(){
		that.resizeTip();
	})


}

App.prototype.updateStyle = function() {
	var windowPos = this.window.scrollTop();
	var containerPos = this.$.mainContainer.offset().top;
	if (windowPos >= containerPos && containerPos > 10) {
		this.$.introHeader.hide();
		this.window.scrollTop(0);
		this.$.leftMenu.addClass('fixed');
	}
}

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
}

App.prototype.getAjax = function(event) {
	var that = event;

	$.ajax({
	    type: 'post',
		url: 'http://'+ document.domain +'/wp-content/themes/grandmatheme/update-likes.php',
	    data: {
	    	tipId: $(that).attr('data-tipId')
	    },
	    success: function(data){
	    	$('.likes-count').html(data);
	    	$('.upvote-btn').addClass('active');
	    }
	});
}

App.prototype.resizeTip = function() {
	var containerHeight = this.$.postContainer.height();
	var titleHeight = this.$.postHeader.outerHeight();
	var newHeight = containerHeight-titleHeight;

	console.log(containerHeight, titleHeight);
	console.log(newHeight);
	this.$.postContent.outerHeight(newHeight);
}

var app = new App();