<div id="create-event-modal" class="mymodal" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create a new event</h5>
        <button type="button" class="close btn-close-modal"  >
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="eventTitle" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="title" 
            autocomplete="off" v-model="title">
        </div>
        <div class="form-group">
            <label for="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" v-model="description" autocomplete="off"></textarea>
        </div>
        <div class="datetime">
          <div class="label">From:</div> 
          <div class="datetime-box">
            <div>
            <input type="text" class="timepicker" id="start-time" autocomplete="off">
            </div>
            <div><input class="datepicker" type="text" id="start-date" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="datetime">
          
            <div class="label">To:</div> 
            <div class="datetime-box">
            <div>
            <input type="text" class="timepicker" id="end-time" autocomplete="off">
            </div>
            <div><input class="datepicker" type="text" id="end-date" autocomplete="off"></div>
          </div>
        </div>
        <div class="public">
          <input type="radio" v-model="isPublic" value="false" id="private" >
          <label for="private">Private</label>
          <p>Only me can see</p>
        </div>

        <div class="public">
          <input type="radio"  v-model="isPublic" value="true" id="public" 
          @click="showPickViewer=true">
          <label for="public">Public</label>
          <p v-if='isChoose==false'>Choose people Who can see</p>
          <p v-if='isChoose==true '><i class="fas fa-check" style="color:green;"></i> Chose viewers</p>
        </div>
        
        <div id="pickViewer" v-if="showPickViewer">
          <div class="content">
            <nav >
              <button @click="showPickViewer=false" class="closePickViewer"><i class="fas fa-times"></i></button>
            </nav>
            <div class="header">
              <label>Who would see this event?</label>
              <div class="list-viewer-item">
                <div class="viewer-item" v-for="chosenViewer in chosenViewers">
                  @{{chosenViewer.name}}
                  <button @click="removeViewer(chosenViewer)"><i class="fas fa-times" ></i></button>
                </div>
              </div>
              <input type="area" placeholder="search by Email" v-model="searchQuery">
            </div>
            <div class="listViewers">
              <ul>
                <li v-for="(filteredUser,index) in filteredUsers" :key="index" @click="addViewer(filteredUser)">
                  <div class="user-item">
                    <p style="font-size: 18px;">@{{filteredUser.name}}</p>
                    <p>@{{filteredUser.email}}</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div id="user_id" style="display: none;">{{ auth()->user()->id }}</div>
        <div id="user_name" style="display: none;">{{ auth()->user()->name }}</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnCreateEvent" @click='postEvent'>Create event</button>
      </div>
    </div>
</div>