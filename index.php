<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <script type="text/javascript" charset="utf-8" src="./js/DataTables-1.9.4/media/js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="./js/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
    
    <title>DIPP Database</title>

    <style type="text/css">
      @import "./js/DataTables-1.9.4/media/css/demo_page.css";
      @import "./js/DataTables-1.9.4/media/css/demo_table.css";
    </style>
  </head>

  <?php
    include('./config.php');

    $SQL_STATEMENT = "SELECT * FROM display3";
    $result = mysqli_query($DATABASE_LINK, $SQL_STATEMENT);
    $count = 0;
  ?>

  <body id="dt_example">
    <div id="container">
      <h1>Disease-specific Imaging Probe Profiling (DIPP) Database</h1>
      <table cellpadding="0" cellspacing="0" border="0" class="display" id="table_id" width="100%" height="70%">
        <thead>
          <tr>
            <th><input type="text" name="tracer_name" value="Search Tracer Name" class="search_init" /></th>
            <th><input type="text" name="modality" value="Search Modality" class="search_init" /></th>
            <th><input type="text" name="target_protein" value="Search Target" class="search_init" /></th>
            <th><input type="text" name="gene_symbol" value="Search Gene Symbol" class="search_init" /></th>
            <th><input type="text" name="disease" value="Search Disease" class="search_init" /></th>
            <th><input type="text" name="roi_name" value="Search ROI" class="search_init" /></th>
            <th><input type="text" name="significant" value="Search Significant" class="search_init" /></th>
            <th><input type="text" name="overexpression" value="Search Overexpression" class="search_init" /></th>
            <th><input type="text" name="underexpression" value="Search Underexpression" class="search_init" /></th>
            <th><input type="text" name="subcellular_location" value="Search Subcellular Location" class="search_init" /></th>
          </tr>
          <tr>
            <th>Tracer Name</th>
            <th>Modality</th>
            <th>Target Protein</th>
            <th>Gene Symbol</th>
            <th>Disease</th>
            <th>Region of Interest (ROI)</th>
            <th>Significant</th>
            <th>Overexpression</th>
            <th>Underexpression</th>
            <th>Subcellular Location</th>
          </tr>
        </thead>

        <tbody>
          <?php
            $count = 0;
            while($count < mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
          ?>
          <?php
            if($row['significant'] == 'YES' && $row['overexpression'] == 'YES') {
          ?>
          <tr class="gradeX">
            <td><?php echo $row['tracer_name']; ?></td>
            <td class="center"><?php echo $row['modality']; ?></td>
            <td><?php echo $row['target_protein_name']; ?></td>
            <td class="center"><?php echo $row['gene_name']; ?></td>
            <td class="center"><?php echo $row['disease_name']; ?></td>
            <td class="center"><?php echo $row['roi_name']; ?></td>
            <td class="center"><?php echo $row['significant']; ?></td>
            <td class="center"><?php echo $row['overexpression']; ?></td>
            <td class="center"><?php echo $row['underexpression']; ?></td>
            <td class="center"><?php echo $row['main_location']; ?></td>
          </tr>
          <?php
              }
              else{
          ?>
          <tr class="gradeA">
            <td><?php echo $row['tracer_name']; ?></td>
            <td class="center"><?php echo $row['modality']; ?></td>
            <td><?php echo $row['target_protein_name']; ?></td>
            <td class="center"><?php echo $row['gene_name']; ?></td>
            <td class="center"><?php echo $row['disease_name']; ?></td>
            <td class="center"><?php echo $row['roi_name']; ?></td>
            <td class="center"><?php echo $row['significant']; ?></td>
            <td class="center"><?php echo $row['overexpression']; ?></td>
            <td class="center"><?php echo $row['underexpression']; ?></td>
            <td class="center"><?php echo $row['main_location']; ?></td>
          </tr>
          <?php
              } // end if else
            ++$count;
            } // end while
          ?>
        </tbody>

        <tfoot>
          <tr>
            <th>Tracer Name</th>
            <th>Modality</th>
            <th>Target Protein</th>
            <th>Gene Symbol</th>
            <th>Disease</th>
            <th>Region of Interest (ROI)</th>
            <th>Significant</th>
            <th>Overexpression</th>
            <th>Underexpression</th>
            <th>Subcellular Location</th>
          </tr>
        </tfoot>
      </table>

    </div>

    <script type="text/javascript">
      var asInitVals = new Array();
      var height = window.innerHeight * 5 / 7;

      $(document).ready( function () {
          var oTable =  $('#table_id').dataTable({
            "sScrollX": "100%",
            //"sScrollXInner": "110%",
            "bScrollCollapse": true,
            "bScrollInfinite": true,
            "iDisplayLength": 50,
            "sScrollY": height,

            "oLanguage": {
              "sSearch": "Search all columns:"
            }
          });

          $("thead input").keyup( function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter( this.value, $("thead input").index(this) );
          } );
     
          /*
            * Support functions to provide a little bit of 'user friendlyness' to the textboxes in
            * the footer
          */
          $("thead input").each( function (i) {
            asInitVals[i] = this.value;
          } );
     
          $("thead input").focus( function () {
            if ( this.className == "search_init" ) {
              this.className = "";
              this.value = "";
           }
          } );
     
          $("thead input").blur( function (i) {
            if ( this.value == "" ) {
              this.className = "search_init";
              this.value = asInitVals[$("thead input").index(this)];
            }
          } );

      } );
    </script>

  </body>
</html>