<img style="width:80%;" src="//{$FQDN}/img/create-shard.jpg" alt="computer servers" title="Graphic depicting some servers in a data center" />

<h2>Accessing the API</h2>
<ul>
<li>Access to the API is controlled by having an API key and signing requests.</li>
<li>To generate a new API key you can issue a command similar to; {literal}<code>curl https://packetflagon.is/api/create -d "{'domain':'YOURSERVERNAME.TLD','contact':'youremail@YOURSERVERNAME.TLD'}"</code>{/literal}</li>
<li>Done!</li>
</ul>

<h2>API Spec</h2>
<table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>
            Endpoint
          </th>
	  <th>
	    Description
	  </th>
          <th>
            Method
          </th>
          <th>
            Payload
          </th>
          <th>
            Response
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>/acl/</th>
	  <td>List of IP acls</td>
          <td>GET</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>
	<tr>
          <th>/bw/</th>
	  <td>Reports current bandwidth usage of the specified proxy</td>
          <td>POST</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>

	<tr>
          <th>/create_pac/</th>
          <td>Creates a new PAC file</td>
          <td>POST</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>

	<tr>
          <th>/get_pac/</th>
          <td>Gets the raw contents of a PAC file</td>
          <td>GET</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>

	<tr>
          <th>/push_to_s3/</th>
          <td>Pushes the specified PAC file to an S3 bucket and returns the URL</td>
          <td>POST</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>

	<tr>
          <th>/proxymeta/</th>
          <td>Gets information such as current bandwidth usage from the proxy servers</td>
          <td>GET</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>

	<tr>
          <th>/add_url_to_pac/</th>
          <td>Adds a new URL to an existing PAC config</td>
          <td>POST</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>

	<tr>
          <th>/remove_url_from_pac/</th>
          <td>Removes a URL from an existing PAC config</td>
          <td>POST</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>
	
	<tr>
          <th>/create/</th>
          <td>Creates an API key</td>
          <td>POST</td>
          <td>JSON</td>
          <td>JSON</td>
        </tr>

      </tbody>
    </table>
