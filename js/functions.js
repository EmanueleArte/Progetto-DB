/* Funzioni base */
function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function deleteCookie(name) {
  document.cookie = name + "= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
}

// ASYNC request
async function postData(url, data) {
  const res = await fetch(url, {
    method: "POST",
    body: data
  });
  return res;
}

var player;
var tempoVis;
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
// Ottiene secondo di riproduzione del video
function getCurrTime() {
  var currTime = player.getCurrentTime();
  return Math.trunc(currTime);
}

// Salva secondo di visualizzazione nel db
function saveVisual() {
  const videoID = urlParams.get('id');
  var formData = new FormData();
  formData.append("idVideo", videoID);
  formData.append("tempoVis", getCurrTime());
  urlParams.set("time", getCurrTime());
  postData('save_visualiz.php', formData);
}

function videoReady() {
  if (tempoVis != -1) player.seekTo(tempoVis, true);
  setInterval(saveVisual, 1000);
}

// This function creates an <iframe> (and YouTube player)
// after the API code downloads. onYouTubeIframeAPIReady
function onYouTubeIframeAPI() {
  const videoID = urlParams.get('video');
  tempoVis = urlParams.get('time');
  player = new YT.Player('ytplayer', {
    height: '360',
    width: '640',
    videoId: videoID,
    events: {
      'onReady': videoReady
      //'onStateChange': setInterval(getCurrTime, 1000),
    }
  });
}

// Salva il video tra i piaciuti
function refreshLike(idLike) {
  var likes = document.getElementById(idLike);
  var array = likes.innerHTML.split(" ");
  if (!likes.classList.contains("liked")) {
    array[0] = parseInt(array[0]) + 1;
    likes.innerHTML = array.join(" ");
    likes.classList.add("liked");
  } else {
    array[0] = parseInt(array[0]) - 1;
    likes.innerHTML = array.join(" ");
    likes.classList.remove("liked");
  }
}

// Salva il video tra i piaciuti
function addLikeVideo(idLike) {
  const videoID = urlParams.get('id');
  refreshLike(idLike);
  var formData = new FormData();
  formData.append("idVideo", videoID);
  postData('likeVideo.php', formData)
    .then((res) => {
    });
}



// Click della card del video o del bottone del canale
function cardOnClick(id, titolo, video, time, creator) {
  if (event.target.tagName.toLowerCase() == "button") {
    location.href = "canale.php?canale=" + creator;
  } else {
    location.href = "video.php?id=" + id + "&titolo=" + titolo + "&video=" + video + "&time=" + time;
  }
}

// mostra e nasconde i contenuti della home
function switchContent() {
  const contentSwitch=document.getElementById("contentSwitch");
  var tuttiPost=document.getElementById("postScrittiTutti");
  var tuttiVideo=document.getElementById("postVideoTutti");
  var seguitiPost=document.getElementById("postScrittiSeguiti");
  var seguitiVideo=document.getElementById("postVideoSeguiti");
  if(contentSwitch.checked) {
    seguitiPost.hidden=false;
    seguitiVideo.hidden=false;
    tuttiPost.hidden=true;
    tuttiVideo.hidden=true;
  } else {
    tuttiPost.hidden=false;
    tuttiVideo.hidden=false;
    seguitiPost.hidden=true;
    seguitiVideo.hidden=true;
  }
}



// CHAT
// Invia un messaggio chat salvandolo nel db
function sendMessageChat() {
  if (event.key === 'Enter') {
    const chatID = urlParams.get('chatID');
    var message = document.getElementById('messageText').value;
    document.getElementById('messageText').value = '';
    var formData = new FormData();
    formData.append("messageText", message);
    formData.append("chatID", chatID);
    postData('sendMessage.php', formData)
    .then((res) => {
    });
  }
}

// Invia un messaggio a un gruppo salvandolo nel db
function sendMessageGroup() {
  if (event.key === 'Enter') {
    const groupID = urlParams.get('groupID');
    var message = document.getElementById('messageText').value;
    document.getElementById('messageText').value = '';
    var formData = new FormData();
    formData.append("messageText", message);
    formData.append("groupID", groupID);
    postData('sendMessage.php', formData)
      .then((res) => {
      });
  }
}

