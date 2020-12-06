<style>
    svg {
        height: 250px;
        width: 250px;
        margin-left: auto;
        margin-right: auto;
        padding-top: .5rem !important;
    }

    .snapImage {
        height: 250px;
        width: 250px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div id="overviewBox" class="boxSlide">
    <div id="splash" class="row">
        <div class="col-md-4" id="dashCol1">
        </div>
        <div class="col-md-4" id="dashCol2">
        </div>
        <div class="col-md-4" id="dashCol3">
        </div>
    </div>
</div>
<script>

function loadOverview()
{
    ajaxRequest('/api/Snaps/GetOverviewController/get', "GET", {}, (data)=>{
        let snaps = makeToastr(data);
        let htmlCols = {"col1": "", "col2": "", "col3": ""};
        let x = 1;
        $.each(snaps, (_, snap)=>{
            let icon = "";

            if(snap.hasOwnProperty("icon")){
                if(snap.icon.startsWith("https://")){
                    icon = `<img class="card-img-top snapImage pt-2 text-center" src='${snap.icon}' alt="Card image">`
                }else if(snap["icon-is-png"]){
                    icon = `<img class="card-img-top snapImage pt-2 text-center" src='data:image/png;base64,${snap.icon}' alt="Card image">`
                } else{
                    icon = snap.icon;
                }
            }
            htmlCols[`col${x}`] += `<div class="card bg-dark">
                ${icon}
              <div class="card-body">
                <a href="#" data-name=${snap.name} class="card-title viewSnap">${snap.title}</a>
                <p class="card-text">
                    <i class="fas fa-road mr-2"></i>${snap["tracking-channel"]}
                    <br/>
                    <i class="fas fa-user mr-2"></i>${snap.publisher["display-name"]}
                </p>
              </div>
            </div>`
            x++;
            if(x > 3){
                x = 1;
            }
        });
        $("#dashCol1").html(htmlCols.col1);
        $("#dashCol2").html(htmlCols.col2);
        $("#dashCol3").html(htmlCols.col3);
    });
}

$("#splash").on("click", ".viewSnap", function(){
    loadSnapView($(this).data("name"));
});

</script>
