
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    // import Draggable object from interaction
    var Draggable = FullCalendarInteraction.Draggable;
    // intitialize a Draggabel object with calendarEl that hold the elements
    // that you want to be draggable
    var draggableEl = new Draggable(calendarEl,{
        itemSelector: '.fc-event',
        eventData: function(eventEl) {
            return {
              title: eventEl.innerText,
              create:false
            };
          }
    });
    //init calendar object
    window.calendar = new FullCalendar.Calendar(calendarEl, {
        // use view plugin
        plugins: ['dayGrid', 'interaction'],
        
        eventRender: function(info) {
            var el=info.el;
            var eventId=info.event.id;
            setEventIdToEl(el,eventId);
        },
        eventClick:function(eventClickInfo){
            var event=eventClickInfo.event; 
            var el= eventClickInfo.el;
            // get coordinates of el
            var rect = el.getBoundingClientRect();
            var bottom= rect.bottom;
            var left= rect.left;
            showEventBox(event,left,bottom);
        },
        select:function(info){
            var start=info.start;
            var end=info.end;
            showCreateEventModal(start,end);
        },
        eventDrop:function(eventDropInfo ){
            var start=eventDropInfo.event.start;
            var end=eventDropInfo.event.end;
            var startDate = moment(start).format('DD-MM-YYYY');
            var endDate = moment(end).format('DD-MM-YYYY');
            var id= eventDropInfo.event.id;
            axios.put('api/events/'+id,{
                startdate:startDate,
                enddate:endDate
            });
        },
        selectable:true,
        editable: true,
        droppable:true,
        eventLimit: true,
        timezone:'local',
        eventTextColor:'white',
        events: []
    });
    calendar.render();
    
    //use library
    $(".timepicker").timepicker({
        timeFormat:'H:i',
        step:'15',
        disableTextInput:true
    });
    $(".datepicker").datepicker({
        format:'dd-mm-yyyy',
        todayHightlight:'true'
    });

   //end using library



    //listen globle events
    $("#backgroundOverlay").click(function(){
        document.getElementsByClassName("toggle")[0].style.display="none";
        document.getElementById("backgroundOverlay").style.display="none";
    });
    $("#event-box #close").click(function(){
        document.getElementsByClassName("toggle")[0].style.display="none";
        document.getElementById("backgroundOverlay").style.display="none";
    });

            //start toggling modal
    var mymodal= document.getElementsByClassName("mymodal");

    for (let i = 0; i < mymodal.length; i++) {
        mymodal[i].addEventListener('click',function(event){
            if(event.target==this){
                this.style.display="none";
            }
        });
    }
    var btnCloseModal= document.getElementsByClassName("btn-close-modal");
    for (let i = 0; i < btnCloseModal.length; i++) {
        btnCloseModal[i].addEventListener('click',function(){
            mymodal[i].style.display="none";
        });
    }
            // end toggling modal

    $("#btnShowEditEvent").click(function(){
        var id=$(this).attr("data-event-id");
        var event=calendar.getEventById(id);
        var title=event.title;
        var des= event.extendedProps.description;
        var startDate = moment(event.start).format('DD-MM-YYYY');
        var endDate = moment(event.end).format('DD-MM-YYYY');
        var startTime = moment(event.start).format('HH:mm');
        var endTime = moment(event.end).format('HH:mm');
        $("#edit-event-modal #title").val(title);
        $("#edit-event-modal #description").val(des);
        $("#edit-event-modal #start-date").val(startDate);
        $("#edit-event-modal #end-date").val(endDate);
        $("#edit-event-modal #start-time").val(startTime);
        $("#edit-event-modal #end-time").val(endTime);
        showEditEvent(id);
        
    });
    $("#btnCreateEvent").click(function(event){
        var title= $("#create-event-modal #title").val();
        var description= $("#create-event-modal #description").val();
        var startdate= $("#create-event-modal #start-date").val();
        var enddate= $("#create-event-modal #end-date").val();
        var starttime= $("#create-event-modal #start-time").val();
        var endtime= $("#create-event-modal #end-time").val();
        if(!title || !description || !startdate || !enddate || !starttime || !endtime)
        {
            alert('all fields is required !');
        }    
        else{
            axios.post('api/events',{
                title:title,
                description:description,
                startdate:startdate,
                enddate:enddate,
                starttime:starttime,
                endtime:endtime,
                user_id:1
            })
            .then(function(res){
                console.log(res)
                var startdate=res.data.startdate.split('-').reverse().join('-');
                var enddate= res.data.enddate.split('-').reverse().join('-');
                var starttime= res.data.starttime;
                var endtime= res.data.endtime;
                var start= startdate +'T'+starttime;
                var end= enddate +'T'+endtime;
                var id=res.data.id;
                var title=res.data.title;
                var description= res.data.description;
                calendar.addEvent({
                    id:id,
                    title:title,
                    description:description,
                    start:start,
                    end:end
                });
            });
        }
    });
    $("#btnDeleteEvent").click(function(){
        var result= confirm("Do you want to delete this event?");
        var id= $(this).attr("data-event-id");
        if(result){
            axios.delete('api/events/'+id);
            calendar.getEventById(id).remove();
        }
    });
    $("#btnEditEvent").click(function(){
        var title= $("#edit-event-modal #title").val();
        var description= $("#edit-event-modal #description").val();
        var startdate= $("#edit-event-modal #start-date").val();
        var enddate= $("#edit-event-modal #end-date").val();
        var starttime= $("#edit-event-modal #start-time").val();
        var endtime= $("#edit-event-modal #end-time").val();
        var id=$(this).attr("data-event-id");
        console.log(title,description,startdate,enddate,starttime,endtime,id)
        axios.put('api/events/'+id,{
            title:title,
            description:description,
            startdate:startdate,
            enddate:enddate,
            starttime:starttime,
            endtime:endtime,
            id:id
        })
        .then(function(res){
                var startdate=res.data.startdate.split('-').reverse().join('-');
                var enddate= res.data.enddate.split('-').reverse().join('-');
                var starttime= res.data.starttime;
                var endtime= res.data.endtime;
                var start= startdate +'T'+starttime;
                var end= enddate +'T'+endtime;
                var id=res.data.id;
                var title=res.data.title;
                var description= res.data.description;
                var event=calendar.getEventById(id);
                console.log(title,description,startdate,enddate,starttime,endtime,id,event)
                event.setProp('title',title);
                event.setProp('start',start);
                event.setProp('end',end);
                event.setExtendedProp('description',description);
        });
    });
    $("#btnGetFinished").click(function(){
        //toggle color of check
        //toggle color of event
        $(this).toggleClass('greenCheck');
        var isFinished='';
        var eventColor;
        if($(this).hasClass('greenCheck')){
            isFinished='1';
            eventColor="green";
        }
        else{
            isFinished='0';
            eventColor='#3685d4';
        }
        var id=$(this).attr('data-event-id');
        axios.put('api/events/'+id,{
            isfinished:isFinished
        });
        calendar.getEventById(id).setProp('color',eventColor);
    })
    //end listening globle event

    



    // fire when render
    $("#btnCloseSuggestUser").click(function(){
        $("#suggestUser").hide();
    });

    // end fire when render    
    
    //call API for getting all events
    axios.get('api/events')
    .then(function(res){
        for(let i=0; i<res.data.length;i++){
            // convert dd-mm-yyyy to yyyy-mm-dd
            var startdate=res.data[i].startdate.split('-').reverse().join('-');
            var enddate= res.data[i].enddate.split('-').reverse().join('-');
            var starttime= res.data[i].starttime;
            var endtime= res.data[i].endtime;
            var start= startdate +'T'+starttime;
            var end= enddate +'T'+endtime;
            //console.log(start,end)
            var title=res.data[i].title;
            var description=res.data[i].description;
            var id= res.data[i].id;
            var isfinished=res.data[i].isfinished;
            console.log(isfinished);
            var color='';
            if(isfinished==0){
                color='#3685d4';
            }
            else{
                color='green';
            }
            calendar.addEvent({
                id:id,
                title:title,
                description:description,
                start:start,
                end:end,
                color:color
            })
        }
        
    })
    .catch(error => {
        console.log(error)
    });
    //end calling API for all events



    function setEventIdToEl(el,id){
        $(el).attr("data-event-id",id);
    }
    
    //functions for calling
    function showCreateEventModal(start,end){
        var createEventModal= document.getElementById("create-event-modal");
        var startDate = moment(start).format('DD-MM-YYYY');
        var endDate = moment(end).subtract(1,'days').format('DD-MM-YYYY');
        $("#create-event-modal #start-date").val(startDate);
        $("#create-event-modal #end-date").val(endDate);
        createEventModal.style.display="block";
    }
    function showEventBox(event,left,bottom){
        var title= event.title;
        var description= event.extendedProps.description;
        var startDate = moment(event.start).format('DD-MM-YYYY');
        var endDate = moment(event.end).format('DD-MM-YYYY');
        var startTime = moment(event.start).format('HH:mm');
        var endTime = moment(event.end).format('HH:mm');
        var color=event.backgroundColor;
        $("#event-box #title").text(title);
        $("#event-box #description").text(description);
        $("#event-box #from").text(startTime + " - "+ startDate);
        $("#event-box #to").text(endTime + " - "+ endDate);
        $("#event-box #btnShowEditEvent").attr("data-event-id",event.id);
        $("#event-box #btnDeleteEvent").attr("data-event-id",event.id);
        $("#event-box #btnGetFinished").attr("data-event-id",event.id);
        if (color=='green') {
            $("#event-box #btnGetFinished").addClass('greenCheck');
        }
        var eventBox=document.getElementById("event-box");
        var left=left+20;
        var bottom=bottom+10;
        eventBox.style.display="block";
        eventBox.style.left= left+'px';
        eventBox.style.top = bottom+'px';
        showBackgroundOverlay();
    }
    function showEditEvent(id){
        $("#btnEditEvent").attr("data-event-id",id);
        document.getElementById("edit-event-modal").style.display="block";
    }
    function showBackgroundOverlay(){
        document.getElementById("backgroundOverlay").style.display="block";
    }
   
}); 