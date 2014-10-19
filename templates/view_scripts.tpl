{literal}
        <script type="text/javascript">
function RemoveURL(URL,ID,H)
{

        var combinedObj = {'password': $("#edit_password").val(), 'url': URL, 'update': 'remove_url', 'ID': ID, 'hash': H };
        var str = "hello";
        $.ajax({
type: "POST",
url: "{/literal}{$PROTO}://{$FQDN}{literal}/update_pac.php",
data: combinedObj,
contentType: "application/x-www-form-urlencoded",
success: function(msg)
{
var jsonMsg = $.parseJSON(msg);
if(jsonMsg.success == 'ok')
{
result = '<div id="notif" class="notification_ok">URL removed, it will take up to 5 minutes for all proxy servers to update.</div>';
$("#row-"+ID).fadeOut(2000);
}
else
{
result = '<div class="alert alert-danger">' + jsonMsg.message +'</div>'
}
$('#note').html(result);
window.setInterval(function(){$('#notif').fadeOut(2000); window.clearInterval(this);}, 5000);
},
error: function(a, b, c)
{
        console.log(a);
        console.log(b);
        console.log(c);
}
});
}

function AddURLs(H)
{
        var combinedObj = {'password': $("#edit_password").val(), 'urls': $("#urls").val(), 'update': 'add_url', 'hash': H };
        $.ajax({
type: "POST",
url: "{/literal}{$PROTO}://{$FQDN}{literal}/update_pac.php",
data: combinedObj,
contentType: "application/x-www-form-urlencoded",
success: function(msg)
{
var jsonMsg = $.parseJSON(msg);
if(jsonMsg.success == 'ok')
{
result = '<div class="notification_ok">Your additional URLs have been added, it will take a few minutes for all PAC and proxy servers to update.</div>';
}
else
{
result = '<div class="alert alert-danger">' + jsonMsg.message +'</div>'
}
$('#note').html(result);
},
error: function(a, b, c)
{
console.log(a);
console.log(b);
console.log(c);
}
});

}

function PushToS3(H)
{
        var combinedObj = {'hash': H };
        $.ajax({
type: "POST",
url: "{/literal}{$PROTO}://{$FQDN}{literal}/put_to_s3.php",
data: combinedObj,
contentType: "application/x-www-form-urlencoded",
success: function(msg)
{
var jsonMsg = $.parseJSON(msg);
if(jsonMsg.success == 'ok')
{
result = '<div class="notification_ok" style="text-transform: none !important;">Your PAC has been pushed to S3 and your URL is: <a href="'+jsonMsg.url+'">'+ jsonMsg.url+ '</a></div>';
}
else
{
result = '<div class="alert alert-danger">' + jsonMsg.message +'<br/>Contact <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a> for assistance.</div>'
}
$('#note').html(result);
}
});

}

</script>
{/literal}
