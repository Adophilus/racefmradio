<?php
// Fetching all the Navbar Data
require "./includes/nav.inc.php"; ?>




<center>

  <h2>RaceFm Live Broadcasting </h2>

    <a href="#" onclick="listenLiveStream(this)" class="btn btn-info btn-lg">
      <span class="glyphicon glyphicon-record"></span> <span class="statusText">Click Here To Stream</span>
    </a>

    <a href="#" onclick="audioOnlyLiveStream(this)" class="btn btn-info btn-lg">
      <span class="glyphicon glyphicon-record"></span> <span class="statusText">Audio Only</span>
    </a>

  <p>
    <video width="320" height="240" width="320" height="240" id="player" controls>
      <source src="Forgetting_June_1.mp4" type="video/mp4">
       Your browser does not support the video tag.
    </video>
  </p>

</center>



<script src="http://localhost:3000/peerjs%401.3.1.min.js"></script>
<script src="http://localhost:3000/socket-io/socket.io.js"></script>
<script src="http://localhost:3000/watcher.js"></script>
<script type="text/javascript">
  let streaming = {
    video: null
  }
  let watcher
  let peerServer = { host: window.location.hostname, port: 3000, path: '/peerjs' }
  let video = document.querySelector("#player")

  function audioOnlyLiveStream (e) {
    if (streaming.video) {
      video.style.display = "none"
      $(e).find(".statusText").html("Enable video")
      streaming.video = false
    }
    else if (streaming.video === false) {
      video.style.display = "block"
      $(e).find(".statusText").html("Audio only")
      streaming.video = true
    }
  }

  function listenLiveStream (e) {
    if (!streaming.video) {
      watcher = new Watcher({ video, peerServer, socketIoServer: "ws://localhost:3000" })
      streaming.video = true
      $(e).find(".statusText").html("End Stream")
    }
    else {
      watcher.stop()
      streaming.video = null
      $(e).find(".statusText").html("Click Here To Stream")
    }
  }
</script>

<?php // Fetching all the Footer Data
require "./includes/footer.inc.php";
?>
