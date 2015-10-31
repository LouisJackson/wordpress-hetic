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
	this.window = $(window);
	
	this.$.randomTitle.attr('href',this.$.mainContainer.attr('data-random'));	

	this.initEvents();

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

var app = new App();