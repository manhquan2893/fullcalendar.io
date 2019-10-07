let createEventModal= new Vue({
	el:"#create-event-modal",
	data:{
		showPickViewer:false,
		users:[],
		searchQuery:'',
		chosenViewers:[],
		title:'',
		description:'',
		isPublic:'false'
	},
	computed:{
		// get users that have first character that is searchQuery 
		filteredUsers:function(){
			self=this
			return this.users.filter(function(el){
				return el.email.indexOf(self.searchQuery.toLowerCase())==0 || 
						el.email.indexOf(self.searchQuery.toUpperCase())==0;
			})
		},
		isChoose:function(){
			return this.chosenViewers.length>0
		}
	},
	created:function(){
		//call API for getting all users
		let self=this;
	    axios.get('users')
	    .then(function(res){

	    	let user_id=document.getElementById('user_id').innerHTML;
	        self.users=res.data.filter(function(el){
	    		return el.id != user_id	
	    	})
	    });
	    //end getting all users

	    
	},
	methods:{
		addViewer:function(viewer){
			let chosenViewers=this.chosenViewers;
			if (chosenViewers.indexOf(viewer)==-1) {
				this.chosenViewers.push(viewer)
			}
			else{
				alert('this user is added')
			}
			
		},
		removeViewer:function(viewer){
			this.chosenViewers= this.chosenViewers.filter(function(el){
				return el.id != viewer.id
			})
		},
		postEvent:function(){
			let self=this
			let user_id=document.getElementById('user_id').innerHTML;
			let starttime=document.getElementById('start-time').value;
			let endtime=document.getElementById('end-time').value;
			let startdate=document.getElementById('start-date').value;
			let enddate=document.getElementById('end-date').value;
			
			// change format to compare date to each other
			let start_date= startdate.split('-').reverse().join('-');
			let end_date= enddate.split('-').reverse().join('-');
			start_date= new Date(start_date);
			end_date= new Date(end_date);
			let during_date= end_date.getTime()-start_date.getTime();
			//end comparing date

			// compare starttime and endtime
			let start_time=starttime.replace(':','');
			let end_time=endtime.replace(':','');
			during_time=Number(end_time)-Number(start_time);
			// end comparing time
			
			if( !self.title || !self.description || !starttime || 
				!endtime || !startdate || !enddate){
				alert('all fields are required')
			}
			else if(during_date<0){
				alert('start date is after end date')
			}
			else if(during_date==0 && during_time<0){
				alert('start time is after end time')
			}
			else{
				axios.post('events',{
					title:self.title,
					description:self.description,
					starttime:document.getElementById('start-time').value,
					endtime:document.getElementById('end-time').value,
					startdate:document.getElementById('start-date').value,
					enddate:document.getElementById('end-date').value,
					viewerIds:self.getViewerIds(),
					user_id:user_id
				})
				location.reload(true);
			}
			
		},
		getViewerIds:function(){
			if (this.isPublic=='true') {
				let viewerIds=[];
				let chosenViewers=this.chosenViewers;
				for(let i=0;i<=chosenViewers.length-1;i++){
					viewerIds.push(chosenViewers[i].id)
				}
				return viewerIds;
			}
			else{
				return [];
			}
		}
	}
})

let editEventModal= new Vue({
	el:"#edit-event-modal",
	data:{
		showPickViewer:false,
		users:[],
		searchQuery:'',
		chosenViewers:[],
		title:'',
		description:'',
		isPublic:'false'
	},
	computed:{
		// get users that have first character that is searchQuery 
		filteredUsers:function(){
			self=this
			return this.users.filter(function(el){
				return el.email.indexOf(self.searchQuery.toLowerCase())==0 || 
						el.email.indexOf(self.searchQuery.toUpperCase())==0;
			})
		},
		isChoose:function(){
			return this.chosenViewers.length>0
		}
	},
	created:function(){
		//call API for getting all users
		let self=this;
	    axios.get('users')
	    .then(function(res){

	    	let user_id=document.getElementById('user_id').innerHTML;
	        self.users=res.data.filter(function(el){
	    		return el.id != user_id	
	    	})
	    });
	    //end getting all users

	    
	},
	methods:{
		addViewer:function(viewer){
			let chosenViewers=this.chosenViewers;
			if (chosenViewers.indexOf(viewer)==-1) {
				this.chosenViewers.push(viewer)
			}
			else{
				alert('this user is added')
			}
			
		},
		removeViewer:function(viewer){
			this.chosenViewers= this.chosenViewers.filter(function(el){
				return el.id != viewer.id
			})
		},
		postEvent:function(e){

			let self=this
			let user_id=document.getElementById('user_id').innerHTML;
			let title=$('#edit-event-modal #title').val();
			let description=$('#edit-event-modal #description').val();
			let starttime=$('#edit-event-modal #start-time').val();
			let endtime=$('#edit-event-modal #end-time').val();
			let startdate=$('#edit-event-modal #start-date').val();
			let enddate=$('#edit-event-modal #end-date').val();
			let id = e.currentTarget.getAttribute('data-event-id');
			// change format to compare date to each other
			let start_date= startdate.split('-').reverse().join('-');
			let end_date= enddate.split('-').reverse().join('-');
			start_date= new Date(start_date);
			end_date= new Date(end_date);
			let during_date= end_date.getTime()-start_date.getTime();
			//end comparing date

			// compare starttime and endtime
			let start_time=starttime.replace(':','');
			let end_time=endtime.replace(':','');
			during_time=Number(end_time)-Number(start_time);
			// end comparing time

			//console.log(user_id,title,description, starttime, endtime, startdate,enddate,id)
			if( !title || !description || !starttime || 
				!endtime || !startdate || !enddate){
				alert('all fields are required')
			}
			else if(during_date<0){
				alert('start date is after end date')
			}
			else if(during_date==0 && during_time<0){
				alert('start time is after end time')
			}
			else{
				axios.put('events/'+id,{
					id:id,
					title:title,
					description:description,
					starttime:starttime,
					endtime:endtime,
					startdate:startdate,
					enddate:enddate,
					viewerIds:self.getViewerIds(),
					user_id:user_id
				})
				.then(res=>console.log(res.data))
				location.reload(true);
			}
			
		},
		getViewerIds:function(){
			if (this.isPublic=='true') {
				let viewerIds=[];
				let chosenViewers=this.chosenViewers;
				for(let i=0;i<=chosenViewers.length-1;i++){
					viewerIds.push(chosenViewers[i].id)
				}
				return viewerIds;
			}
			else{
				return [];
			}
		}
	}
})

