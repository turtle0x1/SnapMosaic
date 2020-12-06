<!-- The Gallery as lightbox dialog, should be a document body child element -->
<div
  id="blueimp-gallery"
  class="blueimp-gallery"
  aria-label="image gallery"
  aria-modal="true"
  role="dialog"
>
  <div class="slides" aria-live="polite"></div>
  <h3 class="title"></h3>
  <a
    class="prev"
    aria-controls="blueimp-gallery"
    aria-label="previous slide"
    aria-keyshortcuts="ArrowLeft"
  ></a>
  <a
    class="next"
    aria-controls="blueimp-gallery"
    aria-label="next slide"
    aria-keyshortcuts="ArrowRight"
  ></a>
  <a
    class="close"
    aria-controls="blueimp-gallery"
    aria-label="close"
    aria-keyshortcuts="Escape"
  ></a>
  <a
    class="play-pause"
    aria-controls="blueimp-gallery"
    aria-label="play slideshow"
    aria-keyshortcuts="Space"
    aria-pressed="false"
    role="button"
  ></a>
  <ol class="indicator"></ol>
</div>
<div id="snapBox" class="boxSlide">
    <div id="snapSplash">
        <div class="row">
            <div class="col-md-12">
                <h4 id="snapTitle"></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-dark mb-2">
                    <div class="card-body">
                        <p class="card-text" id="snapDescription"></p>
                    </div>
                </div>
                <div class="card bg-dark">
                    <div class="card-body">
                        <table class="table table-bordered table-dark" id="snapDetailsTable">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark">
                    <div class="card-body row" id="snapImageCard">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark">
                    <div class="card-header">
                        <h4>Apps</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-dark" id="snapAppTable">
                            <thead>
                                <tr>
                                    <th>Snap</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function loadSnapView(name)
{
    $(".boxSlide").hide();
    ajaxRequest('/api/Snaps/GetSnapController/get', "POST", {name: name}, (data)=>{
        $("#snapBox").show();
        let snap = makeToastr(data);

        $("#snapTitle").text(snap.title);
        $("#snapDescription").html(nl2br(snap.description));

        let snapDetailsTrs = "";

        snapDetailsTrs += `<tr><th>Installed</th><td>${moment(snap["install-date"]).format("llll")}</td></tr>`
        snapDetailsTrs += `<tr><th>Developer</th><td>${snap.developer}</td></tr>`
        snapDetailsTrs += `<tr><th>Version</th><td>${snap.version}</td></tr>`
        snapDetailsTrs += `<tr><th>Revision</th><td>${snap.revision}</td></tr>`
        snapDetailsTrs += `<tr><th>Base</th><td>${snap.base}</td></tr>`
        snapDetailsTrs += `<tr><th>Size</th><td>${formatBytes(snap["installed-size"])}</td></tr>`
        snapDetailsTrs += `<tr><th>Website</th><td><a target="_blank" href="${snap.website}">${snap.website}</a></td></tr>`

        $("#snapDetailsTable").empty().append(snapDetailsTrs);

        let snapAppsTrs = "";
        $.each(snap.apps, (_, app)=>{
            snapAppsTrs += `<tr><td>${app.snap}</td><td>${app.name}</td></tr>`
        });
        $("#snapAppTable > tbody").empty().append(snapAppsTrs)


        let snapImages = "";
        $.each(snap.media, (_, item)=>{
            if(item.type == "screenshot"){
                snapImages += `<a href="${item.url}" class="col-xs-12 col-lg-6 mb-2" title="Banana">
                    <img class="img-thumbnail" src="${item.url}" alt="Banana" />
                  </a>`
            }
        });
        $("#snapImageCard").empty().append(snapImages);

        document.getElementById('snapImageCard').onclick = function (event) {
          event = event || window.event
          var target = event.target || event.srcElement
          var link = target.src ? target.parentNode : target
          var options = { index: link, event: event }
          var links = this.getElementsByTagName('a')
          blueimp.Gallery(links, options)
        }
    });
}

</script>
