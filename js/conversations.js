$(document).ready(function() {
    var running = false;
  // sorttable.makeSortable(document.getElementById("dvlist"));
  function updateProgress(dom, p) {
      if (p < 0) p = 0;
      if (p >= 99) p = 100;
      dom.css('width', p + '%'); 
      dom.html(p + '%');
  }
  
  // the console on the page
  function log(msg) {
    var t = $('#console').val();
    var ccc = $('#console');  
    ccc.val(t + "\n" + msg);
    ccc.scrollTop(ccc[0].scrollHeight);     
  }
  steem.api.setOptions({ url: "https://api.steemit.com" });
  
  function steem_url(id) {
    return "<a target=_blank rel=nofollow href='https://steemit.com/@" + id + "'>@" + id + "</a>";
  }

  // get the history between two accounts with limits
  function getHistory(dom, account, account2, total, from, limit) {
    if (from < limit) {
      limit = from;
    }
    steem.api.getAccountHistory(account, from, limit, function (err, result) {
      if (err) {
        log(err);
        return;
      }
      if (running == false) return; // only 1 instance please
      var cont = from > 0;
      result.forEach(function (tx) {
        var op = tx[1].op;
        var op_type = op[0];
        var op_value = op[1];
  
        if (running == false) return; // stop button is clicked.
        var timestamp = tx[1].timestamp;
                          
        var memo =  $('#memoc').val().trim();
        // narrow down the comments - ignore the revisions
        if ((op_type == "comment") && (op_value.author == account2) && (!op[1].body.startsWith("@@")) && (op[1].body.includes(memo))) {              
  
              log(tx[1].timestamp + ": @" + account + " says to " + " @" + account2 + ": " + op[1].body);
              
              var sorttype = $('#sorttype').val();
              
              var row = '<tr><td>' + steem_url(op[1].author) + '</td><td>' + steem_url(account) + "</td>" + 
              '<td class=overflow-wrap-hack><a target=_blank rel=nofollow href="https://steemit.com/@' + op[1].author + "/" + op[1].permlink + '">' + 'URL</a></td><td>' + op[1].body.replaceAll(memo, "<span style='background:yellow;color:blue'>" + memo + "</span>") + '</td>' + '<td>' + timestamp.replace("T", " ") + '</td></tr>';
              
              if (sorttype == '1') { // sorting type add front or rear
                $('#dvlist').first().prepend(row);
              } else {
                $('#dvlist').last().append(row);              
              }
              // sorttable.makeSortable(document.getElementById("dvlist"));
          }        
      });
      if (cont) {      
        if (running == false) return;
        var fromOp = from - limit;
        if (fromOp < limit) {
          limit = fromOp;
        }      
        var per = (100 - 100* (from - limit) / total).toFixed(2);
        // update the UI bar
        updateProgress(dom, per);
        log(per + "% Getting ops starting from " + (from - limit));
        getHistory(dom, account, account2, total, fromOp, limit);
      } else {
        updateProgress(100);
        log('Done!');
      }
    });
  }
  
  function getTransfer(dom, account, account2) {
    steem.api.getAccountHistory(account, -1, 0, function (err, result) {
        var opCount = result[0][0];
        log("Total transaction to process: " + opCount);
        if (running == false) return;
        getHistory(dom, account, account2, opCount, opCount, 1000);
    });
  }  
  $('input#run').click(function() {
    if (running) {
        alert('Please Stop Ongoing Search First.');
        return;   
    }
    var node_url = $("#nodes").val();
    if (!node_url) node_url = "https://api.steemit.com";
    steem.api.setOptions({ url: node_url });
    var acc = $('#steemid').val().trim().toLowerCase().replace("@", "");
    var acc2 = $('#steemid2').val().trim().toLowerCase().replace("@", "");
    if (steem.utils.validateAccountName(acc) == null && steem.utils.validateAccountName(acc2) == null) {
        running = true;
        getTransfer($("#bar"), acc, acc2);      
        getTransfer($("#bar2"),acc2, acc);
    } else {
        alert('Invalid Steem ID given.');
    }    
  });
  
  $('#clearlog').click(function() {
    $('#console').val('');
    $('#dvlist tbody').html("");
  });  
  
  $('#stop').click(function() {
    running = false;
    //updateProgress(0);
    log('Stopped.');
  });   
});
