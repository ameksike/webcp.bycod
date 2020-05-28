var Bycod = Bycod || {};
Bycod.router = Bycod.router || {};
Bycod.router = {
	url: function(index=false){
		return window.location.pathname.substring(0, window.location.pathname.lastIndexOf('index.php') + (index ? 9 : 0));
	},
	module: function(module){
		return this.url() + "lib/" + module;
    },
    action: function(module){
		return this.url(true) + "/" + this.idiom() + module;
	},
	idiom: function(){
		if(!Bycod.idiom || !Bycod.idiom.id) return '';
		return Bycod.idiom.id + "/";
	}
}
