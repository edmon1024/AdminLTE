<?php /*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2017 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license. */
    require "scripts/pi-hole/php/header.php";

$list = $_GET['l'];

if($list !== "white" && $list !== "black"){
    echo "Invalid list parameter";
    require "scripts/pi-hole/php/footer.php";
    die();
}

function getFullName() {
    global $list;
    if($list == "white")
        echo "Whitelist";
    else
        echo "Blacklist";
}
?>
<!-- Send list type to JS -->
<div id="list-type" hidden><?php echo $list ?></div>

<!-- Title -->
<div class="page-header">
    <h1><?php getFullName(); ?></h1>
</div>
<div class="row">
  <div class="col-md-6">
    <label for="ex1">Domain:</label>
    <input id="domain" type="text" class="form-control" placeholder="Add a domain (example.com)">
  </div>
  <div class="col-md-6">
    <label for="ex2">Comment:</label>
    <div class="form-group input-group">
      <input id="comment" type="text" class="form-control" placeholder="Include a comment (optional)">
      <span class="input-group-btn">
          <button id="btnAdd" class="btn btn-default" type="button">Add (exact)</button>
          <button id="btnAddWildcard" class="btn btn-default" type="button">Add (wildcard)</button>
          <button id="btnAddRegex" class="btn btn-default" type="button">Add (regex)</button>
          <button id="btnRefresh" class="btn btn-default" type="button"><i class="fa fa-sync"></i></button>
      </span>
    </div>
  </div>
</div>
<!-- Alerts -->
<div id="alInfo" class="alert alert-info alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Adding to the <?php getFullName(); ?>...
</div>
<div id="alSuccess" class="alert alert-success alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <span id="success-message"></span>
</div>
<div id="alFailure" class="alert alert-danger alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Failure! Something went wrong, see output below:<br/><br/><pre><span id="err"></span></pre>
</div>
<div id="alWarning" class="alert alert-warning alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    At least one domain was already present, see output below:<br/><br/><pre><span id="warn"></span></pre>
</div>


<!-- Domain List -->
<h3 id="h3-exact" hidden="true">Exact blocking</h3>
<ul class="list-group" id="list"></ul>
<h3 id="h3-regex" hidden="true"><a href="https://docs.pi-hole.net/ftldns/regex/overview/" target="_blank" title="Click for Pi-hole Regex documentation">Regex</a> &amp; Wildcard blocking</h3>
<ul class="list-group" id="list-regex"></ul>

<script src="scripts/pi-hole/js/list.js"></script>

<?php
require "scripts/pi-hole/php/footer.php";
?>
