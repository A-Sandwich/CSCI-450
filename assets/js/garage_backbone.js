var Garage = Backbone.Collection.extend({
	model: Car,
	url: 'http://novusgarage.x10.mx/user_profile.php'
}); 

var Car = Backbone.Model.extend({
	
	initialize: function(){
		console.log('Car has been initialized!');
	},
	
	defaults: function(){
		return {
			make: '',
			model: '',
			nickName: '',
			odometer: -1,
			pid: -1,
			selected: '',
			fuelEconomy: -1 
		};
	}
	
});




