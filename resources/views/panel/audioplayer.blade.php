
<div class="music-player d-none">
  <div class="info">
    
    <div class="left">
     <!-- <a href="javascript:;" class="icon-shuffle"></a>
      <a href="javascript:;" class="icon-heart"></a> -->
    </div>
    
    <div class="center">
      <div class="jp-playlist">
        <ul>
          <li></li>
        </ul>
      </div> 
    </div>
    
    <div class="right">
      <!-- <a href="javascript:;" class="icon-repeat"></a>
      <a href="javascript:;" class="icon-share"></a> -->
    </div>
    
    <div class="progress"></div>
    
  </div>
      
  <div class="controls">
    <div class="current jp-current-time">00:00</div>
    <div class="play-controls">
      <!-- <a href="javascript:;" class="icon-previous jp-previous" title="previous"></a> -->
      <a href="javascript:;" class="icon-play jp-play" title="play"></a>
      <a href="javascript:;" class="icon-pause jp-pause" title="pause"></a>
     <!-- <a href="javascript:;" class="icon-next jp-next" title="next"></a> -->
    </div>
    <div class="volume-level">
      <a href="javascript:;" class="icon-volume-up" title="max volume"></a>
      <a href="javascript:;" class="icon-volume-down" title="mute"></a>
    </div>
  </div>
  
  <div id="jquery_jplayer" class="jp-jplayer"></div>
  
</div>
<div class="bg-light d-flex justify-content-center waveplayer">
<div id="wave">
    <input type="range"  value="0" step="0.1" onchange="changeCurrentTime(this.value)" id="progress">  
    <div id="played"></div>
</div>
</div>
  <div class="circleplay m-auto" onclick="playAudio()">
    <i class="fa fa-play " id="playericon"></i>
  </div>
