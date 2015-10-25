function App() {
	this.init();
}

App.prototype.init = function() {
	this.$ = {};
	this.$.mainContainer = $('.main-container');
	this.$.introHeader = $('.intro-header');
	this.$.leftMenu = this.$.mainContainer.find('nav');
	this.window = $(window);

	this.initEvents();
}

App.prototype.initEvents = function() {

	var that = this;

	this.window.on('scroll', function() {
		that.updateStyle();
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