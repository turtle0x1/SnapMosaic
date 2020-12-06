function makeToastr(x) {
    if(!$.isPlainObject(x)){
        x = $.parseJSON(x);
    }

    if(x.hasOwnProperty("responseText")){
        x = $.parseJSON(x.responseText);
    }


    if(x.hasOwnProperty("state")){

        toastr[x.state](x.message);
    }
    return x;
}


function formatBytes(bytes,decimals) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
       dm = decimals || 2,
       sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
       i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// Adapted from https://stackoverflow.com/questions/4687723/how-to-convert-minutes-to-hours-minutes-and-add-various-time-values-together-usi
function convertMinsToHrsMins(mins) {
  let h = Math.floor(mins / 60);
  let m = mins % 60;
  h = h < 10 ? '0' + h : h;
  m = m < 10 ? '0' + m : m;
  m = parseFloat(m).toFixed(0);
  return `${h}:${m}`
}

function nanoSecondsToHourMinutes(nanoseconds) {
    return convertMinsToHrsMins(nanoseconds / 60000000000);
}


function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function ajaxRequest(url, method, data, callback){
    if (typeof userDetails == "object") {
        $.ajaxSetup({
            headers: userDetails
        })
    }

    $.ajax({
         type: 'POST',
         data: data,
         url: url,
         success: function(data, _, jqXHR){
             if(jqXHR.status == 205){
                 $.alert("its likely a host has gone offline, refresh the page");
                 return false;
             }
             callback(data);
         },
         error: function(data){
             if(data.status == 403){
                 location.reload();
             }
             callback(data);
         }
     });
}


function mapObjToSignleDimension(obj, keyToMap)
{
    let output = [];
    Object.keys(obj).map(function(key, index) {
       output.push(obj[key][keyToMap]);
    });
    return output;
}

function createBreadcrumbItemHtml(name, classes)
{
    return `<li class="breadcrumb-item ` + classes + `">` + name + `</li>`;
}

function setBreadcrumb(name, classes)
{
    $(".breadcrumb").empty().append(createBreadcrumbItemHtml(name, classes))
}

function addBreadcrumbs(names, classes, preserveRoot = true)
{
  if(preserveRoot){
      $(".breadcrumb").find(".breadcrumb-item:gt(0)").remove();
  }else{
      $(".breadcrumb").empty();
  }

  $(".breadcrumb").find(".active").removeClass("active");
  let items = "";

  $.each(names, function(i, item){
      items += createBreadcrumbItemHtml(item, classes[i]);
  })

  $(".breadcrumb").append(items)
}

function changeActiveNav(newActiveSelector)
{
    $("#mainNav").find(".active").removeClass("active");
    $("#mainNav").find(newActiveSelector).parent(".nav-item").addClass("active");
}

function makeNodeMissingPopup()
{
    $.confirm({
        title: "Node server isn't reachable!",
        content: `You can try <code> restarting the container</code> or <code>pm2 restart all</code>
            <br/>
            <br/>
            Without the node server you won't be able to get operation updates or
            connect to container consoles`,
        theme: 'dark',
        buttons: {
            ok: {
                btnClass: "btn btn-danger"
            }
        }
    });
}

var hostStatusChangeConfirm = null;

function makeServerChangePopup(status, host)
{
    if(hostStatusChangeConfirm !== null && hostStatusChangeConfirm.isOpen()){
        hostStatusChangeConfirm.close();
    }

    let message = "";
    if(status == "offline"){
        message = `If there any requests related to hosts running you
          may need to wait 30 seconds and refresh the page`;
    }else{
        message = "Host is now online"
    }

    hostStatusChangeConfirm = $.confirm({
        title: `${host} is ${status}!`,
        content: message,
        theme: 'dark',
        buttons: {
            ok: {
                btnClass: "btn btn-danger"
            }
        }
    });
}

function getSum(total, num) {
    return parseInt(total) + parseInt(num);
}

var scalesBytesCallbacks = {
  yAxes: [{
    ticks: {
      callback: function(value, index, values) {
          return formatBytes(value);
      }
    }
  }]
};

var toolTipsBytesCallbacks = {
    callbacks: {
        label: function(value, data) {
            return formatBytes(data.datasets[value.datasetIndex].data[value.index]);
        }
    }
};

var monthsNameArray = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

https://stackoverflow.com/questions/1484506/random-color-generator/32124533
function randomColor(format = 'hex') {
    return '#2ecc71'
    const rnd = Math.random().toString(16).slice(-6);
    if (format === 'hex') {
        return '#' + rnd;
    }
    if (format === 'rgb') {
        const [r, g, b] = rnd.match(/.{2}/g).map(c=>parseInt(c, 16));
        return `rgb(${r}, ${g}, ${b})`;
    }
}
