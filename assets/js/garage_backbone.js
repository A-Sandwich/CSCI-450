	var fuel = Backbone.Model.extend({
		initialize: function(){
			console.log('Car has been initialized!');
		},
		
		defaults: function(){
			return {
				date: '',
				milage: -1,
				price: 0.000,
				cost: 0.00,
				saved: false,
				car: -1
			};
		},
	});
	
	var fuelUps = Backbone.Collection.extend({
		model: fuel,
		url: 'http://novusgarage.x10.mx/user_profile.php'
	}); 
	
	addFuelUp = function(clicked){
		//debugger;
		
		for(key in myGarage.models){
			if(parseInt(clicked.target.name) == parseInt(myGarage.at(key).get('pid'))){
				fuelCollection = new fuelUps;
				newFuelUp = new fuel;
				newFuelUp.set('date', $('#fuelDate').val());
				newFuelUp.set('milage', $('#fuelMilage').val());
				newFuelUp.set('price', $('#fuelPrice').val());
				newFuelUp.set('cost', $('#fuelTotal').val());
				newFuelUp.set('car', myGarage.at(key).get('pid'));
				fuelCollection.push(newFuelUp);
				myGarage.at(key).set('collection', fuelCollection);
				
				syncData = JSON.stringify(fuelCollection);
			
				$.ajax({
				type: "POST",
				url: "assets/class/class_car.php",
				data: syncData,
				success: function(data){
					alert('sync!');
					console.log(syncData);
				}
			});
			};
			
			
		}
	};
	
	var Car = Backbone.Model.extend({
		
		initialize: function(){
			console.log('Car has been initialized!');
		},
		
		collection: fuelUps,
		
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
		},
		
	});
	
	selectCar = function(clicked){
		//debugger;
		//$('.car-active').removeClass('car-active');
		for(key in myGarage.models){
			myGarage.at(key).set('selected', '');
		};
	
		if(clicked.target.tagName == "IMG"){
			myGarage.at($(clicked.target).parent().index()).set('selected', 'car-active');
		}else{
			myGarage.at($(clicked.target).index()).set('selected', 'car-active');
		}
		garageView.render();
	};
	
	var Garage = Backbone.Collection.extend({
		model: Car,
		url: 'http://novusgarage.x10.mx/user_profile.php'
	}); 
	
	var carView = Backbone.View.extend({
		tagName: "div",
		className: "garage_templated",
		collection: Garage,
		el: "#templateLocation",
		test: function(){console.log('sdlfhja');},
		events:{
			//'click .repairCar': test
			//'click .repairCar': test1,
			'click .car': selectCar,
			'click .fuelUp': addFuelUp
		},	
		
		
		
		render: function(){
			var html = '<div class="jumbotron garage" style="overflow-x:auto;"><!--Users Garage-->';
			$(this.collection.models).each(function(){
				html +=_.template($('#jumobtron-content').html(), this.toJSON());
			});
			html += '</div>';
			if($('.car-active').index() != -1){
				html +=_.template($('#profile_form').html(), this.collection.at($('.car-active').index()).toJSON());
			}else{
				html +=_.template($('#profile_form').html(), this.collection.at(0).toJSON());
			}
			this.$el.html(html);
		},
	
	});
	
	
	
	
	