let personal_info= new Vue({
	el:'#personal-info',
	data:{
		currentView:'myEvents',
		allEvents:[]
	},
	watch:{
		currentView:'changeView'
	},
	methods:{
		changeView:function(){
			let user_id=document.getElementById('user_id').innerHTML;
			let currentEvents=[]
			//console.log(this.allEvents)
			if(this.currentView=='myEvents'){
				currentEvents=this.allEvents.filter(el=>el.user_id==user_id)
			}
			else if(this.currentView=='eventsShared'){
				currentEvents=this.allEvents.filter(el=>el.user_id!=user_id)	
			}
			else{
				currentEvents=this.allEvents
			}
			let calendarEvents=calendar.getEvents()
			for(let i=0;i<calendarEvents.length;i++){
				calendarEvents[i].remove()
			}
			
			for(let i=0;i<currentEvents.length;i++){
				calendar.addEvent({
					id:currentEvents[i].id,
		        	title:currentEvents[i].title,
					description:currentEvents[i].description,
		        	start:currentEvents[i].start,
		        	end:currentEvents[i].end,
		            color:currentEvents[i].color,
		            user_id:currentEvents[i].user_id,
		            user_name:currentEvents[i].user_name,
		            isFinished:currentEvents[i].isFinished
				})
			}
			
		}
	},
	created:function(){
		//call API for getting all events
		let self=this
		let currentUserId=document.getElementById('user_id').innerHTML;
		let currentUserName=document.getElementById('user_name').innerHTML;
		axios.get('events')
	    .then(function(res){
	        for(let i=0; i<res.data.length;i++){
	            // convert dd-mm-yyyy to yyyy-mm-dd
	            let startdate=res.data[i].startdate.split('-').reverse().join('-');
	            let enddate= res.data[i].enddate.split('-').reverse().join('-');
	            let starttime= res.data[i].starttime;
	            let endtime= res.data[i].endtime;
	            let start= startdate +'T'+starttime;
	            let end= enddate +'T'+endtime;
	            //console.log(start,end)
	            let title=res.data[i].title;
	            let description=res.data[i].description;
	            let id= res.data[i].id;
	            let isfinished=res.data[i].isfinished;
	            let color='';
	            let user_id=res.data[i].user_id;
	            let user_name= res.data[i].user_name;
	            if(user_id == currentUserId){
	            	color='#3685d4';
	            }
	            else{
	            	color='purple';
	            }
	            if (isfinished==1) {
	            	color='green';
	            }
	            self.allEvents.push({
		        	id:id,
		        	title:title,
					description:description,
		        	start:start,
		        	end:end,
		            color:color,
		            user_id:user_id,
		            user_name:user_name,
		            isFinished:isfinished
		        })

	        }
	        self.allEvents.push({
		        	title: 'VietNam Woman\'s Day',
		        	description: `Hey `+currentUserName+`, 
					Do you have any plan for your women ? 
		        	`,
		        	start:'2019-10-20T00:00',
		        	end:'2019-10-20T24:00',
		        	user_id:1,
		        	user_name: 'Admin',
		        	color:'red'
		        })
	    });
	    
	    //end calling API for all events
	}
})
// render my events when calendar loaded completely
setTimeout(function(){
    personal_info.changeView()
},600);

let event_box=new Vue({

})