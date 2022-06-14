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
  formData.append("durata", player.getDuration());
  postData('save_visualiz.php', formData);
}

// Avvia il video dal secondo giusto
function videoReady() {
  if (tempoVis != -1) player.seekTo(tempoVis, true);
  player.playVideo();
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



// Aggiunge una scelta etichetta aggiuntiva al form (massimo 3)
var nEtichette=1;
const groupBase=document.getElementById("etichette").innerHTML;
function additionalTag() {
  var group=document.getElementById("etichette");
  var selects=document.getElementsByClassName("custom-select");
  var cont=0;
  var values=new Array();
  for(var select of selects) {
    if(select.value!="-1") {
      cont++;
      values.push(select.value);
    }
  }
  if(nEtichette<3 && cont==selects.length) {
    group.innerHTML+=groupBase;
    selects=document.getElementsByClassName("custom-select");
    var i=0;
    for(var i=0; i<selects.length-1; i++) {
      selects[i].value=values[i];
    }
    nEtichette++;
  }
}



// Switch tra playlist likes pubblica e privata
function switchLikesPubbl() {
  var switchPubbl=document.getElementById("likesSwitch").checked;
  var formData = new FormData();
  formData.append("pubblica", switchPubbl);
  postData('likesPubblica.php', formData);
}



// Click della card del video o del bottone del canale
function cardOnClick(id, titolo, video, time, creator) {
  if (event.target.tagName.toLowerCase() == "button") {
    location.href = "canale.php?canale=" + creator;
  } else {
    location.href = "video.php?id=" + id + "&titolo=" + titolo + "&video=" + video + "&time=" + time;
  }
}

// Mostra e nasconde i contenuti della home
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

function sendComment() {
  if (event.key === 'Enter') {
    const videoID = urlParams.get('id');
    var comment = document.getElementById('commentText').value;
    document.getElementById('commentText').value = '';
    var formData = new FormData();
    formData.append("commentText", comment);
    formData.append("videoID", videoID);
    postData('sendComment.php', formData)
      .then((res) => {
      });
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

