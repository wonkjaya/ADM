<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "<?php echo get_site_url('get_datas');?>",
          dataType:"json",
          async: false
          }).responseText;
      var titleChart = "<?php echo ucfirst('Aktivitas '.$c->userdata); ?>";
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      var options = {
          title: titleChart,
          pointSize: 10,
          width: 900, 
          height: 540,
          
        };
      chart.draw(data, options);
    }

    </script>
    
	<div class="portlet-content nopadding" >
	<!-- CHART -->
            <div id="chart_div"></div>
            
              	<table width=100%>
		      <tr class="footer">
		        <td align="right">
					<!--  PAGINATION START  -->             
		            <div class="pagination">
		            <span class="previous-off">&laquo; Previous</span>
		            <a href="query_41878854" class="next">Next &raquo;</a>
		            </div>  
		        <!--  PAGINATION END  -->       
		        </td>
		      </tr>
		</table>
	</div>
