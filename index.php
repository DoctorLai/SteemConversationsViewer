<?php
$id = $_GET['id'] ?? '';
$id2 = $_GET['id2'] ?? '';
$text = $_GET['text'] ?? '';
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="en-US">
<!--<![endif]-->
<head><meta charset="UTF-8">
<title>Steem Comment Conversations Viewer | View Steem Account Comment History Between Two Accounts</title>
<meta name='description' content='Steem Account Comment Viewer, Steem Comments Lookup, View Steem Account Comments History between Two Accounts'>
<meta name='keywords' content='Steem Comment Conversation, Steem Comment Lookup, Account Comments History'>
<link rel="alternate" hreflang="zh-CN" href="https://steemyy.com/steem-conversations-viewer/">
<link rel="canonical" href="https://steemyy.com/steem-conversations/">
<meta property="og:url" content="https://steemyy.com/steem-conversations/">
<meta property="og:image" content="https://justyy.com/png/whale.png">
<link href="/bs/css/bootstrap.min.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body><?php //@include('/var/www/helloacm.com/top-html.php');?>
<center>
<div class='mainbody'>
<h1>Steem Conversations Viewer</h1>
<p>Want to quickly locate your conversations between you and your friend on the steem blockchain? This tool will retrieve the conversations (comments) between two steem accounts.</p>
<form class='form-inline'>
<fieldset>
<legend>
Steem Account ID 1: <input type='text' id='steemid' style='width:300px;max-width:100%' class='form-control' placeholder='without @ - URL parameter ?id=' value='<?php echo htmlspecialchars($id);?>'><BR/>
Steem Account ID 2: <input type='text' id='steemid2' style='width:300px;max-width:100%' class='form-control' placeholder='without @ - URL parameter ?id2=' value='<?php echo htmlspecialchars($id2);?>'>
<BR/>
Text Contains: <input type='text' id='memoc' class='form-control' placeholder='contains text - URL parameter ?text=' value='<?php echo htmlspecialchars($text);?>' style="width:100%"><BR/>
<input style='background:green;color:yellow' type=button id=run class='form-control' value='Query'/>
<input style='background:green;color:yellow' type=button id=stop class='form-control' value='Stop'/>
<input style='background:green;color:yellow' type=button id=clearlog class='form-control' value='Clear'/>
<select id='sorttype' class='form-control'>
<option value=0>Latest First</option>
<option value=1>Oldest First</option>
</select>
<?php
@include('nodes.php');
?>
<BR/>
<div id='progress' style='width:100%;background-color:gray;text-align:right'><div id='bar' style='width:0%;background-color:green;color:white'>0%</div></div>
<div id='progress2' style='width:100%;background-color:gray;text-align:right'><div id='bar2' style='width:0%;background-color:green;color:white'>0%</div></div>
<div id='result'>
<table id="dvlist" class="sortable">
<thead><tr><th style='width:10%' class='sorttable_nosort'>From</th><th class='sorttable_nosort' style='width:10%'>To</th><th class='sorttable_nosort' style='width:10%'>Comment Link</th>
<th class='sorttable_nosort'>Conversations</th><th style='width:10%'>Time</th></tr></thead><tbody>
</table>
</div>
<textarea id=console class='form-control' style='width:100%;background-color:black;color:yellow' readonly rows=10></textarea>
</legend></fieldset>
</form>
<p align=left>
<BR/>
Created and Maintained by <a href='https://steemit.com/@justyy' target='_blank' rel='nofollow'>@justyy</a>. All rights Reserved &copy;, <?php echo date('Y');?>. 中文: <a hreflang="zh-CN" href="https://steemyy.com/steem-conversations-viewer/">Steem 帐号评论查询</a>
</p>
</div>
</center><script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"></script>
<script src="/js/sorttable.js"></script>
<script src="/js/functions.js"></script>
<script src="/js/conversations.js"></script>
<script src='https://cdn.steemjs.com/lib/latest/steem.min.js'></script>
</body></html>
