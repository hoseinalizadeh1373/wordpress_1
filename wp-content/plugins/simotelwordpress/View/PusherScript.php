<?php
function btnShow(){
echo '
  
  <p id="pp">
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
  <button type="button" class="btn btn-primary" id="toastbtn">Show Toast</button>
  
  <div class="toast" data-bs-autohide="true">
    <div class="toast-header">
      <strong class="me-auto">Toast Header</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body">
      <p>Some text inside the toast body</p>
    </div>
  </div>
  ';
  ?>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
 document.getElementById("toastbtn").onclick = function() {
  var toastElList = [].slice.call(document.querySelectorAll('.toast'))
  var toastList = toastElList.map(function(toastEl) {
    return new bootstrap.Toast(toastEl)
  })
  toastList.forEach(toast => toast.show()) 
}

//  document.getElementById("pp").style.visibility='hidden';
 let p = document.getElementById("pp");
 p.style.visibility='hidden';
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('ee78b89bab3d3590ede6', {
      cluster: 'us2'
    });
  
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      
      var toastElList = [].slice.call(document.querySelectorAll('.toast'))
  var toastList = toastElList.map(function(toastEl) {
    return new bootstrap.Toast(toastEl)
  })
  toastList.forEach(toast => toast.show()) 
  alert(JSON.stringify(data));
  document.getElementsByClassName('toast-body')[0].textContent = JSON.stringify(data);
    });
  </script>
  <?php

}
