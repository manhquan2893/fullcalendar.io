<div id="edit-event-modal" class="mymodal" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit event</h5>
        <button type="button" class="close btn-close-modal"  >
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="eventTitle" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description"></textarea>
        </div>
        <div class="datetime">
          <div class="label">From:</div> 
          <div>
          <input type="text" class="form-control timepicker" id="start-time">
          </div>
          <div><input class="form-control datepicker" type="text" id="start-date"></div>
        </div>
        <div class="datetime">
          <div class="label">To:</div> 
          <div>
          <input type="text" class="form-control timepicker" id="end-time">
          </div>
          <div><input class="form-control datepicker" type="text" id="end-date"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnEditEvent">Edit event</button>
      </div>
    </div>
</div>