function App() {
	this.init();
}

App.prototype.init = function() {
	this.$ = {};
	this.$.mainContainer = $('.main-container');
	this.$.introHeader = $('.intro-header');
	this.$.leftMenu = this.$.mainContainer.find('nav');
	this.$.searchTitle = this.$.mainContainer.find('.menu-item-5 a');
	this.$.randomTitle = this.$.mainContainer.find('.menu-item-37 a');
	this.$.searchBox = this.$.mainContainer.find('nav form');
	this.window = $(window);
	
	this.$.randomTitle.attr('href',this.$.mainContainer.attr('data-random'));	

	this.initEvents();
}

App.prototype.initEvents = function() {

	var that = this;

	this.window.on('scroll', function() {
		that.updateStyle();
	});

	this.$.searchTitle.on('click', function(e) {
		e.preventDefault();
		that.$.searchBox.fadeToggle();
	});	this.$.searchTitle.on('click', function(e) {
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

var app = new App();