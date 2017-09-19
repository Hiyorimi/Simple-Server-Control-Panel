<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Data Center | Servers list</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
  </head><body>
    <div id="wrapper">
      <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4 col-sm-offset-3">
          <h2>Servers list | <a href="#">Monitoring</a></h2> 
          <ol class="breadcrumb">
            <li>
              <a href="/">Your Data Center</a>
            </li>
            <li class="active">
              <strong>Server list</strong>
            </li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
          <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
              <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                  <div class="col-md-1">
                    <button type="button" id="refresh-btn" class="btn btn-white btn-sm">
                      <i class="fa fa-refresh"></i>Refresh</button>
                  </div>
                </div>
                <div class="server-list">
                  <table class="table table-hover" id="control-panel">
                    <tbody>
                        
			<?php
				include('config.php');
				foreach ($hosts as $host) {
					$number = intval(end(explode('.',$host)))-100;
					$server_name = sprintf('catseye-shaft-%03d',$number);
                      echo '<tr>
                        <td class="server-status">
				
			  <a class="btn btn-xs btn-info ping" data-service="ssh" data-port="22" data-ip="'.$host.'">ssh</a>
			  <a class="btn btn-xs btn-info ping" data-service="nagios" data-port="5666" data-ip="'.$host.'">nagios</a>
                        </td>
                        <td class="server-title">
                          '.$server_name.'
                          <br>
                          <small>'.$host.'</small>
                        </td>
                        <td class="server-actions">
                          <a class="btn btn-outline-secondary btn-sm reboot-btn" data-control-request="reboot"  data-service="Reboot" data-ip="'.$host.'"><i class="fa fa-repeat"></i> Reboot </a>
                          <a class="btn btn-outline-secondary btn-sm shutdown-btn" data-control-request="shutdown" data-service="Shutdown" data-ip="'.$host.'"><i class="fa fa-stop"></i> Shutdown </a>
                        </td>
                      </tr>';
				}
			?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="js/plugins/pace/pace.min.js"></script>
  

</body></html>
