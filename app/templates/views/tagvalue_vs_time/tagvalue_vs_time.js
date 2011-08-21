var tag = 'latency@grej.roskilde-festival.dk'
var something = 'latency';
var interval = 10; //seconds
var range = 60*60*2; //seconds

var startkey = "[%22"+tag+"%22,"+(new Date().getTime() - range*1000)+"]";
var endkey = "[%22"+tag+"%22,"+(new Date().getTime())+"]";

var url = "/couchdb/data/_design/tagsdate/_view/tagsdate?startkey="+startkey+"&endkey="+endkey;
$.ajax({
    type: "GET",
    url: url,
    dataType: 'json',
    success: function(msg){
        console.log(msg.rows.length);
        var i=0;
        d=[];
        $.each(msg.rows, function(k,r){
            d.push([r.value.date, r.value.latency]); 
        });
        $.plot($('#'+viewid), [{data: d, color: 'red', bars: { show: true }}],{xaxis: { mode: "time" },yaxis:{min: 0, max: 10000}});
    }
});

var lastFetch = new Date().getTime();
    
function plotDelta(){
    var startkey = "[%22"+tag+"%22,"+(lastFetch)+"]";
    var endkey = "[%22"+tag+"%22,"+(new Date().getTime())+"]";
    
    var url = "/couchdb/data/_design/tagsdate/_view/tagsdate?startkey="+startkey+"&endkey="+endkey;
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        success: function(msg){
            console.log(msg.rows.length);
            var i=0;
            $.each(msg.rows, function(k,r){
                //d.shift();
                d.push([r.value.date, r.value.latency]);   
            });
            $.plot($('#'+viewid), [{data: d, color: 'red', bars: { show: true }}],{xaxis: { mode: "time" }, yaxis:{min: 0, max: 10000}});
        }
    });
    lastFetch = new Date().getTime();

}

window.setInterval(plotDelta,interval*1000);

